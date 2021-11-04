<?php

namespace Its\Lib\Geo;

class Polygon
{
    /** @var Polygon[] $holes */
    protected $holes = [];

    /** @var Point[] $coordinates */
    private $coordinates = [];

    /** @var string $hash */
    private $hash;

    public function __construct(array $coordinates)
    {
        foreach($coordinates as $coordinate) {
            $this->coordinates[] = new Point((float) $coordinate[1], (float) $coordinate[0]);
        }

        $this->hash = md5(serialize($this->coordinates));
    }

    public static function fetchCoordinatesFromGeojson(array $geojson): array
    {
        $feature = $geojson['features'] ? current($geojson['features']) : null;

        if(
            $feature
            && $feature['geometry']
            && $feature['geometry']['coordinates']
            && is_array($feature['geometry']['coordinates'])
        ) {
            return $feature['geometry']['coordinates'];
        }

        return [];
    }

    public static function createPolygonFromGeojson(array $geojson): self
    {
        $coordinatesArray = self::fetchCoordinatesFromGeojson($geojson);
        $coordinates = array_shift($coordinatesArray);

        $mainObject = new self($coordinates ?? []);

        /**
         * RFC 7946
         * (3.1.6. Polygon)
         * For type "Polygon", the "coordinates" member MUST be an array of linear ring coordinate arrays.
         *
         * (A.3.  Polygons)
         * The first element in the array represents the exterior ring.  Any subsequent elements represent interior rings (or holes).
         */
        foreach($coordinatesArray as $coordinate) {
            $mainObject->addHole(new self($coordinate));
        }

        return $mainObject;
    }

    public function addHole(Polygon $polygon): void
    {
        $this->holes[$polygon->getHash()] = $polygon;
    }

    public function removeHoleByHash(string $hash): void {
        if(array_key_exists($hash, $this->holes)) {
            unset($this->holes[$hash]);
        }
    }

    /**
     * Возвращает хэш полигона или хэш одного из полигонов семейства в которых точка находится,
     * либо null в случае, если точка не принадлежит ни одномк из полигонов
     * @param Point $point
     * @return bool
     */
    public function isContentsPoint(Point $point): bool
    {
        if(!$this->checkIfPolygonContentsPoint($point)) {
            return false;
        }

        foreach ($this->holes as $hole) {
            if($hole->isContentsPoint($point)) {
                return false;
            }
        }

        return true;
    }

    private function checkIfPolygonContentsPoint(Point $pointObject): bool
    {
        $contents = false;
        $polygonPointsCount = count($this->coordinates);

        for ($i = 0, $j = $polygonPointsCount - 1 ; $i < $polygonPointsCount; $j = $i++) {
            if (
                ($this->coordinates[$i]->getLatitude() > $pointObject->getLatitude() !== ($this->coordinates[$j]->getLatitude() > $pointObject->getLatitude()))
                &&
                (
                    $pointObject->getLongitude()
                    <
                    ($this->coordinates[$j]->getLongitude() - $this->coordinates[$i]->getLongitude()) * ($pointObject->getLatitude() - $this->coordinates[$i]->getLatitude()) / ($this->coordinates[$j]->getLatitude() - $this->coordinates[$i]->getLatitude()) + $this->coordinates[$i]->getLongitude()
                )
            ) {
                $contents = !$contents;
            }
        }

        return $contents;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }
}

<?

namespace Its\Lib\Asset;

use Bitrix\Main\Context;

class AssetManager
{
    public const TYPE_STRING = 0;
    public const TYPE_CSS = 1;
    public const TYPE_JS = 2;

    /** @var AssetManager */
    private static $instance = null;

    private $assets = [];

    private static $counter = 0;
    private $unique = 0;

    private $innerAssets = false;
    private $debug = false;

    public function __construct()
    {
        $this->unique = ++self::$counter;
    }

    public static function getInstance(): AssetManager
    {
        if (!(self::$instance instanceof AssetManager)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function escapeType(int $type): int
    {
        if ($type === self::TYPE_JS || $type === self::TYPE_CSS) {
            return $type;
        }

        return self::TYPE_STRING;
    }

    public function showInnerAsset(bool $show): void
    {
        $this->innerAssets = $show;
    }

    public function showHead(): void
    {
        global $APPLICATION;

        $charset = LANG_CHARSET;

        echo "<meta charset='{$charset}'>\n";
        $APPLICATION->ShowMeta("robots", false, false);
        $APPLICATION->ShowMeta("keywords", false, false);
        $APPLICATION->ShowMeta("description", false, false);
        $APPLICATION->ShowLink("canonical", null, false);

        if ($this->innerAssets) {
            $APPLICATION->ShowCSS(true, false);
            $APPLICATION->ShowHeadStrings();
            $APPLICATION->ShowHeadScripts();
        }

        $APPLICATION->AddBufferContent([&$this, 'getAssets']);
    }

    public function getUnique(): string
    {
        return md5($this->unique);
    }

    public function setDebug(bool $enable): void
    {
        $this->debug = $enable;
    }

    public function add(string $source, int $type = self::TYPE_STRING, int $sort = 100): AssetItem
    {
        $type = static::escapeType($type);
        $index = md5($source);
        $this->assets[$type][$index] = new AssetItem($source, $type, $sort);
        $asset = &$this->assets[$type][$index];

        return $asset;
    }

    public function addJs(string $path, int $sort = 100): AssetItem
    {
        return $this->add($path, self::TYPE_JS, $sort);
    }

    public function addCss(string $path, int $sort = 100): AssetItem
    {
        return $this->add($path, self::TYPE_CSS, $sort);
    }

    public function getAssets(): string
    {
        $start = microtime(true);

        $assets = implode("\n\n", [
            $this->getAssetHtml(self::TYPE_CSS),
            $this->getAssetHtml(self::TYPE_JS),
            $this->getAssetHtml(self::TYPE_STRING),
        ]);

        $total = microtime(true) - $start;

        if ($this->debug) {
            return "{$assets}\n<!-- Total assets time {$total} -->\n";
        }

        return $assets;
    }

    private function sortAssets(array &$collection): void
    {
        uasort($collection, [&$this, 'sortHandler']);
    }

    public function sortHandler(AssetItem $a, AssetItem $b): int
    {
        if ($a->getSort() == $b->getSort()) {
            return 0;
        }

        return ($a->getSort() < $b->getSort()) ? -1 : 1;
    }

    private function getAssetHtml(int $type): string
    {
        $collection = $this->assets[$type] ?? [];
        $this->sortAssets($collection);

        $requestUri = Context::getCurrent()->getServer()->getRequestUri();

        $result = [];
        foreach ($collection as $item) {
            /** @var AssetItem $item */
            if (!$item->isValid()) {
                continue;
            }

            if (mb_strlen($item->getPattern()) > 0) {
                if (preg_match($item->getPattern(), $requestUri) !== 1) {
                    continue;
                }
            }

            $attr = '';

            if ($type !== self::TYPE_STRING) {
                $arAttr = [];
                foreach ($item->getAttributes() as $name => $value) {
                    $arAttr[] = is_null($value) ? $name : "{$name}='{$value}'";
                }

                $attr = implode(' ', $arAttr);
            }

            switch ($type) {
                case self::TYPE_JS:
                    $result[] = "<script type='text/javascript' src='{$item->getPath()}' {$attr}></script>";
                    break;

                case self::TYPE_CSS:
                    $result[] = "<link rel='stylesheet' href='{$item->getPath()}' {$attr}>";
                    break;

                default:
                    $result[] = $item->getSource();
                    break;
            }
        }

        return implode("\n", $result);
    }
}

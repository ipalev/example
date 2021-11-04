<?

namespace Its\lib\Asset;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Path;

class AssetItem
{
    private $type = 0;
    private $source = '';
    private $sort = 0;

    private $attributes = [];
    private $pattern = '';

    private $external = false;
    private $relative = '';
    private $hash = '';

    public function __construct(string $source, int $type = AssetManager::TYPE_STRING, int $sort = 100)
    {
        $this->type = AssetManager::escapeType($type);
        $this->source = $source;
        $this->sort = $sort;
    }

    public function setAttribute(string $key, string $value = null): AssetItem
    {
        $key = preg_replace('/[^a-z0-9_-]/i', '', $key);
        $value = preg_replace('/[^а-яa-z0-9 _#;:|&?-]/i', '', $key);

        if (in_array($key, ['src', 'href', 'rel', 'type'])) {
            return $this;
        }

        $this->attributes[$key] = $value;
        return $this;
    }

    public function skipMove(): AssetItem
    {
        if ($this->type === AssetManager::TYPE_JS) {
            $this->setAttribute('data-skip-moving', 'true');
        }

        return $this;
    }

    public function defer(): AssetItem
    {
        if ($this->type === AssetManager::TYPE_JS) {
            $this->setAttribute('defer');
        }

        return $this;
    }

    public function for(string $pattern): AssetItem
    {
        $this->pattern = $pattern;
        return $this;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    private static function clearPath(string $path)
    {
        if (($p = mb_strpos($path, "?")) > 0) {
            $path = mb_substr($path, 0, $p);
        }

        return $path;
    }

    public function isValid(): bool
    {
        if ($this->type === AssetManager::TYPE_STRING) {
            return !empty($this->source);
        }

        if (\CMain::IsExternalLink($this->source)) {
            $this->external = true;
            return true;
        }

        $this->relative = static::clearPath($this->source);

        if (!Path::validate($this->relative)) {
            return false;
        }

        $absolute = realpath(Application::getDocumentRoot() . '/' . ltrim($this->relative, '\\/'));

        if (!file_exists($absolute) || is_dir($absolute)) {
            return false;
        }

        $this->hash = hash_file('md5', $absolute);

        return true;
    }

    public function getPath(): string
    {
        if (!$this->isValid()) {
            return '';
        }

        if ($this->external) {
            return $this->source;
        }

        return "{$this->relative}?v={$this->hash}";
    }

    public function getSource(): string
    {
        return $this->source;
    }
}

<?php

namespace Its\Lib;

class Sizes {
  
    const CATALOG_ITEM = ['width' => 300, 'height' => 300];
    const CATALOG_SECTION_BAR = ['width' => 150, 'height' => 150];
    const CATALOG_ELEMENT = ['width' => 800, 'height' => 800];
    const CATALOG_THUMB = ['width' => 107, 'height' => 107];

    const ORDER_THUMB = ['width' => 150, 'height' => 150];

    public static function resize (
        int $imageId,
        array $size,
        int $type = BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
        string $defaultImagePath = Constant::NOIMG_COMMON
    )
    {
        if($imageId <= 0) return $defaultImagePath;

        $resizedPath = \CFile::ResizeImageGet(
            $imageId, $size, $type, false,
            [['name' => 'sharpen', 'precision' => 0]]
        )['src'] ?? false;

        return $resizedPath ?: $defaultImagePath;
    }
}

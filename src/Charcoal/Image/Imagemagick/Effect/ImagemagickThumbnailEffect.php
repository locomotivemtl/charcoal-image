<?php

namespace Charcoal\Image\Imagemagick\Effect;

/**
 * Create a thumbnail with the Imagemagick driver.
 *
 * This is similar to {@see ImagemagickResizeEffect resize}, except it is optimized for speed.
 * See {@link http://www.imagemagick.org/script/command-line-options.php#thumbnail Thumbnail}
 * for complete details about the operator.
 */
class ImagemagickThumbnailEffect extends ImagemagickResizeEffect
{
    /**
     * Retrieve the resize operator.
     *
     * @return string
     */
    protected function resizeOperator()
    {
        return '-thumbnail';
    }
}

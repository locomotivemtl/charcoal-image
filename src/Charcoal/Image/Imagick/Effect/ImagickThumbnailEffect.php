<?php

namespace Charcoal\Image\Imagick\Effect;

use \Imagick;

/**
 * Resize Effect for the Imagick driver
 */
class ImagickThumbnailEffect extends ImagickResizeEffect
{
    /**
     * @param integer $width   The target width.
     * @param integer $height  The target height.
     * @param boolean $bestFit The "best_fit" flag.
     * @return void
     */
    protected function doResize($width, $height, $bestFit = false)
    {
        $mode = $this->mode();
        if ($mode == 'auto') {
            $mode = $this->autoMode();
        }

        if ($mode === 'crop') {
            $this->image()->imagick()->cropThumbnailImage($width, $height);
        } else {
            $this->image()->imagick()->thumbnailImage($width, $height, $bestFit);
        }
    }

    /**
     * @uses   self::processExactMode()
     * @return AbstractResizeEffect Chainable
     */
    protected function processCropMode()
    {
        return $this->processExactMode();
    }
}

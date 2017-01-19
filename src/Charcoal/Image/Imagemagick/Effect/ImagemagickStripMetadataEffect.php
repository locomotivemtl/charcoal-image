<?php

namespace Charcoal\Image\Imagemagick\Effect;

use \Exception;
use \Charcoal\Image\Effect\AbstractStripMetadataEffect;

class ImagemagickStripMetadataEffect extends AbstractStripMetadataEffect
{
    /**
     * Process the effect.
     *
     * @todo   Preserve orientation and {@link http://stackoverflow.com/a/17516878/140357 profiles}
     * @param  array $data
     * @return ImagemagickStripMetadataEffect Chainable
     */
    public function process(array $data = null)
    {
        if ($data !== null) {
            $this->setData($data);
        }

        $cmd = [];

        $this->preProcess($cmd);

        $cmd[] = '-strip';

        $this->postProcess($cmd);

        $this->image()->applyCmd(implode(' ', $cmd));

        return $this;
    }

    /**
     * Operations before processing.
     *
     * @param  array $cmd The CLI parameters to apply.
     * @return ImagickStripMetadataEffect Chainable
     */
    public function preProcess(array &$cmd = [])
    {
        foreach ($this->preserved() as $key) {
            switch ($key) {
                case 'orientation':
                    $cmd[] = '-auto-orient'
                    break;

                /*
                case 'icc':
                    $img = $this->image();
                    # $img->applyCmd('profile.icm');
                    if (!fileExists($img->tmp())) {
                        throw new Exception('No file');
                    }

                    $this->exec($this->convertCmd().' profile.icm');
                    break;
                */
            }
        }

        return $this;
    }

    /**
     * Operations after processing.
     *
     * @param  array $cmd The CLI parameters to apply.
     * @return ImagickStripMetadataEffect Chainable
     */
    public function postProcess(array &$cmd = [])
    {
        /*
        foreach ($this->preserved() as $key) {
            switch ($key) {
                case 'icc':
                    $cmd[] = '-profile profile.icm';
                    break;
            }
        }
        */

        return $this;
    }
}

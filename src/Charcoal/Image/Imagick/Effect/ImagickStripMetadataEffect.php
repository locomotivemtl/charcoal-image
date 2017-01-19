<?php

namespace Charcoal\Image\Imagick\Effect;

use \ImagickException;
use \Charcoal\Image\Effect\AbstractStripMetadataEffect;

class ImagickStripMetadataEffect extends AbstractStripMetadataEffect
{
    /**
     * Process the effect.
     *
     * @param  array $data
     * @return ImagickStripMetadataEffect Chainable
     */
    public function process(array $data = null)
    {
        if ($data !== null) {
            $this->setData($data);
        }

        $this->preProcess();

        $this->image()->imagick()->stripImage();

        $this->postProcess();

        return $this;
    }

    /**
     * Operations before processing.
     *
     * @return ImagickStripMetadataEffect Chainable
     */
    public function preProcess()
    {
        foreach ($this->preserved() as $key) {
            switch ($key) {
                case 'orientation':
                    try {
                        $orientation = $this->image()->imagick()->getImageOrientation();
                    } catch (ImagickException $e) {
                        $orientation = 0;
                    }

                    $this->setOrientation($orientation);
                    break;

                case 'icc':
                    try {
                        $profiles = $img->getImageProfiles('icc', true);
                    } catch (ImagickException $e) {
                        $profiles = [];
                    }

                    $this->setProfiles($profiles);
                    break;
            }
        }

        return $this;
    }

    /**
     * Operations after processing.
     *
     * @return ImagickStripMetadataEffect Chainable
     */
    public function postProcess()
    {
        foreach ($this->preserved() as $key) {
            switch ($key) {
                case 'orientation':
                    $orientation = $this->orientation();
                    if ($orientation) {
                        $this->image()->imagick()->setImageOrientation($orientation);
                    }
                    break;

                case 'icc':
                    $profiles = $this->profiles();
                    if (isset($profiles['icc'])) {
                        $this->image()->imagick()->profileImage('icc', $profiles['icc']);
                    }
                    break;
            }
        }

        return $this;
    }
}

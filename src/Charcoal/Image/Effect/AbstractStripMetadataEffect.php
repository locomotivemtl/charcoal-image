<?php

namespace Charcoal\Image\Effect;

use \InvalidArgumentException;

use \Charcoal\Image\AbstractEffect;

/**
 * Strips an image of all profiles and comments
 */
abstract class AbstractStripMetadataEffect extends AbstractEffect
{
    /**
     * The metadata to preseve.
     *
     * @var array
     */
    private $preserve = [];

    /**
     * The image's orientation.
     *
     * @var integer
     */
    private $orientation = 0;

    /**
     * The image's profiles.
     *
     * @var array
     */
    private $profiles = [];

    /**
     * Set the metadata to preseve.
     *
     * @param  array $keys One or more metadata keys.
     * @return AbstractStripMetadataEffect Chainable
     */
    public function setPreserve(array $keys)
    {
        $this->preserve = $keys;

        return $this;
    }

    /**
     * Retrieve the metadata to preseve.
     *
     * @return array
     */
    public function preserve()
    {
        return $this->preserve;
    }

    /**
     * Alias of {@see self::preserve()}.
     *
     * @return array
     */
    public function preserved()
    {
        return $this->preserve();
    }

    /**
     * Set the image orientation to preserve.
     *
     * @param  integer $orientation One of the
     *     {@link http://php.net/manual/en/imagick.constants.php#imagick.constants.orientation orientation constants}.
     * @return AbstractStripMetadataEffect Chainable
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * Retrieve the preserved image orientation.
     *
     * @return integer
     */
    public function orientation()
    {
        return $this->orientation;
    }

    /**
     * Set the image profiles to preserve.
     *
     * @param  array $profiles One or more image profiles.
     * @return AbstractStripMetadataEffect Chainable
     */
    public function setProfiles(array $profiles)
    {
        $this->profiles = $profiles;

        return $this;
    }

    /**
     * Retrieve the preserved image profiles.
     *
     * @return array
     */
    public function profiles()
    {
        return $this->profiles;
    }
}

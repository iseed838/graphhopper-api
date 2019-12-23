<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 06.06.19
 * Time: 17:29
 */

namespace Graphhopper\Traits;

/**
 * Base constructor
 * Trait Configurable
 */
trait ConfigurableTrait
{
    /**
     * Replace base constructor
     * ConfigurableTrait constructor.
     * @param array $properties
     */
    public function __construct($properties = [])
    {
        $this->configure($properties);
        $this->init();
    }

    /**
     * Loading class
     * @param $properties
     * @return static
     */
    public function configure($properties = []): self
    {
        if (!is_array($properties) || empty($properties)) {
            return $this;
        }
        foreach ($properties as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }

        return $this;
    }

    /**
     * Initialization class
     */
    public function init()
    {

    }
}
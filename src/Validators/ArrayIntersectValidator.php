<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 10:52
 */

namespace Graphhopper\Validators;


use Rakit\Validation\Rule;

class ArrayIntersectValidator extends Rule
{

    /** @var string */
    protected $message = "The :attribute item only allows :allowed_values";
    /** @var bool */
    protected $strict = false;

    /**
     * Given $params and assign the $this->params
     *
     * @param array $params
     * @return self
     */
    public function fillParameters(array $params): Rule
    {
        if (count($params) == 1 && is_array($params[0])) {
            $params = $params[0];
        }
        $this->params['allowed_values'] = $params;

        return $this;
    }

    /**
     * Set strict value
     *
     * @param bool $strict
     * @return void
     */
    public function strict(bool $strict = true)
    {
        $this->strict = $strict;
    }

    /**
     * Check value
     * @param $value
     * @return bool
     */
    public function check($value): bool
    {
        if (!is_array($value)) {
            return false;
        }
        $allowedValues = $this->parameter('allowed_values');
        foreach ($value as $item) {
            if (!in_array($item, $allowedValues)) {
                return false;
            }
        }

        return true;
    }
}
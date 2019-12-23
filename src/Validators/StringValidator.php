<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 10:52
 */

namespace Graphhopper\Validators;


use Rakit\Validation\Rule;

class StringValidator extends Rule
{

    /** @var bool */
    protected $implicit = true;

    /** @var string */
    protected $message = "The :attribute must be type of string";

    /**
     * @param $value
     * @return bool
     */
    public function check($value): bool
    {
        $this->requireParameters($this->fillableParams);
        if (empty($value)) {
            return true;
        }

        return is_string($value);
    }
}
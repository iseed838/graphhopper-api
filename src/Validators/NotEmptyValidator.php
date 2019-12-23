<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 10:52
 */

namespace Graphhopper\Validators;


use Rakit\Validation\Rule;

class NotEmptyValidator extends Rule
{

    /** @var bool */
    protected $implicit = true;

    /** @var string */
    protected $message = "The :attribute is empty";

    public function check($value): bool
    {
        return !empty($value);
    }
}
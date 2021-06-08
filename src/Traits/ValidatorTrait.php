<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 06.06.19
 * Time: 17:29
 */

namespace Graphhopper\Traits;

use Graphhopper\Exceptions\ValidException;
use Graphhopper\Validators\ArrayIntersectValidator;
use Graphhopper\Validators\NotEmptyValidator;
use Graphhopper\Validators\StringValidator;
use Rakit\Validation\RuleQuashException;
use Rakit\Validation\Validation;
use Rakit\Validation\Validator;

/**
 * Validate trait
 * Trait Configurable
 */
trait ValidatorTrait
{
    use ArrayableTrait;

    /**
     * Validate rules
     * @param array $rules
     * @param array $messages
     * @param Validator|null $validator
     * @return Validation
     * @throws RuleQuashException
     */
    public function validate(array $rules, array $messages = [], Validator $validator = null)
    {
        if (is_null($validator)) {
            $validator = new Validator();
        }
        $validator->addValidator('not_empty', new NotEmptyValidator());
        $validator->addValidator('string', new StringValidator());
        $validator->addValidator('in_array', new ArrayIntersectValidator());

        return $validator->validate($this->toArray(), $rules, $messages);
    }

    /**
     * Check validation rules
     * @param array $rules
     * @param array $messages
     * @param Validator|null $validator
     * @throws ValidException
     * @throws RuleQuashException
     */
    public function validateOrExcept(array $rules, array $messages = [], Validator $validator = null)
    {
        $validation = $this->validate($rules, $messages, $validator);
        if ($validation->fails()) {
            $errors = $validation->errors->firstOfAll();
            throw new ValidException(array_shift($errors));
        }
    }
}
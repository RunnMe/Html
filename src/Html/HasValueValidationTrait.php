<?php

namespace Runn\Html;

use Runn\Core\Exceptions;
use Runn\Validation\Validator;
use Runn\Validation\Validators\PassThruValidator;

/**
 * Trait for elements that have value, it's validation and store errors
 *
 * Trait HasValueValidationTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\HasValueValidationInterface
 * @implements \Runn\Html\HasValueInterface
 * @implements \Runn\Validation\ValidatorAwareInterface
 */
trait HasValueValidationTrait
    /*implements HasValueValidationInterface*/
{

    use HasValueTrait {
        setValue as traitHasValueSetValue;
    }

    /**
     * @var \Runn\Validation\Validator
     */
    protected $validator;

    /**
     * @var \Runn\Html\ValidationErrors
     */
    protected $errors;

    /**
     * @param Validator|null $validator
     * @return $this
     */
    public function setValidator(?Validator $validator)
    {
        $this->validator = $validator;
        return $this;
    }

    /**
     * @return \Runn\Validation\Validator
     */
    public function getValidator(): Validator
    {
        return $this->validator ?? new PassThruValidator;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->traitHasValueSetValue($value);
        $this->validate();
    }

    /**
     * Makes value validation
     *
     * Returns true if there are no validation errors, false otherwise
     * @return bool
     */
    public function validate(): bool
    {
        $this->errors = new ValidationErrors;

        $validator = $this->getValidator();
        $value = $this->getValue();

        try {
            $result = $validator($value);
            if (!$result) {
                $this->errors[] = new ValidationError($this, $value);
            }
        } catch (Exceptions $errors) {
            foreach ($errors as $error) {
                $this->errors[] = new ValidationError($this, $value, $error->getMessage(), $error->getCode(), $error);
            }
        } catch (\Throwable $error) {
            $this->errors[] = new ValidationError($this, $value, $error->getMessage(), $error->getCode(), $error);
        }

        return $this->errors->empty();
    }

    /**
     * Returns validation errors collection
     *
     * @return \Runn\Html\ValidationErrors
     */
    public function errors(): ValidationErrors
    {
        return $this->errors ?? new ValidationErrors;
    }

}

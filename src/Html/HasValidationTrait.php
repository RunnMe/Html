<?php

namespace Runn\Html;

use Runn\Core\Exceptions;
use Runn\Validation\Validator;
use Runn\Validation\Validators\PassThruValidator;

trait HasValidationTrait
    /*implements HasValidationInterface*/
{

    use HasValueTrait {
        setValue as traitSetValue;
    }

    /**
     * @var \Runn\Html\ValidationErrors
     */
    protected $errors;

    /**
     * @return \Runn\Validation\Validator
     */
    protected function getValidator(): Validator
    {
        return new PassThruValidator;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->traitSetValue($value);
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
        } catch (Exceptions $errors) {
            foreach ($errors as $error) {
                $this->errors[] = new ValidationError($this, $value, $error->getMessage(), $error->getCode());
            }
        } catch (\Throwable $error) {
            $this->errors[] = new ValidationError($this, $value, $error->getMessage(), $error->getCode());
        } finally {
            if (isset($result) && ($result instanceof \Generator)) {
                foreach ($result as $error) {
                    $this->errors[] = new ValidationError($this, $value, $error->getMessage(), $error->getCode());
                }
            }
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

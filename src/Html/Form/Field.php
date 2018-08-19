<?php

namespace Runn\Html\Form;

use Runn\Html\HasAttributesInterface;
use Runn\Html\HasAttributesTrait;
use Runn\Html\HasNameInterface;
use Runn\Html\HasNameTrait;
use Runn\Html\HasOptionsInterface;
use Runn\Html\HasOptionsTrait;
use Runn\Html\HasTitleInterface;
use Runn\Html\HasTitleTrait;
use Runn\Html\HasValueInterface;
use Runn\Html\HasValueValidationInterface;
use Runn\Html\HasValueValidationTrait;

/**
 * Abstract form field class
 *
 * Class Field
 * @package Runn\Html\Form
 */
abstract class Field
    implements FormElementInterface, HasOptionsInterface, HasAttributesInterface, HasTitleInterface, HasNameInterface, HasValueInterface, HasValueValidationInterface
{

    use FormElementTrait;

    use HasOptionsTrait;

    use HasAttributesTrait;

    use HasTitleTrait {
        setTitle as protected traitSetTitle;
    }

    use HasNameTrait {
        setName as protected traitSetName;
    }

    use HasValueValidationTrait {
        setValue as protected traitSetValue;
    }

    /**
     * @param string|null $name
     * @param string|null $value
     * @param iterable $attributes
     * @param iterable $options
     *
     * @7.1
     */
    public function __construct(string $name = null, $value = null, /*iterable */$attributes = null, /*iterable */$options = null)
    {
        $this->setAttributes($attributes);
        $this->setOptions($options);
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * @param string|null $name
     * @return $this
     *
     * @7.1
     */
    public function setName(/*?*/string $name = null)
    {
        $this->setAttribute('name', $name);
        $this->traitSetName($name);
        return $this;
    }

    /**
     * @param string|null $title
     * @return \Runn\Html\Form\Field $this
     *
     * @7.1
     */
    public function setTitle(/*?*/string $title = null)
    {
        $this->setAttribute('title', $title);
        $this->traitSetTitle($title);
        return $this;
    }

    /**
     * @param \Runn\ValueObjects\SingleValueObject|string $val
     * @return \Runn\Html\Form\Field $this
     */
    public function setValue($val)
    {
        $this->setOption('value', $val);
        $this->traitSetValue($val);
        return $this;
    }

    protected function escape(string $val): string
    {
        return htmlspecialchars($val, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

}

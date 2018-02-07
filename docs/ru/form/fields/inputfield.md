Элемент формы InputField
========================

Класс `Runn\Html\Form\Fields\InputField` является объектным представлением элемента HTML `<input>` в PHP.

Предок
------

Класс `Runn\Html\Form\Fields\InputField` наследуется от класса [`Runn\Html\Form\Field`](../field.md)

Особенности
-----------

В классе заданы специализированные методы:
* `public function setType(string $type)` 
* `public function getType(): ?string`

позволяющие управлять атрибутом `type` элемента.

Например, следующий код

```php
$field = (new InputField('foo', 'bar'))->setType('text');
$field->render();
```
отобразит примерно такой вывод:
```html
<input type="text" name="foo" value="bar">
```

Потомки
-------

В свою очередь от класса `InputField` наследуется множество классов конкретных элементов ввода форм:

* [CheckboxField](./checkboxfield.md)
    * [BooleanField](./booleanfield.md)
    * [TernaryField](./ternaryfield.md)
* [DateField](./datefield.md)
* [FileField](./filefield.md)
* [HiddenField](./hiddenfield.md)
* [InputField](./inputfield.md)
* [NumberField](./numberfield.md)
* [PasswordField](./passwordfield.md)
* [TextField](./textfield.md)

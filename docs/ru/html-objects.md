Интерфейсы и трейты HTML-объектов
=================================

Для корректной объектно-ориентированной реализации элементов HTML, библиотека Runn Me! HTML определяет ряд важных 
интерфейсов и их стандартных реализаций в виде трейтов.

`HasAttributesInterface` и `HasAttributesTrait`
-------------------------------------------

Интерфейс и его стандартная реализация, задающие поведение объектов, отображающих HTML-элементы, имеющих атрибуты (то есть, в общем-то, все элементы HTML).
 
Пример использования:
```php
class Div implements HasAttributesInterface
{
  use HasAttributesTrait;
}
 
$div = new Div;
$div->setAttributes(['id' => 'someid', 'class' => 'someclass']);
$div->setAttribute('data-foo', 'bar');
 
assert('someid' === $div->getAttribute('id'));
assert('someclass' === $div->getAttribute('class'));
assert('bar' === $div->getAttribute('data-foo'));
 
assert('someid' === $div->getAttributes()->id);
...
```
 
`HasNameInterface` и `HasNameTrait`
-----------------------------------
Несмотря на то, что имя, к примеру, поля формы, это один из ее атрибутов, интерфейс и трейт, задающие поведение объекта, 
имеющего имя, вынесены отдельно.

Пример использования:

```php
class Field implements HasNameInterface
{
  use HasNameTrait;
}
 
$field = new Field;
$field->setName('foo');
 
assert('foo' === $field->getName());
```

`HasValueInterface` и `HasValueTrait`
-------------------------------------

Аналогично библиотека Runn Me! HTML поступает и с объектами, имеющими значение, например - с полями форм.
Их поведение также вынесено в отдельные интерфейс и стандартный трейт.

Пример использования:
```php
class Field implements HasValueInterface
{
  use HasValueTrait;
}
 
$field = new Field;
$field->setValue('foo');
 
assert('foo' === $field->getValue());
```
 
`HasTitleInterface` и `HasTitleTrait`
-------------------------------------

Данный интерфейс и трейт задают поведение и стандарт реализации для объектов, имеющих заголовок. Ими могут быть 
поля форм, группы полей, сами формы и, в общем-то, любые HTML-объекты.

Пример использования:
```php
class Field implements HasTitleInterface
{
  use HasTitleTrait;
}
 
$field = new Field;
$field->setTitle('Foo!');
 
assert('Foo!' === $field->getTitle());
```

`HasOptionsInterface` и `HasOptionsTrait`
-----------------------------------------
 
Интерфейс и его стандартная реализация, задающие поведение объектов, имеющих какие-либо настройки 
(в случае HTML-элементов это те опции, которые нельзя напрямик выразить атрибутами тега элемента).
 
Пример использования:
```php
class Elemenet implements HasOptionsInterface
{
  use HasOptionsTrait;
}
 
$el = new Elemenet;
$el->setOptions(['foo' => '12', 'bar' => 34]);
$el->setOption('baz', 'bla');
 
assert('12' === $el->getOption('foo'));
assert(34 === $el->getOption('bar'));
assert('bla' === $el->getOption('baz'));
 
assert('12' === $el->getOptions()->foo);
```

7.2.4, 7.3.4, 7.4.4
===================
* Улучшения в `HasAttributesInterface` и `HasAttributesTrait`
* Улучшения в `HasNameTrait`
* Улучшения в `HasOptionsInterface` и `HasOptionsTrait`
* Улучшения в `HasTitleTrait`
* Улучшения в `HasValueTrait`

7.2.3, 7.3.3, 7.4.3
===================
* Добавлено получение значений элементов в виде объектов-значений
* Исправлена ошибка заполнения значений в классе `Elements group`

7.2.2, 7.3.2, 7.4.2
===================
* Прекращена поддержка PHP 7.0
* Прекращена поддержка PHP 7.1
* Добавлена поддержка PHP 7.4

7.0.1, 7.1.1, 7.2.1
===================
* Обновлен идентификатор лицензии библиотеки

7.0.0, 7.1.0, 7.2.0
===================
* Первая релизная версия. Перенос кода из проекта Running.FM
* Добавлены `RendererInterface` и класс `NativeRenderer`
* Добавлены интерфейс `RendererAwareInterface` и его эталонная реализация `RendererAwareTrait`
* Добавлены интерфейс `HasTemplateInterface` и его эталонная реализация `HasTemplateTrait`
* Добавлены интерфейс `ElementHasParentInterface` и его эталонная реализация `ElementHasParentTrait`
* Улучшена подсистема рендеринга
* Добавлен абстрактный класс `Button`, его реализации `SubmitButton`, `ResetButton`
* Добавлены методы `Form::action()` и `Form::method()`
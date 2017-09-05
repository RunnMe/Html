Быстрый старт
=============

Библиотека "Runn Me! HTML" предназначена для работы с HTML-кодом в ОПП-стиле из языка PHP. 

Основные задачи, которые решает библиотека:

* Предоставление программисту различных интерфейсов и их эталонных реализаций, позволяющих строить объектное представление элементов HTML 
* Объектное представление HTML-форм, их элементов и комбинаций элементов форм
* Интерфейс RendererInterface и его эталонная реализация NativeRenderer, позволяющая рендерить шаблоны, написанные на языке PHP

Пример использования
--------------------
Ниже приведен простейший пример использования библиотеки для отображения формы входа на сайт:

```php
use \Runn\Html\Form\Form;
use \Runn\Html\Form\Fields\TextField;
use \Runn\Html\Form\Fields\PasswordField;
    
$form = new Form;
$form->setAttribute('action', 'index.php');

$form->login = new TextField();
$form->password = new PasswordField();

echo $form->render();
```

Результатом выполнения кода будет примерно такой текст:

```html
<form>
    <input type="text" name="login">
    <input type="password" name="password">
</form>
```
    
Тот же самый объект можно использовать не только для рендеринга HTML, 
но и для структурирования и валидации данных, 
полученных сервером извне (например - из HTML-формы методом POST):

```php
// $_POST = ['login' => 'test@test.com', 'password' => '123']

$form->setValue($_POST);
```
    
Метод setValue() передаст значения элементам формы, согласно их именам:
    
```php   
var_dump($form->getValue());
/*
array(2) {
  ["login"]=>string(13) "test@test.com"
  ["password"]=>string(3) "123"
}
*/
var_dump($form->login->getValue()); // string(13) "test@test.com"
var_dump($form->password->getValue()); // string(3) "123"

echo $form->render();
```

После выполнения последнего оператора мы получим "заполненную" форму:

```html   
<form action="index.php">
    <input type="text" name="login" value="test@test.com">
    <input type="password" name="password" value="123">
</form>
```
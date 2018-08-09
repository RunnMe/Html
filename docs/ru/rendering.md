Рендеринг
=========

Библиотека Runn Me! HTML основана на концепции рендеринга - превращения объектов языка PHP в их текстовые представления 
с помощью шаблонов.

Реализация рендеринга начинается со следующих интерфейсов и трейтов:

`\Runn\Html\Rendering\RendererInterface`
------------------------------
Интерфейс, задающий список методов "движков рендеринга". Состоит из единственного метода публичного метода `render()` 
с двумя аргументами:
- `$template`: шаблон, объект, реализующий интерфейс `Runn\Storages\SingleValueStorageInterface` (например - объект 
класса `\Runn\Fs\File`)
- `$data`: необязательный, данные, которые нужно передать в шаблон перед рендерингом.

`Runn\Html\Rendering\Renderers\NativeRenderer`
------------------------------------
Класс, реализующий "ванильный" движок рендеринга, использующий PHP в качестве шаблонизатора. Включен в состав библиотеки, 
как эталонная реализация интерфейса `\Runn\Html\RendererInterface`

Пользоваться им достаточно просто, см. пример ниже: 

```php
// template.php:

<h1><?php echo $title; ?></h1>
<article><?php echo $contents; ?></article>

// index.php:

$renderer = new NativeRenderer;
echo 
    $renderer->render(new File(__DIR__ . '/template.php', [
        'title' => 'Заголовок',
        'contents' => 'Текст',
    ]);

```

В результате выполнения этого кода мы увидим:
```html
<h1>Заголовок</h1>
<article>Текст</article>
```

Данные были переданы в шаблон в виде локальных переменных шаблона, шаблон проинтерпретирован и результат возвращен 
из метода `render()`.

_N.B. `NativeRenderer` поддерживает передачу параметра `'this'`. Если этот параметр не будет указан в данных, 
передаваемых в шаблон, псевдопеременная `$this` будет связана с самим объектом класса `NativeRenderer`._ 

Другие интерфейсы, трейты и классы
----------------------------------

`namespace \Runn\Html\Rendering`:
- `HasTemplateInterface` и `HasTemplateTrait`: интерфейс и стандартная его реализация для объекта, располагающего шаблоном;
`namespace \Runn\Html\Rendering`:
- `RendererAwareInterface` и `RendererAwareTrait`: интерфейс и стандартная его реализация для объекта, имеющего движок 
рендеринга в качестве зависимости;
- `RenderableInterface extends RendererAwareInterface, HasTemplateInterface` и `RenderableTrait` - интерфейс и его 
стандартная реализация для объектов, умеющих рендерить самое себя.
 
Пример использования
--------------------

Благодаря высокой степени готовности указанные интерфейсы и трейты можно использовать в своём коде непосредственно.

Рассмотрим пример: у нас есть объект "статья" с двумям полями `$title` и `$contents` и нам требуется обеспечить отображение 
этого объекта в HTML.

Класс объекта, файл Article.php:
```php
use Runn\Html\Rendering\RenderableInterface;
use Runn\Html\Rendering\RenderableTrait;

class Article implements RenderableInterface
{

  use RenderableTrait;
  
  public $title;
  public $contents; 
  
}
```

Шаблон, файл `Article.template.php`, находящийся в той же папке (место и имя для шаблона по умолчанию):
```php
<h1><?php echo $this->title; ?></h1>
<article><?php echo $this->contents; ?></article>
```

Код, демонстрирующий работу рендеринга:
```php
$article = new Article;
$article->title = 'Заголовок';
$article->contents = 'Текст';
echo $article->render();
```

Результат работы:
```html
<h1>Заголовок</h1>
<article>Текст</article>
```
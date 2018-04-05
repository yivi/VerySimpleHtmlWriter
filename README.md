# VerySimpleHtmlWriter

No safety belt. No speed limit. No parachute. No nothing. This is an HTML party and sanitizers and error checkers are not invited. XSS gallore!

I wanted a quick way to generate HTML for a simple project. You shouldn't be using this anywhere unless you know what you are doing and why you are doing it. Even then, you _shouldn't_.

## Usage (very alpha, much changing):

```php
$writer        = new HtmlWriterService();
$main_layout   = $writer->layout('main');

$openBody      = $writer->tag('body')->leaveOpen();
$title         = $writer->fragment('hello, world!');
$h1            = $writer->tag('h1')->content($title);

$main_layout->addParts($openBody, $h1);

$ul_nav        = $writer->tag('ul')
                      ->attribute('role', 'navigation')
                      ->addClass('navigation')
                      ->id('navigation');

$nav_li_layout = $writer->layout('nav');

$li_home       = $writer->tag('li')->content($writer->fragment('Home'));
$li_contact    = $writer->tag('li')->content($writer->fragment('Contact'));
$li_about      = $writer->tag('li')->content($writer->fragment('About'));

$nav_li_layout->addParts($li_home, $li_contact, $li_about);

$ul_nav->content($nav_li_layout);

$closeBody     = $writer->tag('body')->justClose();

$main_layout->addParts($ul_nav, $closeBody)

echo $main_layout->compile();
 
```
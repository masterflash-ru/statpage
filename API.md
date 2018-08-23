API Просто страницы

Используется пространство имен Mf\Statpage.


Сервис Mf\Statpage\Statpage

Вызов | описание
------|--------------
LoadFromUrl($url):string | Получить контент опубликованной страницы по url
 LoadFromSysname($name):string | Получить контент опубликованной страницы по системному имени страницы
 LoadFromId($id):string | Получить контент опубликованной страницы по внутреннему идентификатору
 getMap():array | Возвращает массив страниц которые будут добавлены в карту сайта, исключаются запрещеные к индексации и не канонические страницы
 getMaxLastMod():object | Возвращает объект в котором записана последняя дата модификации страниц и кол-во опубликованных страниц
 SetPageType(int $page_type):void | Устанавливает тип считываемых страниц, номера статусов проверяются из конфига
 GetPageType():int | Возвращает номер статуса считываемых страниц на данный момент
 SetLocale($locale=NULL):void | Устанавливает локаль страниц, проверяется на допустимость локали, по умолчанию стоит ru_RU, null - ничего не делать
 GetLocale():string | Получить строку текущей локали
 GetDefaultLocale():string | Получить строку локали принятой по умолчанию в конфиге
 getServerDefaultUri():string | Получить канонический адрес сайта, берется из конфига приложения
 
Помощник Mf\Statpage\View\Helper

Опции по умолчанию:
```php
protected $options=[
    "locale"=>"ru_RU",			//имя локали
    "pageType"=>2,				//тип страниц для извлечения, 2
    "errMode"=>"empty",			//тип обработки ошибок,empty - вернуть "" (по умолчанию), exception - исключение
    "seo" => false,             //заполнять СЕО-теги извлекаемой страницы, по умолчанию false (нет)
  ];
```
Вызов | описание
------|--------------
__invoke($sysname = null,array $options=[]) | Магический метод при обращении из сценария вывода. При $sysname = null - возвращается экземпляр данного объекта, $options - опции. 
setOptions(array $options=[]) | Установить опции (склеить с дефолтными), возвращает сам объект
setOption($name,$value) | Установить отдельную опцию по имени
getOptions():array | Возвращает массив установленных опций
getPage($sysname):string | Возвращает контент страницы

Помощник Mf\Statpage\Controller\Plugin
Опции по умолчанию:
```php
protected $options=[
    "locale"=>"ru_RU",			//имя локали
    "pageType"=>2,				//тип страниц для извлечения, 2
    "errMode"=>"empty",			//тип обработки ошибок,empty - вернуть "" (по умолчанию), exception - исключение
  ];
```
Все вызовы полностью соответсвуют помощнику Mf\Statpage\View\Helper


Стандартное использование это встроеный контроллер для обработки запросов. По умолчанию устанавливается маршрут
```php
            'page_ru_RU' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/page/:page',
                    'constraints' => [
                        'page' => '[a-zA-Z0-9_-]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                        'locale'	=> 'ru_RU'
                    ],
                ],
            ],

```
Контроллер обратаывает запросы вида /page/URL_страницы, страницы должны быть опубликованы, иметь статус 1.
По умолчанию устанавливается следующая конфигурация:
```php
    "statpage"=>[
        'tpl'=>[                                  //пользовательские шаблоны вывода контента
        ],
        'layout'=>[                               //имена макетов которые имеются в приложении
        ],
        'media_folder'=>"media",                  //имя папки в public для размещения медиаматериала стат.страниц
        'status'=>[
            0=>"Не опубликовано",
            1=>"Опубликовано",
            2=>"Для внутренних целей",
        ],
        "defaultStatus"=>1,                     //код статуса по умолчанию (опубликовано)
    ],

    "locale_default"=>"ru_RU",
    "locale_enable_list"=>["ru_RU"],
    /*Канонический адрес сайта*/
    "ServerDefaultUri"=>"http://".trim($_SERVER["SERVER_NAME"],"w."),

```
При необходимости ваше приложение может установить свою конфигурацию:
'tpl' - массив сценариев вывода страниц сайта, например, "application/statpage/1"=>"Шаблон 1", обратите внимание, ключ это путь в терминологии Zend Framework
'layout' - массив layout макетов сайта, каждую страницу можно связать с отдельным макетом, пути так же как и в параметре 'tpl'
'status' - вы можете добавить свои статусы, например, сообщения регистрированным посетителям.
Остальные параметры как правило повторяются во всех наших пакетах, вы их можете задать в своем приложении.
"ServerDefaultUri" - используется для генерации канонических ссылок.


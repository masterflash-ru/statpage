Просто страницы
выводит не связанные страницы в системе управления Simba

Установка
1. composer require masterflash-ru/statpage
2. загрузить дамп install.sql в mysql базу приложения в из папки data
3. в админке создать пункт меню, например, "Просто страницы", привязать к этому пункту /adm/line/statpage
4. если вы переходите от версий 1.0 выполните update_1.0_to_1.1.sql для добавления новых полей в таблицы.

Создать новый конфиг в замен дефолтному при необходимости в конфиге вашего приложения:
```php
	"statpage"=>[
		'tpl'=>[                                  //пользовательские шаблоны вывода контента, если нужны, пусто - по умолчанию, используется внутренний
            "application/statpage/1"=>"Шаблон 1",
        ],
        'layout'=>[                               //имена макетов которые имеются в приложении, если нужны, пусто - по умолчанию
            "layout/layout_glav"=>"Главная страница",
        ],
		'media_folder'=>"media",                  //имя папки в public для размещения медиаматериала стат.страниц, это значение по умолчанию
		'status'=>[                               //статусы страниц (по умолчанию используются эти)
			0=>"Не опубликовано",
			1=>"Опубликовано",
			2=>"Для внутренних целей",
		],
        "defaultStatus"=>1,                     //код статуса по умолчанию (опубликовано)
	],
```
Как правило достаточно указать новые сценарии вывода - это параметр tpl и новые статусы, которые можно использовать в других модулях-расширениях.
Если используется новый сценарий вывода, то он должен самостоятельно создавать все метатеги, пример все этого можно посмотреть в стандартном сценарии данного пакета.
Новый сценарий вывода применяется только в контроллере данного пакета, т.е., по умолчанию по адресам страниц /page/url_страницы, в помощниках данный параметр не используется.
layout указывается по аналогии с tpl, это позволяет выводить страницы в макетах отличных от стандартного, обратите внимание на пути! это не пути к файлам в буквальном смысле!

просто страницы доступны по адресу /page/URL_страницы (только имеющие статус 2 - опубликованные)

Создается помощник для view:
обязательный параметр только первый - системное имя страницы
```php
$this->statpage("Системное имя страницы" ,$options)
```

Опции в помощник, массив:
locale - строка локали, по умолчанию "ru_RU",
page_type  - тип страницы, по умолчанию 2, 
seo - заполнять СЕО-теги извлекаемой страницы, по умолчанию false (нет) (ОСТОРОЖНО! можно получить задвоение метатегов!)
err_mode - что делать если страница не найдена: empty (по умолчанию) - вернуть пустую строку, exception - исключение

Аналогично создается плагин контроллера, для чтения каких-либо страниц внутри конроллера, например, уведомлений посетителю при регистрации.
Все работает в точности как же как и помощник в view.

Для генерации карты сайта (sitemap) используется пакет masterflash-ru/sitemap, для его работы уже готовы и инициализированы нужные вызовы.
В карте публикуется только страницы имеющие статус 2 (опубликованные, и не запрещенные к индексации, и не отмеченные как не канонические)

Параметры СЕО передаются в сценарий вывода, там создаются нужные элементы для указания что страницу нельзя индексировать или ссылка на каноническую страницу.

Если установлен пакет локального поиска, тогда в локальный поисковый индекс передается текст страницы и ее URL. 
Проверка наличия локального индексатора и передача в него информации производится в сценарии вывода, поэтому если вы используете свой сценарий это нужно учесть.


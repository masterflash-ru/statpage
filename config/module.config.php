<?php
/**
работа с просто страницами
 */

namespace Mf\Statpage;

use Zend\Router\Http\Segment;

/*
для других языков создайте дополнительные маршрутя по аналогии с ru_RU
обязательно в имени маршрута должна быть локаль
*/

return [
	//маршруты
    'router' => [
        'routes' => [
			
			//маршрут для варианта с одним языком
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
	    ],
    ],
	//контроллеры
    'controllers' => [
        'factories' => [
			//если мы используем нашу фабрику вызова, класс должен включать интерфейс FactoryInterface
			Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,	
        ],
	],

	'service_manager' => [
			'factories' => [//сервисы-фабрики
				Service\Statpage::class => Service\Factory\StatpageFactory::class,
				Service\GetControllersInfo::class => Service\Factory\GetControllersInfoFactory::class,
                Service\GetMap::class => Service\Factory\GetMapFactory::class,
			],
		],
    /*плагин контроллера для доступа к статичным страницам внутри контроллеров*/
    'controller_plugins' => [
        'aliases' => [
            'Statpage' => Controller\Plugin\Statpage::class,
            'Statpage' => Controller\Plugin\Statpage::class,
            'Zend\Mvc\Controller\Plugin\Statpage' => Controller\Plugin\Statpage::class,
        ],
        'factories' => [
            Controller\Plugin\Statpage::class => Controller\Plugin\StatpageFactory::class,
        ],
    ],


    'view_helpers' => [
        'factories' => [
            View\Helper\Statpage::class => View\Helper\Factory\Statpage::class,
        ],
        'aliases' => [
            'Statpage' => View\Helper\Statpage::class,
			'statpage' => View\Helper\Statpage::class,
			'StatPage' => View\Helper\Statpage::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
	"statpage"=>[
        'tpl_folder'=>"",                         //устарел и не используется
		'tpl'=>[                                  //пользовательские шаблоны вывода контента
            "application/statpage/1"=>"Шаблон 1",
        ],        
		'media_folder'=>"media",                  //имя папки в public для размещения медиаматериала
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


];

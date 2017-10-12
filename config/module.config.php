<?php
/**
работа с просто страницами
 */

namespace Statpage;

use Zend\Router\Http\Segment;



return [
	//маршруты
    'router' => [
        'routes' => [
			
			//маршрут для варианта с одним языком
            'page' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '[/:locale]/page/:page',
					'constraints' => [
                               			 'page' => '[a-zA-Z0-9_-]+',
										 'locale' => '[a-zA-Z0-9_-]+',
                           			 ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
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
			],
		],

/*
    'access_filter' => [
        'controllers' => [
            Controller\IndexController::class => [
                //разрешение для входа
                ['actions' => '*', 'allow' => '*'],
            ],
        ]
    ],
*/

    'view_helpers' => [
        'factories' => [
            View\Helper\Statpage::class => View\Helper\Factory\Statpage::class,
        ],
        'aliases' => [
            'Statpage' => View\Helper\Statpage::class,
			'statpage' => View\Helper\Statpage::class,
			
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
			__DIR__ . '/../../../../data/statpage/tpl',	//папка для поиска дополнительных шаблонов
        ],
    ],
	"statpage"=>[
		'data_folder'=>"data/statpage/content",	//файлы с html контентом
		'tpl_folder'=>"data/statpage/tpl",		//шаблоны вывода контента
		'media_folder'=>"media",				//имя папки в public для размещения медиаматериала
	]
];

<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
use Selective\BasePath\BasePathMiddleware;
use Slim\Views\Twig;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $settings = $container->get('settings')['error'];

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details']
        );
    },

	BasePathMiddleware::class => function(ContainerInterface $container){
		return new BasePathMiddleware($container->get(App::class));
	},

	'PDO' => function (ContainerInterface $container) {
		$settings = $container->get('settings')['db'];
		$driver = $settings['driver'];
		$host = $settings['host'];
		$dbname = $settings['database'];
		$username = $settings['username'];
		$password = $settings['password'];
		$charset = $settings['charset'];
		$dsn = "$driver:host=$host;dbname=$dbname;charset=$charset";

		return new PDO($dsn, $username, $password);
	},

];

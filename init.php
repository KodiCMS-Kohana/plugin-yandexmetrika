<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

Plugin::factory('yandexmetrika', array(
	'title' => 'Yandex Метрика',
	'description' => 'Метрика посещения пользователями сайта',
))->register();

class Yandex_Autoloader {

	public static function autoload($class)
	{
		if (strpos($class, 'Yandex') !== FALSE)
		{
			Kohana::auto_load($class, 'vendor');
		}
	}
}

// Register the autoloader
spl_autoload_register(array('Yandex_Autoloader', 'autoload'));
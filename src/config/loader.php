<?php
	
	/*$loader = new \Phalcon\Loader();
	$loader->registerDirs(
		array(
			APP_PATH . $config->application->controllersDir,
			APP_PATH . $config->application->pluginsDir,
			APP_PATH . $config->application->libraryDir,
			APP_PATH . $config->application->modelsDir,
			APP_PATH . $config->application->formsDir,
		)
	)->register();*/

	use Phalcon\Loader;

	$loader = new Loader();

	$loader->registerNamespaces(array(
	    'App\Models' => $config->application->modelsDir,
	    'App\Controllers' => $config->application->controllersDir,
        'App\Controllers\Maestros' => $config->application->controllersMastersDir,
	    'App\Forms' => $config->application->formsDir,
	    'App\Business' => $config->application->businessDir,
	    'App\Utilities' => $config->application->utilitiesDir,
	    'App' => $config->application->libraryDir
	));

	$loader->register();
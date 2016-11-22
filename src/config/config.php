<?php


return new \Phalcon\Config([
    'database' => [
       'adapter'   => 'Mysql',
       'host'      => 'localhost',//64.79.70.108
       'username'  => 'root',
       'password'  => '',
       'dbname'    => 'base'
    ],
    'application' => [
        'controllersDir'    => APP_DIR.'/controllers/',
        'controllersMastersDir'    => APP_DIR.'/controllers/maestros/',
        'businessDir'       => APP_DIR.'/business/',
        'utilitiesDir'      => APP_DIR.'/utilities/',
        'modelsDir'         => APP_DIR.'/models/',
        'formsDir'          => APP_DIR.'/forms/',
        'libraryDir'        => APP_DIR.'/library/',
        'pluginsDir'        => APP_DIR.'/plugins/',
        'cacheDir'          => APP_DIR.'/cache/',
        'baseUri'           => '/base/',
        'publicUrl'         => '/base/',
        'cryptSalt'         => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D'
    ],
    'switchUtils' => [
        'socket' => true
    ],
    'amazon' => [
        'AWSAccessKeyId'    => '',
        'AWSSecretKey'      => ''
    ], 
    'noAuth'        => [         
        'session'   => array('*'    =>  true),
        'prueba'    => array('*'    =>  true),
        'test'      => array('*'    =>  true)
    ],
    'appTitle'      =>'BASE',
    'appName'       =>"BASE",
    'appAutor'      =>'Zenta',
    'appAutorLink'  =>'Zenta',
]);

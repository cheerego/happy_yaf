#!/usr/bin/env php
<?php


require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

define('APPLICATION_PATH', dirname(__FILE__));
define('MODEL_PATH',APPLICATION_PATH.'/application/models');
define('TEMPLATE_PATH',APPLICATION_PATH.'/artisan/templates');

use Symfony\Component\Console\Application;
use Artisan\GenerateModelCommand;
use Artisan\GeneratePluginCommand;
use Artisan\GenerateControllerCommand;
$application = new Application();

// ... register commands
$application->add(new GenerateModelCommand());
$application->add(new GeneratePluginCommand());
$application->add(new GenerateControllerCommand());
$application->run();

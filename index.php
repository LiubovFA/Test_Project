<?php

use test_project\app\App;

require_once __DIR__ .'/vendor/autoload.php';
//require_once __DIR__.'/app/App.php';

try
{
    App::init();
}
catch (Exception $e)
{
    echo $e->getMessage();
}


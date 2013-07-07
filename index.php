<?php

require_once 'config/config.php';

define('APP_PATH', SITE_PATH . 'apps/bowling/');

function __autoload($classname) {
  require_once(SITE_PATH . 'classes/'.$classname.'.class.php');
}

Controller::start();
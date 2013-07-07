<?php

class View {

  public static $params = null;

  function __construct() {

  }

  public static function redirect($controller, $action='index') {
    $location = SITE_URL . 'index.php?q='.$controller.'&do='.$action;
    header('Location: '.$location);
  }

  public static function render($template, $params = null) {

    if($params) {
      self::$params = &$params;
    }
    
    $template_file=APP_PATH . 'views/'.$template.'.php';
    if (!file_exists($template_file)) {
      die('ERROR : no template file '.$template);
    }

    ob_start();
    include($template_file);
    $view_content = ob_get_clean();

    print $view_content;
  }

}

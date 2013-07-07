<?php
class Controller {

  const DEFAULT_CONTROLLER = 'home';
  const DEFAULT_ACTION = 'index';

  public static $params = null;

/**
 * Method check and execute controller action from request
 */
  public static function start() {
    $request    = &$_REQUEST;

    if(isset($request['q'])) {
      $controller = $request['q'];
    } else {
      $controller = self::DEFAULT_CONTROLLER;
    }
    
    if(isset($request['do'])) {
      $action = $request['do'];
    } else {
      $action = self::DEFAULT_ACTION;
    }

    self::route_request($controller, $action);
  }

  private static function route_request($controller, $action) {
    $controller_file=APP_PATH . 'controllers/'.$controller.'.php';
    if (!file_exists($controller_file)) {
      die('ERROR : no controller file '.$controller);
    }

    $function='action_'.$action;

    require_once($controller_file);
    $obj = new $controller;
    if (!method_exists($obj, $function)) {
      $function='action_'.self::DEFAULT_ACTION;
    }

    self::route_exec($obj, $function);
  }

  private static function route_exec(&$obj, &$function) {
    try {
      $obj->$function(self::$params);
    } catch(SitePageException $e) {
      View::redirect('home');
    }
  }

  protected function load($model, $params=null) {

    $model_file=APP_PATH . 'models/'.$model.'.php';
    if (!file_exists($model_file)) {
      die('ERROR : no model file '.$model);
    }

    $model = $model.'_db';
    require_once $model_file;
    return new $model($params);
  }

  public function action_index() {
    print 'No content';
  }
}

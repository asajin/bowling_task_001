<?php

class home extends Controller {

  public function action_index() {
    $model = $this->load('bowling');
    
    $bowling = $model->get_default();

    View::render('home', $bowling);
  }

}

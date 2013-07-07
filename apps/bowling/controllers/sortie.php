<?php

class sortie extends Controller {

  public function action_item() {
    $model = $this->load('sortie');

    $params['sortie'] = $model->get_item($_REQUEST['id']);
    $params['parties'] = $model->get_parties($_REQUEST['id']);

    View::render('affichage_sortie_bowling', $params);
  }

}

<?php

class sortie_db extends DB {
  
  public function get_item($id) {
    
    $sql = 'SELECT date, nom, adresse FROM sortie s '
          .'LEFT JOIN bowling b '
          .'ON (s.bowling_id=b.id) '
          .'WHERE s.id='.$id;

    $st = $this->query($sql);
    $result = $st->fetch(PDO::FETCH_ASSOC);

    return $result;
  }

  public function get_parties($id) {

    $sql = 'SELECT date, joueur_id, joueur_alias FROM sortie s '
          .'LEFT JOIN participation_sortie ps '
          .'ON (s.id=ps.sortie_id) '
          .'WHERE s.id='.$id;

    $st = $this->query($sql);
    $joueurs = array();
    while($row = $st->fetch(PDO::FETCH_ASSOC)){
      $joueurs[$row['joueur_id']] = $row;
    }
    
    $sql = 'SELECT score, l.`index`, joueur_id, coup_id, partie_id FROM lancer l '
           .'LEFT JOIN coup c ON (c.id=l.coup_id) '
           .'LEFT JOIN partie p ON (p.id=c.partie_id) '
           .'WHERE p.sortie_id='.$id;

    $st = $this->query($sql);
    $coups = array();
    $joueur_total = array();
    $joueur_total_cumul = array();
    while($row = $st->fetch(PDO::FETCH_ASSOC)){
      $partie_id = $row['partie_id'];
      $joueur_id = $row['joueur_id'];
      $coup_id   = $row['coup_id'];
      if(isset($coups[$partie_id][$joueur_id][$coup_id])) {
        $coups[$partie_id][$joueur_id][$coup_id]['coup_score'] .= ' '.$row['score'];
        @$joueur_total[$partie_id][$joueur_id] += $row['score'];
        @$joueur_total_cumul[$joueur_id] += $row['score'];
      } else {
        $row['coup_score'] = $row['score'];
        $coups[$partie_id][$joueur_id][$coup_id] = $row;
        @$joueur_total[$partie_id][$joueur_id] += $row['score'];
        @$joueur_total_cumul[$joueur_id] += $row['score'];
      }
    }

    $params['joueurs'] = &$joueurs;
    $params['coups'] = &$coups;
    $params['joueur_total'] = &$joueur_total;
    $params['joueur_total_cumul'] = &$joueur_total_cumul;

    return $params;
  }
}

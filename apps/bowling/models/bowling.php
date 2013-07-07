<?php

class bowling_db extends DB {

  const DEFAULT_BOWLING = 1;
  
  public function get_default() {
    
    $sql = 'SELECT nom FROM  bowling WHERE id='.self::DEFAULT_BOWLING;

    $st = $this->query($sql);
    $result = $st->fetch(PDO::FETCH_ASSOC);

    return $result;
  }
}

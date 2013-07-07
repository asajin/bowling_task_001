<?php
class DB extends PDO {

  function __construct() {
    $dsn = 'mysql:dbname='.DB_DEFAULT.';host='.DB_HOST;
    parent::__construct($dsn, DB_USER, DB_PASSWD);
  }

}
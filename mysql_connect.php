<?php

function db_connect($serv_db, $user_db, $pass_db, $schema_db)
{
  $db = mysqli_connect($serv_db, $user_db, $pass_db, $schema_db);

  if(!$db)
  {
    die('Error connecting to MySql database with message: '. mysqli_connect_error());
  }
  return $db;
}
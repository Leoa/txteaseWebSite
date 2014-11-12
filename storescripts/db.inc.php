<?php

$connection = mysql_connect('mysql', 'beleoa', '11dd11');
if ($connection){ $g=0; }
if(! $connection) die(/*"could't connect ".mysql_error() */);







/*
$rs1 = mysql_list_dbs($connection);
for ( $row = 0; $row < mysql_num_rows($rs1); $row++) {

$db_list .=  mysql_tablename($rs1, $row) . "<br>";
               
              if( !$db_list){
              
              echo 'no tables';
              }
         }

//mysql_select_db('high_scores', $connection) or die ("couldn't select highscores:".mysql_error() );


      */



?>
  
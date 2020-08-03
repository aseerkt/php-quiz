<?php
   
   $host = 'localhost';
   $port = '3306';
   $db_name = 'Quiz_DB';
   $db_user = 'root';
   $db_pass = 'testing123';

   $pdo = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$db_name.';', $db_user, $db_pass);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>
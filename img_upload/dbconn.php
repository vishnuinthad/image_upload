<?php

   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'adminpanel';
   $conn = mysqli_connect($dbhost,$dbuser, $dbpass, $dbname );
   
   if(! $conn ) {
      die('Could not connect: ' . mysqli_connect_error());
      
   }
   ?>
   
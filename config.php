<?php
   define('DB_SERVER', 'localhost:3036');
   define('DB_USERNAME', 'eote');
   define('DB_PASSWORD', 'C1oudbur5t');
   define('DB_DATABASE', 'edge_of_the_empire');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   /* check connection */
   if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
       exit();
   }
?>
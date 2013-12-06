<?php
 $cookie_time=time()+60*10;
 if (!isset($_COOKIE['test'])) {
   echo "Cookie nastavujem!";
   setcookie("test",1,$cookie_time);
 } else {
   echo "Cookie je nastavene!";
 }
?>
<?php
/* Инклудит функции и в них инклудится логин скрипт для вывода формы логина и для логаута */
error_reporting(false);
include('./auth_funcs.php');

function Show(){ 
               echo '
					<div style="width: 753px; height: 1031px; margin: 8px auto; background-image: url(img/portfolio.png);"></div>
               ';
               }
               
//Вывод общей картины
function IncludeTemplates(){
                           include('./settings.php');

                           //$header = './templates/header.php';
                           $black = './templates/black.php';
                           $content = './templates/gallery.php';
                           $advert = './templates/advert.php';
                           $footer = './templates/footer.php';

                           //include($header);
                           include($black);
                           include($content);
                           include($advert);
                           include($footer);
                           }
include('./templates/body.php');
?>
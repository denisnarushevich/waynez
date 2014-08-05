<?php
/* Инклудит функции и в них инклудится логин скрипт для вывода формы логина и для логаута */
error_reporting(false);
include('./auth_funcs.php');

function Show(){ 
               include('./gallery/registry.php');
               $comm_location = './gallery/comments.xml';
                          
               //Отображение тумбнайлов или фотографии
               $img = $_GET['img'];
               if($img) 
                 {
                 //array_slice?!
                 while(key($GALLERY) != basename("./gallery/pictures/$img", '.JPG')) {next($GALLERY);}
                 $curr = current($GALLERY);
                                                              
                 function getPrevious($array){
                 // na 110mb sbivaetsa ukazatelj massiva, pri ispolzovaniji funkcij - t.e. funciji otsi4itivajut s nulja. nado propisivatj while cikl v funciji.
                                             if(prev($array) == FALSE) {end($array);}
                                             $curr = current($array);
                                             echo "$curr[filename]";
                                             }
                                 
                 function getNext($array){
                                         if(next($array) == FALSE) {reset($array);}
                                         $curr = current($array);
                                         echo "$curr[filename]";
                                         }
                                         
                 ////Блок комментов, начало////
                 
                 //Инициализация XML         
                 $comm_doc = new DOMDocument('1.0'); 
                 $comm_doc->preserveWhiteSpace = false;
                 $comm_doc->load($comm_location);
                 $comm_doc->formatOutput = true;
                 $comm_xpath = new DOMXpath($comm_doc);        
                 $imgnojpg = basename($img, '.JPG');
  
                 //Ф-ия добавления комментария                   
                 if($_POST['comment'] == 'post_it') 
                   {
                   //Задаю некоторые значения
                   $comm_id = $_POST['id'];
                   $comm_name = $_POST['name'];
                   $comm_date = date("d.m.y H:i");
                   $comm_text = $_POST['text'];
                   $regexp = '/^[\~\!\@\#\$\%\^\&\*\<\>\?\/\;\:\,\.\\\|\(\)\}\{\]\[a-zA-Zа-яА-ЯЧчАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцшщъыьэюя\s\d]+$/';
                   $commed_image = $_POST['postable_image'];
                   if($comm_name == NULL)
                     {$post_status = 'Нет имени!';}
                   elseif($comm_text == NULL)
                         {$post_status = 'Нет текста!';}
                   //Проверка на повторный коммент
                   elseif($comm_xpath->query('//comment[@id='. $comm_id .']')->item(0) != NULL)
                         {}
                   elseif(!preg_match($regexp, $comm_text))
                         {
                         $post_status = 'EPIC MSG FAIL!';
                         }
                   elseif(!preg_match($regexp, $comm_name))
                         {
                         $post_status = 'EPIC NAME FAIL!';
                         }
                   //Записываю значения из формы в XML файл
                   else{
                       //Проверка на наличие и создание блока комментов данной фотографии               
                       if($comm_xpath->query('//photo[@img='. $commed_image .']')->item(0) == NULL)
                         {
                         $new_element_photo = $comm_doc->createElement('photo');
                         $new_element_photo->setAttribute('img', $commed_image);
                         $comm_xpath->query('/root')->item(0)->appendChild($new_element_photo);
                         }
                       //Перевод значений в XML формат
                       $new_element_comm = $comm_doc->createElement('comment');
                       $new_element_comm->setAttribute('id', $comm_id);
                       $new_element_name = $comm_doc->createElement('name', $comm_name);
                       $new_element_date = $comm_doc->createElement('date', $comm_date);
                       $new_element_text = $comm_doc->createElement('text', $comm_text);
                       $element_comm_path = $comm_xpath->query('//photo[@img='. $imgnojpg .']')->item(0)->appendChild($new_element_comm);
                       $element_comm_path->appendChild($new_element_name);
                       $element_comm_path->appendChild($new_element_date);
                       $element_comm_path->appendChild($new_element_text);
                       //Записываю XML файл
                       $comm_doc->save($comm_location);
                       }
                   }
                   
                 function ShowComments($comm_xpath, $imgnojpg){
                 $n = '0';
                 foreach($comm_xpath->query('//photo[@img='. $imgnojpg .']/comment') as $comment) 
                        {
                        $n++;
                        $getname = $comment->getElementsByTagName('name')->item(0);
                        $getdate = $comment->getElementsByTagName('date')->item(0);
                        $gettext = $comment->getElementsByTagName('text')->item(0);
                        include('./templates/content/comment.php'); 
                        }
                 }
                 ////Блок комментов, конец////
                 $photo_size = getimagesize('./gallery/pictures/'.$img);
                 $photo_width = $photo_size[0];
                 $photo_height = $photo_size[1];
                 include('./templates/content/photo.php');
                 }
               else{
                   $page = $_GET['page'];
                   $perpage = 16;
                   $page_numb = 0;
                   $page_numb_displ = 1;
                   //Высчитывает количество и выводит ссылки страниц
                   echo "Страницы:&nbsp;";
                   while($page_numb < ceil(count($GALLERY)/$perpage)) 
                        {
                        echo "<a href='?page=$page_numb'>$page_numb_displ</a>&nbsp;"; 
                        $page_numb++; 
                        $page_numb_displ++;
                        }
                   echo "<br/>\n\n";
                   //Проматывает указательно массива
                   while($x1 != $page*$perpage) 
                        {
                        $x1++; 
                        next($GALLERY);
                        }
                   //Вывод изображения
                   $comm_doc = new DOMDocument('1.0'); 
                   $comm_doc->preserveWhiteSpace = false;
                   $comm_doc->load($comm_location);
                   $comm_doc->formatOutput = true;
                   $comm_xpath = new DOMXpath($comm_doc);
                   while($x2 != $perpage) 
                        {         
                        $x2++;
                        $current_array = current($GALLERY);         
                        $number_of_comments = $comm_xpath->evaluate('count(/root/photo[@img='. basename($current_array['filename'], '.JPG') .']/comment)');
                        $image_width = getimagesize("gallery/thumbs/$current_array[filename]");
                        $width = $image_width[0]-26 .'px';
                        include('./templates/content/thumbnail.php'); 
                        if(next($GALLERY) == FALSE) {break;}
                        }                   
                   }
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
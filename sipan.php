<?php
/* Инклудит функции и в них инклудится логин скрипт для вывода формы логина и для логаута */
include('./auth_funcs.php');

/* Проверяет авторизацию, для блокирования доступа при переходе на файл "по прямой" */
Auth('pagelock');

$del = $_GET['del'];
$act = $_POST['action'];
if($act == 'upload')
  {
  date_default_timezone_set('Europe/Helsinki');
  
  $image_author = $_POST['author'];
  $pic_dir = "gallery/pictures/";
  $thumb_dir = "gallery/thumbs/";
  $registry = "gallery/registry.php";
  $tmp_filename = $_FILES['file']['tmp_name'];  
  $filetype = $_FILES['file']['type']; 
  $filesize = $_FILES['file']['size'];           
  $filename = date("ymdHis");
  $date = date("d.m.y");
  $imgname = $_POST['imgname'];
  $ext = ".JPG";
     
  // Проверяет файл
  if (!is_uploaded_file($tmp_filename)) {$upload_status = '<span class="upload_form_status_negative">Невозможно</font>';} 
  elseif ($filesize > 5242880) {$upload_status = '<span class="upload_form_status_negative">Больше 5мб</span>';}
  elseif ($filetype != "image/jpeg") {$upload_status = '<span class="upload_form_status_negative">Формат</span>';}
  elseif (is_uploaded_file($tmp_filename) ) 
         {
         $upload_status = '<span class="upload_form_status_positive">Загружен</span>';
            ini_set('memory_limit', '128M');

            // Создаёт тумбнайл и сохранаем фотографию
            if($img = imagecreatefromjpeg($tmp_filename))
              {
              $width = imagesx($img);
              $height = imagesy($img);
            
              //Creating picture 
              if($width >= $height) {$new_width = 640; $new_height = floor($height*($new_width/$width) );} 
              else {$new_height = 640; $new_width = floor($width*($new_height/$height) );}
              $tmp_img = imagecreatetruecolor($new_width, $new_height);
              imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
              imagejpeg($tmp_img, $pic_dir.$filename.$ext);   
                      
              //Creating thumbnail
              if($width >= $height) {$new_width = 160; $new_height = floor($height*($new_width/$width) );} 
              else {$new_height = 160; $new_width = floor($width*($new_height/$height) );}
              $tmp_thumb = imagecreatetruecolor($new_width, $new_height);
              imagecopyresampled($tmp_thumb, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
              imagejpeg($tmp_thumb, $thumb_dir.$filename.$ext);
            
              // Записывает отображение фотографии на сайте в gallery.php                       
              $f = fopen("$registry", "r+");
              fseek($f,-21,SEEK_END);
              $add="  '$filename' =>\n  array (\n    \"filename\" => \"{$filename}{$ext}\",\n    \"name\" => \"$imgname\",\n    \"date\" => \"$date\",\n    \"author\" => \"$image_author\",\n  ),\n);krsort(\$GALLERY);?>";
              fwrite($f,$add);
              fclose($f);
		      }                    
         }
  }
  
  
elseif($act == 'editme')
      {
      $img = $_GET['img'];
      include('./gallery/registry.php');
      $r = fopen("gallery/registry.php", "w");
      $imagekey = basename('./gallery/pictures/'.$img, '.JPG');
      $result = var_export(array_diff_assoc($GALLERY, array($imagekey => array() ) ), TRUE);
      fwrite($r, "<?php\n\$GALLERY = $result;krsort(\$GALLERY);?>");
      fclose($r);
        
      $newname = $_POST['newname'];
      $newdate = $_POST['newdate'];
      $newauthor = $_POST['newauthor'];                            
      $f = fopen("gallery/registry.php", "r+");
      fseek($f,-21,SEEK_END);
      $add="  '$imagekey' =>\n  array (\n    'filename' => '$img',\n    'name' => '$newname',\n    'date' => '$newdate',\n    'author' => '$newauthor',\n  ),\n);krsort(\$GALLERY);?>";
      fwrite($f,$add);
      fclose($f);
      
      $image_edit_status = '<span class="sipan_edit_status_positive">Готово</span>';
      }
           
elseif($act == 'deleteme')
      {
      $img = $_GET['img'];
      include('./gallery/registry.php');
      unlink("gallery/thumbs/$img");
      unlink("gallery/pictures/$img");
      $r = fopen("gallery/registry.php", "w");
      $imagekey = basename('./gallery/pictures/'.$img, '.JPG');
      $result = var_export(array_diff_assoc($GALLERY, array($imagekey => array() ) ), TRUE);
      fwrite($r, "<?php\n\$GALLERY = $result;krsort(\$GALLERY);?>");
      fclose($r);
      
      $image_delete_status = '<span class="sipan_edit_status_positive">Удалил.</span>';
      }
      
if($del)
  {
  $comm_location = 'gallery/comments.xml';
  $comm_doc = new DOMDocument('1.0'); 
  $comm_doc->preserveWhiteSpace = false;
  $comm_doc->load($comm_location);
  $comm_doc->formatOutput = true;
  $comm_xpath = new DOMXpath($comm_doc);        
  $imgnojpg = basename($img, '.JPG');
  $del_comm = $comm_xpath->query('//comment[@id='. $del .']')->item(0);
  $del_comm->removeChild($del_comm->getElementsByTagName('name')->item(0));
  $del_comm->removeChild($del_comm->getElementsByTagName('date')->item(0));
  $del_comm->removeChild($del_comm->getElementsByTagName('text')->item(0));
            
  $del_comm_par = $del_comm->parentNode;
  $del_comm_par->removeChild($del_comm);
            
  $comm_doc->save($comm_location);
  }

function ShowUpload(){
                     include('./sipan/image_upload.php');
                     }

function ShowEdit(){
                   $img = $_GET['img'];
                   if($img)
                     {
                     include('./gallery/registry.php');
                     $imagekey = basename('./gallery/pictures/'.$img, '.JPG');
                     }
                   include('./sipan/image_edit.php');
                   }

function ShowMain(){
                   include('./gallery/registry.php');
                   $page = $_GET['page'];
                   $perpage = 12;
                   $page_numb = 0;
                   $page_numb_displ = 1;
                   //Высчитывает количество и выводит ссылки страниц
                   echo 'Страницы:&nbsp;';
                   while($page_numb < ceil(count($GALLERY)/$perpage)) 
                        {
                        echo '<a href="?page='.$page_numb.'">'.$page_numb_displ.'</a>&nbsp;'; 
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
                   $comm_location = './gallery/comments.xml';
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
                   
function ShowCommentList(){
                          $img = $_GET['img']; 
                          if($img)
                            {
                            $comm_location = './gallery/comments.xml';
                            $comm_doc = new DOMDocument('1.0'); 
                            $comm_doc->preserveWhiteSpace = false;
                            $comm_doc->load($comm_location);
                            $comm_doc->formatOutput = true;
                            $comm_xpath = new DOMXpath($comm_doc);       
                            $imgnojpg = basename($img, '.JPG');
                            $n = '0';
                            foreach($comm_xpath->query('//photo[@img='. $imgnojpg .']/comment') as $comment) 
                                   {
                                   $n++;
                                   $getname = $comment->getElementsByTagName('name')->item(0);
                                   $getdate = $comment->getElementsByTagName('date')->item(0);
                                   $gettext = $comment->getElementsByTagName('text')->item(0);
                                   include('./sipan/comm.php'); 
                                   }
                            }
                          }

/* Вывод общей картины */
if(!function_exists(IncludeTemplates))
  {
  function IncludeTemplates(){
                             include('./settings.php');
                           
                             $header = './templates/header.php';
                             $black = './templates/black.php';
                             $content = './sipan/sipan.php';
                             $footer = './templates/footer.php';
  
                             include($header);
                             include($black);
                             include($content);
                             //include($footer);
                             }
  include('./templates/body.php');
  }
?>
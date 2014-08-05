<?php
/* Запрашивает массив с аккаунтами */
require('./accounts/accounts.php');

/* При помощи функции авторизации проверяет вводимый логин, пароль и выводит форму логина */
if(isset($_POST['user']) && isset($_POST['pass']))
  {
  $_SESSION['user'] = $_POST['user'];
  $_SESSION['pass'] = $_POST['pass'];
  }
   
if(Auth('login') == '10')
  {
  $_SESSION['name'] = $ACCOUNTS[$_SESSION['user']]['name'];
  
  $logout = $_GET['logout'];
  if($logout == 'true')
    {
    session_destroy();
    unset($_SESSION['name']);
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
    if(!function_exists(Login))
      {
      function Login(){
                      IncludeLogin();
                      }
      }
    }
  else{
      function Controls(){
                         include('./sipan/controls.php');
                         }
      }
  }      
elseif(Auth('login') == '01')
      {
      if(!function_exists(Login))
        {
        function Login(){
                        IncludeLogin('Не впущу!');
                        session_destroy();
                        }
        }
      }
elseif(Auth('login') == '00')
      {
      if(!function_exists(Login))
        {
        function Login(){
                        IncludeLogin();
                        }
        }
      }
?>
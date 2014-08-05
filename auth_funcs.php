<?php 
session_start();

// Функции, используемые при авторизациях


/* Проверки на верификация, используется при логине, проверки доступа к странице на прямую итд */
if(!function_exists(Auth))
  {
  function Auth($value = NULL){ /* value can be: 'pagelock' - for page access check, 'login' - for login post info check, 'anyvalue' - will echo anyvalue, empty will return TRUE/FALSE */
  
  require('./accounts/accounts.php');
  
  if(isset($_SESSION['user']) && isset($_SESSION['pass']))
    {
    if(array_key_exists($_SESSION['user'], $ACCOUNTS) && $_SESSION['pass'] == $ACCOUNTS[$_SESSION['user']]['password'])
      {
      if(isset($value))
        {
        if($value == 'login')
          {
          return('10');
          }
        elseif($value == 'pagelock')
              {
              }              
        else{  
            echo $value;
            }
        }
      else{
          return(TRUE);
          }
      }
    else{
        if($value == 'login')
          {
          return('01');
          }
        elseif($value == 'pagelock')
              {
              exit(include('./index.php'));
              }
        else{  
            return(FALSE);
            }
        }
    }
  else{
      if($value == 'login')
        {
        return('00');
        }
      elseif($value == 'pagelock')
            {
            exit(include('./index.php'));
            }
      else{
          return(FALSE);
          }
      }
  }
}
  
/* Вывод формы логина и удаление запроса на логаут из адреса действия формы */   
   
if(!function_exists(IncludeLogin))
  {
  function IncludeLogin($logstatus = NULL){
                                          $nologout = explode('logout=true&', $_SERVER['REQUEST_URI']);
                                          $request_uri = join($nologout);
                                          $login_status = $logstatus;
                                          include('./templates/login.php');
                                          }
  }
  
/* Вывод администраторских кнопок */

if(!function_exists(ShowControls))
  {
  function ShowControls(){
                         if(function_exists(Controls))
                           {
                           Controls();
                           }
                         }
  }

/* Вывод формы логина */

if(!function_exists(ShowLogin))
  {
  function ShowLogin(){
                      if(function_exists(Login))
                        {
                        Login();
                        }
                      }
  }

/* Один раз инклудит логин скрипт */
include_once('./login.php');                  
?>
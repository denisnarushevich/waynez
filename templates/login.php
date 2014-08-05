<!-- Форма логина, начало -->
<div>
 <table id="login_form">
  <tr>
   <td>
    <form method="post" action="<?php echo $request_uri; ?>">
      <div class="login_form_names">Логин:</div>
      <div><input class="login_form_input" name="user" type="text" size="14" /></div>
      <div class="login_form_names">Пароль:</div>
      <div><input class="login_form_input" name="pass" type="password" size="14" /></div>
      <div>
       <input class="login_form_submit" type="submit" value="Войти" />
       <span id="login_form_status"><?php echo $login_status; ?></span>
      </div>
    </form>
   </td>
  </tr>
 </table>
</div>
<!-- Форма логина, конец -->

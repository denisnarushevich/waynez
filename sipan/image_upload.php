<div class="hat_margin">
 <div>
  <form enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
  <div>
   <input type="hidden" name="MAX_FILE_SIZE" value="7340032" />
   <input type="hidden" name="action" value="upload" />
   <input type="hidden" name="author" value="<?php echo $_SESSION['name']; ?>" />
  </div>
  <div>
   <span class="names">Aвтор:</span>
   <span class="values"><?php echo $_SESSION['name']; ?></span>
  </div>
  <div>
   <span class="names">Файл:</span>
   <span><input class="files" name="file" type="file" size="8" /></span>
  </div>
  <div>
   <span class="names">Назв.:</span>
   <span><input class="fields" name="imgname" type="text" size="16" /></span>
  </div>
  <div>
   <span class="names">&nbsp;</span>
   <span><input class="buttons" type="submit" value="Загрузить" /></span>
  </div>
  </form>
 </div>
</div>
<!-- Форма отображения комментариев -->
<div class="comm">
 <div class="comm_name"><a class="link" name="<?php print $comment->getAttribute('id'); ?>" href="#<?php print $comment->getAttribute('id'); ?>"><?php print '#'.$n.'.&nbsp;'.$getname->nodeValue; ?></a></div>
 <div class="comm_text">&nbsp;&nbsp;<?php print $gettext->nodeValue; ?></div>
 <div class="comm_date"><?php print $getdate->nodeValue; ?></div>
</div>
<!-- Форма отображения комментариев, конец -->


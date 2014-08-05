<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<title>Narushevich.Lv</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="author" lang="ru" content="Нарушевич Денис" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="cubes/cubes.css" type="text/css" />
		<script src='cubes/cubes.js'></script>
		<script src='cubes/ImprovedNoise.js'></script>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
		<script src="http://www.thebeatlesrockband.com/js/jquery.scrolling-parallax.js" type="text/javascript"></script>
<link rel="stylesheet" href="nav/style.css" type="text/css" />
</head>
<body>
<div id="bg">
</div>
<div id="cubes" style=" z-index: 1;"></div>
<script>

	$( function ( ) {
		$( '#bg' ).scrollingParallax({ 
    staticSpeed : 3, 
    loopIt : true 
});
	} );
	
	//cubes.init();

</script>
<table id="viewport" style="position: relative; z-index: 2;">
 <tr>
  <td id="left_light"></td>
  <td id="container">
  
  
<?php IncludeTemplates($choosentemplate); ?>


  </td>
  <td id="right_light"></td>
 </tr>
</table>
</body>
</html>
<!---------------------------------------->
<!----- Head of site Schoollearn.ru  ----->
<!-----     (by Rodion Kolovanov)    ----->
<!---------------------------------------->

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="<?php if(isset($charset)) echo $charset; else echo "UTF-8";?>"/>
	<title><?=$title?></title>
	<?php
	
	foreach($include_links as $key)
		echo '<link href="'.$href_main.$key[0].'" rel="'.$key[1].'" type="'.$key[2].'"/>';
	
	foreach($include_scripts as $key)
		echo '<script type="text/javascript" src="'.$href_main.'scripts/'.$key.'"></script>';
	
	if(isset($descr))
		echo '<meta name="description" content="'.$descr.'"/>';
	
	if(isset($keyWords))
		echo '<meta name="keywords" content="'.$keyWords.'"/>';
		
	if(isset($head_text))
		echo $head_text;
	
	?>
	<script type="text/javascript"
		src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
	</script>
</head>

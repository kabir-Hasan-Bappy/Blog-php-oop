<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">

<?php 
$query = "SELECT * FROM theme WHERE id = '1'";
$theme = $db->select($query);
while ($result= $theme->fetch_assoc()) {
	if ($result['theme_name'] == 'default') {?>
		<link rel="stylesheet" href="themes/default.css"> <?php }
		elseif($result['theme_name'] == 'green'){?>
			<link rel="stylesheet" href="themes/green.css"> 
				<?php }} ?>
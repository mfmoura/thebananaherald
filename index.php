<?php 
	include "config/conn.php";

	$ytb = $conn->query("SELECT `youtube`.`id`, `youtube`.`youtube` FROM `youtube` ORDER BY RAND() LIMIT 0,1");

	$code = $ytb->fetch_assoc();

 ?>

 <html>
 <head>
 	<title>The Banana Herald</title>

 	<style type="text/css">
 		<?php 
	 		if ($code['id'] == 11){
	 			echo "body{ background-image: url('office.png'); }";
	 			echo "p { color: #FFF; }";
	 		}
	 		else{
	 			echo "body{ background-image: url('loren.jpg'); }";
	 		}
	 	 ?>

 	</style>
 </head>
 <body>

 	<!-- Two programmers enters in a bar, they

 	<p align="center"><img src="thebananaherald.png" align="center"></p>

 	<p align="center"> <?php echo "<iframe width='420' height='315' src='https://www.youtube.com/embed/" . $code['youtube'] . "?autoplay=1' frameborder='0' allowfullscreen autoplay></iframe>"; ?></p>

 	<br>
 	<hr width="50%">
 	<p align="center">The Banana Herald - 2015</p>
 </body>
 </html>
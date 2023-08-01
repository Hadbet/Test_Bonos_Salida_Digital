<?php
if(isset($_POST['firma'])){
	$data = $_POST['firma'];
	$imagen = str_replace('data:image/png;base64,', '', $data);
	$imagen = str_replace(' ', '+', $imagen);
	$decodedImage = base64_decode($imagen);
	file_put_contents('firma.png', $decodedImage);
	echo 'La firma se ha guardado correctamente';
}
?>
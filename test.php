<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Verificar si se recibió el archivo adjunto
	if (isset($_FILES['PDF']) && !empty($_FILES['PDF']['name'])) {
		$pdfData = $_FILES['PDF'];

		$uploadDir = __DIR__ . '/PDF/';
		$pdfFileName = uniqid() . '_' . basename($pdfData['name']);
		$pdfFilePath = $uploadDir . $pdfFileName;

		if (move_uploaded_file($pdfData['tmp_name'], $pdfFilePath)) {
			echo 'Archivo PDF subido exitosamente.';
		} else {
			echo 'Error al subir el archivo PDF.';
		}
	} else {
		echo 'No se recibió ningún archivo adjunto.';
	}
} else {
	echo 'Método no permitido.';
}
?>

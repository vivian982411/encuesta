<?php
	if (isset($_GET['id'])) {
		$archivo="reportes/Reporte".$_GET['id'].".xls";
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$archivo");
		header("Content-Type: application/zip");
		header("Content-Trandfer-Emcoding: binary");
		readfile($archivo);
	}
?>
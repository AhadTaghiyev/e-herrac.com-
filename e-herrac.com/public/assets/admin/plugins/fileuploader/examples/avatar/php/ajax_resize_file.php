<?php
	include('../../../src/php/class.fileuploader.php');

	if (isset($_POST['fileuploader']) && isset($_POST['name']) && isset($_POST['_editor'])) {
		$uploadDir = '../uploads/';
		$name = str_replace(array('/', '\\'), '', $_POST['name']);
		$file = $uploadDir . $name;
		
		if (is_file($file)) {
			$editor = json_decode($_POST['_editor'], true);

			Fileuploader::resize($file, null, null, null, (isset($editor['crop']) ? $editor['crop'] : null), 100, (isset($editor['rotation']) ? $editor['rotation'] : null));
		}
	}
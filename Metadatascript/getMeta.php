<?php
    spl_autoload_register(function($classname) { require_once(realpath(__DIR__."/{$classname}.php")); });

    header('Content-type: application/json; charset="utf-8"');

    $document = $_FILES['document'];
	
	// Rewrite the submitted Mime-Type due to Windows submits the wrong type for some files.
    $document['type'] = mime_content_type($document['tmp_name']);

    require_once(realpath(__DIR__."/mapArray.php"));


    $extractedMeta = $maparray[$document['type']]($document['tmp_name'], $document['name']);
    print_r($extractedMeta->getSummary());
?>
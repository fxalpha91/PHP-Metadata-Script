<?php

$maparray = [
    'application/vnd.oasis.opendocument.text'
        => function($file, $name) { return new OpenDocumentText($file, $name); },
    'application/vnd.oasis.opendocument.spreadsheet'
        => function($file, $name) { return new OpenDocumentSpreadsheet($file, $name); },
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        => function($file, $name) { return new OpenXMLFormatsOfficeWord($file, $name); },
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        => function($file, $name) { return new OpenXMLFormatsOfficeSpreadsheet($file, $name); }
];
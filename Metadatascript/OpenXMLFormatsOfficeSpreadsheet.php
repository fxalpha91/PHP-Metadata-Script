<?php

class OpenXMLFormatsOfficeSpreadsheet extends OpenXMLFormatsOffice {
    public function __construct($file, $name) {
        parent::__construct($file, $name);


        $this->setDC('type', 'spreadsheet');
    }
}
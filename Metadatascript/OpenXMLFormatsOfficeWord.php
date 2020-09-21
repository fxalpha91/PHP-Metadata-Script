<?php

class OpenXMLFormatsOfficeWord extends OpenXMLFormatsOffice {
    public function __construct($file, $name) {
        parent::__construct($file, $name);

        $zip = new ZipArchive();
        $zip->open($file);

        $app = new SimpleXMLElement($zip->getFromName('docProps/app.xml'));

        $this->setStats('pages', intval($app->Pages));
        $this->setStats('paragraphs', intval($app->Paragraphs));
        $this->setStats('lines', intval($app->Lines));
        $this->setStats('words', intval($app->Words));
        $this->setStats('charsWoSpace', intval($app->Characters));
        $this->setStats('chars', intval($app->CharactersWithSpaces));

        $zip->close();

        $this->setDC('type', "text");
    }
}
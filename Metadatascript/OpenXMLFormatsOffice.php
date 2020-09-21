<?php

abstract class OpenXMLFormatsOffice extends DocumentFormat {

    public function __construct($file, $name) {
        parent::__construct($file, $name);

        $zip = new ZipArchive();
        $zip->open($file);

        $core = new SimpleXMLElement($zip->getFromName('docProps/core.xml'));

        $cp = $core->children("cp", true);
        $dc = $core->children('dc', true);
        $dcterms = $core->children("dcterms", true);

        $this->setDC('title', (string)$dc->{'title'});
        $this->setDC('subject', (string)$dc->{'subject'});
        $this->setDC('creators', (array)$dc->{'creator'});
        
        $keywords = [];
        preg_match_all("/([^\s,;]+)/i", (string)$cp->{'keywords'}, $keywords);
        $this->setDC('keywords', $keywords[0]);
        
        $this->setDC('description', (string)$dc->{'description'});
        $this->setDC('date', (string)$dcterms->{'modified'});
        $zip->close();
    }
}
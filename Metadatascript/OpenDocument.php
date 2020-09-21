<?php

abstract class OpenDocument extends DocumentFormat {
    public function __construct($file, $name) {
        parent::__construct($file, $name);

        $zip = new ZipArchive();

        $zip->open($file);

        $metaXML = new SimpleXMLElement($zip->getFromName('meta.xml'));
        $dc = $metaXML->children('office', true)->children('dc', true);
        $otherMeta = $metaXML->children('office', true)->children('meta', true);
    
        //print_r(intval($stats['page-count']));

        $this->setDC('title', (string)($dc->{'title'}));
        $this->setDC('creators', (array)($dc->{'creator'}));
        //$this->setDC('subtitle', $dc->{'subtitle'});
        $this->setDC('subject',  (string)($dc->{'subject'}));
        $this->setDC('description',  (string)($dc->{'description'}));
        $this->setDC('date',  (string)($dc->{'date'}));
        $this->setDC('keywords', (array)$otherMeta->{'keyword'});

        $zip->close();
    }
}
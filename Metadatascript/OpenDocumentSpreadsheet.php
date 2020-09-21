<?php

class OpenDocumentSpreadsheet extends OpenDocument {
    public function __construct($file, $name) {
        parent::__construct($file, $name);

        $zip = new ZipArchive();
        $zip->open($file);

        $metaXML = new SimpleXMLElement($zip->getFromName('meta.xml'));
        $otherMeta = $metaXML->children('office', true)->children('meta', true);
        $stats = $otherMeta->{'document-statistic'}->attributes('meta', true);
        
        $this->setStats('pages', intval($stats->{'table-count'}));
        $this->setStats('paragraphs', intval($stats->{'paragraph-count'}));
        $this->setStats('words', intval($stats->{'word-count'}));
        $this->setStats('charsWoSpace', intval($stats->{'non-whitespace-character-count'}));
        $this->setStats('chars', intval($stats->{'character-count'}));

        $this->setDC('type', 'spreadsheet');
        $zip->close();
    }
}
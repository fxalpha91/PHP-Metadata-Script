<?php

abstract class DocumentFormat {
    
    private $meta = [
        'dc' => [
            'title' => "",
            'subtitle' => "",
            'subject' => "",
            'description' => "",
            'date' => "",
            'creators' => [],
            'contributors' => [],
            'keywords' => [],
            'type' => ''
        ],
        'stats' => [
            'pages' => 0,
            'paragraphs' => 0,
            'lines' => 0,
            'words' => 0,
            'chars' => 0,
            'charsWoSpace' => 0
        ],
        'mimetype' => "",
        'filename' => ""
    ];

    public function __construct($file, $name) {
        $this->meta['mimetype'] = mime_content_type($file);
        $this->meta['filename'] = $name;
    }

    protected function getMeta() {
        return $this->meta;
    }

    protected function setDC($property, $value) {
        $this->meta['dc'][$property] = $value;
    }

    protected function setStats($property, $value) {
        $this->meta['stats'][$property] = $value;
    }

    public function getSummary() {
        return json_encode($this->meta);
    }
}
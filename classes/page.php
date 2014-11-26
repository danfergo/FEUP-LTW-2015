<?php
require_once("view.php");

class Page extends View{

    private $user;
    protected $path = "";
    protected $headers = "";
    protected $title = "";

    public function __construct($path, $user) {
        $this->user = $user;
        $this->path = $path;
    }

    public function addMetaTag($metadata) {
        $metatag = '<meta';
        foreach ($metadata as $attr => $value) {
            $metatag .= " " . $attr . '="' . $value . '"';
        }

        $metatag .= ">";
        $this->headers .= $metatag . "\n";
    }

    public function addJavasScriptSrc($src) {
        $this->headers .= "\n" . '<script type="text/javascript" src="' . $src . '"> </script>';
    }

    public function addStyleSheetSrc($src) {
        $this->headers .= "\n" . '<link href="' . $src . '" rel="stylesheet">';
    }

    public function setBody($view){
        $this->addChildView('body', $view);
    }
    
    public function getUser(){
        return $this->user;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    protected function initializeChildren(){
         $this->initialize();

         foreach ($this->getChildren() as $child) {
                $child->setPage($this);
                $child->initializeChildren();
         }
    }
    
    public function initialize() {
        $this->setTemplate('page');
    }
    
    public function echoView() {
        $this->initializeChildren();
        parent::echoView();
    }

}



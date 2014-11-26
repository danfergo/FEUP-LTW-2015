<?php

abstract class View {

    private $template = "";
    private $children = array();
    private $page = null;

    public function addChildView($id, $view) {
        $this->children[$id] = $view;
    }

    protected function initializeChildren() {
        $this->initialize();

        foreach ($this->children as $child) {
            $child->setPage($this->page);
            $child->initializeChildren();
        }
    }

    abstract public function initialize();

    protected function setTemplate($template) {
        $this->template = $template;
    }

    public function getPage() {
        return $this->page;
    }

    protected function setPage($page) {
        $this->page = $page;
    }

    protected function getChildren() {
        return $this->children;
    }

    public function getChildView($id) {
        return isset($this->children[$id]) ? $this->children[$id] : null;
    }

    protected function insert_view($view) {
        if (isset($this->children[$view])) {
            $this->children[$view]->echoView();
        } else {
            throw new Exception("View $view not found in template $this->template.");
        }
    }

    public function echoView() {
        if ($this->template !== "") {
            include(dirname(dirname(__FILE__)) . "/views/templates/$this->template.php");
        }
    }

}

abstract class PrivateView extends View {

    public function initialize() {
        if ($this->getPage()->getUser() === null) {
            $this->initializeForPublic();
        } else {
            $this->initializeForMember();
        }
    }

    public function initializeForMember() {
        
    }

    public function initializeForPublic() {
        
    }

}

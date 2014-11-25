<?php

abstract class Module {
    private $name;
    private $modules = array();
    
    public function __construct($name){
        $this->name = $name;
    }
    
    public function addSubModule(Module $module) {
        $this->modules[] = $module;
    }
    
    protected function printSubModules(){
        foreach ($this->modules as $module) {
            $module->printModule();
        }
    }
    
    abstract public function printModule();
}
<?php
require_once("module.php");

class Page {

    private $lang = 'pt';
    private $path = "";
    private $extraHeaders = "";
    private $title = "";
    private $modules = array();

    public function __construct($path) {
        $this->path = $path;
    }

    public function addJavasScriptSrc($src) {
        $this->extraHeaders .= '<script type="text/javascript" src="' . $src . '> </script>';
    }

    public function addStyleSheetSrc($src) {
        $this->extraHeaders .= '<script type="text/javascript" src="' . $src . '> </script>';
    }

    public function addModule(Module $module) {
        $this->modules[] = $module;
    }

    public function printHTML() {
        ?>
        <!DOCTYPE html>
        <html lang="<?= $this->lang ?>">
            <head>
                <title><?= $this->title ?></title>
                <?= $this->extraHeaders ?>
            </head>
            <body>
                <?php
                foreach ($this->modules as $module) {
                    $module->printModule();
                }
                ?>
            </body>
        </html>
        <?php
    }

}

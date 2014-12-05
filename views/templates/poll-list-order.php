<?php $ampersand = $this->getType() != '' ? '&' : ''; ?>

<div class="col-xs-12 text-right order-buttons">
    <p style="display: inline">Ordenar por:</p>
    <a href="<?=$this->getType() . $this->getParameter() . $ampersand?>order=<?=$this->getOrder() == 0 ? 1 : 0 ?>&page=<?=$this->getNumPage()?>" role="button" class="btn btn-default">
        Por nome
        <?php
        if($this->getOrder() == 0) {
            echo '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>';
        }
        else if($this->getOrder() == 1) {
            echo '<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>';
        }
        ?>
    </a>
    <a href="<?=$this->getType() . $this->getParameter() . $ampersand?>order=<?=$this->getOrder() == 2 ? 3 : 2 ?>&page=<?=$this->getNumPage()?>" role="button" class="btn btn-default">
        Por data de criação
        <?php
        if($this->getOrder() === 2) {
            echo '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>';
        }
        else if($this->getOrder() === 3) {
            echo '<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>';
        }
        ?>
    </a>
    <a href="<?=$this->getType() . $this->getParameter() . $ampersand?>order=4&page=<?=$this->getNumPage()?>" role="button" class="btn btn-default">
        Mais Populares
        <?php
        if($this->getOrder() == 4) {
            echo '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>';
        }
        ?>
    </a>
</div>
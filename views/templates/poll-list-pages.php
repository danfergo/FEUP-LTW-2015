<?php
$disableBackwards = ($this->getPollSize() == 0 || $this->getNumPage() == 0 ? 'class="disabled"' : "");
$disableForwards = ($this->getPollSize() < 12 ? 'class="disabled"' : "");
?>

<nav class="col-xs-12">
    <ul class="pager">
        <li <?php echo $disableBackwards; ?> >
            <a <?php echo $disableBackwards== ""?'href="' . $this->getType() . $this->getParameter() . $ampersand . 'order=' . $this->getOrder() . '&page=' . ($this->getNumPage() - 1) . '"' : 'href="#"';?>>
                Anterior
            </a>
        </li>
        <li <?php echo $disableForwards; ?> >
            <a <?php echo $disableForwards==""? 'href="' . $this->getType() . $this->getParameter() . $ampersand . 'order='.$this->getOrder().'&page='.($this->getNumPage() + 1).'"':'href="#"';?>>
                Seguinte
            </a>
        </li>
    </ul>
</nav>
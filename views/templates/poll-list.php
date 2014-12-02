<?php
$disableForwards = (count($this->getPolls()) < 12 || $this->getNumPage() === 0 ? 'class="disabled"' : "");
$disableBackwards = (count($this->getPolls()) < 12 ? 'class="disabled"' : "");
?>
<section id="listpoll">
    <div class="col-xs-12 order-buttons">                   <!-- Falta meter isto no lado direito -->
        <p style="display: inline">Ordenar por:</p>
        <button type="button" class="btn btn-default">Por nome
            <?php
            if($this->getOrder() === 0) {
                echo '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>';
            }
            else if($this->getOrder() === 1) {
                echo '<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>';
            }
            ?>
        </button>
        <button type="button" class="btn btn-default">Por data de criação
            <?php
            if($this->getOrder() === 2) {
                echo '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>';
            }
            else if($this->getOrder() === 3) {
                echo '<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>';
            }
            ?>
        </button>
        <button type="button" class="btn btn-default">Mais populares</button>
    </div>
    <?php foreach ($this->getPolls() as $index => $poll) { ?>
        <article class="col-md-4 col-lg-3 col-xs-12 listPoll">
            <header><h4><?=$poll->getTitle()?></h4></header>
            <h5><?=$poll->getDescription()?></h5>
            <h5><?=$poll->getCreatedTime()?></h5>
        </article>
    <?php }

    ?>
    <nav class="col-xs-12">
        <ul class="pager">
            <li <?php echo $disableForwards; ?> >
                <a <?php echo $disableForwards== ""?'href="search.php?search='.$this->getSearch().'&order='.$this->getOrder().'&page='.($this->getNumPage()-1):'href="#"';?> >Anterior</a>
            </li>
            <li <?php echo $disableBackwards; ?> >
                <a <?php echo $disableBackwards==""?'href="search.php?search='.$this->getSearch().'&order='.$this->getOrder().'&page='.($this->getNumPage()+1):'href="#"';?> >Seguinte</a>
            </li>
        </ul>
    </nav>
</section>

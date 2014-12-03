<?php
$disableBackwards = (count($this->getPolls()) == 0 || $this->getNumPage() == 0 ? 'class="disabled"' : "");
$disableForwards = (count($this->getPolls()) < 12 ? 'class="disabled"' : "");
?>
<section id="listpoll">
    <div class="col-xs-12 text-right order-buttons">
        <p style="display: inline">Ordenar por:</p>
        <a href=search.php?search=<?=$this->getSearch()?>&order=<?=$this->getOrder() == 0 ? 1 : 0 ?>&page=<?=$this->getNumPage()?> role="button" class="btn btn-default">Por nome
            <?php
            if($this->getOrder() == 0) {
                echo '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>';
            }
            else if($this->getOrder() == 1) {
                echo '<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>';
            }
            ?>
        </a> <!--</button> -->
        <a href=search.php?search=<?=$this->getSearch()?>&order=<?=$this->getOrder() == 2 ? 3 : 2 ?>&page=<?=$this->getNumPage()?> role="button" class="btn btn-default">Por data de criação
            <?php
            if($this->getOrder() === 2) {
                echo '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>';
            }
            else if($this->getOrder() === 3) {
                echo '<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>';
            }
            ?>
        </a>        <!-- PARA IMPLEMENTAR. ORDENADO POR POPULARIDADE -->
        <a href=search.php?search=<?=$this->getSearch()?>&order=4&page=<?=$this->getNumPage()?> role="button" class="btn btn-default">Mais Populares
            <?php
            if($this->getOrder() == 4) {
                echo '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>';
            }
            ?>
        </a>
    </div>
    <?php foreach ($this->getPolls() as $index => $poll) { ?>
        <article class="col-md-4 col-lg-3 col-xs-12 listPoll">
            <img src="img/poll/thumb/<?=$poll->getPollId()?>.jpg" height="200px" width="200px">
            <header><h4><a href="poll.php?id=<?=$poll->getPollId()?>" ><?=$poll->getTitle()?></a></h4></header>
            <h5><?=$poll->getDescription()?></h5>
            <p><small><?=$poll->getCreatedTime()?></small></p>
        </article>
    <?php }

    ?>
    <nav class="col-xs-12">
        <ul class="pager">
            <li <?php echo $disableBackwards; ?> >
                <a <?php echo $disableBackwards== ""?'href="search.php?search='.$this->getSearch().'&order='.$this->getOrder().'&page='.($this->getNumPage() - 1).'"':'href="#"';?> >Anterior</a>
            </li>
            <li <?php echo $disableForwards; ?> >
                <a <?php echo $disableForwards==""?'href="search.php?search='.$this->getSearch().'&order='.$this->getOrder().'&page='.($this->getNumPage() + 1).'"':'href="#"';?> >Seguinte</a>
            </li>
        </ul>
    </nav>
</section>

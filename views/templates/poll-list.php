<section id="listpoll">
    <?php foreach ($this->getPolls() as $index => $poll) { ?>
        <article class="col-md-4 col-xs-12 listPoll">
            <header><h2><?=$poll['title']?></h2></header>
            <h3><?=$poll['description']?></h3>
            <h3><?=$poll['created_time']?></h3>
        </article>
    <?php } ?>
</section>

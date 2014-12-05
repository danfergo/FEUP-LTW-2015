<?php foreach ($this->getPolls() as $index => $poll) { ?>
    <article class="col-md-6 col-lg-4 col-xs-12 listPoll">
        <div class="media">
            <div class="col-md-12 col-lg-12 col-sm-4 col-xs-12 text-center">
                <a href="poll.php?id=<?=$poll->getPollId()?>">
                    <img class="img-rounded" src="img/poll/thumb/<?=$poll->getPollId()?>.jpg" height="200px" width="200px">
                </a>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-12"
                <header>
                    <h4 class="text-center">
                        <a href="poll.php?id=<?=$poll->getPollId()?>">
                            <?=$poll->getTitle()?>
                        </a>
                    </h4>
                </header>
                <h5 align='justify'>
                    <?=$poll->getDescription()?>
                </h5>
                <p>
                    <small>
                        Criado por: <?=db_user_select_byid($poll->getOwnerId())->getName() ?> <br>
                        <?=$poll->getCreatedTime()?> Número de votos: <?=db_get_poll_votes_by_id($poll->getPollId())?>
                    </small>
                </p>
            </div>
        </div>
    </article>
<?php } ?>


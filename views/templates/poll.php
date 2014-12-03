<div id="poll-cover" style="background:url('img/poll/<?= $this->getPoll()->getPollId() ?>.jpg')">
    <div class="container-fluid title">
        <div class="row">
            <div class="col col-md-1 col-xs-12 social">
                <ul>
                    <li>
                    </li>
                </ul>

            </div>
            <div class="col col-md-10 col-xs-12">
                <h1><strong><?= $this->getPoll()->getTitle() ?></strong></h1>
            </div>
            <div class="col col-md-1 col-xs-0">
            </div>
        </div>
    </div>
</div>
<p class="poll-description"><?= $this->getPoll()->getDescription() ?></p>

<div class="container-fluid questions">
    <button class="btn btn-primary" id="btn-vote" poll-id="<?= $this->getPoll()->getPollId() ?>"> Votar</button>
    <div class="row">
        <?php foreach ($this->getPoll()->getQuestions() as $question) { ?>

            <div class="col-md-4">
                <h2><?= $question->getTitle() ?></h2>
                <p><?= $question->getDescription() ?></p>
                <ul question-id="<?= $question->getQuestionId() ?>" class="question">
                    <?php foreach ($question->getAnswers() as $answer) { ?> 
                        <li>
                            <label>
                                <input type="checkbox" answer-id="<?= $answer->getAnswerId(); ?>"/>
                                <?= $answer->getTitle() ?>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>



<?php
var_dump($this->getPoll());
?>

<style>
    #poll-cover{
        height:300px;
        position:relative;
        background:#eee;
        border-bottom: 1px solid #000;
    }

    #poll-cover .title{
        position:absolute;
        bottom:0;
        left:0;
        right:0;
    }

    #poll-cover .title .col{
        float:right;
    }

    h2 {
        border-bottom:1px solid #e0e0e0;
        font-size:18pt;
        line-height:130%;
        margin:0;
        margin-bottom:2px;
    }

    #poll-cover h1{
        margin:0;
        margin-bottom:-5px;

    }

    ul {
        list-style: none;
        font-size:15px;

    }

    .questions{
        margin-top:50px;
    }

    .poll-description{
        padding: 5px;
    }


</style>

<script>
    $votingdata = new Array();
    $arr = $("ul.question");



    $("#btn-vote").click(function () {
        $pollId = $(this).attr('poll-id');
        $vdata = new Array();

        $("ul.question").each(function () {
            $answers = new Array();
            $(this).find("input").each(function () {
                if ($(this).is(':checked')) {
                    $answers.push($(this).attr('answer-id'));
                }
            });
            if ($answers.length) {
                $vdata.push({'question_id': $(this).attr('question-id'), 'answers': $answers});
            }
        });
/**/
        $.post("requests/poll/vote.php?pollid=" + $pollId, {'data': JSON.stringify($vdata)}).done(function (data) {
            alert("Data Loaded: " + data);
        });
    });

</script>   
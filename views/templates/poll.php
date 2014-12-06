<?php
$poll_id = $this->getPoll()->getPollId();
?>

<script type="text/javascript">
    function popItUp(preurl,w, h){
        window.open( preurl+this.window.location.href,"", "width=" + w + ", height=" + h + ",resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no");
    }
</script>


<div id="poll-page">

    <div id="poll-cover" style="background:url('img/poll/<?= $this->getPoll()->getPollId() ?>.jpg')">
        <div class="container-fluid title">
            <div class="row">
                <div class="col col-md-2 col-xs-12 text-right">
                    <a href="javascript:popItUp('https://www.facebook.com/sharer/sharer.php?u=',600,200);"><img src="img/fb.png" alt="Partilha no facebook" width="32" height="32"/> </a> 
                    <a href="javascript:popItUp('https://plus.google.com/u/0/share?url=',600,600);"><img src="img/gp.png" alt="Partilha no Google Plus" width="32" height="32"/> </a>
                    <a href="javascript:popItUp('https://twitter.com/intent/tweet?url=',500,300);"><img src="img/tw.png" alt="Partilha no Twitter" width="32" height="32"/> </a> 
                    <a href="javascript:popItUp('https://www.reddit.com/login?dest=',500,300);"><img src="img/reddit.png" alt="Partilha no Reddit" width="32" height="32"/> </a> 
                </div>
                <div class="col col-md-9 col-xs-12">
                    <h1><strong><?= $this->getPoll()->getTitle() ?></strong></h1>
                </div>
                <div class="col col-md-1 col-xs-0">
                </div>
            </div>
        </div>
    </div>
    <p class="poll-description"><?= $this->getPoll()->getDescription() ?></p>

    <div class="container-fluid questions">
        <div class="row">
            <div class="col col-xs-12 text-right">
                <button class="btn btn-primary btn-vote" poll-id="<?= $poll_id; ?>"> Votar</button>
                <?php if ($this->isEditable()) { ?>
                    <a href="managepoll.php?id=<?= $this->getPoll()->getPollId() ?>">
                        <input type="submit" class="btn" value="Editar" ></a>
                    <a href="requests/poll/publish.php?id=<?= $this->getPoll()->getPollId() ?>">
                        <input type="submit" class="btn" value="Publicar"></a>
                <?php } ?>
            </div>
        </div>
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
        <div class="row">
            <div class="col col-xs-12 text-right">
                <button class="btn btn-primary btn-vote" poll-id="<?= $this->getPoll()->getPollId() ?>"> Votar</button>
            </div>
        </div>
    </div>


    <div class="container-fluid" id="poll-results">
        <div class="row">
            <h2>Resultados</h2>
        </div>
        <div class="row" class="graphs">

        </div>
    </div>


</div>
<style>
    #poll-results{
        margin-top:40px;
        margin-bottom:50px;
        display:none;
    }

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

    #poll-page h2 {
        border-bottom:1px solid #e0e0e0;
        font-size:18pt;
        line-height:130%;
        margin:0;
        margin-bottom:10px;
    }


    #poll-cover .title{
        background: -moz-linear-gradient(top,  rgba(255,255,255,0) 0%, rgba(255,255,255,0.7) 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0.7))); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.7) 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.7) 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.7) 100%); /* IE10+ */
        background: linear-gradient(to bottom,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.7) 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#b3ffffff',GradientType=0 ); /* IE6-9 */
        margin:0;
    }

    #poll-cover h1{
        margin: 0;
        margin-bottom: -10px;
        font-size: 60px;
    }



    #poll-page  ul {
        list-style: none;
        font-size:15px;

    }

    .questions{
        margin-top:50px;
    }

    .poll-description{
        padding: 5px;
    }

    .graph{
        overflow:hidden;
        padding:15px;
        border:1px dashed #ccc;
        border-radius:3px;
    }

    .graph .graph-bar ul{
        margin:0; 
        padding:0;
        width:100%;
    }

    .graph .graph-bar li{
        margin-bottom:25px;
    }

    .graph .graph-bar li .bar{
        background:#ccc;
        display:block;
        height:100%;        
        -webkit-transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        width:0;
        border-radius:3px;
    }

    .graph .graph-bar .bar-bg{
        background:#eee;
        display:block;
        float:left;
        width:80%;
        height:20px;
        border-radius:3px;
    }

    .graph .graph-bar .percentage-sub{
        float:left;
        width:20%;
        height:20px;
        padding-left:3px;
    }

</style>

<script>
    POLL_ID = <?= $this->getPoll()->getPollId() ?>;





    $(".btn-vote").click(function() {
        $pollId = POLL_ID;
        $vdata = new Array();

        $("ul.question").each(function() {
            $answers = new Array();
            $(this).find("input").each(function() {
                if ($(this).is(':checked')) {
                    $answers.push($(this).attr('answer-id'));
                }
            });
            if ($answers.length) {
                $vdata.push({'question_id': $(this).attr('question-id'), 'answers': $answers});
            }
        });

        $.post("requests/poll/vote.php?pollid=" + $pollId, {'data': JSON.stringify($vdata)}).done(function(data) {
            alert("Data Loaded: " + data);
        });
    });





    function graph_bars(answers) {
        var ul = $('<ul/>');
        var sum = 0;
        var span, percentage, spanBackground, percentSub;

        for (i in answers) {
            sum += parseFloat(answers[i]['votes']);
        }

        for (i in answers) {
            percentage = sum === 0 ? 0 : answers[i]['votes'] * 100 / sum;
            span = $('<div class=bar>').css('width', percentage + '%');
            spanBackground = $('<div class=bar-bg>').append(span);
            percentSub = $('<div class=percentage-sub>').text(Math.round(percentage) + '%');
            ul.append($("<li>").append('<div class=answer-title>' + answers[i]['title']).append(spanBackground).append(percentSub));
        }
        return ul;
    }

    function graph_bars_update(ul, answers) {
        var sum = 0, percentage;

        for (i in answers) {
            sum += parseFloat(answers[i]['votes']);
        }
        for (i in answers) {
            percentage = sum === 0 ? 0 : answers[i]['votes'] * 100 / sum;
            ul.find('.bar').eq(i).css('width', percentage + '%');
            ul.find('.percentage-sub').eq(i).text(Math.round(percentage) + '%');

        }
    }


    function graph_doughnut(answers) {
        var doughnutData = new Array();

        for (i in answers) {
            doughnutData.push({
                value: parseInt(answers[i]['votes']),
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: answers[i]['title']
            });
        }
        var canvas = $("<canvas width=100% height=100%>");
        var ctx = canvas[0].getContext('2d');
        canvas.data('chart', new Chart(ctx).Doughnut(doughnutData, {responsive: false}));
        return canvas;
    }


    function graph_doughnut_update(chart, answers) {
        var changed = false;
        for (i in answers) {
            if (chart.segments[i].value !== parseInt(answers[i]['votes'])) {
                chart.segments[i].value = parseInt(answers[i]['votes']);
                changed = true;
            }
        }
        if (changed)
            chart.update();
    }

    function graph(data) {
        var outside = $('<div id="graph-' + data['question_id'] + '" class="graph">');
        var graphs = $('<div class=row>').appendTo("<div class=container-fluid>");
        var graphCol = $('<div class="col-md-6 col-xs-12">');
        var leftCol = graphCol.clone().addClass('doughnut').appendTo(graphs);
        var rightCol = graphCol.clone().addClass('graph-bar').appendTo(graphs);

        var spanTitle = $("<div class=graph-title>").text(data['title']);
        outside.append(spanTitle);
        outside.append(graphs);

        rightCol.append(graph_bars(data['answers']));
        leftCol.append(graph_doughnut(data['answers']));
        return outside;
    }


    function graph_update(graph, data) {
        graph_doughnut_update(graph.find('canvas').data('chart'), data['answers']);
        graph_bars_update(graph.find('.graph-bar ul'), data['answers']);
    }

    var cell = $('<div class="col-md-4 col-xs-12">'), pollResultsRow = $("#poll-results .row").eq(1);

    setInterval(function() {
        var graphHTML;
        $.get("requests/poll/vote.php?pollid=" + POLL_ID).done(function(data) {
            for (i in data) {
                if ('question_id' in data[i] && 'answers' in data[i]) {
                    graphHTML = $("#graph-" + data[i]['question_id']);
                    if (graphHTML.length > 0) {
                        graph_update(graphHTML, data[i]);
                    } else {
                        pollResultsRow.parent().show();
                        pollResultsRow.append(cell.clone().append(graph(data[i])));
                    }
                }
            }
        });
    }, 500);

</script>   
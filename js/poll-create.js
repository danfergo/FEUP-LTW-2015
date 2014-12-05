ERROR_MESSAGE = false;
OLD_POLL_DATA = null;

WARNING = new Array();
WARNING.INVALID_POLL_TITLE = "O titulo da poll não está direito, fds.";




/**** ANSWER ****/

function Answer(question, answer) {
    $answer = answer ? answer['title'] : "";
    this.question = question;
    this.li = $("<li>");
    if (answer) {
        this.li.prepend(this.hiddenId = $('<input type=hidden>').val(answer['answer_id']));
    }
    this.li.append(this.input = $("<input type=text class=form-control>").val($answer));
}

Answer.prototype.html = function() {
    return this.li;
};

Answer.prototype.setName = function(q, a) {
    this.input.attr('name', 'answer_' + q + '_' + a);
    if (this.hiddenId)
        this.hiddenId.attr('name', 'answer_id_' + q + '_' + a);
};

Answer.prototype.rmv = function() {
    this.li.remove();
};



function RemovableAnswer(question, answer) {
    Answer.call(this, question, answer); // calls supper class constructor

    this.li.addClass("input-group");
    this.btnRemove = $("<button class='btn btn-default' tabindex='-1'>").append("<span class='glyphicon glyphicon-remove'>");
    $wrapper = $("<span class=input-group-btn>").append(this.btnRemove);

    this.btnRemove.data('answer', this);
    this.btnRemove.on('click', function(e) {
        e.preventDefault();
        var answer = $(this).data('answer');
        answer.question.rmvAnswer(answer);
    });
    this.li.append($wrapper);

}
RemovableAnswer.prototype = new Answer();


function AnswerAdder(question) {
    Answer.call(this, question); // calls supper class constructor
    this.input.addClass("answer-adder");
    this.input.val("Clique para adicionar opção de resposta.");
    this.input.data('question', this.question).on('click keydown', function(e) {
        $(this).data('question').addAnswer();
    });
}
AnswerAdder.prototype = new Answer();

/**** QUESTION ****/


function Question(question,poll) {
    this.poll = poll;

    $title = question ? question['title'] : "";
    $description = question ? question['description'] : "";



    this.li = $("<li>");
    $area = $("<div class=container-fluid>");

    $col = $("<div class='col-md-6 col-xs-12'>").append("<label class='col-md-4 control-label'>").append("<div class=col-md-8>");
    $area0 = $area.clone().append("<div class='col-md-10 col-xs-12'>").append("<div class='col-md-2 col-xs-12 text-right'>");

    $area1 = $area.clone().append($col1 = $col.clone()).append($col2 = $col.clone());
    $area2 = $area.clone().append($col3 = $col.clone()).append($col4 = $col.clone());

    $col1.find("label").html("Título:");
    $col2.find("label").html("Texto de ajuda:");

    if (question) {
        this.li.prepend(this.hiddenId = $('<input type=hidden>').val(question['question_id']));
    }
    this.inpTitle = $('<input type=text class=form-control>').val($title).appendTo($col1.find("div"));
    this.inpDescription = $('<input type=text class=form-control>').val($description).appendTo($col2.find("div"));

    $col3.find("label").html("Nº minimo de opções:");
    $col4.find("label").html("Nº máximo de opções:");
    this.selMin = $('<select class=form-control>').appendTo($col3.find("div"));
    this.selMax = $('<select class=form-control>').appendTo($col4.find("div"));


    this.li.append($area0).append($area1).append($area2);
    this.li.append(this.ol = $("<ol>"));
    this.answers = new Array();
    this.answerAdder = new AnswerAdder(this);
    this.ol.append(this.answerAdder.html());



    // default answers
    if (question) {
        for (a in question['answers']) {
            this.addAnswer(question['answers'][a]);
        }
    } else {
        this.addAnswer();
        this.addAnswer();
    }


}

Question.prototype.html = function() {
    return this.li;
};


Question.prototype.addAnswer = function(answer) {
    var answer = this.answers.length < 2 ? new Answer(this, answer) : new RemovableAnswer(this, answer);
    this.answers.push(answer);
    this.answerAdder.html().before(answer.html());
    answer.input.focus();

    this.selMin.append("<option value='" + this.answers.length + "'>" + this.answers.length);
    this.selMax.append("<option value='" + this.answers.length + "'>" + this.answers.length);
};


Question.prototype.rmvAnswer = function(answer) {
    this.answers.splice(answer.li.index(), 1);
    this.selMin.find("option:last").remove();
    this.selMax.find("option:last").remove();
    answer.rmv();
};

Question.prototype.rmv = function() {
    this.li.remove();
};

Question.prototype.data = function() {
    var data = {
        title: this.inpTitle.val(),
        answers: new Array()
    };
    for (i in this.answers) {
        data.answers.push(this.answers[i].data());
    }
    return data;
};


Question.prototype.setName = function(q) {
    for (a in this.answers) {
        this.answers[a].setName(q, a);
    }
    if (this.hiddenId)
        this.hiddenId.attr('name', 'question_id_' + q);
    this.selMin.attr('name', 'question_min_' + q);
    this.selMax.attr('name', 'question_max_' + q);
    this.inpTitle.attr('name', 'question_title_' + q);
    this.inpDescription.attr('name', 'question_description_' + q);
};


function RemovableQuestion(question,poll) {
    Question.call(this, question,poll); // calls supper class constructor
    this.li.children('.container-fluid:eq(0)').children('div:eq(1)').append(this.btnRemove = $('<input type=button class="btn btn-default" value="Remover Pergunta">'));

    this.btnRemove.data('question', this).on('click', function() {
        $(this).data('question').poll.rmvQuestion($(this).data('question'));
    });
}

RemovableQuestion.prototype = new Question();


/**** POLL ****/

function Poll(errorMsg, oldPollData) {
    this.form = $("<form class=create-poll action=requests/poll/create.php method=post enctype='multipart/form-data'>");

    this.form.append($fsPollData = $("<fieldset>").append("<legend>Dados da votação"));

    $title = "", $description = "";
    //typeof errorMsg === "string" && errorMsg !== 'EDIT_POLL'
    // this.form.append($("<div class='alert alert-danger' role=alert><strong>Erro!</strong> " + WARNING[errorMsg] + "</div>"));


    $container = $('<div class=container-fluid>').appendTo($fsPollData);
    $row = $('<div class=row>');
    $cell = $('<div class="form-group col-md-6 col-xs-12">');
    $lbl = $('<label>');
    $row1 = $row.clone().appendTo($container).append($cell.clone()).append($cell.clone());
    $row2 = $row.clone().appendTo($container).append($cell.clone()).append($cell.clone());


    $cell11 = $lbl.clone().appendTo($row1.children('div:eq(0)')).append('Título');
    $cell12 = $lbl.clone().appendTo($row1.children('div:eq(1)')).append('Descrição');
    $cell21 = $lbl.clone().appendTo($row2.children('div:eq(0)'));
    $cell22 = $lbl.clone().appendTo($row2.children('div:eq(1)'));

    if (oldPollData) {
        $title = oldPollData['title'], $description = oldPollData['description'];
        this.form.prepend(this.hiddenId = $('<input type=hidden>').val(oldPollData['poll_id']));
    }
    $cell11.append(this.inpTitle = $('<input type=text class=form-control>').val($title));
    $cell12.append(this.inpDescription = $('<input type=text class=form-control>').val($description));
    this.inpImg = $('<input type=file class=form-control>');
    $cell21.append('<label>Imagem').append(this.inpImg);
    $cell22.append('Privacidade<br><br>').append(this.inpPrivacy = $("<input type=checkbox>")).append(' Votação privada. (não aparcerá nos resultados de pesquisa)');


    this.form.append($fsQuestions = $("<fieldset>"));
    $fsQuestions.append("<legend>Questões");

    $fsQuestions.append(this.ol = $("<ol>").addClass('questions'));
    this.questions = new Array();
    $fsQuestions.append(this.btnQuestionAdder = $("<input type=button class='btn btn-default' value='Adicionar pergunta'>"));
    $div = $("<div>").append(this.btnSubmit = $("<input type=submit  class='btn btn-primary' alue='Enviar'>"));
    this.form.append($div);

    this.btnQuestionAdder.data('poll', this).on('click', function() {
        $(this).data('poll').addQuestion();
    });

    this.btnSubmit.data('poll', this).on('click', function(e) {
        $(this).data('poll').submit();
    });

    //default question
    if (oldPollData) {
        for (q in oldPollData['questions']) {
            this.addQuestion(oldPollData['questions'][q]);
        }
    } else {
        this.addQuestion(null);
    }




    this.inpImg.attr('name', 'image');
    this.inpTitle.attr('name', 'title');
    if (this.hiddenId)
        this.hiddenId.attr('name', 'poll_id');
    this.inpDescription.attr('name', 'description');
    this.inpPrivacy.attr('name', 'privacy');


}

Poll.prototype.addQuestion = function(question) {
    question = this.questions.length === 0 ? new Question(question,this) : new RemovableQuestion(question,this);
    this.questions.push(question);
    this.ol.append(question.html());
    question.inpTitle.focus();
};

Poll.prototype.html = function() {
    return this.form;
};



Poll.prototype.submit = function() {
    for (q in this.questions) {
        this.questions[q].setName(q);
    }
};


Poll.prototype.rmvQuestion = function(question){
    this.questions.splice(question.li.index(), 1);
    question.rmv();
};



$(document).ready(function() {
    $("#poll-create").append(new Poll(ERROR_MESSAGE, OLD_POLL_DATA).html());
});


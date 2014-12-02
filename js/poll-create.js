
/*var question_num = 1;
 
 function addAnswer(num) {
 $('#Answers_' + num + ' li:last').after();
 maxAnswers(num);
 }
 
 function addQuestion() {
 $('#Questions div:last').after('<div><li><label><strong>Question </strong><input type="text" id="question_1" name="question_1" required="required"></label><button onclick="removeQuestion(1); return false;"><strong>-</stron></button><br><label>Number of min answers:<input value="1" type="number" id="min_answers_0" name="min_answers" min="1" max="2"></label><label>Number of max answers:<input value="1" type="number" id="max_answers_0" name="max_answers" min="1" max="2"></label><ol id="Answers_1"><li><label><strong>Answer </strong><input type="text" name="answer_1_1" name="answer_1_1" required="required"><button onclick="removeAnswer(1); return false;"><strong>-</strong></button></label></li><li><label><strong>Answer </strong><input type="text" name="answer_' + question_num + '_2" name="answer_' + question_num + '_2" required="required"><button onclick="removeAnswer(2); return false;"><strong>-</strong></button></label></li><button onclick="addAnswer(); return false;"><strong>+</strong></button></ol></li></div>');
 num_question++;
 }
 
 function removeAnswer(num) {
 if ($('#Answers_' + num + '> li').length > 2)
 $('#Answers_' + num + ' li:last').remove();
 maxAnswers(num);
 }
 
 function removeQuestion(num) {
 if (num_question > 1) {
 $('#Questions div:last').remove();
 }
 }
 
 function maxAnswers(num) { //atualiza o atributo 'max' no numero de respotas
 var size = $('#Answers_' + num + '> li').length;
 $('#min_answers_' + num).attr('max', size);
 $('#max_answers_' + num).attr('max', size);
 }
 
 function validateForm() {
 var i;
 for (i = 1; i <= num_question; i++) {
 var size1 = $('#min_answers_' + i).val();
 var size2 = $('#max_answers_' + i).val();
 if (size1 > size2) {
 //alert("O minimo é maior que o máximo.")
 return false;
 }
 }
 return true;
 }*/

/**
function pollSerialize($form) {
    $data = {
        title: "title",
        description: "description",
        questions: new Array()
    };

    $form.find("li.question").each(function() {
        $question = {
            title: "",
            description: "",
            answers: new Array()
        };

        $(this).find("li.answer input").each(function() {
            $question.answers.push($(this).val());
        });

        $data.questions.push($question);
    });

    return $data;
}
***/

/**** ANSWER ****/

function Answer(question) {
    this.question = question;
    this.li = $("<li>");
    this.li.append(this.input = $("<input type=text class=form-control>"));
}

Answer.prototype.html = function() {
    return this.li;
};

Answer.prototype.setName = function(q, a) {
    this.input.attr('name', 'answer_' + q + '_' + a);
};

Answer.prototype.rmv = function() {
    this.li.remove();
};



function RemovableAnswer(question) {
    Answer.call(this, question); // calls supper class constructor

    this.li.addClass("input-group");
    this.btnRemove = $("<button class='btn btn-default'>").append("<span class='glyphicon glyphicon-remove'>");
    $wrapper = $("<span class=input-group-btn>").append(this.btnRemove);

    this.btnRemove.data('answer', this);
    this.btnRemove.on('click', function(e) {
        e.preventDefault();
        var answer = $(this).data('answer');
        answer.question.rmv(answer);
    });
    this.li.append($wrapper);

}
RemovableAnswer.prototype = new Answer();


function AnswerAdder(question) {
    Answer.call(this, question); // calls supper class constructor
    this.input.addClass("answer-adder");
    this.input.val("Clique para adicionar opção.");
    this.input.data('question', this.question).on('click keypress', function(e) {
        e.preventDefault();
        $(this).data('question').addAnswer();
    });
}
AnswerAdder.prototype = new Answer();

/**** QUESTION ****/


function Question() {

    this.li = $("<li>");
    $area = $("<div class=container-fluid>");
    $col = $("<div class='col-md-6 col-xs-12'>").append("<label class='col-md-4 control-label'>").append("<div class=col-md-8>");
    $area.append($col1 = $col.clone()).append($col2 = $col.clone());


    $col1.find("label").html("Minimo de opções:");
    $col2.find("label").html("Máximo de opções:");

    this.selMin = $('<select class=form-control>').appendTo($col1.find("div"));
    this.selMax = $('<select class=form-control>').appendTo($col2.find("div"));

    this.li.append(this.inpTitle = $('<input type=text class=form-control>'));
    this.li.append(this.inpDescription = $('<input type=text class=form-control>'));
    this.li.append(this.ol = $("<ol>"));
    this.answers = new Array();
    this.answerAdder = new AnswerAdder(this);
    this.ol.append(this.answerAdder.html());

    this.li.append($area);


    // default answers
    this.addAnswer();
    this.addAnswer();
}

Question.prototype.html = function() {
    return this.li;
};


Question.prototype.addAnswer = function() {
    var answer = this.answers.length < 2 ? new Answer(this) : new RemovableAnswer(this);
    this.answers.push(answer);
    this.answerAdder.html().before(answer.html());
    answer.input.focus();

    this.selMin.append("<option value='" + this.answers.length + "'>" + this.answers.length);
    this.selMax.append("<option value='" + this.answers.length + "'>" + this.answers.length);
};


Question.prototype.rmv = function(answer) {
    this.answers.splice(answer.li.index(),1);
    this.selMin.find("option:last").remove();
    this.selMax.find("option:last").remove();
    answer.rmv();
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
    this.selMin.attr('name', 'question_min_' + q);
    this.selMax.attr('name', 'question_max_' + q);
    this.inpTitle.attr('name', 'question_title_' + q);
    this.inpDescription.attr('name', 'question_description_' + q);
};





/**** POLL ****/

function Poll() {
    this.form = $("<form class=create-poll action=requests/poll/create.php method=post enctype='multipart/form-data'>").append('<div class=form-group><label>Título').append('<div class=form-group><label>Descrição');
    this.form.find('label:eq(0)').append(this.inpTitle = $('<input type=text class=form-control>'));
    this.form.find('label:eq(1)').append(this.inpDescription = $('<input type=text class=form-control>'));
    this.form.append(this.inpPrivacy = $("<select class=form-control>").append('<option value=0>Publica').append('<option value=1>Privada'));

    this.form.append($fsQuestions = $("<fieldset>"));
    $fsQuestions.append("<legend><label>Questões");
    this.form.append(this.ol = $("<ol>"));
    this.questions = new Array();
    this.form.append(this.btnQuestionAdder = $("<button type=button class='btn btn-default'>Adicionar pergunta </button>"));
    $div = $("<div>").append(this.btnSubmit = $("<input type=submit  class='btn btn-primary' alue='Enviar'>"));
    this.form.append($div);




    this.btnQuestionAdder.data('poll', this).on('click', function() {
        $(this).data('poll').addQuestion();
    });

    this.btnSubmit.data('poll', this).on('click', function(e) {
        //  e.preventDefault();
        $(this).data('poll').submit();
    });

    //default question
    this.addQuestion();

    this.inpTitle.attr('name', 'title');
    this.inpDescription.attr('name', 'description');
    this.inpPrivacy.attr('name', 'privacy');


}

Poll.prototype.addQuestion = function() {
    question = new Question();
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




$(document).ready(function() {



    /**
     * 
     * 
     * Answer.prototype.data = function() {
     return this.input.val();
     };
     Poll.prototype.data = function() {
     var data = {
     questions: new Array()
     };
     for (i in this.questions) {
     data.questions.push(this.questions[i].data());
     }
     return data;
     };
     
     * 
     $("#poll-create").on('click', ".remove-answer", function() {
     $(this).parent().remove();
     });
     
     $("#poll-create").on('click', ".add-answer", function() {
     $(this).parent().before('<li><input type="text"> <button class="remove-answer">-</button></li>');
     });
     
     $("#poll-create").on('click', ".remove-question", function() {
     $(this).parent().remove();
     });
     $("#poll-create").on('click keypress', ".add-question", function() {
     $(this).parent().before('<li> <input type="text"required="required"> <button class="remove-question">-</button> <div> <label> Number of min answers: <input value="1" type="number" min="1" max="2"> </label> <label> Number of max answers: <input value="1" type="number" min="1" max="2"> </label> </div> <ol class="answers"> <li> <input type="text" required="required"> <button class="remove-answer">-</button> </li> <li> <input type="text" required="required"> <button class="remove-answer">-</button> </li> <li> <input type="text" class="add-answer" value="Clique para adicionar opção."> </li> </ol> </li>');
     });
     
     $("#poll-create input[type='submit']").on('click', function() {
     event.preventDefault();
     
     $form = $(this).parent();
     pollSerialize($form);
     
     });
     **/


    $("#page-content").append(new Poll().html());
});


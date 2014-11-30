
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


/**** ANSWER ****/

function Answer() {
    this.li = $("<li class=input-group>");
    this.li.append(this.input = $("<input type=text class=form-control>"));
}

Answer.prototype.html = function() {
    return this.li;
};

Answer.prototype.data = function() {
    return this.input.val();
};

Answer.prototype.rmv = function() {
    this.li.remove();
};



function RemovableAnswer() {
    Answer.call(this); // calls supper class constructor

    this.btnRemove = $("<button class='btn btn-default'>").append("<span class='glyphicon glyphicon-remove'>");
    this.btnRemove.data('answer', this);

    $wrapper = $("<span class=input-group-btn>").append(this.btnRemove);
    this.btnRemove.on('click', function() {
        $(this).data('answer').rmv();
    });
    this.li.append($wrapper);

}

RemovableAnswer.prototype = new Answer();




/**** QUESTION ****/


function Question() {

    this.li = $("<li>");

    this.li.append(this.inpTitle = $('<input type=text>'));
    this.li.append(this.ol = $("<ol>"));

    this.answers = new Array();
    this.answers.push(new Answer());
    this.answers.push(new Answer());
    this.ol.append(this.answers[0].html(), this.answers[1].html());

}

Question.prototype.html = function() {
    return this.li;
};


Question.prototype.addAnswer = function() {
    var answer = new RemovableAnswer();
    this.answers.push(answer);
    this.ol.append(answer.html());
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




/**** POLL ****/

function Poll() {
    this.form = $("<form>");
    this.form.append(this.ol = $("<ol>"));

    this.questions = new Array();
    this.questions.push(new Question());
    this.ol.append(this.questions[0].html());

    this.form.append(this.btnSubmit = $("<input type=submit value='Enviar'>"));
    this.btnSubmit.data('poll', this);

    this.btnSubmit.on('click', function(e) {
        e.preventDefault();
        $(this).data('poll').submit();
    });
}

Poll.prototype.html = function() {
    return this.form;
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

Poll.prototype.submit = function() {
    console.dir(JSON.stringify(this.data()));
};




$(document).ready(function() {



    /**
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


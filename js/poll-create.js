
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


$(document).ready(function () {

    $("#poll-create .remove-answer").on('click', function () {
        $(this).parent().remove();
    });

    $("#poll-create .add-answer").on('click', function () {
        $(this).parent().before('<li><input type="text"> <button class="remove-answer">-</button></li>');
    });

    $("#poll-create .remove-question").on('click', function () {
        $(this).parent().remove();
    });
    $("#poll-create .add-question").on('click keypress', function () {
        $(this).parent().before('<li> <input type="text"required="required"> <button class="remove-question">-</button> <div> <label> Number of min answers: <input value="1" type="number" min="1" max="2"> </label> <label> Number of max answers: <input value="1" type="number" min="1" max="2"> </label> </div> <ol class="answers"> <li> <input type="text" required="required"> <button class="remove-answer">-</button> </li> <li> <input type="text" required="required"> <button class="remove-answer">-</button> </li> <li> <input type="text" class="add-answer" value="Clique para adicionar opção."> </li> </ol> </li>');
    });

    $("#poll-create input[type='submit']").on('click',function (){
        event.preventDefault();

        $data = {
            title: "title",
            description: "description",
            questions: new Array()
        };
        
        $form = $("#poll-create form");
        $form.find("li.question").each(function(i,$q){
            $question =  {
                title : "",
                description: "",
                answers: new Array()
            };
            console.dir($q.find("li.answer input"));
            $q.find("li.answer input").each(function(i,$a){
                $question.answers.push($a.val());
            });
            
            $data.questions.push($question);
        });
        console.dir($data);
    });

});


<html>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        var num_question = 1;
        function addAnswer(num) {
            $('#Answers_'+num+' li:last').after( '<li><label><strong>Answer </strong><input type="text" name="answer" required="required"></label></li>' );
            maxAnswers(num);
        }
            
        function addQuestion() {
            $('#Questions div:last').after();
            num_question++;
        }
            
        function removeAnswer(num) {
            if($('#Answers_'+num+'> li').length > 2)    $('#Answers_'+num+' li:last').remove();
            maxAnswers(num);
        }
        
        function removeQuestion(num) {
            if(num_question > 1){   
                    $('#Questions div:last').remove();
                }
        }
        
        function maxAnswers(num) { //atualiza o atributo 'max' no numero de respotas
            var size = $('#Answers_'+num+'> li').length;
            $('#min_answers_'+num).attr('max', size);
            $('#max_answers_'+num).attr('max', size);
        }
                
        function validateForm() {
            var i;
            for(i=1; i <= num_question; i++){
                var size1 = $('#min_answers_'+i).val();
                var size2 = $('#max_answers_'+i).val();
                if(size1 > size2){
                    //alert("O minimo é maior que o máximo.")
                    return false;
                }
            }
            return true;
        }


    </script>

    <head>
        <title>Creating a Poll</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div>
            <form action="newpoll.php" onsubmit="return validateForm()" method="get">
                <ol id="Questions">
                    <div><li><label><strong>Question </strong>
                        <input type="text" id="question_1" name="question_1" required="required"></label>
                        <button onclick="removeQuestion(1); return false;"><strong>-</stron></button><br>
                        <label>Number of min answers:<input value="1" type="number" id="min_answers_0" name="min_answers" min="1" max="2"></label>
                        <label>Number of max answers:<input value="1" type="number" id="max_answers_0" name="max_answers" min="1" max="2"></label>
                    <ol id="Answers_1">
                        <li><label><strong>Answer </strong>
                            <input type="text" name="answer_1_1" name="answer_1_1" required="required">
                            <button onclick="removeAnswer(1); return false;"><strong>-</stron></button>
                            </label>
                        </li>
                        <li><label><strong>Answer </strong>
                            <input type="text" name="answer_1_2" name="answer_1_2" required="required">
                            <button onclick="removeAnswer(2); return false;"><strong>-</stron></button>
                            </label>
                        </li>
                        <button onclick="addAnswer(); return false;"><strong>+</strong></button>
                    </ol></li></div>
                    <button onclick="addQuestion(); return false;"><strong>+</strong></button>
                </ol>
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>
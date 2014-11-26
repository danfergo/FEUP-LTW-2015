<html>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        var num_question = 1;
        function addAnswer(num) {
            $('#Answers'+num+' li:last').after( '<li><label><strong>Answer </strong><input type="text" name="answer" required="required"></label></li>' );
            }
        function addQuestion() {
            $('#Questions div:last').after( '<div><li><label><strong>Question </strong><input type="text" name="question" required="required"></label><br><label>Number of choiceable answers:<input type= "number" name="num_choiceable_answers" min="0" max="20"></label><ol id="Answers'+num_question+'"><li><label><strong>Answer </strong><input type="text" name="answer" required="required"></label></li><li><label><strong>Answer </strong><input type="text" name="answer" required="required"></label></li><button onclick="addAnswer('+num_question+'); return false;"><strong>+</stron></button><button onclick="removeAnswer('+num_question+'); return false;"><strong>-</stron></button></ol></li></div>' );
            num_question++;
            }
        function removeAnswer(num) {
            if($('#Answers'+num+'> li').length > 2)    $('#Answers'+num+' li:last').remove();
        }
        function removeQuestion() {
            if(num_question > 1){   
                    $('#Questions div:last').remove();
                    num_question--;
                }
        }
    </script>

    <head>
        <title>Creating a Poll</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div>
            <form action="newpoll.php" method="get">
                <ol id="Questions">
                    <div><li><label><strong>Question </strong>
                                <input type="text" name="question" required="required"></label><br>
                    <label>Number of choiceable answers:<input type= "number" name="num_choiceable_answers" min="0" max="20"></label>
                    <ol id="Answers0">
                        <li><label><strong>Answer </strong>
                            <input type="text" name="answer" required="required">
                            </label>
                        </li>
                        <li><label><strong>Answer </strong>
                            <input type="text" name="answer" required="required">
                            </label>
                        </li>
                        <button onclick="addAnswer(0); return false;"><strong>+</stron></button>
                            <button onclick="removeAnswer(0); return false;"><strong>-</stron></button>
                    </ol></li></div>
                    <button onclick="addQuestion(); return false;"><strong>+</stron></button>
                        <button onclick="removeQuestion(); return false;"><strong>-</stron></button>
                </ol>
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>
<html>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        var num_question = 1;
        function addAnswer(elem) { //terminar numero das resposta
            $('#newAnswer p:last').before( '<p><li><label><strong>Answer </strong><input type="text" name="Answer" required="required"></label></li></p>' );
            }
        function addQuestion() {
            $('#newQuestion p:last').before( '<p><li><label><strong>Question</strong><input type="text" name="Question" required="required"></label><ol id="newAnswer'+1+'"><p><li><label><strong>Answer</strong><input type="text" name="Answer" required="required"></label></li></p><p><li><label><strong>Answer</strong><input type="text" name="Answer" required="required"></label></li></p><button onclick="addAnswer(); return false;"><strong>+</stron></button></ol></li></p>' );
            num_question++;
            }
    </script>

    <head>
        <title>Creating a Poll</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div>
            <form action="newpoll.php" method="get">
                <ol id="newQuestion">
                    <p><li><label><strong>Question</strong>
                    <input type="text" name="Question" required="required">
                        </label>
                    <ol id="newAnswer">
                        <p><li><label><strong>Answer</strong>
                            <input type="text" name="Answer" required="required">
                            </label>
                        </li></p>
                        <p><li><label><strong>Answer</strong>
                            <input type="text" name="Answer" required="required">
                            </label>
                        </li></p>
                        <button onclick="addAnswer(); return false;"><strong>+</stron></button>
                    </ol></li></p>
                    <button onclick="addQuestion(); return false;"><strong>+</stron></button>
                </ol>
                <input type="submit" value="submit">
            </form>
        </div>
    </body>
</html>
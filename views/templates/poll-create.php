
<div id="poll-create">
    <form>

        <ol class="questions">
            <li class="question">
                <input type="text"required="required">
                <button class="remove-question">-</button>
                <div>
                    <label>
                        Number of min answers:
                        <input value="1" type="number"  min="1" max="2">
                    </label>
                    <label>
                        Number of max answers:
                        <input value="1" type="number"  min="1" max="2">
                    </label>
                </div>
                <ol class="answers">
                    <li class="answer">
                        <input type="text"  required="required">
                        <button class="remove-answer">-</button>
                    </li>
                    <li class="answer">
                        <input type="text"  required="required">
                        <button class="remove-answer">-</button>
                    </li>
                    <li>
                        <input type="text" class="add-answer" value="Clique para adicionar opção.">
                    </li>
                </ol>
            </li>
            <li>
                <input type="text" class="add-question" value="Clique para adicionar outra pergunta">
            </li>
        </ol>
        <input type="submit" value="Submit">
    </form>
</div>

<style>

    /*fieldset{
        margin-top: 10px;
    }

    fieldset:first-of-type{
        margin-top: 0px;
    }

    #submitmessage{
        //margin-top: 5px;
    }*/

</style>

<section>
    <form>

        <fieldset>
            <legend>Informação Pessoal</legend>
            <div class="container-fluid">
                <label>Nome:
                    <input type="text" name="username" required="required">
                </label>
            </div>

            <div class="container-fluid">
                <label>E-mail:
                    <input type="mail" name="email" required="required">
                </label>
            </div>
        </fieldset>

        <fieldset>
            <legend>Informação a Enviar</legend>

            <div class="container-fluid">
                <label>Assunto:
                    <select>
                        <option value="bug" selected>Reportar Erros</option>
                        <option value="poll">Reportar Questionáio</option>
                        <option value="sugestion">Sugestão</option>
                        <option value="doubt">Dúvida</option>
                        <option value="other" selected="selected">Outro Assunto</option>
                    </select>
                </label>
            </div>

            <br>

            <div class="container-fluid">
                <label>Mensagem:
                    <textarea name="message" rows="8" cols="50" required="required"></textarea>
                </label>
            </div>

        </fieldset>
        <input id="submitmessage" type="submit" value="Enviar">
    </form>

</section>
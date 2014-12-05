<style>

    fieldset {
        margin-bottom: 40px;
    }

    /*.btn-primary {
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
    }*/

</style>


<div class="container-fluid">
    <form>
        <center><p><h1><strong>Contacto<strong></h1></p>
            <p><h5>Caso nos deseje contactar pode enviar uma mensagem através do serviço disponibilizado.</h5></p>
        </center>
        <fieldset>
            <legend>Informação Pessoal</legend>
            <div class="row">
                <div class="col-xs-12 col-md-3 form-group">
                    <label>Nome:
                        <input class="form-control" type="text" name="username" required="required">
                    </label>
                </div>
                <div class="col-xs-12 col-md-3 form-group">
                    <label>E-mail:
                        <input class="form-control" type="mail" name="email" required="required">
                    </label>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Informação a Enviar</legend>
            <div class="col-xs-12 col-md-3 form-group">
                <label>Assunto:
                    <select class="form-control">
                        <option value="bug" selected>Reportar Erros</option>
                        <option value="poll">Reportar Questionáio</option>
                        <option value="sugestion">Sugestão</option>
                        <option value="doubt">Dúvida</option>
                        <option value="other" selected="selected">Outro Assunto</option>
                    </select>
                </label>
            </div>

            <br>

            <div class="form-group">
                <label>Mensagem:
                    <textarea class="form-control" name="message" rows="8" cols="50" required="required"></textarea>
                </label>
            </div>

        </fieldset>
        <input class="btn btn-primary" type="submit" value="Enviar">
    </form>

</div>
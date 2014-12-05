<style>

    fieldset {
        margin-bottom: 40px;
    }

</style>

<div class="container-fluid">
    <form id="sendemail" method="post">
        <center><p><h1><strong>Contacto<strong></h1></p>
            <p><h5>Caso nos deseje contactar pode enviar uma mensagem através do serviço disponibilizado.</h5></p>
        </center>
        <fieldset><!--$blah = php_function(); echo"$blah";-->
            <legend>Informação Pessoal</legend>
            <div class="row">
                <div class="col-xs-12 col-md-3 form-group">
                    <label>Nome:
                        <input class="form-control" type="text" name="username" value="<?=$this->formUsername();?>" required="required">
                    </label>
                </div>
                <div class="col-xs-12 col-md-3 form-group">
                    <label>E-mail:
                        <input class="form-control" type="mail" name="email" value="<?=$this->formEmail();?>" required="required">
                    </label>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Informação a Enviar</legend>
            <div class="col-xs-12 col-md-3 form-group">
                <label>Assunto:
                    <select name="subject" class="form-control">
                        <option value="Reportar Erros">Reportar Erros</option>
                        <option value="Reportar Questionario">Reportar Questionário</option>
                        <option value="Sugestao">Sugestão</option>
                        <option value="Duvida">Dúvida</option>
                        <option value="Outro Assunto" selected="selected">Outro Assunto</option>
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
        <input class="btn btn-primary" type="submit" onsubmit="sendEmail()" value="Enviar">
    </form>
</div>
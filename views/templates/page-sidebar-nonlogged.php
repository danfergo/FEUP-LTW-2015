<form action="index.php" method="post" id="user-login">
    <fieldset>
        <legend>Login</legend>
        <label>
            Email:<br>
            <input class='form-control' type="email" name="email">
        </label><br>
        <label>
            Password:<br>
            <input class='form-control' type="password" name="password">
        </label><br>
        <input type="submit" class="btn btn-primary" value="Login">
    </fieldset>
</form>


<form action="index.php" method="post" id="user-register" class="form-group">
    <fieldset>
        <legend>Registar</legend>
        <label>
            Nome:<br>
            <input class='form-control' type="text" name="name">
        </label><br>
        <label>
            Email:<br>
            <input class='form-control' type="email" name="email">
        </label><br>
        <label>
            Password:<br>
            <input class='form-control' type="password" name="password">
        </label><br>
        <label>
            Repita a password:<br>
            <input class='form-control' type="password" name="re_password">
        </label><br>
        <label>
            Data nascimento:<br>
            <input class='form-control' type="date" name="birthday">
        </label><br>
        <input type="submit" class="btn btn-primary" value="Registar">
    </fieldset>
</form>


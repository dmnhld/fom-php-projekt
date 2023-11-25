<div class="form-control" style="display: grid; place-items: center;">
    <h1 style="margin-bottom: 12px">Login</h1>
    <form action="?controller=user&action=getLogin" method="post">
        <div>
            <label for="username">Benutzername</label><br>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Passwort</label><br>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button class="btn" style="width: 100%;" type="submit">Login</button>
        </div>
    </form>
</div>

<hr style="margin: 30px auto; width: 200px;">

<div style="text-align: center">
    Sie haben noch keinen Account? Registrieren Sie sich <a href="?controller=user&action=register">hier</a>.
</div>
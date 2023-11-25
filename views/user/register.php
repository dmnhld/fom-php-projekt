<div class="form-control" style="display: grid; place-items: center;">
    <h1 style="margin-bottom: 12px">Registrieren</h1>
    <form action="?controller=user&action=getRegister" method="post">
        <div>
            <label for="firstname">Vorname</label><br>
            <input type="text" name="firstname" id="firstname" required>
        </div>
        <div>
            <label for="lastname">Nachname</label><br>
            <input type="text" name="lastname" id="lastname" required>
        </div>
        <div>
            <label for="username">Benutzername</label><br>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Passwort</label><br>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="password_rp">Passwort wiederholen</label><br>
            <input type="password" name="password_rp" id="password_rp" required>
        </div>
        <div>
            <button class="btn" style="width: 100%;" type="submit">Register</button>
        </div>
    </form>
</div>

<hr style="margin: 30px auto; width: 200px;">

<div style="text-align: center">
    Sie haben schon einen Account? Loggen Sie sich <a href="?controller=user&action=index">hier</a> ein.
</div>
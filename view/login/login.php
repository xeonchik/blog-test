<?php

/** @var string|null $error */
?>
<form action="/login" method="post" class="login-form">
    <?php if ($this->error): ?>
    <div class="error"><?=$this->error?></div>
    <?php endif; ?>
    <label>
        Benutzername: <input type="text" name="login">
    </label>
    <label>
        Passwort: <input type="password" name="password">
    </label>

    <label>
        <input type="submit" name="submit" value="Login">
    </label>
</form>

<?php
isConnected();

$title = 'se connecter';

$errors = getErrorUserLogin($_POST);
if (empty($errors) && !empty($_POST)) {
    $user = getUserFieldOrField($_POST['utilisateur'], 'utilisateur', 'email');
    if (empty($user)) {
        throw new Exception("nous n'avons pas pu trouver un utilisateur");
    }
    $verifyPassword = verifyPassword($_POST['password'], $user['password']);
    if (!$verifyPassword) {
        $errors['password'] = "le mot de passe est incorrect.";
    } else {
        $message = sprintf("vous êtes connecté %s", $user['utilisateur']);
        setFlash('success', $message, generate('store'));
        setSession(SESSION_USER, $user);
        createBanque($user['utilisateur_id']);
        redirect(generate('store'));
    }
}
?>
<div class="container <?= !empty($errors) ? 'is-error' : '' ?>">
        <h2>Se connecter</h2>
        <?= flash() ?>
        <form action="" class="form" method="post">
            <div class="form-group">
                <?= inputField('utilisateur', [
                    'type' => 'text',
                    'class' => 'field',
                    'placeholder' => "nom d'utilisateur ou email"
                ], $_POST, $errors) ?>
            </div>
            <div class="form-group">
                <?= inputField('password', [
                    'type' => 'password',
                    'class' => 'field',
                    'placeholder' => "mot de passe"
                ], $_POST, $errors) ?>
            </div>
            <button type="submit">se connecter</button>

        </form>
        <div class="options">
            <a href="<?= generate('user.create') ?>">créer un compte</a>
            <a href="<?= generate('user.your-email') ?>">mot de passe oublié</a>
        </div>
    </div>

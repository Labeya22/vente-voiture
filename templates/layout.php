<?php
$user = getSession(SESSION_USER);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= dist('css/app.css') ?>">
    <link rel="stylesheet" href="<?= dist('css/toast.css') ?>">
    <link rel="stylesheet" href="<?= dist('vendor/fontawesome/css/all.css') ?>">
    <link rel="shortcut icon" href="<?= dist('images/favicon.svg') ?>" type="image/x-icon">
    
    <script src="<?= dist('js/app.js') ?>" type="module" defer></script>
    <script src="<?= dist('js/cart.js') ?>" type="module" defer></script>
    <script src="<?= dist('js/message.js') ?>" type="module" defer></script>
    <title> vente de vehicule<?= isset($title) ? sprintf(" | %s", $title) : ''  ?></title>
</head>
<body>
        <!-- header -->
    <div class="header" id="header">
        <nav class="nav" id="nav">
            <a class="brand" href="#">
                <span class="fa fa-car brand-icon"></span>
                <span class="brand-text">vehicule-vente</span>
            </a>
            <div class="nav-menu" id="nav-menu">
                <ul class="nav-list">
                    <?=  li('Accueil', generate('home')) ?>
                    <?=  li('A propos', generate('about')) ?>
                    <?=  li('Stores', generate('store')) ?>
                    <?=  li('Factures', generate('facture.all')) ?>
                    <?=  li('Contact', generate('contact')) ?>

                    <?php if (!is_null($user)): ?>
                    <?= $user['role'] === 'admin' ?  li('Admin', generate('admin.dash')): '' ?>
                    <?php endif ?>
                </ul>
                <span class="fa fa-xmark close-nav-menu" id="close-nav"></span>
            </div>
            <div class="nav-options">
             <?php if (hasSession(SESSION_USER)) : ?>
           
                <div class="nav-option">
                    <?= linkOption(
                        generate('cart'), 
                        'fa fa-shopping-cart', 
                        [
                            'id' => 'cart-shop',
                            'url' => generate('cart.news')
                        ], '') ?>
                </div>
                
                <?= bell($user['utilisateur_id']) ?>
             
                <div class="nav-option">
                    <span class="separator">|</span>
                </div>
                    <div class="nav-option">
                        <?= linkOption(generate('user.profil'), 'fa fa-user') ?>
                    </div>
                    <div class="nav-option">
                        <?= linkOption(generate('user.logout'), 'fa fa-sign-out', [
                            'onclick' => "return confirm('Vous voulez vraiment effectuer cette action.')"
                        ]) ?>
                    </div>
                <?php else: ?>
                    <?= linkOption(generate('user'), 'fa fa-sign-in') ?>
                <?php endif ?>
                <div class="nav-option screen-sm" id="navbar">
                    <a href="#" class="link-option"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </nav>
    </div>
    <!-- end header -->
    <main class="main"><?= $content ?></main>


    <script src="<?= dist('vendor/typewriterjs/dist/core.js') ?>"></script>

    <script type="text/javascript">
        (function () {
            const write = document.querySelector('#write')
            if (write) {
                const options = {
                    strings: ['rapidement', 'facilement', 'simplement'],
                    autoStart: true,
                    loop: true
                }
                const instance = new Typewriter('#write', options);
            }
        }())
    </script>
    <div id="preloader"></div>

</body>
</html>
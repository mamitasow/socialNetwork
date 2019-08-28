<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="index.php"> <?= WEBSITE_NAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item  <?= set_active('index') ?>">
                    <a class="nav-link" href="index.php">Acceuil <span class="sr-only">(current)</span></a>
                </li>
            <?php if(is_logged_in() ):?>

            <li class="nav-item<?= set_active('profile') ?> ">
                    <a class="nav-link" href="profile.php?id=<?= get_session('user_id')?>">Profile</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="logout.php">Deconnexion</a>
                </li>
<?php else:?>
                <li class="nav-item<?= set_active('login') ?> ">
                    <a class="nav-link" href="login.php">Connexion</a>
                </li>
                <li class="nav-item <?= set_active('register') ?>">
                    <a class="nav-link" href="register.php">Inscription</a>
                </li>
<?php endif;?>
            </ul>
        </div>
    </nav>
</header>
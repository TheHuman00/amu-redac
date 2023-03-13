<?php $rapports_header = find_all('rapports');?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="🚑 Faire son rapport AMU au fur et à mesure ! 🏥 Aide rédaction rapport de stage amu ambulance. amu redac">
        <meta name="author" content="TheHuman00" />
        <title><?php if(!empty($pagetitre)){echo $pagetitre;}else{echo "AMU-Rédac";}?></title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                    <?php if(!empty($navfix) && $navfix == true):?>
                    <nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
                    <?php else:?>
                    <nav class="navbar navbar-marketing navbar-scrolled navbar-expand-lg bg-transparent navbar-dark">
                    <?php endif;?>
                        <div class="container px-5">
                        <a href="index">
                        <img class="navbar-brand" src="https://i.imgur.com/vbkFYtb.png" height="55" wight="55" alt="logo">
                        </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto me-lg-5">
                                    <li class="nav-item"><a class="nav-link" href="index">Accueil</a></li>
                                    <li class="nav-item dropdown dropdown-s no-caret">
                                        <a class="nav-link dropdown-toggle" id="navbarDropdownDemos" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Mes rapports
                                            <i class="fas fa-chevron-right dropdown-arrow"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up me-lg-n25 me-xl-n15" aria-labelledby="navbarDropdownDemos">
                                            <div class="row g-0">
                                                <a class="dropdown-item" href="rapport">Tous mes rapports</a>
                                                <div class="dropdown-divider border-0 d-lg-none"></div>
                                            </div>
                                            <?php foreach($rapports_header as $rapport):
                                                    if($rapport['user'] == $user['email']):?>
                                                <div class="row g-0">
                                                    <a class="dropdown-item" href="view_rapport?id=<?php echo $rapport['id'];?>"><?php echo $rapport['title'];?></a>
                                                    <div class="dropdown-divider border-0 d-lg-none"></div>
                                                </div>
                                            <?php endif; endforeach;?>
                                        </div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="contact">Info / Contact</a></li>
                                    <li class="nav-item dropdown dropdown-s no-caret">
                                        <a class="nav-link dropdown-toggle" id="navbarDropdownDemos" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Mon compte
                                            <i class="fas fa-chevron-right dropdown-arrow"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up me-lg-n25 me-xl-n15" aria-labelledby="navbarDropdownDemos">
                                            <?php if($session->isUserLoggedIn()): ?>
                                            <div class="row g-0">
                                                <a class="dropdown-item" href="changer_mdp">Changer de mot de passe</a>
                                                <div class="dropdown-divider border-0 d-lg-none"></div>
                                            </div>
                                            <div class="row g-0">
                                                <a class="dropdown-item" href="logout">Se déconnecter</a>
                                                <div class="dropdown-divider border-0 d-lg-none"></div>
                                            </div>
                                            <?php else:?>
                                            <div class="row g-0">
                                                <a class="dropdown-item" href="register">Se créer un compte</a>
                                                <div class="dropdown-divider border-0 d-lg-none"></div>
                                            </div>
                                            <div class="row g-0">
                                                <a class="dropdown-item" href="login">Se connecter</a>
                                                <div class="dropdown-divider border-0 d-lg-none"></div>
                                            </div>
                                            <?php endif;?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <?php if($session->isUserLoggedIn()):?>
                            <a class="btn fw-500 btn-sm ms-lg-4 btn-danger" href="logout">
                                    Se déconnecter
                                    <i class="ms-2" data-feather="arrow-right"></i>
                                </a>
                                <?php else:?>
                                    <a class="btn fw-500 btn-sm ms-lg-4 btn-teal" href="login">
                                    Se connecter
                                    <i class="ms-2" data-feather="arrow-right"></i>
                                </a>
                                <?php endif;?>
                        </div>
                    </nav>




                    
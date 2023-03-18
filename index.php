<?php $pagetitre = "Accueil - AMU-Rédac";
$navfix = true;
$lgfooter = true;
include_once('./includes/load.php');
$user = current_user();
include_once('./libs/header.php'); ?>
<header class="page-header-ui page-header-ui-dark bg-gradient-primary-to-secondary">
    <div class="page-header-ui-content pt-1">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-up">
                    <h1 class="page-header-ui-title">Une petite aide pour mes futurs AMU &#60;3</h1>
                            <p class="page-header-ui-text mb-5">Création simplifié : Permet de prendre des notes structurées pendant les stages ! Faire son rapport au fur et à mesure.</p>
                            <a class="btn btn-teal fw-500 me-2" href="rapport">
                                Commencer rapport
                                <i class="ms-2" data-feather="arrow-right"></i>
                            </a>
                            <a class="btn btn-link fw-500" href="contact">Ca marche comment ? <i class="ms-2" data-feather="arrow-right"></i></a>
                </div>
                <div class="col-lg-6 d-none d-lg-block" data-aos="fade-up" data-aos-delay="100"><img class="img-fluid" src="./assets/img/pres.jpg" alt="Image de présentation du service"/></div>
            </div>
        </div>
    </div>
    <div class="svg-border-rounded text-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
        </svg>
    </div>
</header>
<section class="bg-white py-10">
    <div class="container px-5">
        <div class="row gx-5 text-center">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="fast-forward"></i></div>
                <h3>Simplifié</h3>
                <p class="mb-0">Formulaire qui insère toutes les informations dans le rapport. Permet de prendre des notes structurées pendant les stages !</p>
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="pen-tool"></i></div>
                <h3>Fichier .docx</h3>
                <p class="mb-0">A la fin de la création, un fichier .docx avec votre rapport sera donnné.</p>
            </div>
            <div class="col-lg-4">
                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="bar-chart"></i></div>
                <h3>Faire son rapport au fur et à mesure</h3>
                <p class="mb-0">Vous pouvez faire mission par mission, les données seront enregistrées.</p>
            </div>
        </div>
    </div>
</section>
<section class="bg-dark py-10">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center text-center">
            <div class="col-lg-8">
                <div class="badge bg-transparent-light rounded-pill badge-marketing mb-4">Disclaimer</div>
                <h2 class="text-white">⚠️ Attention ⚠️</h2>
                <p class="lead text-white-50 mb-5">L'<strong>ifamu</strong> n'a en aucun cas accepter l'existence de ceci. Cette plateforme n'a aucun lien avec l'école. Elle est simplement alimenté par ses étudiants !</p>
            </div>
        </div>
    </div>
    <div class="svg-border-rounded text-light">
        <!-- Rounded SVG Border-->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
        </svg>
    </div>
</section>
</main>
</div>
<?php require_once('./libs/footer.php'); ?>
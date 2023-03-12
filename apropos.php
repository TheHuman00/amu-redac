<?php $pagetitre = "AMU-Rédac";
require_once('includes/load.php');
$footerdark = true;
$user = current_user();
include_once('./libs/header.php'); ?>
                    <header class="page-header-ui page-header-ui-light bg-white">
                        <div class="page-header-ui-content">
                            <div class="container px-5">
                                <div class="row gx-5 justify-content-center">
                                    <div class="col-xl-8 col-lg-10 text-center mb-4" data-aos="fade">
                                        <h1 class="page-header-ui-title">Tout le site est en open-source</h1>
                                        <p class="page-header-ui-text">Un organigramme explique toute la structure du site - <strong>Regarder aussi les crédits ci-dessous</strong></p>
                                        <a class="btn btn-primary fw-500 me-2" href="#!">Voir le code</a>
                                        <a class="btn btn-link fw-500 me-2" href="assets/img/org.png">Voir l'organigramme du site<i class="ms-2" data-feather="arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-rounded text-light">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                        </div>
                    </header>
                    <section class="bg-light pb-10 pt-10">
                        <div class="container px-5">
                            <div class="device-laptop text-gray-200 mt-n10" data-aos="fade-up">
                                <svg class="device-container" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="83.911 298.53 426.962 243.838"><path d="M474.843 516.208V309.886c0-6.418-4.938-11.355-11.354-11.355H131.791c-6.417 0-11.354 4.938-11.354 11.355v206.816H83.911v13.326c4.938 7.896 31.098 12.34 40.969 12.34h345.024c10.366 0 36.526-4.936 40.969-12.34v-13.326h-36.03v-.494zM134.26 313.341h326.762v203.361H134.26V313.341z"></path></svg>
                                <img class="device-screenshot" src="https://i.imgur.com/0zSWdUC.png" />
                            </div>
                        </div>
                    </section>
                    <section class="bg-light pb-10 pt-5">
                        <div class="container px-5">
                                <div class="card z-1 mb-n10">
                                        <div class="card-body text-center py-5">
                                        <h1>CREDITS</h1>
                                        <p class="lead">Merci à toutes ces aides !</p>
                                        <h2 class="mb-3"><a href="https://fullcalendar.io/">FullCalendar</a></h2>
                                        <p>La librairie qui a permis de générer plus facialement un calendrier.</p>
                                        <h2 class="mb-3"><a href="https://getbootstrap.com/">GetBootStrap</a></h2>
                                        <p>Une librairie pour du CSS préassemblé.</p>
                                        <h2 class="mb-3"><a href="https://startbootstrap.com/">StartBootStrap</a></h2>
                                        <p>La template de tout le site.</p>
                                        <h2 class="mb-3"><a href="https://fontawesome.com">FontAwesome</a></h2>
                                        <p>Pour les icones du site.</p>
                                        <h2 class="mb-3"><a href="https://feathericons.com">FeatherIcons</a></h2>
                                        <p>Pour les icones du site.</p>
                                        <h2 class="mb-3"><a href="https://michalsnik.github.io/aos/">AOS</a></h2>
                                        <p>Animation lors du "scrollage".</p>
                                        </div>
                                    </div>
                        </div>

                    </section>
</main>

<?php include_once('libs/footer.php'); ?>
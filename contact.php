<?php $pagetitre = "Contact - AMU-Rédac";
require_once('includes/load.php');
$footerdark = true;
$user = current_user();
include_once('./libs/header.php'); ?>
            <header class="page-header-ui page-header-ui-dark bg-img-repeat bg-primary" style="background-image: url('assets/img/backgrounds/pattern-shapes.png')">
                        <div class="page-header-ui-content">
                            <div class="container px-5">
                                <div class="row gx-5 justify-content-center">
                                    <div class="col-xl-8 col-lg-10 text-center">
                                        <h1 class="page-header-ui-title">Site en OPEN-SOURCE sur GITHUB</h1>
                                        <p class="page-header-ui-text mb-5">Contact moi comme tu peux ahhah</p>
                                        <a class="btn btn-dark fw-500 me-2" href="https://github.com/TheHuman00/amu-redac" target="_blank" rel="noopener">GitHub</a>
                                        <a class="btn btn-secondary fw-500" href="https://discord.gg/EkXxgTz7FV" target="_blank" rel="noopener">Discord</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-waves text-light">
                            <!-- Wave SVG Border-->
                            <svg class="wave" style="pointer-events: none" fill="currentColor" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 75">
                                <defs>
                                    <style>
                                        .a {
                                            fill: none;
                                        }
                                        .b {
                                            clip-path: url(#a);
                                        }
                                        .d {
                                            opacity: 0.5;
                                            isolation: isolate;
                                        }
                                    </style>
                                </defs>
                                <clippath id="a"><rect class="a" width="1920" height="75"></rect></clippath>
                                <g class="b"><path class="c" d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48"></path></g>
                                <g class="b"><path class="d" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10"></path></g>
                                <g class="b"><path class="d" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24"></path></g>
                                <g class="b"><path class="d" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150"></path></g>
                            </svg>
                        </div>
                    </header>
                    <section class="bg-white py-5">
                        <div class="container px-5">
                            <div class="row gx-5">
                                <div class="col-md-6 col-xl-4 mb-5">
                                    <div class="card card-team">
                                        <div class="card-body">
                                            <img class="card-team-img mb-3" src="./assets/img/emoji.jpg" alt="..." />
                                            <div class="card-team-name">Guillaume</div>
                                            <div class="card-team-position mb-3">Développeur</div>
                                            <p class="small mb-0">Jeune AMU (fin j'espère)</p>
                                            <p class="small mb-0"><a href="mailto:support@amu-redac.com">support@amu-redac.com</a></p>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a class="btn btn-icon btn-transparent-dark mx-1" href="https://discord.gg/DfrY7Qfym9"><i class="fab fa-discord"></i></a>
                                            <a class="btn btn-icon btn-transparent-dark mx-1" href="mailto:support@amu-redac.com"><i class="far fa-envelope"></i></a>
                                            <a class="btn btn-icon btn-transparent-dark mx-1" href="https://github.com/TheHuman00"><i class="fab fa-github"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4 mb-5">
                                    <div class="card card-team">
                                        <div class="card-body">
                                            <img class="card-team-img mb-3" src="./assets/img/empty-emoji.png" alt="..." />
                                            <div class="card-team-name">Envie de nous aider ?</div>
                                            <div class="card-team-position mb-3">Des places de libre pour vous</div>
                                            <p class="small mb-0">Faire partie de l'équipe ?</p>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a class="btn btn-icon btn-transparent-dark mx-1" href="login"><i class="fas fa-user-md"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <header class="page-header-ui page-header-ui-light bg-white">
                        <div class="page-header-ui-content">
                            <div class="container px-5">
                                <div class="row gx-5 justify-content-center">
                                    <div class="col-xl-8 col-lg-10 text-center mb-4" data-aos="fade">
                                        <h1 class="page-header-ui-title">Tout le site est en open-source</h1>
                                        <a class="btn btn-primary fw-500 me-2" href="https://github.com/TheHuman00/amu-redac" target="_blank" rel="noopener">Voir le code</a>
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
                                <img class="device-screenshot" src="./assets/img/repo.png" />
                            </div>
                        </div>
                    </section>
                    <section class="bg-light pb-10 pt-5">
                        <div class="container px-5">
                                <div class="card z-1 mb-n10">
                                        <div class="card-body text-center py-5">
                                        <h1>CREDITS</h1>
                                        <p class="lead">Merci à toutes ces aides !</p>
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
            <div id="layoutDefault_footer">
            <?php if(!empty($lgfooter) && $lgfooter == true):?>
                <footer class="footer pt-10 pb-5 mt-auto bg-light footer-light">
                    <div class="container px-5">
                        <div class="row gx-5">
                            <div class="col-lg-3">
                                <div class="footer-brand">AMU-Rédac</div>
                                <div class="mb-3">Aide à la rédaction</div>
                                <div class="icon-list-social mb-5">
                                    <a class="icon-list-social-link"><i class="fas fa-align-justify"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row gx-5">
                                    <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                        <div class="text-uppercase-expanded text-xs mb-4">Général</div>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><a href="index">Accueil</a></li>
                                            <li class="mb-2"><a href="contact">Contact / Equipe</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                        <div class="text-uppercase-expanded text-xs mb-4">Rapports</div>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><a href="rapport">Mes rapports</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                                        <div class="text-uppercase-expanded text-xs mb-4">Mon compte</div>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><a href="changer_mdp.php">Changer de mots de pase</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php else:?>
                            <?php if(!empty($footerdark) && $footerdark == true):?>
                            <footer class="footer pt-1 pb-5 mt-auto bg-dark footer-dark">
                            <?php else:?>
                                <footer class="footer pt-1 pb-5 mt-auto bg-light footer-light">
                            <?php endif;?>
                        <div class="container px-5">
                        <?php endif;?>
                        <hr class="my-5" />
                        <div class="row gx-5 align-items-center">
                            <div class="col-md-6 small">Copyright &copy; AMU-Rédac (Open-Source)</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="contact">Contact / Code Source</a>
                                &middot;
                                <a href="contact">Crédits</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({
                disable: 'mobile',
                duration: 600,
                once: true,
            });
        </script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/autosize.js/4.0.2/autosize.min.js"></script>
        <script>autosize(document.querySelectorAll('#autosize'));</script>
    </body>
</html>

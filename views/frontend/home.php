<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Accueil</title>    
</head>
<body>
    <!-- Menu -->
    <nav class="navbar fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="/assets/img/logo.png" alt="">
            </a>
            <!-- contact details -->
            <!-- <div class="contact-detail d-sm-none d-md-block d-none d-sm-block">
                <span>Appel moi +41 79 221 21 00 / hello@ntimba.com</span>
            </div> -->
            <div class="downloadcv d-sm-none d-md-block d-none d-sm-block">
                <a href="#">Download CV <i class="bi bi-download"></i></a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <!-- <span class="navbar-toggler-icon"></span> -->
                <i class="bi bi-list"></i>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header offcanvas__header">
                    <!-- <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5> -->
                    <ul class="d-flex justify-content-start">
                        <li>
                            <a class="btn button button--secondary signup" href="#" role="button">S'enregistrer <i class="bi bi-person-fill-add"></i></a>
                        </li>

                        <li>
                            <a class="btn button button--primary login" href="#" role="button">Se connecter</a>
                        </li>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>


                <div class="offcanvas-body offcanvas__body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">À propos de moi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Compétences</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Contact</a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </nav>
<!-- End Menu -->

<div class="homepage">
    <div class="container">
        <!-- Page title -->
        <div class="row">
            <div class="col-md mt-3 mb-3 title">
                <div class="title--page">
                    À propos de moi
                </div>
            </div>
        </div>

        <div class="hero">
            <div class="row">
                <div class="col-md-6 hero__content">
                    <div class="row">
                        <h1 class="title--hero">Salut,<br> Je suis <span class="name">Ntimba</span></h1>
                        <h3 class="title--sub">Developpeur d'application php</h3>
                        <p>Cherchez-vous un développeur web PHP pour booster votre entreprise ? Unissons-nous ! Contactez-moi bour concretiser vos
    projets et propulser votre présence en ligne</p>
                    </div>
                    <div class="row">
                        <div class="rounded-image profile-image">
                            <img class="" src="/assets/uploads/moi.jpg" alt="Chancy Ntimba">
                        </div>

                        <a class="btn button button--secondary" href="">Contacter Moi <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-6 hero__image">
                    <img src="/assets/img/aboutme_img.png" alt="background image">
                </div>
            </div>
        </div>
        
    </div>
</div>


<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="index.php">
                    <img class="logo" src="/assets/img/logo_ntimba_white.png" alt="">
                </a>
            </div>

            <div class="col-md-6">
                <ul class="footer__menu d-flex justify-content-end">
                    <li><a href="#">mensions légales</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Cookies</a></li>
                    <li><a href="#">CGU</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="copyright">
                    <span>All rights reserved © Ntimba Software 2023</span>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <ul class="hero__socialmedia d-flex justify-content-start">
                    <li><a href="https://github.com/ntimba/"><i class="bi bi-linkedin"></i></a></li>
                    <li><a href="#"><i class="bi bi-github"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>


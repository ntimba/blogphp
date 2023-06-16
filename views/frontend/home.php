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
            <a class="navbar-brand" href="#">
                <img src="/assets/img/logo.png" alt="">
            </a>
            <!-- contact details -->
            <div class="contact-detail d-sm-none d-md-block d-none d-sm-block">
                <span>Appel moi +41 79 221 21 00 / hello@ntimba.com</span>
            </div>
            <div class="download-cv d-sm-none d-md-block d-none d-sm-block">
                <a href="#">
                    <span>Download CV <i class="bi bi-file-arrow-down-fill"></i> </span>
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <!-- <span class="navbar-toggler-icon"></span> -->
                <i class="bi bi-list"></i>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
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
            <div class="col-md">
                <div>
                    <hr>
                </div>
                <div class="page-title">
                    À propos de moi
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2>Salut, je suis Ntimba</h2>
                <p> With this tool, you will get much better results at work and develop new skills. Will you take the risk of trying the latest version of our application?</p>
                <a href="#" class="btn btn-primary">Contactez-moi</a>
            </div>
            <div class="col-md-6">
                <img src="#" alt="background image">
            </div>
        </div>
        <div class="row">
            <h3>À propos moi</h3>
            <p> If you have ever wondered how to develop your brand, this is the place for you. Take a big step forward in growing your business with this great tool.</p>
            <div class="rounded-image">
                <img class="profile-image" src="/assets/img/avatar.png" alt="Chancy Ntimba">
            </div>
            <a href="#" class="btn btn-primary">Contactez-moi</a>
            <a href="#" class="btn btn">Télécharger mon cv</a>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
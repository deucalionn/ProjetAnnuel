<!DOCTYPE HTML> 
<html>
    <head>
        <title>MEETRAVEL</title>
		<meta charset="UTF-8">
        <meta name="accuiel" description="page d'accueil"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link href="/ProjetAnnuel/src/style/index.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar bg-black text-white stiky-top" data-bs-theme="dark">
            <div class="row p-4 container-fluid d-flex align-items-center">

                <div class="col-2 d-flex p-2 justify-content-center">
                    <a class="navbar-brand" href="#">
                        <img src="/ProjetAnnuel/src/img/logoblack.png" alt="MEETRAVEL" width="100" height="100">
                    </a>
                </div>

                <div class="col-8 p-2 justify-content-center">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </form>
                </div>
                
                <div class="col-2 d-flex p-2 justify-content-center">

                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class=" grid gap-3 offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">

                        <ul class="nav nav-pills nav-fill flex-column">

                            <li class="nav-item">
                                <a class="nav-link" href="profil.php"> Voir le profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Paramètre</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Déconnexion</a>
                            </li>

                        </ul>
                    </div>
                    
                </div>
                <span class="border-bottom"></span>
            </div>
            
        </nav>

            <!-- </div>
        </nav>   -->
                    <!-- SOMBRE - CLAIR   

                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary active">
                            <input type="radio" name="options" id="option1" autocomplete="off" checked> Active
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio" name="options" id="option2" autocomplete="off"> Radio
                        </label>
                    </div>
                    -->

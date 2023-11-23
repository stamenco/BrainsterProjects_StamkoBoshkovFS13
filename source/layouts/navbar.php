<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= route("home") ?>">
            <img src="<?= PATH . "source/assets/images/logo.png" ?>" class="logo" alt="Brainster Library Logo">
            <p class="small fw-bold text-light text-uppercase mb-0">brainster library</p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarExpand">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navBarExpand">
            <?php
                use BLibrary\Auth\Auth;

                if (Auth::isLogged() && Auth::isAdmin()) {
                    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="btn btn-warning" href="'. route("dashboard") .'">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-warning ms-lg-3 mt-3 mt-lg-0" href="'. route("logout") .'">Logout</a>
                        </li>
                    </ul>';     
                } else if (Auth::isLogged()) { 
                    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-uppercase small disabled" href="#">Logged in as '. htmlspecialchars(Auth::user()) .'</a>
                        </li>    
                        <li class="nav-item">
                            <a class="btn btn-outline-warning" href="'. route("logout") .'">Logout</a>
                        </li>
                    </ul>';
                 } else {
                    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-outline-warning" href="'. route("login") .'">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning ms-lg-3 mt-3 mt-lg-0" href="'. route("register") .'">Sign Up</a>
                    </li>
                </ul>';
                }
            ?>
        </div>
    </div>
</nav>
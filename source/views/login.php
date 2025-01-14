<?php

use BLibrary\Auth\Auth;

if (Auth::isLogged()) {
    redirect(route('home'));
}
?>
<div class="d-flex justify-content-center align-items-center vh-100">
    <form class="d-flex flex-column col-10 col-md-3">
        <div id="notification"></div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" placeholder="name@example.com">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <button id="signInAction" class="btn btn-primary mt-3">Sign In</button>
        <a href="<?= route("home") ?>" class="btn btn-danger mt-2">Go Back</a>

        <p class="lead fs-6 ps-0 mt-2">Don't have an account? <a href="<?= route("register") ?>" class="text-decoration-none">Sign Up</a></p>
    </form>
</div>

<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>
<script type="module" src="<?= PATH . "source/assets/js/modules.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/login.js" ?>"></script>
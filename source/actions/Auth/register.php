<?php

require_once __DIR__ . "/../../../autoload.php";

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'authRegister') {
    # Validators
    emptyFields($_POST);

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['auth' => false, 'message' => 'Please enter valid email address']);
        exit;
    }

    Auth::register($_POST);
}
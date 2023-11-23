<?php

require_once __DIR__ . "/../../../autoload.php";

use BLibrary\Auth\Auth;

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'authLogin') {
    Auth::login($_POST);
}
<?php
session_start();

# Load Consts
require_once __DIR__ . "/source/consts.php";

# Load functions & routes
require_once __DIR__ . "/source/helpers/functions.php";
require_once __DIR__ . "/source/helpers/routes.php";

# Load Router
require_once __DIR__ . "/source/classes/Router/Router.php";
require_once __DIR__ . "/source/database/database.php";

# Load Auth
require_once __DIR__ . "/source/classes/Auth/auth.php";

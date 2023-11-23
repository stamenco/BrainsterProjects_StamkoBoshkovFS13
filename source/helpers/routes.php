<?php 

/**
 * Removing '/' from application path and then adding it again
 */
$url = trim(PATH, "/") . "/";

/**
 * Store route name and path
 */
$routes = [
    "home" => $url . "home",
    "dashboard" => $url . "dashboard",
    "404" => $url . "404",
    "broken" => $url . "broken",
    "login" => $url . "login",
    "register" => $url . "register",
    "logout" => $url . "logout"
];

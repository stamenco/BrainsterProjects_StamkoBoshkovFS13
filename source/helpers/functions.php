<?php

/**
 * Checks whether REQUEST METHOD is POST or not
 * @return bool
 */
function onlyPostRequestMethod(): bool 
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        return true;
    }
    return false;
}

/**
 * Redirect to specfied file
 * @param string $route
 * @param int $id
 */
function route(string $route, int|string $id = null)
{
    global $routes;

    return str_replace("{ID}", $id, $routes[$route]) ?? "";
}

/**
 * Redirect to specified file (for errors, etc.)
 * @param string $route
 * @return void
 */
function redirect(string $route): void
{
    header("Location: {$route}");
    die();
}

/**
 * Check if any empty fields
 */
function emptyFields($data)
{
    $flag = false;

    foreach ($data as $value) {
        if (isset($value)) {
            if (empty($value)) {
                $flag = true;
            } 
        }
    }

    if ($flag) {
        echo json_encode(['auth' => false, 'message' => 'All fields are required']);
        exit;
    }
}

/**
 * Generate random code
 *
 * @return string
 */
function generateCode() : string
{
    $lowerCharacters = 'abcdefghijklmnopqrstuvwxyz'; 
    $upperCharacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $randomString = ''; 
    
    for ($i = 0; $i <2; $i++) { 
        $index1 = rand(0, strlen($lowerCharacters) - 1);
        $index2 = rand(0, strlen($numbers) - 1);
        $index3 = rand(0, strlen($upperCharacters) - 1); 
        $randomString .= $lowerCharacters[$index1] . $numbers[$index2] . $upperCharacters[$index3]; 
    } 
    return $randomString; 
}
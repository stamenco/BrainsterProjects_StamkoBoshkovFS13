<?php

namespace BLibrary\Auth;

use BLibrary\Database\Connection\DB;
use PDOException;

class Auth
{
    /**
     * Login existing user
     */
    public static function login($object)
    {
        try {
            $stmt = DB::connect()->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$object['email']]);
    
            if ($stmt->rowCount() == 0) {
                echo json_encode(['auth' => false]);
                exit;
            }
    
            $user = $stmt->fetch();
    
            if (password_verify($object['password'], $user['password'])) {
                $_SESSION['auth'] = $user;
                echo json_encode(['auth' => true]);
                exit;
            } else {
                echo json_encode(['auth' => false]);
                exit;
            }
    
        } catch (PDOException $e) {
            redirect(route('broken'));
        }
    }

    /**
     * Register a new user
     */
    public static function register($object) 
    {
        try {
            $stmt = DB::connect()->prepare("SELECT email FROM users WHERE email = ?");
            $stmt->execute([$object['email']]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['auth' => false, 'message' => 'This email address already exists']);
                exit;
            }

            $object['password'] = password_hash($object['password'], PASSWORD_BCRYPT);

            $stmt = DB::connect()->prepare("INSERT INTO users (email, fullname, password) VALUES(?, ?, ?)");
            $stmt->execute([$object['email'], $object['fullname'], $object['password']]);

            if ($stmt->rowCount() == 0) {
                echo json_encode(['auth' => false, 'message' => 'There was an error, please try again..']);
                exit;
            }

            echo json_encode(['auth' => true]);
            exit;

        } catch (PDOException $e) {
            redirect(route('broken'));
        }
    }

    /**
     * Logout existing user
     */
    public static function logout() 
    {
        $_SESSION['auth'] = null;
        session_destroy();
        redirect(route('home'));
    }

    /**
     * Check if user is logged in
     */
    public static function isLogged()
    {
        return isset($_SESSION["auth"]) ?? null;
    }

    /**
     * Check if user is administrator
     */
    public static function isAdmin()
    {
        return isset($_SESSION['auth']['is_admin']) ? ($_SESSION['auth']['is_admin'] == 1 ? true : false) : false;
    }

    /**
     * Print logged in user data
     */
    public static function user()
    {
        return "{$_SESSION['auth']['fullname']}";
    }

    /**
     * Returns current user id
     *
     * @return string
     */
    public static function id() : string
    {
        return isset($_SESSION['auth']) ? $_SESSION['auth']['id'] : '';
    }
}

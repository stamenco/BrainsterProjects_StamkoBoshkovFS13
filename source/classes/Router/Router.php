<?php 

namespace BLibrary\Router;

class Router
{
    private static $requested_path;

    public function __construct($requested_path)
    {
        self::$requested_path = self::removeSlashes($requested_path);
    }

    private static function removeSlashes($requested_path)
    {
        if (empty($requested_path)) return $requested_path;

		if ($requested_path[strlen($requested_path) -1] == '/')
		{
			$requested_path = rtrim($requested_path, "/");
		}
		return $requested_path;
    }

    public static function get($segment)
    {
        $url = str_replace(self::$requested_path, '', $_SERVER["REQUEST_URI"]);
		$url = explode('/', $url);

		if (isset($url[$segment])) {
			return $url[$segment];
        } else {
			return false;
        }
    }
}
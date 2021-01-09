<?php
namespace Components;
use League\Plates\Engine;

/**
 * Example:
 *    use Components\View;
 *    echo View::on()->render('userslist');
 */
class View
{
    private static $engine = null;

    public static function on()
    {
        if (!isset(self::$engine)) {
            self::$engine = new Engine('../templates');
        }

        return self::$engine;
    }
}
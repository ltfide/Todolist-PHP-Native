<?php 

namespace Todolist\PHP\Native\App;

class View 
{
    public static function render($view, $model = [])
    {
        require __DIR__ . "/../View/" . $view . ".php";
    }

    public static function redirect($url)
    {
        header("Location: $url");
    }
}
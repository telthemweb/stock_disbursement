<?php
/*
|--------------------------------------------------------------------------
|            This file is part of the Telthemweb package.
|               
|--------------------------------------------------------------------------
|
|     For the full copyright and license information, please view the LICENSE
|       file that was distributed with this source code.
|
*/

namespace Ti\Mss\App\controllers;

use Ti\Mss\Helpers\View;

class Controller  {
    public function view($view,$layoutd,$footerlayout,array $values)
    {
        return (new View())->getViewResponse($view,$layoutd,$footerlayout, $values);
    }

    public function back()
    {
        header('location:'.$_SERVER['HTTP_REFERER']);
        exit();
    }

    public function url($url)
    {

        echo "http://localhost:9002/public/".$url;
    }
    
    
}
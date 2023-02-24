<?php

use Ti\Mss\Helpers\Routers;
require __DIR__ . './bootstrap.php';

class Dispatcher
{
    public Routers $router;
    

    public function __construct(){
        $this->router = new Routers();
        new Ti\Mss\Helpers\Database();
    }

    public function run(): void
    {

        try {
            require __DIR__ . './../routes/web.php';
        } catch (\Exception $e) {
            echo "Error Message ".$e->getMessage();
        }
    }





}
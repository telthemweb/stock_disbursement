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
namespace Ti\Mss\Helpers\middleware;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\SessionManager;
class AuthAdminMiddleware
{
    
    public function __construct()
    {
        $this->AuthenticatedUserIdData();
    }
    public function AuthenticatedUserIdData()
    {
        
        if(isset($_SESSION['admin_id']))
        { 
            $session = new SessionManager;
             $session->setFlash('error', 'You are not authorized to this Page. Please Login first!!');
             Configuration::redirection('dashboard');
        }
    }

    public function sendBack(){
        header('location:'.$_SERVER['HTTP_REFERER']);
        exit();
     }
}

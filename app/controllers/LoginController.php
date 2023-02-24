<?php
namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Administrator;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\Helpers\middleware\AuthAdminMiddleware;

class LoginController extends Controller
{
	public function __construct(){
		(new AuthAdminMiddleware())->AuthenticatedUserIdData();
	}

	public function login()
	{
		
         $this->view("login", "admin", 'footer', []);
	}

	public function authenticate()
	{
		$log = new  Systemlogs();
		$request= new Request(); 
		$session = new SessionManager();
		$username = $request->input('username');
		$password = $request->input('password');
		$check= str_starts_with($username, "Ctc");
		if($check==false){
			$session->setFlash('error', 'Username is incorrect format please contact Administrator username start with Ewc');
			Configuration::redirection('admin-auth/login');
		}
		else{
			$admin = Administrator::whereusername($username)->first();
			if($admin != NULL){
				if($admin->status=="1"){
					$veryfypass = password_verify($password, $admin->password);
					if($veryfypass==true){
						$_SESSION['admin_id'] = $admin->id;
						$_SESSION['name'] = $admin->name;
						$_SESSION['surname'] = $admin->surname;
						$_SESSION['email'] = $admin->email;
						$_SESSION['phone'] = $admin->phone;
						$_SESSION['username'] = $admin->username;
						$_SESSION['gender'] = $admin->gender;
						$_SESSION['country'] = $admin->country;
						$_SESSION['province'] = $admin->province;
						$_SESSION['city'] = $admin->city;
						$_SESSION['role_id'] = $admin->role_id;
						$_SESSION['role_name'] = $admin->role->name;
						$_SESSION['address'] = $admin->address;
						$_SESSION['depot_id'] = $admin->depot_id;
						Configuration::redirection('dashboard');
						$session->setFlash('success', 'Welcome '.$admin->name.' '.$admin->surname);
						//add logs
						$log->administrator_id =$admin->id;
						$log->timein=date('H:i:s');
						$log->ipaddress=$_SERVER['REMOTE_ADDR'];
						$log->geolocationap="";
						$log->useaccountname= $admin->name .' '.$admin->surname;
						$log->timeout="Pending";
						$log->save();
					}else{
						
						Configuration::redirection('admin-auth/login');
					   $session->setFlash('error', 'Incorrect password please try again !!');
						exit();
					}
				}
				else{
					Configuration::redirection('admin-auth/login');
					   $session->setFlash('error', 'Your account has been blocked please contact Administrator !!');
						exit();
				}
		
			}else{	
				Configuration::redirection('admin-auth/login');
			    $session->setFlash('error', 'Incorrect credentials please contact Administrator for account Activation !!');
				exit();
			}
			
		}
		

	}
}
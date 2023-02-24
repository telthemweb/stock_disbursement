<?php
namespace Ti\Mss\App\controllers;

use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\Administrator;
use Ti\Mss\App\models\Role;
use Ti\Mss\App\models\Farmer;
use Ti\Mss\App\models\Supplier;
use Ti\Mss\App\models\Depot;
use Ti\Mss\App\models\CommonDisbusement;
use Ti\Mss\App\models\Product;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class DashboardController extends Controller
{

	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

	public function index()
	{
		$totalfarmers = Farmer::count();
		$totalsuppliers = Supplier::count();
		$totaluser = Administrator::count();
		$totalDepots = Depot::count();
		$totalCidps = CommonDisbusement::count();
		$totalinventories = Product::count();

		$totalstockinventorycount = Product::where('quantity','>',0)->count(); //79090
		$totaloutstockinventorycount = Product::where('quantity','<=',0)->count(); 
        $stockitemquantitytotal = Product::sum('quantity');

         $this->view("administrator/dashboard", "dash", 'adminfooter', [
         	'totalfarmers'=>$totalfarmers,
         	'totalsuppliers'=>$totalsuppliers,
         	'totaluser'=>$totaluser,
         	'totalDepots'=>$totalDepots,
         	'totalCidps'=>$totalCidps,
         	'totalinventories'=>$totalinventories,
         	'totalstockinventorycount'=>$totalstockinventorycount,
         	'totaloutstockinventorycount'=>$totaloutstockinventorycount,
         	'stockitemquantitytotal'=>$stockitemquantitytotal,
         ]);
	}

	public function systemlogs(){	
    $logs = Systemlogs::orderByDesc('created_at')->get();
		$this->view("administrator/Audit/systemlog", "dash", 'adminfooter', ['logs'=>$logs]);
	}
	public function audittray(){
		$audits = Audit::orderByDesc('created_at')->get();
		$this->view("administrator/Audit/audit", "dash", 'adminfooter', ['audits'=>$audits]);

	}



	public function getAdminProfile(){
		$role = new Role();
		$roles = $role->all();
        $admin_id =$_SESSION['admin_id'];
        $administrator= Administrator::find($admin_id);
        return $this->view("administrator/profile","dash",'adminfooter',[
            'administrator' => $administrator,
            '$roles' => $roles ,]);
    }

    
	public function changepassword(){
        $admin_id =$_SESSION['admin_id'];
		$admin = Administrator::find($admin_id);
        return $this->view("administrator/changepassword","dash",'adminfooter',[
            'admin' => $admin,]);
    }


/*
|--------------------------------------------------------------------------
|                        SYSTEM USERS ACCOUNTS         
|--------------------------------------------------------------------------
|
|
*/

	public function users()
    {
		$session = new SessionManager();
        $dataemp =  Administrator::orderByDesc('created_at')->get();
		$role = new Role();
		$roles = $role->all();
         $this->view("administrator/employees/index","dash",'adminfooter',[
            'administrators' => $dataemp,
			'roles' => $roles
        ]);
    }

    public function store() {
		$session = new SessionManager();
		
		$request = new Request;
		$admin = new Administrator();

		$data = array();
		$newdata = array();
		$data['name'] = $request->input('name');
		$data['surname'] = $request->input('surname');
		$data['role_Id'] = $request->input('role_id');
		$data['username'] = $request->input('username');
		$data['address'] = $request->input('address');
		$data['gender'] = $request->input('gender');
		$data['country'] = $request->input('country');
		$data['email'] = $request->input('email');
		$data['phone'] = $request->input('phone');
		$data['province'] = $request->input('province');
		$data['city'] = $request->input('city');
		$mydata = json_encode($data);

		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Administrator';
		$audit->oldvalue = 'N/A';
		$audit->newvalue=$mydata;
		$audit->action="CREATE_EMPLOYEE";
		$audit->save();




        $options = [
            'cost' => 12,
        ];
        $encrypetedpass = password_hash($request->input('password'), PASSWORD_BCRYPT, $options);
        $admin->name = $request->input('name');
        $admin->surname = $request->input('surname');
        $admin->role_id = $request->input('role_id');
        $admin->username = $request->input('username');
        $admin->password =$encrypetedpass;
        $admin->address = $request->input('address');
        $admin->gender = $request->input('gender');
        $admin->country = $request->input('country');
        $admin->email = $request->input('email');
        $admin->phone = $request->input('phone');
        $admin->province = $request->input('province');
        $admin->city = $request->input('city');
        $admin->save();
        $this->back();
        $session->setFlash('success', $admin->name.' '.$admin->surname .'created successfully !!"');
	}
	
		public function show($id) {
		$role = new Role();
		$roles = $role->all();
		$admin =  Administrator::find($id);
		$this->view("administrator/employees/edit", "dash", 'adminfooter', ['administrator'=>$admin,'roles'=>$roles]);
    
	}

	public function update($id) {
		$request = new Request;
		$admin = Administrator::find($id);
		$session = new SessionManager();
		$olddata = array();
		$olddata['name'] = $admin->name;
		$olddata['surname'] = $admin->surname;
		$olddata['role_id'] = $admin->role_id;
		$olddata['username'] = $admin->username;
		$olddata['address'] = $admin->address;
		$olddata['gender'] = $admin->gender;
		$olddata['country'] = $admin->country;
		$olddata['email'] = $admin->email;
		$olddata['phone'] = $admin->phone;
		$olddata['province'] = $admin->province;
		$olddata['city'] = $admin->city;
		$myolddata = json_encode($olddata);

		$newdata = array();
		$newdata['name'] = $request->input('name');
		$newdata['surname'] = $request->input('surname');
		$newdata['role_id'] = $request->input('role_id')==null?$admin->role_Id:$request->input('role_id');
		$newdata['role_status'] = $request->input('role_id')==null?"Not changed":"Role Changed  ".$admin->role->name;
		$newdata['username'] = $request->input('username');
		$newdata['address'] = $request->input('address');
		$newdata['gender'] = $request->input('gender');
		$newdata['country'] = $request->input('country');
		$newdata['email'] = $request->input('email');
		$newdata['phone'] = $request->input('phone');
		$newdata['province'] = $request->input('province');
		$newdata['city'] = $request->input('city');
		$mydata = json_encode($newdata);

		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Administrator';
		$audit->oldvalue = $myolddata;
		$audit->newvalue=$mydata;
		$audit->action="UPDATE_EMPLOYEE";
		$audit->save();


	$options = [
				'cost' => 12,
			];
			$encrypetedpass = $request->input('password')==null?$admin->password:password_hash($request->input('password'), PASSWORD_BCRYPT, $options);
			$admin->name = $request->input('name');
			$admin->surname = $request->input('surname');
			$admin->role_id = $request->input('role_id')==null?$admin->role_id:$request->input('role_id');
			$admin->username = $request->input('username');
			$admin->password =$encrypetedpass;
			$admin->address = $request->input('address');
			$admin->gender = $request->input('gender')==null?$admin->gender: $request->input('gender');
			$admin->country = $request->input('country')==null?$admin->country:$request->input('country');
			$admin->email = $request->input('email');
			$admin->phone = $request->input('phone');
			$admin->province = $request->input('province');
			$admin->city = $request->input('city');
			$admin->update([$admin]);
			$session->setFlash('success', 'System user updated successfully!!');
			Configuration::redirection('employees');
	}

public function deactivate($id) {
		$session = new SessionManager();
			$admin =  Administrator::find($id);
			$role = Role::find($_SESSION['role_id']);
			if($admin->role_id==$_SESSION['role_id']){
				$session->setFlash('error','You cant block yourself!!');
				$this->back();	
			}
			else{
				$newdata = array();
				$newdata['name'] = $admin->name;
				$newdata['surname'] = $admin->surname;
				$newdata['role_Id'] = $admin->role_Id;
				$newdata['username'] = $admin->username;
				$newdata['address'] = $admin->address;
				$newdata['gender'] = $admin->gender;
				$newdata['country'] = $admin->country;
				$newdata['email'] = $admin->email;
				$newdata['phone'] = $admin->phone;
				$newdata['province'] = $admin->province;
				$newdata['city'] = $admin->city;
				$newdata['status'] = $admin->status;
				$myolddata = json_encode($newdata);
				$audit = new Audit();
				$audit->administrator_id=$_SESSION['admin_id'];
				$audit->entity='Ti\Mss\App\models\Administrator';
				$audit->oldvalue = $myolddata;
				$audit->newvalue = '0';
				$audit->action="DEACTIVATE_ACCOUNT";
				$audit->save();

				$admin->status= 0;
				$admin->update([$admin]);
				$session->setFlash('success', $admin->name.' Account has been blocked!!');
				$this->back();	
			}
		
		
		
	}

	public function activate($id) {
		$session = new SessionManager();
			$admin = Administrator::find($id);
			$role = Role::find($admin->role_id);

			$newdata = array();
			$newdata['name'] = $admin->name;
			$newdata['surname'] = $admin->surname;
			$newdata['role_Id'] = $admin->role_Id;
			$newdata['username'] = $admin->username;
			$newdata['address'] = $admin->address;
			$newdata['gender'] = $admin->gender;
			$newdata['country'] = $admin->country;
			$newdata['email'] = $admin->email;
			$newdata['phone'] = $admin->phone;
			$newdata['province'] = $admin->province;
			$newdata['city'] = $admin->city;
			$newdata['status'] = $admin->status;
			$myolddata = json_encode($newdata);
			$audit = new Audit();
			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Mss\App\models\Administrator';
			$audit->oldvalue = '1';
			$audit->newvalue = 'N/A';
			$audit->action="ACTIVATE_ACCOUNT";
			$audit->save();



			$admin->status = 1;
			$admin->update([$admin]);
			$session->setFlash('success', $admin->name . ' Account has been activated!!');
			$this->back();
		
		
	}


	public function destroy($id) {
		$admin = Administrator::find($id);
		$newdata = array();
		$newdata['name'] = $admin->name;
		$newdata['surname'] = $admin->surname;
		$newdata['role_Id'] = $admin->role_Id;
		$newdata['username'] = $admin->username;
		$newdata['address'] = $admin->address;
		$newdata['gender'] = $admin->gender;
		$newdata['country'] = $admin->country;
		$newdata['email'] = $admin->email;
		$newdata['phone'] = $admin->phone;
		$newdata['province'] = $admin->province;
		$newdata['city'] = $admin->city;
		$myolddata = json_encode($newdata);
		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Administrator';
		$audit->oldvalue = $myolddata;
		$audit->newvalue = 'Deleted';
		$audit->action="DELETE_EMPLOYEE";
		$audit->save();
	}









































































	public function logout()
    {
		$log = Systemlogs::wheretimeout('Pending')->wherestatus('Pending')->whereadministrator_id($_SESSION['admin_id'])->first();
		//add logs
		$log->administrator_id =$_SESSION['admin_id'];
		$log->ipaddress=$_SERVER['REMOTE_ADDR'];
		$log->geolocationap="";
		$log->status="Offline";
		$log->useaccountname = $_SESSION['name'] . ' ' . $_SESSION['surname'];
		$log->timeout=date('H:i:s');;
		$log->update([$log]);

		unset($_SESSION['admin_id']);
		unset($_SESSION['name']);
		unset($_SESSION['surname']);
		unset($_SESSION['email']);
		unset($_SESSION['phone']);
		unset($_SESSION['username']);
		unset($_SESSION['gender']);
		unset($_SESSION['country']);
		unset($_SESSION['province']);
		unset($_SESSION['city']);
		unset($_SESSION['city']);
		unset($_SESSION['address']);
		unset($_SESSION['maxtask']);
		unset($_SESSION['isActive']);
		
        session_destroy();
        Configuration::redirection('admin-auth/login');
    }

}
<?php
namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\Role;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class RoleController extends Controller
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

	public function index() {
		$rols = new Role();
		$roles = $rols->all();
         $this->view("administrator/roles/index", "dash", 'adminfooter', ['roles' => $roles,]);
	}

	public function store() {
		$request = new Request;
		$session = new SessionManager();
        $role = new Role();

        $olddata = array();
        $olddata['newdata'] = 'new entry data';
        $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['name'] = $request->input('name');
        $newdata['level'] = $request->input('level');
        $mynewdata= json_encode($newdata);
		
        $audit = new Audit();

		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Role';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="create-role";
		$audit->save([$audit]);

        $role->name = $request->input('name');
        $role->level = $request->input('level');
        $role->save();
		$session->setFlash('success', 'New Role created successfully!!');
		$this->back();
	}
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function show($id) {
		$role =  Role::find($id);
		$this->view("administrator/roles/edit", "dash", 'adminfooter', ['role'=>$role]);
	}

	public function update($id) {
		$request = new Request;
		$session = new SessionManager();
		$role = Role::find($id);

		$olddata = array();
        $olddata['name'] = $role->name;
        $olddata['level'] = $role->level;
        $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['name'] = $request->input('name');
        $newdata['level'] = $request->input('level');
        $mynewdata= json_encode($newdata);
		
        $audit = new Audit();

		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Role';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="update-role";
		$audit->save([$audit]);

        $role->name = $request->input('name');
        $role->level = $request->input('level');
		$role->update([$role]);
		$session->setFlash('success', 'Role updated successfully!!');
		Configuration::redirection('roles');
	}

	public function destroy($id) {
		$session = new SessionManager();
		$role = Role::find($id);

		$olddata = array();
        $olddata['name'] = $role->name;
        $olddata['level'] = $role->level;
        $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['deleted'] = 'deleted';
        $mynewdata= json_encode($newdata);
		
        $audit = new Audit();

		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Role';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="delete-role";
		$audit->save([$audit]);




		 if(count($role->administrators)>0){
		 	 $session->setFlash('error', 'Role cant be deleted');
		 	 Configuration::redirection('roles');
		 }else{
		 	 $role->delete();
		 	 $session->setFlash('success', 'Role  deleted successfully');
		 	 Configuration::redirection('roles');
		 }
	}
}
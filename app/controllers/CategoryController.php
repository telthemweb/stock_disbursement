<?php
namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\Category;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class CategoryController extends Controller
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

	public function index()
	{
		$categories =  Category::orderByDesc('created_at')->get();
         $this->view("administrator/category/index", "dash", 'adminfooter', ['categories'=>$categories]);
	}

/*
|--------------------------------------------------------------------------
|            This file is part of the Carlos package.
|               
|--------------------------------------------------------------------------
|
|     Category just for defferentiate Products in our inventory
|       
|
*/

	public function add()
	{
		$request = new Request;
		$session = new SessionManager();
        $cat = new Category();
		$audit = new Audit();
        $cat->name = $request->input('name');

		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Category';
		$audit->oldvalue='';
		$audit->newvalue=$request->input('name');
		$audit->action="create-category";
		$audit->save([$audit]);
        $cat->save();
		$session->setFlash('success', 'Category created successfully!!');
		$this->back();
	}

	public function show($id)
	{
		$cats =  Category::find($id);
		$this->view("administrator/category/edit", "dash", 'adminfooter', ['category'=>$cats]);
	}

	public function update($id)
	{
		$request = new Request;
		$session = new SessionManager();
		$cat = Category::findOrFail($id);

		$olddata = array();
		$olddata['name'] = $cat->name;
		$olddata['created_at'] = $cat->created_at;

		$myolddata= json_encode($olddata);


		$newdata = array();
		$newdata['name'] = $request->input('name');
		$newdata['updated_at'] = date('d-m-Y');
		$mynewdata= json_encode($newdata);

		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Category';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="update-category";
		$audit->save();


		$cat->name = $request->input('name');
		$cat->update([$cat]);
		$session->setFlash('success', 'Category updated successfully!!');
		Configuration::redirection('categories');
	}

	public function destroy($id) {
		$session = new SessionManager();
		$cat = Category::find($id);
		 if(count($cat->products)>0){
		 	 $session->setFlash('error', 'Category cant be deleted');
		 	 Configuration::redirection('categories');
		 }else{

		 $olddata = array();
		$olddata['name'] = $cat->name;
		$olddata['created_at'] = $cat->created_at;

		$myolddata= json_encode($olddata);




			$audit = new Audit();
			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Helpdesk\App\Model\Category';
			$audit->oldvalue=$myolddata;
			$audit->newvalue='Deleted';
			$audit->action="delete-category";
			$audit->save();
		 	 $cat->delete();
		 	 $session->setFlash('success', 'Category  deleted successfully');
		 	 Configuration::redirection('categories');
		 }
	}




}
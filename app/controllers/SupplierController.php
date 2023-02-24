<?php
namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\Supplier;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class SupplierController extends Controller
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

	public function index()
	{	
	  $suppliers =  Supplier::orderByDesc('created_at')->get();
     $this->view("administrator/supplier/index", "dash", 'adminfooter', ['suppliers'=>$suppliers]);
	}

	public function add()
	{
		try{
		$request = new Request;
		$session = new SessionManager();
        $supplier = new Supplier();
		$audit = new Audit();

		$suppliercheck = Supplier::wherename($request->input('name'))->first();

		if($suppliercheck !=null){
			$session->setFlash('error', 'Supplier already added!!');
		   $this->back();
		}
		$company_image = $request->fileinput('image'); 
		$company_imageinfo = pathinfo($company_image, PATHINFO_EXTENSION);

		$arrycompany_image = strtotime(date('YmdHis'));


		$timecompany_image= base64_encode($arrycompany_image.random_int(1000,9999)).".".$company_imageinfo;
		
		
		$pickcompany_image= "assets/img/uploads/supplier/".$timecompany_image;

		
		


	   $olddata = array();
       $olddata['newdata'] = 'new entry data';
       $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['name'] = $request->input('name');
        $newdata['address'] = $request->input('address');
        $newdata['administrator_id'] = $_SESSION['admin_id'];
        $newdata['email'] = $request->input('email');
        $newdata['phone'] = $request->input('phone');
        $newdata['city'] = $request->input('city');
        $newdata['company_logo'] = $pickcompany_image;
        $newdata['status'] = "Active";
        $mynewdata= json_encode($newdata);


       


        $supplier->name = $request->input('name');
        $supplier->address =$request->input('address');
        $supplier->email = $request->input('email');
        $supplier->phone = $request->input('phone');
        $supplier->image = $pickcompany_image;
        $supplier->administrator_id=$_SESSION['admin_id'];
        $supplier->city = $request->input('city');
        $supplier->status = "Active";



		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Supplier';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="create-supplier";
		$audit->save([$audit]);


       
      $supplier->save();
	$session->setFlash('success', 'Supplier created successfully!!');
      move_uploaded_file($_FILES['image']['tmp_name'],$pickcompany_image);
		$this->back();
		}catch(Exception $ex){
			$session->setFlash('error', $ex->getMessage());
			$this->back();
		}
	}

	

	public function show($id)
	{
		$supplier =  Supplier::find($id);
		$this->view("administrator/supplier/edit", "dash", 'adminfooter', ['supplier'=>$supplier]);
	}


    public function update($id)
	{
		try{
		$request = new Request;
		$session = new SessionManager();
		$audit = new Audit();

		$supplier =  Supplier::find($id);
		


	   $olddata = array();
        $olddata['name'] = $supplier->name;
        $olddata['address'] = $supplier->address;
        $olddata['administrator_id'] = $supplier->administrator_id;
        $olddata['email'] = $supplier->email;
        $olddata['phone'] = $supplier->phone;
        $olddata['city'] = $supplier->city;
        $olddata['company_logo'] = $supplier->company_logo;
        $olddata['status'] = $supplier->status;
       $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['name'] = $request->input('name');
        $newdata['address'] = $request->input('address');
        $newdata['administrator_id'] = $_SESSION['admin_id'];
        $newdata['email'] = $request->input('email');
        $newdata['phone'] = $request->input('phone');
        $newdata['city'] = $request->input('city');
        $newdata['company_logo'] = $pickcompany_image;
        $newdata['status'] = "Active";
        $mynewdata= json_encode($newdata);


       


        $supplier->name = $request->input('name');
        $supplier->address =$request->input('address');
        $supplier->email = $request->input('email');
        $supplier->phone = $request->input('phone');
        $supplier->image = $pickcompany_image;
        $supplier->administrator_id=$_SESSION['admin_id'];
        $supplier->city = $request->input('city');
        $supplier->status = "Active";



		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Supplier';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="update-supplier";
		$audit->save([$audit]);


       
        $supplier->update([$supplier]);
	    $session->setFlash('success', 'Supplier updated successfully!!');
		Configuration::redirection('suppliers');
		}catch(Exception $ex){
			$session->setFlash('error', $ex->getMessage());
			$this->back();
		}
	}



      public function destroy($id) {
		$session = new SessionManager();
		$supplier =  Supplier::find($id);
		 if(count($supplier->products)>0){
		 	 $session->setFlash('error', 'Supplier cant be deleted');
		 	$this->back();
		 }else{

		$olddata = array();
		$olddata['name'] = $supplier->name;
        $olddata['address'] = $supplier->address;
        $olddata['administrator_id'] = $supplier->administrator_id;
        $olddata['email'] = $supplier->email;
        $olddata['phone'] = $supplier->phone;
        $olddata['city'] = $supplier->city;
        $olddata['company_logo'] = $supplier->company_logo;
        $olddata['status'] = $supplier->status;

		$myolddata= json_encode($olddata);




			$audit = new Audit();
			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Helpdesk\App\Model\Supplier';
			$audit->oldvalue=$myolddata;
			$audit->newvalue='Deleted';
			$audit->action="delete-supplier";
			$audit->save();
		 	 $supplier->delete();
		 	 $session->setFlash('success', 'Supplier  deleted successfully');
		 	 $this->back();
		 }
	}












}
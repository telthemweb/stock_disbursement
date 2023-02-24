<?php
namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\Farmer;
use Ti\Mss\App\models\CommonDisbusement;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class FarmerController extends Controller
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

	public function index()
	{
		$cidpoint =CommonDisbusement::whereadministrator_id($_SESSION['admin_id'])->first();
		$farmers =  Farmer::wherecidp_id($cidpoint->id)->orderByDesc('created_at')->get();
        $this->view("inputclerk/customers", "dash", 'adminfooter', ['farmers'=>$farmers,'cidpoint'=>$cidpoint]);
	}


    public function add()
	{
		try{
		$request = new Request;
		$session = new SessionManager();
        $farmer = new Farmer();

		$farmercheck = Farmer::wherename($request->input('name'))->first();

		if($farmercheck !=null){
			$session->setFlash('error', 'farmers already added!!');
		   $this->back();
		}
		
        

		$farmer->cidp_id= $request->input('cidp_id');
		$farmer->customercode= "G".random_int(1000000,9999999);
		$farmer->name= $request->input('name');
		$farmer->surname= $request->input('surname');
		$farmer->city= $request->input('city');
		$farmer->address= $request->input('address');
		$farmer->gender= $request->input('gender');
		$farmer->phonenumber= $request->input('phonenumber');
		$farmer->gender= $request->input('gender');
		$farmer->email= $request->input('email');
		$farmer->country= $request->input('country');
		$farmer->identitynumber= $request->input('identitynumber');
		$farmer->nextofkin= $request->input('nextofkin');
		$farmer->province= $request->input('province');
		$farmer->ward= $request->input('ward');
		$farmer->village= $request->input('village');
		$farmer->marital_status= $request->input('marital_status');

       
      $farmer->save();
	  $session->setFlash('success', 'Supplier created successfully!!');
      
		$this->back();
		}catch(Exception $ex){
			$session->setFlash('error', $ex->getMessage());
			$this->back();
		}
	}

	

	public function show($id)
	{
		$farmer =  Farmer::find($id);
		$this->view("inputclerk/editfarmer", "dash", 'adminfooter', ['farmer'=>$farmer]);
	}


    public function update($id)
	{
		try{
		$request = new Request;
		$session = new SessionManager();
		

		$farmer =  Farmer::find($id);
		// $farmer->cidp_id= $request->input('cidp_id');
		// $farmer->customercode= "G".random_int(1000000,9999999);
		$farmer->name= $request->input('name');
		$farmer->surname= $request->input('surname');
		$farmer->city= $request->input('city');
		$farmer->address= $request->input('address');
		$farmer->gender= $request->input('gender')==null?$request->input('gender'):$farmer->gender;
		$farmer->phonenumber= $request->input('phonenumber');
		$farmer->gender= $request->input('gender');
		$farmer->email= $request->input('email');
		$farmer->country= $request->input('country');
		$farmer->identitynumber= $request->input('identitynumber');
		$farmer->nextofkin= $request->input('nextofkin');
		$farmer->province= $request->input('province')==null?$farmer->province:$request->input('province');
		$farmer->ward= $request->input('ward');
		$farmer->village= $request->input('village');
		$farmer->marital_status= $request->input('marital_status')==null?$farmer->marital_status:$request->input('marital_status');

		
       
        $farmer->update([$farmer]);
	    $session->setFlash('success', 'farmer updated successfully!!');
		Configuration::redirection('farmers');
		}catch(Exception $ex){
			$session->setFlash('error', $ex->getMessage());
			$this->back();
		}
	}



	public function destroy($id) 
	{
	$session = new SessionManager();
	$farmer =  Farmer::find($id);
	
		 $farmer->delete();
		 $session->setFlash('success', 'farmer  deleted successfully');
		 $this->back();


   }











}
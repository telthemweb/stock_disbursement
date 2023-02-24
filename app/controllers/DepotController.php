<?php
namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\Depot;
use Ti\Mss\App\models\CommonDisbusement;
use Ti\Mss\App\models\Administrator;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class DepotController extends Controller
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

	public function index()
	{
		$depots =  Depot::orderByDesc('created_at')->get();
		$administrators =  Administrator::whererole_id('2')->get();
         $this->view("administrator/depot/add", "dash", 'adminfooter', ['depots'=>$depots,'administrators'=>$administrators]);
	}

    public function add()
	{
		$request = new Request;
		$session = new SessionManager();
        $depot = new Depot();
        $depotname = Depot::wherename($request->input('name'))->first();

        if($depotname ==null){
		$audit = new Audit();

		$olddata = array();
        $olddata['newdata'] = 'new entry data';
        $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['name'] = $request->input('name');
        $newdata['province'] = $request->input('province');
        $newdata['district'] = $request->input('district');
        $mynewdata= json_encode($newdata);

        $checkalreadyexist =  Depot::whereadministrator_id($request->input('administrator_id'))->first();

		if($checkalreadyexist ==null){
        $depot->name = $request->input('name');
        $depot->province = $request->input('province');
        $depot->district = $request->input('district');
        $depot->administrator_id = $request->input('administrator_id');

		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Depot';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="create-depot";
		$audit->save([$audit]);
        $depot->save();
		$session->setFlash('success', 'Depot created successfully!!');
		$this->back();
	   }else{
			$session->setFlash('error', 'Stores person Already exist!!');
		    $this->back();
		}
		}
		else{
			$session->setFlash('error', $request->input('name') .' Already exist!!');
		    $this->back();
		}
	}

	public function show($id) 
	{
			$depot =  Depot::find($id);
			$administrators =  Administrator::whererole_id('2')->get();
			$this->view("administrator/depot/edit", "dash", 'adminfooter', ['depot'=>$depot,'administrators'=>$administrators]);
	}

     public function showcidp($id) 
	{
			$depot =  Depot::find($id);
			$depotcidps =  CommonDisbusement::wheredepot_id($depot->id)->get();
			$administrators =  Administrator::whererole_id('4')->get();
			$this->view("administrator/depot/sellingpoint", "dash", 'adminfooter', ['depot'=>$depot,'depotcidps'=>$depotcidps,'administrators'=>$administrators]);
	}




    public function update($id)
	{
		$request = new Request;
		$session = new SessionManager();
		$depot = Depot::findOrFail($id);

		$olddata = array();
		$olddata['name'] = $depot->name;
		$olddata['province'] = $depot->province;
		$olddata['district'] = $depot->district;
		$olddata['created_at'] = $depot->created_at;

		$myolddata= json_encode($olddata);


		$newdata = array();
		$newdata['name'] = $request->input('name');
		$newdata['province'] = $request->input('province')==null?$depot->province:$request->input('province');
		$newdata['district'] = $request->input('district')==null?$depot->district:$request->input('district');
		$newdata['updated_at'] = date('d-m-Y');
		$mynewdata= json_encode($newdata);

		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Depot';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="update-depot";
		$audit->save();


		$depot->name = $request->input('name');
		$depot->province = $request->input('province')==null?$depot->province:$request->input('province');
		$depot->district = $request->input('district')==null?$depot->district:$request->input('district');
		$depot->administrator_id = $request->input('administrator_id')==null?$depot->administrator_id:$request->input('administrator_id');
		$depot->update([$depot]);
		$session->setFlash('success', 'Depot updated successfully!!');
		Configuration::redirection('depots');
	}

	public function destroy($id) {
		$session = new SessionManager();
		$depot = Depot::find($id);
		 if(count($depot->customers)>0){
		 	 $session->setFlash('error', 'Depot cant be deleted');
		 	 Configuration::redirection('depots');
		 }else{

		 $olddata = array();
		$olddata['name'] = $depot->name;
		$olddata['province'] = $depot->province;
		$olddata['district'] = $depot->district;

		$myolddata= json_encode($olddata);




			$audit = new Audit();
			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Helpdesk\App\Model\Depot';
			$audit->oldvalue=$myolddata;
			$audit->newvalue='Deleted';
			$audit->action="delete-depot";
			$audit->save();
		 	 $depot->delete();
		 	 $session->setFlash('success', 'Depot  deleted successfully');
		 	 Configuration::redirection('depots');
		 }
	}







}
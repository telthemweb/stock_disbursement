<?php


namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\CommonDisbusement;
use Ti\Mss\App\models\Administrator;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class DisbusemenPointController extends Controller
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

        public function add() {
		$request = new Request;
		$session = new SessionManager();
        $commonDisbusement = new CommonDisbusement();

        $olddata = array();
        $olddata['newdata'] = 'new entry data';
        $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['name'] = $request->input('name');
        $mynewdata= json_encode($newdata);
		
        $audit = new Audit();

		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\CommonDisbusement';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="create-commonDisbusement";
		$audit->save([$audit]);
		$checkalreadyexist =  CommonDisbusement::whereadministrator_id($request->input('administrator_id'))->first();

		if($checkalreadyexist ==null){
			$commonDisbusement->name = $request->input('name');
	        $commonDisbusement->depot_id = $request->input('depot_id');
	        $commonDisbusement->administrator_id = $request->input('administrator_id');
	        $commonDisbusement->save();
			$session->setFlash('success', 'New commonDisbusement created successfully!!');
			$this->back();
		}else{
			$session->setFlash('error', 'Clerk Already exist!!');
		    $this->back();
		}

        
	}

     public function show($id) 
	{
			$depotcidp =  CommonDisbusement::find($id);
			$administrators =  Administrator::whererole_id('4')->get();
			$this->view("administrator/depot/editcidp", "dash", 'adminfooter', ['depotcidp'=>$depotcidp,'administrators'=>$administrators]);
	}


     public function update($id) {
		$request = new Request;
		$session = new SessionManager();
 
		$commonDisbusement = CommonDisbusement::findOrFail($id);
		$commonDisbusement->name = $request->input('name');
        $commonDisbusement->depot_id = $request->input('depot_id');
        $commonDisbusement->administrator_id = $request->input('administrator_id')==null?$commonDisbusement->administrator_id:$request->input('administrator_id');
		$commonDisbusement->update([$commonDisbusement]);
		$session->setFlash('success', 'commonDisbusement updated successfully!!');
		$this->back();
	}

      public function destroy($id) {
		$session = new SessionManager();
		$commonDisbusement = CommonDisbusement::findOrFail($id);
		$commonDisbusement->delete();
		$session->setFlash('success', 'commonDisbusement  deleted successfully');
		$this->back();
	}

}
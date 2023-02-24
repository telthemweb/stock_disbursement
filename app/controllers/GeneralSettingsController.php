<?php
namespace Ti\Mss\App\controllers;

use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\Settings;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;
use Exception;

class GeneralSettingsController extends Controller
{
   public function __construct(){
	(new AdministratorMiddleware())->redirectIfNotAuthenticated();
   }

	public function index()
	{	
	  $settings =  Settings::orderByDesc('created_at')->get();
     $this->view("administrator/settings/index", "dash", 'adminfooter', ['settings'=>$settings]);
	}

	public function add()
	{
		try{
		$request = new Request;
		$session = new SessionManager();
      $setting = new Settings();
		$audit = new Audit();

		$settingcheck = Settings::wherestatus('Active')->first();

		if($settingcheck !=null){
			$session->setFlash('error', 'Settings already added!!');
		   $this->back();
		}
		$site_logo = $request->fileinput('site_logo'); 
		$favicon = $request->fileinput('favicon'); 
		$pathsite_logoinfo = pathinfo($site_logo, PATHINFO_EXTENSION);
		$pathfaviconinfo = pathinfo($favicon, PATHINFO_EXTENSION);

		$arrysite_logo = strtotime(date('YmdHis'));
		$arryfavicon = strtotime(date('YmdHis'));


		$timesite_logo= base64_encode($arrysite_logo.random_int(1000,9999)).".".$pathsite_logoinfo;
		$timefavicon= base64_encode($arryfavicon.random_int(1000,9999)).".".$pathfaviconinfo;
		
		
		$picksite_logo= "assets/img/uploads/developer/".$timesite_logo;
		$pickfavicon= "assets/img/uploads/developer/".$timefavicon;

		
		


		 $olddata = array();
       $olddata['newdata'] = 'new entry data';
       $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['site_title'] = $request->input('site_title');
        $newdata['site_logo'] = $picksite_logo;
        $newdata['favicon'] = $pickfavicon;
        $newdata['administrator_id'] = $_SESSION['admin_id'];
        $newdata['currency'] = $request->input('currency');
        $newdata['currency_position'] = $request->input('currency_position');
        $newdata['developed_by'] = $request->input('developed_by');
        $newdata['status'] = "Active";
        $mynewdata= json_encode($newdata);


       
        $setting->site_title = $request->input('site_title');
        $setting->site_logo = $picksite_logo;
        $setting->favicon = $pickfavicon;
        $setting->administrator_id=$_SESSION['admin_id'];
        $setting->currency = $request->input('currency');
        $setting->currency_position = $request->input('currency_position');
        $setting->developed_by = $request->input('developed_by');
        $setting->status = "Active";



			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Mss\App\models\Settings';
			$audit->oldvalue=$myolddata;
			$audit->newvalue=$mynewdata;
			$audit->action="create-setting";
			$audit->save([$audit]);


       
      $setting->save();
		$session->setFlash('success', 'Settings created successfully!!');
      move_uploaded_file($_FILES['site_logo']['tmp_name'],$picksite_logo);
      move_uploaded_file($_FILES['favicon']['tmp_name'],$pickfavicon);
		$this->back();
		}catch(Exception $ex){
			$session->setFlash('error', $ex->getMessage());
			$this->back();
		}
	}

	public function show($id)
	{
		$setting =  Settings::find($id);
		$this->view("administrator/settings/edit", "dash", 'adminfooter', ['setting'=>$setting]);
	}

	public function update($id)
	{
		$request = new Request;
		$session = new SessionManager();
		$setting = Settings::findOrFail($id);

		$site_logo = $request->fileinput('site_logo'); 
		$favicon = $request->fileinput('favicon'); 

		

		if ($site_logo !=null || $favicon !=null) {
			if(file_exists($this->url($setting->site_logo))){
				unlink($this->url($setting->site_logo)); 
			}
			elseif (file_exists($this->url($setting->favicon))) {
				unlink($this->url($setting->favicon)); 
			}
			       
			       
			$pathsite_logoinfo = pathinfo($site_logo, PATHINFO_EXTENSION);
			$pathfaviconinfo = pathinfo($favicon, PATHINFO_EXTENSION);

			$arrysite_logo = strtotime(date('YmdHis'));
			$arryfavicon = strtotime(date('YmdHis'));


			$timesite_logo= base64_encode($arrysite_logo.random_int(1000,9999)).".".$pathsite_logoinfo;
			$timefavicon= base64_encode($arryfavicon.random_int(1000,9999)).".".$pathfaviconinfo;
			
			
			$picksite_logo= "assets/img/uploads/developer/".$timesite_logo;
			$pickfavicon= "assets/img/uploads/developer/".$timefavicon;





		 $olddata = array();
        $olddata['site_title'] = $setting->site_title;
        $olddata['site_logo'] =  $setting->site_logo;
        $olddata['favicon'] = $setting->favicon;
        $olddata['administrator_id'] = $setting->administrator_id;
        $olddata['currency'] = $setting->currency;
        $olddata['currency_position'] = $setting->currency_position;
        $olddata['developed_by'] = $setting->developed_by;
        $olddata['status'] = $setting->status;

        $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['site_title'] = $request->input('site_title');
        $newdata['site_logo'] = $picksite_logo;
        $newdata['favicon'] = $pickfavicon;
        $newdata['administrator_id'] = $_SESSION['admin_id'];
        $newdata['currency'] = $request->input('currency');
        $newdata['currency_position'] = $request->input('currency_position');
        $newdata['developed_by'] = $request->input('developed_by');
        $mynewdata= json_encode($newdata);


			$audit = new Audit();
			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Mss\App\models\Settings';
			$audit->oldvalue=$myolddata;
			$audit->newvalue=$mynewdata;
			$audit->action="update-setting";
			$audit->save();
			
		  $setting->site_title = $request->input('site_title');
        $setting->site_logo = $picksite_logo;
        $setting->favicon = $pickfavicon;
        $setting->administrator_id=$_SESSION['admin_id'];
        $setting->currency = $request->input('currency');
        $setting->currency_position = $request->input('currency_position');
        $setting->developed_by = $request->input('developed_by');

			$setting->update([$setting]);
			$session->setFlash('success', 'Setting updated successfully!!');
			//Configuration::redirection('settings');
		}
		

	}

	public function destroy($id) {
		$session = new SessionManager();
		$setting = Settings::find($id);

		$olddata = array();
        $olddata['site_title'] = $setting->site_title;
        $olddata['site_logo'] =  $setting->site_logo;
        $olddata['favicon'] = $setting->favicon;
        $olddata['administrator_id'] = $setting->administrator_id;
        $olddata['currency'] = $setting->currency;
        $olddata['currency_position'] = $setting->currency_position;
        $olddata['developed_by'] = $setting->developed_by;
        $olddata['status'] = $setting->status;

        $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['deleted'] = 'deleted';
        $mynewdata= json_encode($newdata);
		
        $audit = new Audit();

			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Mss\App\models\Settings';
			$audit->oldvalue=$myolddata;
			$audit->newvalue=$mynewdata;
			$audit->action="delete-settings";
			$audit->save([$audit]);

          $setting->delete();
		 	 $session->setFlash('success', 'Settings  deleted successfully');
		 	 unlink($this->url($setting->site_logo));
		 	 unlink($this->url($setting->favicon));
		 	 Configuration::redirection('settings');
	}

}
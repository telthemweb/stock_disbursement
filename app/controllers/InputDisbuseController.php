<?php
namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\CommonDisbusement;
use Ti\Mss\App\models\CIDPGoodreceived;
use Ti\Mss\App\models\Farmer;
use Ti\Mss\App\models\Disbursement;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class InputDisbuseController extends Controller
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

	public function index()
	{
		$cidpoint =CommonDisbusement::whereadministrator_id($_SESSION['admin_id'])->first();
		$goodreceiveds =  CIDPGoodreceived::wherecidp_id($cidpoint->id)->wherestatus("Pending")->orderByDesc('created_at')->get();
		
        $this->view("inputclerk/cidpgoodsreceivedpending", "dash", 'adminfooter', [
        	'goodreceiveds'=>$goodreceiveds,
        ]);
	}

	public function receiveditems()
	{
		$cidpoint =CommonDisbusement::whereadministrator_id($_SESSION['admin_id'])->first();
		$goodreceiveds =  CIDPGoodreceived::wherecidp_id($cidpoint->id)->wherestatus("Received")->orderByDesc('created_at')->get();
		
        $this->view("inputclerk/cidpgoodsreceiveditems", "dash", 'adminfooter', [
        	'goodreceiveds'=>$goodreceiveds,
        ]);
	}

  public function acceptstock($id)
  {
  	$session = new SessionManager();
  	$goodreceiveds =  CIDPGoodreceived::find($id);
  	$goodreceiveds->status = "Received";
	$goodreceiveds->update([$goodreceiveds]);
	$session->setFlash('success', 'Goods has been received successfully!!');
	$this->back();
  }

	  public function farmerinputdisbursement($id)
	  {
	  	$cidpgood =  CIDPGoodreceived::find($id);
	  	$disbursements =  Disbursement::wherecidp_id($cidpgood->cidp_id)->orderByDesc('created_at')->get();
		$farmers=  Farmer::wherecidp_id($cidpgood->cidp_id)->orderByDesc('created_at')->get();
		$this->view("inputclerk/farminputdisbuserpos", "dash", 'adminfooter', ['goodreceiveds'=>$cidpgood,'farmers'=>$farmers,'disbursements'=>$disbursements]);
	  }



	   public function disburseadd()
	{
		try{
			$request = new Request;
			$session = new SessionManager();
	        $disbursement = new Disbursement();


	        
	        $goodreceiveds =  CIDPGoodreceived::find($request->input('grv_id'));
			if($goodreceiveds->quantity <0){
				$session->setFlash('error', 'Product is out of stock!!');
			    $this->back();
			}
			
			

	        
	        $disbursement->farmer_id = $request->input('farmer_id');
	        $disbursement->cidp_id =$request->input('cidp_id');
	        $disbursement->product_id = $request->input('product_id');
	        $disbursement->quantity = $request->input('quantity');




			
			$goodreceiveds->quantity =$goodreceiveds->quantity-$request->input('quantity');
	        $goodreceiveds->update([$goodreceiveds]);
	        $disbursement->save();
		   $session->setFlash('success', 'Farmer receive product successfully!!');
			$this->back();
			}catch(Exception $ex){
				$session->setFlash('error', $ex->getMessage());
				$this->back();
			}
	}



}
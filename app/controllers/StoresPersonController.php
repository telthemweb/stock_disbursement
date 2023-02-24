<?php
namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\Depot;
use Ti\Mss\App\models\Goodreceived;
use Ti\Mss\App\models\Administrator;
use Ti\Mss\App\models\CommonDisbusement;
use Ti\Mss\App\models\CIDPGoodreceived;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class StoresPersonController extends Controller
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

	public function index()
	{
		$depot =  Depot::whereadministrator_id($_SESSION['admin_id'])->first();
		$goodreceiveds =  Goodreceived::wheredepot_id($depot->id)->wherestatus("Pending")->orderByDesc('created_at')->get();
		$acceptedgoodreceiveds =  Goodreceived::wheredepot_id($depot->id)->wherestatus("Received")->orderByDesc('created_at')->get();
        $this->view("storesperson/goodsreceived", "dash", 'adminfooter', [
        	'goodreceiveds'=>$goodreceiveds,
        ]);
	}

	public function receiveditems()
	{
		$depot =  Depot::whereadministrator_id($_SESSION['admin_id'])->first();
		$acceptedgoodreceiveds =  Goodreceived::wheredepot_id($depot->id)->wherestatus("Received")->orderByDesc('created_at')->get();
        $this->view("storesperson/goodsreceiveditems", "dash", 'adminfooter', [
        	'goodreceiveds'=>$acceptedgoodreceiveds,
        ]);
	}

  public function acceptstock($id)
  {
  	$session = new SessionManager();
  	$goodreceiveds =  Goodreceived::find($id);
  	$goodreceiveds->status = "Received";
	$goodreceiveds->update([$goodreceiveds]);
	$session->setFlash('success', 'Goods has been received successfully!!');
	$this->back();
  }


	public function cidps($id) 
	{
			$depot = Depot::whereadministrator_id($id)->first();
			$depotcidps =  CommonDisbusement::wheredepot_id($depot->id)->get();
			$this->view("storesperson/sellingpoint", "dash", 'adminfooter', ['depot'=>$depot,'depotcidps'=>$depotcidps]);
	}



	public function disburse($id)
	{
		$goodreceiveds =  Goodreceived::find($id);
		$depot =  Depot::whereadministrator_id($_SESSION['admin_id'])->first();
		$transferedgoods=  CIDPGoodreceived::wheredepot_id($depot->id)->orderByDesc('created_at')->get();
		$cidps=  CommonDisbusement::wheredepot_id($depot->id)->orderByDesc('created_at')->get();
		$this->view("storesperson/transferedgoods", "dash", 'adminfooter', ['goodreceiveds'=>$goodreceiveds,'transferedgoods'=>$transferedgoods,'cidps'=>$cidps]);
	}

     public function disburseadd()
	{
		try{
			$request = new Request;
			$session = new SessionManager();
	        $goodreceivedtrans = new CIDPGoodreceived();


	        
	        $goodreceiveds =  Goodreceived::find($request->input('grv_id'));
			if($goodreceiveds->quantity <0){
				$session->setFlash('error', 'Product is out of stock!!');
			    $this->back();
			}
			
			

	        
	        $goodreceivedtrans->quantity = $request->input('quantity');
	        $goodreceivedtrans->product_id =$request->input('product_id');
	        $goodreceivedtrans->depot_id = $request->input('depot_id');
	        $goodreceivedtrans->cidp_id = $request->input('cidp_id');
	        $goodreceivedtrans->stock_alert_quantity = $request->input('stock_alert_quantity');
	        $goodreceivedtrans->distributedby=$_SESSION['admin_id'];
	        $goodreceivedtrans->status = "Pending";




			
			$goodreceiveds->quantity =$goodreceiveds->quantity-$request->input('quantity');
	        $goodreceiveds->update([$goodreceiveds]);
	        $goodreceivedtrans->save();
		  $session->setFlash('success', 'Stock Transfered successfully!!');
			$this->back();
			}catch(Exception $ex){
				$session->setFlash('error', $ex->getMessage());
				$this->back();
			}
	}




}
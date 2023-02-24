<?php
namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\Depot;
use Ti\Mss\App\models\Product;
use Ti\Mss\App\models\Goodreceived;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class ProcurementController extends Controller
{
		public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
		}

		public function index()
		{
			$depots =  Depot::orderByDesc('created_at')->get();
			$products =  Product::orderByDesc('created_at')->get();
			$goodreceiveds =  Goodreceived::wherestatus("Pending")->orderByDesc('created_at')->get();
	        $this->view("administrator/dispatch/index", "dash", 'adminfooter', [
	        	'depots'=>$depots,
	        	'products'=>$products,
	        	'goodreceiveds'=>$goodreceiveds,
	        ]);
		}

		public function transfer()
		{
			try{
			$request = new Request;
			$session = new SessionManager();
	        $goodreceived = new Goodreceived();
			$audit = new Audit();

			
			$docnumber ="GRV-".random_int(1000,9999) .date('dmYhms');

			if($quantitycheck->stockonhand <$quantitycheck->stock_alert_quantity ){
				$session->setFlash('error', 'Product is out of stock!!');
			    $this->back();
			}
			
			$quantitycheck = Product::find($request->input('product_id'));
			if($quantitycheck->quantity < $request->input('quantity')){
				$session->setFlash('error', 'quantity allocated is more than quantity available in the stores!!');
			    $this->back();
			}


		   $olddata = array();
	       $olddata['newdata'] = 'new stock-transfer';
	       $myolddata= json_encode($olddata);

	        $newdata = array();
	        $newdata['quantity'] = $request->input('quantity');
	        $newdata['product_id'] = $request->input('product_id');
	        $newdata['depot_id'] = $request->input('depot_id');
	        $newdata['stock_alert_quantity'] = $request->input('stock_alert_quantity');
	        $newdata['distributedby'] = $_SESSION['admin_id'];
	        $newdata['status'] = "Active";
	        $mynewdata= json_encode($newdata);
		
		
		

	       


	        $goodreceived->docnumber = $docnumber;
	        $goodreceived->quantity = $request->input('quantity');
	        $goodreceived->product_id =$request->input('product_id');
	        $goodreceived->depot_id = $request->input('depot_id');
	        $goodreceived->stock_alert_quantity = $request->input('stock_alert_quantity');
	        $goodreceived->distributedby=$_SESSION['admin_id'];
	        $goodreceived->status = "Pending";



			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Mss\App\models\Goodreceived';
			$audit->oldvalue=$myolddata;
			$audit->newvalue=$mynewdata;
			$audit->action='stock-transfer';
			$audit->save([$audit]);

			$quantitycheck->stockonhand =$quantitycheck->stockonhand-$request->input('quantity');
			$quantitycheck->quantity =$quantitycheck->quantity-$request->input('quantity');
	       $quantitycheck->update([$quantitycheck]);
	      $goodreceived->save();
		  $session->setFlash('success', 'Stock Transfered successfully!!');
			$this->back();
			}catch(Exception $ex){
				$session->setFlash('error', $ex->getMessage());
				$this->back();
			}
		}

	

	public function show($id)
	{
		$goodreceived =  Goodreceived::find($id);
		$depots =  Depot::orderByDesc('created_at')->get();
		$products =  Product::orderByDesc('created_at')->get();
		$this->view("administrator/dispatch/edit", "dash", 'adminfooter', [
			'depots'=>$depots,
	        'products'=>$products,
			'goodreceived'=>$goodreceived]);
	}


       public function update($id)
		{
			try{
			$request = new Request;
			$session = new SessionManager();
	        $goodreceived = Goodreceived::find($id);
			$audit = new Audit();
			$product =$request->input('product_id')==null?$goodreceived->product_id:$request->input('product_id');
			$quantitycheck = Product::find($product);

		   $olddata = array();

	       $olddata['docnumber'] =  $goodreceived->docnumber;
	       $olddata['quantity'] =  $goodreceived->quantity;
	       $olddata['product'] =  $goodreceived->product->name;
	       $olddata['depot_id'] =  $goodreceived->depot->name;
	       $olddata['distributedby'] =  $goodreceived->administrator->name. " ".$goodreceived->administrator->surname;
	       $olddata['status'] =  $goodreceived->status;

	       $myolddata= json_encode($olddata);

	        $newdata = array();
	        $newdata['quantity'] = $request->input('quantity');
	        $newdata['product_id'] = $request->input('product_id');
	        $newdata['depot_id'] = $request->input('depot_id');
	        $newdata['distributedby'] = $_SESSION['admin_id'];
	        $mynewdata= json_encode($newdata);
		
		
		

	       
	        $goodreceived->quantity = $request->input('quantity');
	        $goodreceived->product_id =$request->input('product_id')==null? $goodreceived->product_id :$request->input('product_id');
	        $goodreceived->depot_id = $request->input('depot_id')==null?$goodreceived->depot_id:$request->input('depot_id');
	        $goodreceived->distributedby=$_SESSION['admin_id'];



			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Mss\App\models\Goodreceived';
			$audit->oldvalue=$myolddata;
			$audit->newvalue=$mynewdata;
			$audit->action='update-stock-transfer';
			$audit->save([$audit]);

		 if($goodreceived->quantity<$request->input('quantity')){
		 	$quantitycheck->stockonhand =$quantitycheck->stockonhand-$request->input('quantity');
		 	$quantitycheck->quantity =$quantitycheck->quantity-$request->input('quantity');
	       $quantitycheck->update([$quantitycheck]);
		 }

		  if($goodreceived->quantity>$request->input('quantity')){

		  	$newstock = $goodreceived->quantity-$request->input('quantity');
		  	$quantitycheck->stockonhand =$quantitycheck->stockonhand+$newstock;
		 	$quantitycheck->quantity =$quantitycheck->quantity+$newstock;
	        $quantitycheck->update([$quantitycheck]);
		  }
		   
		   


	      $goodreceived->update([$goodreceived]);
		  $session->setFlash('success', 'Stock Transfer updated successfully!!');
			$this->back();
			}catch(Exception $ex){
				$session->setFlash('error', $ex->getMessage());
				$this->back();
			}
		}













}

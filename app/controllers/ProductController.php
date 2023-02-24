<?php
namespace Ti\Mss\App\controllers;


use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\Helpers\Configuration;
use Ti\Mss\Helpers\Request;
use Ti\Mss\App\models\Systemlogs;
use Ti\Mss\App\models\Audit;
use Ti\Mss\App\models\Product;
use Ti\Mss\App\models\Supplier;
use Ti\Mss\App\models\Category;
use Ti\Mss\Helpers\middleware\AdministratorMiddleware;

class ProductController extends Controller
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

	public function index()
	{
		$products =  Product::orderByDesc('created_at')->get();
		$categories = Category::orderByDesc('created_at')->get();
		$suppliers =  Supplier::orderByDesc('created_at')->get();
        $this->view("administrator/stockitems/products", "dash", 'adminfooter', [
        	'products'=>$products,
        	'categories'=>$categories,
        	'suppliers'=>$suppliers
        ]);
	}


	public function add()
	{
		try{
		$request = new Request;
		$session = new SessionManager();
        $product = new Product();
		$audit = new Audit();
 
		$productcheck = Product::wherename($request->input('name'))->first();

		$barcodedata=$request->input('barcode')==null?"ctc".random_int(1000000,9999999):$request->input('barcode');
		$product_code=$request->input('product_code')==null?"ctc".random_int(1000,9999):$request->input('product_code');

		// if($productcheck !=null){
		// 	$session->setFlash('error', 'Product already added!!');
		//    $this->back();
		// }

		$currentdate = date('d-m-Y');
		$stockindated = date('d-m-Y',strtotime($request->input('datestockin')));
		$expirydated = date('d-m-Y',strtotime($request->input('bestbefore')));

		// if($expirydated<$currentdate){
		// 	$session->setFlash('error', 'Product already expired you cant put this in stock!');
		//    $this->back();
		// }

		$imageurl = $request->fileinput('imageurl'); 
		$pathimageurlinfo = pathinfo($imageurl, PATHINFO_EXTENSION);
		$arryimageurl = strtotime(date('YmdHis'));
		$timeimageurl= base64_encode($arryimageurl.random_int(1000,9999)).".".$pathimageurlinfo;
		$pickimageurl= "assets/img/uploads/products/".$timeimageurl;

		
		


	   $olddata = array();
       $olddata['newdata'] = 'new entry data';
       $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['category_id'] = $request->input('category_id');
        $newdata['product_code'] = $product_code;
        $newdata['name'] = $request->input('name');
        $newdata['desc'] = $request->input('desc');
        $newdata['imageurl'] = $pickimageurl;
        $newdata['barcode'] = $barcodedata;
        $newdata['quantity'] = $request->input('quantity');
        $newdata['bestbefore'] = $request->input('bestbefore');
        $newdata['datestockin'] =$stockindated;
        $newdata['administrator_id'] = $_SESSION['admin_id'];
        $newdata['stock_alert_quantity'] = $request->input('stock_alert_quantity');
        $newdata['stockonhand'] = $request->input('stockonhand');
        $newdata['status'] = "Active";
        $newdata['supplier_id'] = $request->input('supplier_id');
        $mynewdata= json_encode($newdata);


       
        $product->category_id = $request->input('category_id');
        $product->unitmeasure = $request->input('unitmeasure');
        $product->product_code = $product_code;
        $product->name = $request->input('name');
        $product->desc = $request->input('desc');
        $product->imageurl=$pickimageurl;
        $product->barcode = $barcodedata;
        $product->quantity = $request->input('quantity');
        $product->bestbefore = $request->input('bestbefore');
        $product->datestockin = $stockindated;
        $product->administrator_id = $_SESSION['admin_id'];
        $product->stock_alert_quantity = $request->input('stock_alert_quantity');
        $product->stockonhand = $request->input('quantity');
        $product->status = $request->input('stockonhand');
        $product->supplier_id = $request->input('supplier_id');
        $product->status = "Active";




		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Product';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="create-product";
		$audit->save([$audit]);


       
      $product->save();
	  $session->setFlash('success', 'Product created successfully!!');
      move_uploaded_file($_FILES['imageurl']['tmp_name'],$pickimageurl);
		$this->back();
		}catch(Exception $ex){
			$session->setFlash('error', $ex->getMessage());
			$this->back();
		}
	}

	public function show($id)
	{
		$product =  Product::find($id);
		$categories = Category::orderByDesc('created_at')->get();
		$suppliers =  Supplier::orderByDesc('created_at')->get();
		$this->view("administrator/stockitems/edit", "dash", 'adminfooter', [
			'product'=>$product,
			'categories'=>$categories,
        	'suppliers'=>$suppliers
		]);
	}


	public function update($id)
	{
		try{
		$request = new Request;
		$session = new SessionManager();
        $product = Product::findOrFail($id);
		$audit = new Audit();

	    $olddata = array();
        $olddata['category_id'] = $product->category_id;
        $olddata['name'] = $product->name;
        $olddata['desc'] = $product->desc;
        $olddata['imageurl'] = $product->imageurl;
        $olddata['barcode'] = $product->barcode;
        $olddata['quantity'] = $product->quantity;
        $olddata['bestbefore'] = $product->bestbefore;
        $olddata['datestockin'] = $product->datestockin;
        $olddata['administrator_id'] = $product->administrator_id;
        $olddata['stock_alert_quantity'] = $product->stock_alert_quantity;
        $olddata['stockonhand'] = $product->stockonhand;
        $olddata['status'] = $product->status;
        $olddata['supplier_id'] = $product->supplier_id;
        $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['category_id'] = $request->input('category_id')==null?$product->category_id:$request->input('category_id');
        $newdata['name'] = $request->input('name');
        $newdata['desc'] = $request->input('desc');
        $newdata['imageurl'] = $pickimageurl;
        $newdata['barcode'] = $request->input('barcode');
        $newdata['quantity'] = $request->input('quantity');
        $newdata['bestbefore'] = $request->input('bestbefore');
        $newdata['datestockin'] = $request->input('datestockin');
        $newdata['administrator_id'] = $_SESSION['admin_id'];
        $newdata['stock_alert_quantity'] = $request->input('stock_alert_quantity');
        $newdata['stockonhand'] = $request->input('stockonhand');
        $newdata['status'] = "Active";
        $newdata['supplier_id'] = $request->input('supplier_id');
        $mynewdata= json_encode($newdata);


       
        $product->category_id = $request->input('category_id')==null?$product->category_id:$request->input('category_id');
        $product->name = $request->input('name');
        $product->desc = $request->input('desc');
        $product->quantity = $request->input('quantity');
        $product->stockonhand = $request->input('quantity');
        $product->bestbefore = $request->input('bestbefore')==null?$product->bestbefore:$request->input('bestbefore');
        $product->administrator_id = $_SESSION['admin_id'];
        $product->stock_alert_quantity = $request->input('stock_alert_quantity');
        $product->supplier_id = $request->input('supplier_id')==null?$product->supplier_id:$request->input('supplier_id');
        $product->unitmeasure = $request->input('unitmeasure');




		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Product';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="update-product";
		$audit->save([$audit]);


      $product->update([$product]);
	  $session->setFlash('success', 'Product updated successfully!!');
	  Configuration::redirection('products');
		}catch(Exception $ex){
			$session->setFlash('error', $ex->getMessage());
			$this->back();
		}
	}

     public function destroy($id) {
		$session = new SessionManager();
		$product = Product::find($id);

		$olddata = array();
        $olddata['category_id'] = $product->category_id;
        $olddata['name'] = $product->name;
        $olddata['desc'] = $product->desc;
        $olddata['imageurl'] = $product->imageurl;
        $olddata['barcode'] = $product->barcode;
        $olddata['quantity'] = $product->quantity;
        $olddata['bestbefore'] = $product->bestbefore;
        $olddata['datestockin'] = $product->datestockin;
        $olddata['administrator_id'] = $product->administrator_id;
        $olddata['stock_alert_quantity'] = $product->stock_alert_quantity;
        $olddata['stockonhand'] = $product->stockonhand;
        $olddata['status'] = $product->status;
        $olddata['supplier_id'] = $product->supplier_id;

        $myolddata= json_encode($olddata);

        $newdata = array();
        $newdata['deleted'] = 'deleted';
        $mynewdata= json_encode($newdata);
		
        $audit = new Audit();

		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Mss\App\models\Product';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="delete-product";
		$audit->save([$audit]);

        $product->delete();
	 	$session->setFlash('success', 'Product  deleted successfully');
	 	Configuration::redirection('products');
	}



}
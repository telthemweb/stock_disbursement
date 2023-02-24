<?php

use Ti\Mss\App\controllers\WelcomeController;
use Ti\Mss\App\controllers\LoginController;
use Ti\Mss\App\controllers\DashboardController;
use Ti\Mss\App\controllers\CategoryController;
use Ti\Mss\App\controllers\RoleController;
use Ti\Mss\App\controllers\DepotController;
use Ti\Mss\App\controllers\GeneralSettingsController;
use Ti\Mss\App\controllers\SupplierController;
use Ti\Mss\App\controllers\ProductController;
use Ti\Mss\App\controllers\ProcurementController;
use Ti\Mss\App\controllers\DisbusemenPointController;
use Ti\Mss\App\controllers\StoresPersonController;
use Ti\Mss\App\controllers\FarmerController;
use Ti\Mss\App\controllers\InputDisbuseController;

use Ti\Mss\helpers\Routers;
/*
|--------------------------------------------------------------------------
|            This file is part of the Telthemweb package.
|               
|--------------------------------------------------------------------------
|
|     For the full copyright and license information, please view the LICENSE
|       file that was distributed with this source code.
|
*/
$router = new Routers();

/*
|--------------------------------------------------------------------------
|                        ALL roles          
|--------------------------------------------------------------------------
|
|
*/
$router->get('/roles', RoleController::class, 'index','');
$router->get('/role/v/{id}', RoleController::class, 'show','');
$router->post('/create', RoleController::class, 'store','');
$router->post('/role/u/{id}', RoleController::class, 'update','');
$router->get('/role/delete/{id}', RoleController::class, 'destroy','');


/*
|--------------------------------------------------------------------------
|                        ALL Admins         
|--------------------------------------------------------------------------
|
|
*/
$router->get('/', WelcomeController::class, 'index','');
$router->get('/admin-auth/login', LoginController::class, 'login','');
$router->post('/admin-auth/auth', LoginController::class, 'authenticate','');
$router->get('/dashboard', DashboardController::class, 'index','');
$router->get('/admin-auth/logout', DashboardController::class, 'logout','');
$router->get('/profile', DashboardController::class, 'getAdminProfile','');
$router->post('/profile/u/{id}', DashboardController::class, 'update','');
$router->post('/changepassword/c/{id}', DashboardController::class, 'changepasswordpost','');

/*
|--------------------------------------------------------------------------
|                        ALL SYSTEM USERS         
|--------------------------------------------------------------------------
|
|
*/
$router->get('/employees', DashboardController::class, 'users','');
$router->post('/employee/register', DashboardController::class, 'store','');
$router->get('/employee/v/{id}', DashboardController::class, 'show','');
$router->post('/employee/u/{id}', DashboardController::class, 'update','');
$router->get('/employee/d/{id}', DashboardController::class, 'destroy','');
$router->get('/employee/r/{id}', DashboardController::class, 'deactivate','');
$router->get('/employee/a/{id}', DashboardController::class, 'activate','');


/*
|--------------------------------------------------------------------------
|                        ALL CATEGORY        
|--------------------------------------------------------------------------
|
|
*/
$router->get('/categories', CategoryController::class, 'index','');
$router->post('/category/add', CategoryController::class, 'add','');
$router->get('/category/e/{id}', CategoryController::class, 'show','');
$router->post('/category/u/{id}', CategoryController::class, 'update','');
$router->get('/cat/delete/{id}', CategoryController::class, 'destroy','');


/*
|--------------------------------------------------------------------------
|                        ALL DEPOTS        
|--------------------------------------------------------------------------
|
|
*/
$router->get('/depots', DepotController::class, 'index','');
$router->post('/depot/add', DepotController::class, 'add','');
$router->get('/depot/e/{id}', DepotController::class, 'show','');
$router->get('/depot/cidp/{id}', DepotController::class, 'showcidp','');
$router->post('/depot/u/{id}', DepotController::class, 'update','');
$router->get('/depot/delete/{id}', DepotController::class, 'destroy','');


/*
|--------------------------------------------------------------------------
|                        ALL CIDP        
|--------------------------------------------------------------------------
|
|
*/
$router->post('/cidp/add', DisbusemenPointController::class, 'add','');
$router->get('/cidp/e/{id}', DisbusemenPointController::class, 'show','');
$router->post('/cidp/u/{id}', DisbusemenPointController::class, 'update','');
$router->get('/cidp/delete/{id}', DisbusemenPointController::class, 'destroy','');



/*
|--------------------------------------------------------------------------
|                        ALL store        
|--------------------------------------------------------------------------
|
|
*/
$router->get('/stores', StoresPersonController::class, 'index','');
$router->get('/received/items', StoresPersonController::class, 'receiveditems','');
$router->get('/store/acceppt/{id}', StoresPersonController::class, 'acceptstock','');
$router->get('/store/cidp/{id}', StoresPersonController::class, 'cidps','');
$router->get('/store/transfer/{id}', StoresPersonController::class, 'disburse','');
$router->post('/store/transfer-cidpstore', StoresPersonController::class, 'disburseadd','');

/*
|--------------------------------------------------------------------------
|                        GENERAL SETTINGS        
|--------------------------------------------------------------------------
|
|
*/
$router->get('/settings', GeneralSettingsController::class, 'index','');
$router->post('/setting/add', GeneralSettingsController::class, 'add','');
$router->get('/setting/e/{id}', GeneralSettingsController::class, 'show','');
$router->post('/setting/u/{id}', GeneralSettingsController::class, 'update','');
$router->get('/setting/delete/{id}', GeneralSettingsController::class, 'destroy','');


/*
|--------------------------------------------------------------------------
|                       SUPPLIERS       
|--------------------------------------------------------------------------
|
|
*/
$router->get('/suppliers', SupplierController::class, 'index','');
$router->post('/supplier/add', SupplierController::class, 'add','');
$router->get('/supplier/e/{id}', SupplierController::class, 'show','');
$router->post('/supplier/u/{id}', SupplierController::class, 'update','');
$router->get('/supplier/delete/{id}', SupplierController::class, 'destroy','');


/*
|--------------------------------------------------------------------------
|                       STOCK PRODUCTS    
|--------------------------------------------------------------------------
|
|
*/
$router->get('/products', ProductController::class, 'index','');
$router->post('/product/add', ProductController::class, 'add','');
$router->get('/product/e/{id}', ProductController::class, 'show','');
$router->post('/product/u/{id}', ProductController::class, 'update','');
$router->get('/product/delete/{id}', ProductController::class, 'destroy','');

/*
|--------------------------------------------------------------------------
|                       STOCK In Transit    PROCUREMENT
|--------------------------------------------------------------------------
|
|
*/
$router->get('/dispatchprocess', ProcurementController::class, 'index','');
$router->post('/dispatchprocess/transfer', ProcurementController::class, 'transfer','');
$router->get('/dispatchprocess/e/{id}', ProcurementController::class, 'show','');
$router->post('/dispatchprocess/u/{id}', ProcurementController::class, 'update','');
$router->get('/dispatchprocess/delete/{id}', ProcurementController::class, 'destroy','');

/*
|--------------------------------------------------------------------------
|                       Farmers       
|--------------------------------------------------------------------------
|
|
*/
$router->get('/farmers', FarmerController::class, 'index','');
$router->post('/farmer/add', FarmerController::class, 'add','');
$router->get('/farmer/e/{id}', FarmerController::class, 'show','');
$router->post('/farmer/u/{id}', FarmerController::class, 'update','');
$router->get('/farmer/delete/{id}', FarmerController::class, 'destroy','');





/*
|--------------------------------------------------------------------------
|                       STOCK In Transit    PROCUREMENT
|--------------------------------------------------------------------------
|
|
*/
$router->get('/inputs/received', InputDisbuseController::class, 'index','');
$router->get('/inputs/disburse', InputDisbuseController::class, 'receiveditems','');
$router->get('/inputs/accept/{id}', InputDisbuseController::class, 'acceptstock','');

$router->get('/pos/{id}', InputDisbuseController::class, 'farmerinputdisbursement','');
$router->post('/pos/add', InputDisbuseController::class, 'disburseadd','');


/*
|--------------------------------------------------------------------------
|            AUDIT TRAIL
|               
|--------------------------------------------------------------------------
|
|    
|       
|
*/
$router->get('/audits', DashboardController::class, 'audittray','');
$router->get('/systemlogs', DashboardController::class, 'systemlogs','');


$router->run();
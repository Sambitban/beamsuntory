<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

		
Route::get('/', function () {
	return view('login');
});
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::any('user-login', 'Auth\LoginController@check_login_details')->name('loginauth');

Route::any('/forget-password', [
			'as' => 'forget-password',
			'uses' => 'Profile\ProfileController@forgot_password'
		]);
		
		 Route::post('/forgot-pass-submit', [
			'as' => 'forgot-pass-submit',
			'uses' => 'Profile\ProfileController@submit_forgot_pass'
		]);
		
		 Route::any('/set-new-password/{number}/{id}', [
			'as' => 'set-new-password',
			'uses' => 'Profile\ProfileController@set_new_password'
		]);
		
		Route::post('/submit-new-set-password', [
			'as' => 'submit-new-set-password',
			'uses' => 'Profile\ProfileController@submit_newset_pass'
		]);
		



Route::group(['middleware' => 'auth'], function () {
	Route::get('dashboard', [
		'as' => 'dashboard',
		'uses' => 'Dashboard\DashboardController@index'
	]);
	Route::group(['prefix' => 'profile-management'], function () {
		Route::get('profile/{id}', 'Profile\ProfileController@profile');

		Route::post('profile-update', 'Profile\ProfileController@profile_update');
		
	});
	
	//<!-- master role section-->
	Route::get('add-role', 'Master\RoleController@add_role');
	Route::post('save-role-data', 'Master\RoleController@save_role_data');
	Route::get('role-list', 'Master\RoleController@role_list');
	Route::get('edit-role/{id}', 'Master\RoleController@role_edit');
	Route::post('update-role-data', 'Master\RoleController@update_role_data');
	Route::get('delete-role/{id}', 'Master\RoleController@delete_role');
	Route::any('role-active/{id?}/{value?}', 'Master\RoleController@changeStatus');
	//Role User
	Route::get('role-user-list', 'Master\RoleUserController@user_list');
	Route::get('add-role-user', 'Master\RoleUserController@add_user');
	Route::any('save-role-user-data', 'Master\RoleUserController@save_user_data');
	Route::get('role-user-edit/{id}', 'Master\RoleUserController@user_edit');
	Route::post('update-role-user-data', 'Master\RoleUserController@update_user_data');
	Route::any('role-user-active/{id?}/{value?}', 'Master\RoleUserController@changeStatus');
	Route::get('delete-role-user/{id}', 'Master\RoleUserController@delete_user');
	//<!-- master Brand section-->
	Route::get('add-brand', 'Master\BrandController@add_brand');
	Route::post('save-brand-data', 'Master\BrandController@save_brand_data');
	Route::get('brand-list', 'Master\BrandController@brand_list');
	Route::get('edit-brand/{id}', 'Master\BrandController@brand_edit');
	Route::post('update-brand-data', 'Master\BrandController@update_brand_data');
	Route::get('delete-brand/{id}', 'Master\BrandController@delete_brand');
	Route::any('brand-active/{id?}/{value?}', 'Master\BrandController@changeStatus');
	//<!-- master store category section-->
	Route::get('add-store-category', 'Master\StoreCategoryController@add_store_category');
	Route::post('save-store-category-data', 'Master\StoreCategoryController@save_store_category_data');
	Route::get('store-category-list', 'Master\StoreCategoryController@store_category_list');
	Route::get('edit-store-category/{id}', 'Master\StoreCategoryController@store_category_edit');
	Route::post('update-store-category-data', 'Master\StoreCategoryController@update_store_category_data');
	Route::get('delete-store-category/{id}', 'Master\StoreCategoryController@delete_store_category');
	Route::any('store-category-active/{id?}/{value?}', 'Master\StoreCategoryController@changeStatus');
	//product master
	Route::get('add-product', 'product\ProductController@add');
	Route::post('get-attribute-detsils', 'product\ProductController@get_attribute_detsils');
	Route::post('save-produt', 'product\ProductController@save_produt');
	Route::any('product-list', 'product\ProductController@product_list');
	Route::any('product-active/{id?}/{value?}', 'product\ProductController@changeStatus');
	Route::post('product-details', 'product\ProductController@view');
	Route::get('edit-product/{id}', 'product\ProductController@edit_product');
	Route::post('update-product', 'product\ProductController@update_product');
	Route::get('delete-product/{id}', 'product\ProductController@delete_product');
	
	//po
	Route::get('add-po-step1/{id?}', 'po\PoMasterController@add');
	Route::post('get-item-details', 'po\PoMasterController@get_item_details');
	Route::post('save-po-steop1', 'po\PoMasterController@save_po_step1');
	Route::any('purchase-order-list', 'po\PoMasterController@purchase_order_list');
	Route::any('purchase-active/{id?}/{value?}', 'po\PoMasterController@changeStatus');
	Route::get('delete-purchase/{id}', 'po\PoMasterController@delete_purchase');
	Route::post('update-po-steop1', 'po\PoMasterController@update_po_steop1');
	// Region
	Route::get('region-master-list', 'Master\RegionController@list');
	Route::get('add-region', [
		'as' => 'add-region',
		'uses' => 'Master\RegionController@addRegion'
	]);

	Route::get('edit-region/{id}', [
		'as' => 'edit-region',
		'uses' => 'Master\RegionController@editRegion'
	]);
	
	Route::post('save-region', [
		'as' => 'save-region',
		'uses' => 'Master\RegionController@save_region'
	]); 
	
	Route::post('update-region', [
		'as' => 'update-region',
		'uses' => 'Master\RegionController@update_region'
	]);
	
	Route::post('region-details', 'Master\RegionController@view');
	Route::any('region/active/{id?}/{value?}', 'Master\RegionController@changeStatus');
	Route::any('region/delete/{id?}/{value?}', 'Master\RegionController@delete_fn');
	
	//State
	Route::get('state-master-list', 'Master\StateController@list');
	Route::get('add-state', [
		'as' => 'add-state',
		'uses' => 'Master\StateController@addState'
	]);
	Route::post('save-state', [
		'as' => 'save-state',
		'uses' => 'Master\StateController@save_state'
	]);
	
	Route::get('edit-state/{id}', [
		'as' => 'edit-state',
		'uses' => 'Master\StateController@editState'
	]);
	
	Route::post('update-state', [
		'as' => 'update-state',
		'uses' => 'Master\StateController@update_state'
	]);
	
	//Route::post('state-details', 'Master\StateController@view');
	Route::any('state/active/{id?}/{value?}', 'Master\StateController@changeStatus');
	Route::any('state/delete/{id?}/{value?}', 'Master\StateController@delete_fn');
	
	
	
	// Supplier
	Route::get('supplier-master-list', 'Master\SupplierController@list');
	Route::get('add-supplier', [
		'as' => 'add-supplier',
		'uses' => 'Master\SupplierController@addSupplier'
	]);
	
	Route::get('edit-supplier/{id}', [
		'as' => 'edit-supplier',
		'uses' => 'Master\SupplierController@editSupplier'
	]);
	
	Route::post('save-supplier', [
		'as' => 'save-supplier',
		'uses' => 'Master\SupplierController@save_supplier'
	]);
	
	Route::post('update-supplier', [
		'as' => 'update-supplier',
		'uses' => 'Master\SupplierController@update_supplier'
	]);
	
	Route::post('supplier-details', 'Master\SupplierController@view');
	Route::any('supplier/active/{id?}/{value?}', 'Master\SupplierController@changeStatus');
	Route::any('supplier/delete/{id?}/{value?}', 'Master\SupplierController@delete_fn');
	
	
	
	//////// Master store section ///
	Route::get('store-list', 'Master\StoreController@store_list');
	Route::get('add-store', 'Master\StoreController@add_store');
	Route::post('submit-store', 'Master\StoreController@save_store');
	Route::get('edit-store/{storeId}', 'Master\StoreController@edit_store');
	Route::post('update-store', 'Master\StoreController@update_store');
	Route::any('store-active/{id?}/{value?}', 'Master\StoreController@changeStatus');
	Route::get('delete-store/{id}', 'Master\StoreController@delete_store');
	
	
	/////////////user management ///////////////
	
	// listing user
		Route::get('user-list', 'Master\UserController@user_list');
		// adding user form
		Route::get('add-user', 'Master\UserController@add_user')->name('user.add');
		// saving user data
		Route::any('save-user-data', 'Master\UserController@save_user_data')->name('save-data');
		// editing user data
		Route::get('user-edit/{id}', 'Master\UserController@user_edit');
		// updating user data
		Route::post('update-user-data', 'Master\UserController@update_user_data');
		
		Route::any('user-active/{id?}/{value?}', 'Master\UserController@changeStatus');
	Route::get('delete-user/{id}', 'Master\UserController@delete_user');
	
	//////////////   product related //////////
	
	Route::get('product-category-list', 'product\ProductCategoryController@product_category_list');
	Route::any('add-Produt-Category', 'product\ProductCategoryController@add_product_category');
	
	Route::any('save-Produt-Category', 'product\ProductCategoryController@save_product_category');
	
	Route::any('edit-Produt-Category/{id}', 'product\ProductCategoryController@edit_product_category');
	
	Route::any('update-Produt-Category', 'product\ProductCategoryController@update_product_category');
	
	Route::any('Produt-Category-active/{id}/{value?}', 'product\ProductCategoryController@change_status_product_category');
	
	Route::any('delete-Produt-Category/{id}', 'product\ProductCategoryController@delete_product_category');
	
	
	/////////////////////////// product attribute ///////////
	
	Route::any('Produt-attribute-list', 'product\ProductAttributeValueController@list_product_attribute_value');
	
	Route::any('add-Produt-attribute-value', 'product\ProductAttributeValueController@add_product_attribute_value');
	
	Route::any('save-Produt-attribute-value', 'product\ProductAttributeValueController@save_product_attribute_value');
	
	Route::any('edit-Produt-attribute-value/{id}', 'product\ProductAttributeValueController@edit_product_attribute_value');
	
	Route::any('update-Produt-attribute-value', 'product\ProductAttributeValueController@update_product_attribute_value');
	
	Route::any('delete-Produt-attribute-value/{id}', 'product\ProductAttributeValueController@delete_product_attribute');
	
	Route::any('Produt-attribute-value-active/{id}/{value?}', 'product\ProductAttributeValueController@change_status_product_attribute');
	
	
		//////////// Warehouse manager////////////
	
	// listing warehouse manager
		Route::get('manager-list', 'Master\WarehouseManagerController@manager_list');
		// adding warehouse manager form
		Route::get('add-warehouse-manager', [
		'as' => 'add-warehouse-manager',
		'uses' => 'Master\WarehouseManagerController@add_warehouse_manager'
		]);
		// saving warehouse manager data
		Route::any('save-warehoue-manager-data', 'Master\WarehouseManagerController@save_warehoue_manager_data');
		// updating warehouse manager data
		Route::any('manager-active/{id?}/{value?}', 'Master\WarehouseManagerController@changeStatus');
		// editing warehouse manager data
		Route::get('warehouse-manager-edit/{id}', 'Master\WarehouseManagerController@warehouse_manager_edit');
		// updating warehouse manager data
		Route::post('update-warehouse-manager-data', 'Master\WarehouseManagerController@update_warehouse_manager_data');
		Route::get('delete-warehouse-manager/{id}', 'Master\WarehouseManagerController@delete_warehouse_manager');
		
		////////// Warehouse////////////
		// listing warehouse
		Route::get('warehouse-list', 'Master\WarehouseController@warehouse_list');
		// adding warehouse form
		Route::get('add-warehouse', [
		'as' => 'add-warehouse',
		'uses' => 'Master\WarehouseController@addWarehouse'
	]);
	// saving warehouse data
		Route::post('save-warehouse', [
			'as' => 'save-warehouse',
			'uses' => 'Master\WarehouseController@save_warehouse'
		]);
		// editing warehouse data
		Route::get('edit-warehouse/{id}', [
		'as' => 'edit-warehouse',
		'uses' => 'Master\WarehouseController@editWarehouse'
	]);
	// updating warehouse data
	Route::post('update-warehouse', [
		'as' => 'update-warehouse',
		'uses' => 'Master\WarehouseController@update_warehouse_data'
	]);
	Route::any('warehouse-active/{id?}/{value?}', 'Master\WarehouseController@changeStatus');
	Route::get('delete-warehouse/{id}', 'Master\WarehouseController@delete_warehouse');
	
	
	//////////// Delivery agent////////////
	
	// listing delivery agent
		Route::get('delivery-agent-list', 'Master\DeliveryAgentController@delivery_agent_list');
		// adding warehouse manager form
		Route::get('add-delivery-agent', [
		'as' => 'add-delivery-agent',
		'uses' => 'Master\DeliveryAgentController@add_delivery_agent'
		]);
		// saving delivery agent data
		Route::any('save-delivery-agent-data', 'Master\DeliveryAgentController@save_delivery_agent_data');
		// updating delivery agent data
		Route::any('delevery-agent-active/{id?}/{value?}', 'Master\DeliveryAgentController@changeStatus');
		// editing delivery agent data
		Route::get('delivery-agent-edit/{id}', 'Master\DeliveryAgentController@delivery_agent_edit');
		// updating delivery agent data
		Route::post('update-delivery-agent-data', 'Master\DeliveryAgentController@update_delivery_agent_data');
		Route::get('delete-delivery-agent/{id}', 'Master\DeliveryAgentController@delete_delivery_agent');
	


//currior or delivery agent web section
	
	Route::any('pickup-order-list', 'po\PoMasterController@purchase_order_list');
});





//Clear Cache facade value:
Route::get('/clear-cache', function () {
	$exitCode = Artisan::call('cache:clear');
	return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
	$exitCode = Artisan::call('optimize');
	return '<h1>Reoptimized class loader</h1>';
});

//Clear Route cache:
Route::get('/route-cache', function () {
	$exitCode = Artisan::call('route:cache');
	return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
	$exitCode = Artisan::call('view:clear');
	return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
	$exitCode = Artisan::call('config:cache');
	return '<h1>Clear Config cleared</h1>';
});
//Clear Config cache:
Route::get('/config-clear', function () {
	$exitCode = Artisan::call('config:clear');
	return '<h1>Clear Config cleared</h1>';
});
//Asset dist
Route::get('/asset-dist', function () {
	$exitCode = Artisan::call('asset:dist');
	return '<h1>Layouts rendered</h1>';
});


//contractor section end //

Auth::routes();

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Log viewer route
Route::get('logs', ['middleware' => ['auth', 'role:Curves'], 'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);

//Data Migration
Route::get('data/migration', ['middleware' => ['auth', 'role:Curves'], 'uses' => 'DataMigrationController@migrate']);
Route::get('data/media/migration', ['middleware' => ['auth', 'role:Curves'], 'uses' => 'DataMigrationController@migrateMedia']);
Route::get('excel/migration', ['middleware' => ['auth', 'role:Curves'], 'uses' => 'DataMigrationController@migrateExcel']);

//Report DATA
Route::get('reportData/members', 'ReportData\MembersController@details');

//API routes
Route::post('api/token', 'Api\AuthenticateController@authenticate');

Route::group(['prefix' => 'api', 'middleware' => ['jwt.auth']], function () {
    Route::get('dashboard', 'Api\DashboardController@index');
    Route::get('members', 'Api\MembersController@index');
    Route::get('subscriptions', 'Api\SubscriptionsController@index');
    Route::get('payments', 'Api\PaymentsController@index');
    Route::get('invoices', 'Api\InvoicesController@index');
    Route::get('invoices/paid', 'Api\InvoicesController@paid');
    Route::get('invoices/unpaid', 'Api\InvoicesController@unpaid');
    Route::get('invoices/partial', 'Api\InvoicesController@partial');
    Route::get('invoices/overpaid', 'Api\InvoicesController@overpaid');
    Route::get('inquiries', 'Api\InquiriesController@index');
    Route::get('settings', 'Api\SettingsController@index');
    Route::get('plans', 'Api\PlansController@index');
    Route::get('subscriptions/expiring', 'Api\SubscriptionsController@expiring');
    Route::get('subscriptions/expired', 'Api\SubscriptionsController@expired');
    Route::get('members/{id}', 'Api\MembersController@show');
    Route::get('subscriptions/{id}', 'Api\SubscriptionsController@show');
    Route::get('payments/{id}', 'Api\PaymentsController@show');
    Route::get('invoices/{id}', 'Api\InvoicesController@show');
    Route::get('inquiries/{id}', 'Api\InquiriesController@show');
    Route::get('plans/{id}', 'Api\PlansController@show');
});

//Auth routes
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
});

//dashboard
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index');
});

//MembersController
Route::group(['prefix' => 'members', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-curves|manage-members|view-member'], 'uses' => 'MembersController@index']);
    Route::get('all', ['middleware' => ['permission:manage-curves|manage-members|view-member'], 'uses' => 'MembersController@index']);
    Route::get('active', ['middleware' => ['permission:manage-curves|manage-members|view-member'], 'uses' => 'MembersController@active']);
    Route::get('inactive', ['middleware' => ['permission:manage-curves|manage-members|view-member'], 'uses' => 'MembersController@inactive']);
    Route::get('create', ['middleware' => ['permission:manage-curves|manage-members|add-member'], 'uses' => 'MembersController@create']);
    Route::post('/', ['middleware' => ['permission:manage-curves|manage-members|add-member'], 'uses' => 'MembersController@store']);
    Route::get('{id}/show', ['middleware' => ['permission:manage-curves|manage-members|view-member'], 'uses' => 'MembersController@show']);
    Route::get('{id}/edit', ['middleware' => ['permission:manage-curves|manage-members|edit-member'], 'uses' => 'MembersController@edit']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-curves|manage-members|edit-member'], 'uses' => 'MembersController@update']);
    Route::post('{id}/archive', ['middleware' => ['permission:manage-curves|manage-members|delete-member'], 'uses' => 'MembersController@archive']);
    Route::get('{id}/transfer', ['middleware' => ['permission:manage-curves|manage-inquiries|transfer-inquiry'], 'uses' => 'MembersController@transfer']);
});

//ReportsController
Route::group(['prefix' => 'reports', 'middleware' => ['auth']], function () {
    Route::get('members/charts', ['middleware' => ['permission:manage-curves|manage-reports|view-report'], 'uses' => 'ReportsController@gymMemberCharts']);
    Route::get('members/data', ['middleware' => ['permission:manage-curves|manage-reports|view-report'], 'uses' => 'ReportsController@gymMemberData']);
    Route::get('inquiries/charts', ['middleware' => ['permission:manage-curves|manage-reports|view-report'], 'uses' => 'ReportsController@inquiryCharts']);
    Route::get('inquiries/data', ['middleware' => ['permission:manage-curves|manage-reports|view-report'], 'uses' => 'ReportsController@inquiryData']);
    Route::get('subscriptions/charts', ['middleware' => ['permission:manage-curves|manage-reports|view-report'], 'uses' => 'ReportsController@subscriptionCharts']);
    Route::get('subscriptions/data', ['middleware' => ['permission:manage-curves|manage-reports|view-report'], 'uses' => 'ReportsController@subscriptionData']);
    Route::get('payments/charts', ['middleware' => ['permission:manage-curves|manage-reports|view-report'], 'uses' => 'ReportsController@paymentCharts']);
    Route::get('payments/data', ['middleware' => ['permission:manage-curves|manage-reports|view-report'], 'uses' => 'ReportsController@paymentData']);
    Route::get('invoices/charts', ['middleware' => ['permission:manage-curves|manage-reports|view-report'], 'uses' => 'ReportsController@invoiceCharts']);
    Route::get('invoices/data', ['middleware' => ['permission:manage-curves|manage-reports|view-report'], 'uses' => 'ReportsController@invoiceData']);
});

//inquiries
Route::group(['prefix' => 'inquiries', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-curves|manage-inquiries|view-inquiry'], 'uses' => 'InquiriesController@index']);
    Route::get('all', ['middleware' => ['permission:manage-curves|manage-inquiries|view-inquiry'], 'uses' => 'InquiriesController@index']);
    Route::get('create', ['middleware' => ['permission:manage-curves|manage-inquiries|add-inquiry'], 'uses' => 'InquiriesController@create']);
    Route::post('/', ['middleware' => ['permission:manage-curves|manage-inquiries|add-inquiry'], 'uses' => 'InquiriesController@store']);
    Route::get('{id}/show', ['middleware' => ['permission:manage-curves|manage-inquiries|view-inquiry'], 'uses' => 'InquiriesController@show']);
    Route::post('{id}/lost', ['middleware' => ['permission:manage-curves|manage-inquiries|view-inquiry'], 'uses' => 'InquiriesController@lost']);
    Route::post('{id}/markMember', ['middleware' => ['permission:manage-curves|manage-inquiries|view-inquiry'], 'uses' => 'InquiriesController@markMember']);
    Route::get('{id}/edit', ['middleware' => ['permission:manage-curves|manage-inquiries|edit-inquiry'], 'uses' => 'InquiriesController@edit']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-curves|manage-inquiries|edit-inquiry'], 'uses' => 'InquiriesController@update']);
});

//followups
Route::group(['prefix' => 'inquiry', 'middleware' => ['auth']], function () {
    Route::post('followups', ['middleware' => ['permission:manage-curves|manage-inquiries|add-inquiry-followup'], 'uses' => 'FollowupsController@store']);
    Route::post('followups/{id}/update', ['middleware' => ['permission:manage-curves|manage-inquiries|edit-inquiry-followup'], 'uses' => 'FollowupsController@update']);
});

//plans
Route::group(['prefix' => 'plans', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-curves|manage-plans|view-plan'], 'uses' => 'PlansController@index']);
    Route::get('all', ['middleware' => ['permission:manage-curves|manage-plans|view-plan'], 'uses' => 'PlansController@index']);
    Route::get('show', ['middleware' => ['permission:manage-curves|manage-plans|view-plan'], 'uses' => 'PlansController@show']);
    Route::get('create', ['middleware' => ['permission:manage-curves|manage-plans|add-plan'], 'uses' => 'PlansController@create']);
    Route::post('/', ['middleware' => ['permission:manage-curves|manage-plans|add-plan'], 'uses' => 'PlansController@store']);
    Route::get('{id}/edit', ['middleware' => ['permission:manage-curves|manage-plans|edit-plan'], 'uses' => 'PlansController@edit']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-curves|manage-plans|edit-plan'], 'uses' => 'PlansController@update']);
    Route::post('{id}/archive', ['middleware' => ['permission:manage-curves|manage-plans|delete-plan'], 'uses' => 'PlansController@archive']);
    Route::get('/services', ['middleware' => ['permission:manage-curves|manage-services|view-service'], 'uses' => 'ServicesController@index']);
    Route::get('services/all', ['middleware' => ['permission:manage-curves|manage-services|view-service'], 'uses' => 'ServicesController@index']);
    Route::get('services/create', ['middleware' => ['permission:manage-curves|manage-services|add-service'], 'uses' => 'ServicesController@create']);
    Route::post('/services', ['middleware' => ['permission:manage-curves|manage-services|add-service'], 'uses' => 'ServicesController@store']);
    Route::get('services/{id}/edit', ['middleware' => ['permission:manage-curves|manage-services|edit-service'], 'uses' => 'ServicesController@edit']);
    Route::post('services/{id}/update', ['middleware' => ['permission:manage-curves|manage-services|edit-service'], 'uses' => 'ServicesController@update']);
    Route::post('services/{id}/delete', ['middleware' => ['permission:manage-curves|manage-services|delete-service'], 'uses' => 'ServicesController@delete']);
});

//services
// Route::group(['prefix' => 'services','middleware' => ['auth']], function() {
// 	Route::get('/',['middleware' => ['permission:manage-curves|manage-services|view-service'],'uses' => 'ServicesController@index']);
// 	Route::get('all',['middleware' => ['permission:manage-curves|manage-services|view-service'],'uses' => 'ServicesController@index']);
// 	Route::get('create',['middleware' => ['permission:manage-curves|manage-services|add-service'],'uses' => 'ServicesController@create']);
// 	Route::post('/',['middleware' => ['permission:manage-curves|manage-services|add-service'],'uses' => 'ServicesController@store']);
// 	Route::get('{id}/edit',['middleware' => ['permission:manage-curves|manage-services|edit-service'],'uses' => 'ServicesController@edit']);
// 	Route::post('{id}/update',['middleware' => ['permission:manage-curves|manage-services|edit-service'],'uses' => 'ServicesController@update']);
// });

//subsciptions
Route::group(['prefix' => 'subscriptions', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-curves|manage-subscriptions|view-subscription'], 'uses' => 'SubscriptionsController@index']);
    Route::get('all', ['middleware' => ['permission:manage-curves|manage-subscriptions|view-subscription'], 'uses' => 'SubscriptionsController@index']);
    Route::get('expiring', ['middleware' => ['permission:manage-curves|manage-subscriptions|view-subscription'], 'uses' => 'SubscriptionsController@expiring']);
    Route::get('expired', ['middleware' => ['permission:manage-curves|manage-subscriptions|view-subscription'], 'uses' => 'SubscriptionsController@expired']);
    Route::get('create', ['middleware' => ['permission:manage-curves|manage-subscriptions|add-subscription'], 'uses' => 'SubscriptionsController@create']);
    Route::post('/', ['middleware' => ['permission:manage-curves|manage-subscriptions|add-subscription'], 'uses' => 'SubscriptionsController@store']);
    Route::get('{id}/show', ['middleware' => ['permission:manage-curves|manage-subscriptions|view-subscription'], 'uses' => 'SubscriptionsController@show']);
    Route::get('{id}/edit', ['middleware' => ['permission:manage-curves|manage-subscriptions|edit-subscription'], 'uses' => 'SubscriptionsController@edit']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-curves|manage-subscriptions|edit-subscription'], 'uses' => 'SubscriptionsController@update']);
    Route::get('{id}/change', ['middleware' => ['permission:manage-curves|manage-subscriptions|change-subscription'], 'uses' => 'SubscriptionsController@change']);
    Route::post('{id}/modify', ['middleware' => ['permission:manage-curves|manage-subscriptions|change-subscription'], 'uses' => 'SubscriptionsController@modify']);
    Route::get('{id}/renew', ['middleware' => ['permission:manage-curves|manage-subscriptions|renew-subscription'], 'uses' => 'SubscriptionsController@renew']);
    Route::post('{id}/cancelSubscription', ['middleware' => ['permission:manage-curves|manage-subscriptions|cancel-subscription'], 'uses' => 'SubscriptionsController@cancelSubscription']);
    Route::post('{id}/delete', ['middleware' => ['permission:manage-curves|manage-subscriptions|delete-subscription'], 'uses' => 'SubscriptionsController@delete']);
});

//invoices
Route::group(['prefix' => 'invoices', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-curves|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@index']);
    Route::get('all', ['middleware' => ['permission:manage-curves|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@index']);
    Route::get('paid', ['middleware' => ['permission:manage-curves|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@paid']);
    Route::get('unpaid', ['middleware' => ['permission:manage-curves|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@unpaid']);
    Route::get('partial', ['middleware' => ['permission:manage-curves|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@partial']);
    Route::get('overpaid', ['middleware' => ['permission:manage-curves|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@overpaid']);
    Route::get('{id}/show', ['middleware' => ['permission:manage-curves|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@show']);
    Route::get('{id}/payment', ['middleware' => ['permission:manage-curves|manage-invoices|add-payment'], 'uses' => 'InvoicesController@createPayment']);
    Route::post('{id}/delete', ['middleware' => ['permission:manage-curves|manage-invoices|delete-invoice'], 'uses' => 'InvoicesController@delete']);
    Route::get('{id}/discount', ['middleware' => ['permission:manage-curves|manage-invoices|add-discount'], 'uses' => 'InvoicesController@discount']);
    Route::post('{id}/applyDiscount', ['middleware' => ['permission:manage-curves|manage-invoices|add-discount'], 'uses' => 'InvoicesController@applyDiscount']);
});

//payments
Route::group(['prefix' => 'payments', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-curves|manage-payments|view-payment'], 'uses' => 'PaymentsController@index']);
    Route::get('all', ['middleware' => ['permission:manage-curves|manage-payments|view-payment'], 'uses' => 'PaymentsController@index']);
    Route::get('show', ['middleware' => ['permission:manage-curves|manage-payments|view-payment'], 'uses' => 'PaymentsController@show']);
    Route::get('create', ['middleware' => ['permission:manage-curves|manage-payments|add-payment'], 'uses' => 'PaymentsController@create']);
    Route::post('/', ['middleware' => ['permission:manage-curves|manage-payments|add-payment'], 'uses' => 'PaymentsController@store']);
    Route::get('{id}/edit', ['middleware' => ['permission:manage-curves|manage-payments|edit-payment'], 'uses' => 'PaymentsController@edit']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-curves|manage-payments|edit-payment'], 'uses' => 'PaymentsController@update']);
    Route::post('{id}/delete', ['middleware' => ['permission:manage-curves|manage-payments|delete-payment'], 'uses' => 'PaymentsController@delete']);
});

//settings
Route::group(['prefix' => 'settings', 'middleware' => ['permission:manage-curves|manage-settings', 'auth']], function () {
    Route::get('/', 'SettingsController@show');
    Route::get('edit', 'SettingsController@edit');
    Route::post('save', 'SettingsController@save');
});

//User Module with roles & permissions
Route::group(['prefix' => 'user', 'middleware' => ['permission:manage-curves|manage-users', 'auth']], function () {
    //User
    Route::get('/', 'AclController@userIndex');
    Route::get('create', 'AclController@createUser');
    Route::post('/', 'AclController@storeUser');
    Route::get('{id}/edit', 'AclController@editUser');
    Route::post('{id}/update', 'AclController@updateUser');
    Route::post('{id}/delete', 'AclController@deleteUser');
});

Route::group(['prefix' => 'user/role', 'middleware' => ['permission:manage-curves|manage-users', 'auth']], function () {
    //Roles
    Route::get('/', 'AclController@roleIndex');
    Route::get('create', 'AclController@createRole');
    Route::post('/', 'AclController@storeRole');
    Route::get('{id}/edit', 'AclController@editRole');
    Route::post('{id}/update', 'AclController@updateRole');
    Route::post('{id}/delete', 'AclController@deleteRole');
});

Route::group(['prefix' => 'user/permission', 'middleware' => ['auth', 'role:Curves']], function () {
    //Permissions
    Route::get('/', 'AclController@permissionIndex');
    Route::get('create', 'AclController@createPermission');
    Route::post('/', 'AclController@storePermission');
    Route::get('{id}/edit', 'AclController@editPermission');
    Route::post('{id}/update', 'AclController@updatePermission');
    Route::post('{id}/delete', 'AclController@deletePermission');
});

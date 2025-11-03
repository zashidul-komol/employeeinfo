<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    //Route::get('/', 'HomeController@contactDirectories')->name('contactdirectories');
    Route::get('/home', 'HomeController@index');
    //Route::get('/home', 'HomeController@contactDirectories');

    Route::get('dashboard/Job-crud', [
        'as' => 'dashboards.Job-crud',
        'uses' => 'HomeController@store',
    ]);
    Route::get('dashboard/updateEmployee', [
        'as' => 'dashboards.index',
        'uses' => 'HomeController@index',
    ]);
    Route::get('dashboard/contactDirectories', [
        'as' => 'dashboards.contactdirectories',
        'uses' => 'HomeController@contactDirectories',
    ]);
    Route::any('dashboard/BmParticipation/', [
        'as' => 'dashboards.bmparticipation',
        'uses' => 'HomeController@BmParticipation',
    ]);

    Route::get('dashboard/ParticipantList', [
        'as' => 'dashboards.participantlist',
        'uses' => 'HomeController@participantlist',
    ]);

    Route::match(array('GET', 'POST'), 'update-bmparticipant-entry', [
        'as' => 'bmparticipant.updateBMparticipant',
        'uses' => 'HomeController@updateBMparticipant',
    ]);

    Route::match(array('GET', 'POST'), 'room-key-delivery', [
        'as' => 'bmparticipant.roomKeyDelivery',
        'uses' => 'HomeController@roomKeyDelivery',
    ]);


    //Route::get('dashboards', 'HomeController@index');


    Route::post('example', 'HomeController@example')->name('example');

    // start for template all page , it should be remove for production
    Route::get('pages/{name}', 'HomeController@pages')->name('template');
    // end for template all page , it should be remove for production

    /* =====================Ajax Route Start================== */

    Route::get('get-item-details', 'AjaxController@getItemDetailsBySeraial')->name('ajax.items.getItemDetailsBySeraial');
    Route::get('get-bm-details', 'AjaxController@getBMParticipantDetails')->name('ajax.bm.getBMParticipantDetails');

    Route::get('get-key-delivery', 'AjaxController@getBMKeyDelivery')->name('ajax.key.getBMKeyDelivery');

    Route::post('get-district', 'AjaxController@getDistricts');
    Route::post('get-thanas', 'AjaxController@getThanas');
    Route::post('get-areas', 'AjaxController@getAreas');
    Route::get('stage-action-oparation/{id}/{functionName}/{stage}/{module?}', 'AjaxController@stageActionOparation')->name('ajax.stage.action');
    Route::post('stage-action-oparation-save/{module?}', 'AjaxController@saveStageAction')->name('ajax.stage.saveAction');

    Route::post('get-multi-district', 'AjaxController@getMultiDistricts')->name('ajax.getMultiDistricts');
    Route::post('get-multi-thana', 'AjaxController@getMultiThanas')->name('ajax.getMultiThanas');
    Route::post('get-multi-distributor', 'AjaxController@getMultiDistributor')->name('ajax.getMultiDistributor');
    Route::post('get-region-wise-depots', 'AjaxController@getRegionWiseDepots')->name('ajax.getRegionWiseDepots');
    Route::post('get-depot-codes', 'AjaxController@getDepotCodes')->name('ajax.getDepotCodes');

    Route::get('settlements-ajax/{param}/continue-list', 'AjaxController@continueList')->name('ajax.settlements.continueList');
    Route::get('settlements-ajax/{param}/closed-list', 'AjaxController@closedList')->name('ajax.settlements.closedList');

    Route::post('get-multi-technician', 'AjaxController@getMultiTechnician')->name('ajax.getMultiTechnician');
    Route::post('profile-picture-upload', 'AjaxController@uploadProfilePicture')->name('ajax.uploadProfilePicture');
    //Route::get('get-sms-promotionals/{param?}', 'AjaxController@getPromotionalSmsWithPaginate')->name('ajax.smsPromotionals.get');
    Route::get('get-distributors', 'AjaxController@getDistributorsWithPaginate')->name('ajax.distributor.get');
    /* =====================Ajax route End==================== */
});

Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();

Route::group(['middleware' => ['auth', 'auth.access']], function () {

    Route::resource('site_settings', 'SiteSettingsController',
        ['only' => ['edit', 'update']]);
    Route::resource('roles', 'RolesController', ['except' => 'show']);

    /*==============User start here==============*/
    Route::get('/users', 'Auth\RegisterController@showUserLists')->name('users.index');
    Route::get('/users/profile/{params?}', 'Auth\RegisterController@showUser')->name('users.show');
    Route::get('/users/{user}/edit', 'Auth\RegisterController@editUser')->name('users.edit');
    Route::put('/users/{user}', 'Auth\RegisterController@updateUser')->name('users.update');
    Route::delete('/users/{user}', 'Auth\RegisterController@destroyUser')->name('users.destroy');
    Route::any('/password/change-user-password/{user}', 'Auth\RegisterController@changeUserPassword')->name('password.changeUserPassword');
    Route::any('/password/change', 'Auth\RegisterController@changePassword')->name('password.change');
    Route::get('/users/list/download', 'Auth\RegisterController@download')->name('users.download');

    /*==============User start here==============*/

    /*==============location start here==============*/
    Route::get('locations/{param?}', [
        'as' => 'locations.index',
        'uses' => 'LocationsController@index',
    ]);
    Route::get('locations/create/{param?}', [
        'as' => 'locations.create',
        'uses' => 'LocationsController@create',
    ]);
    Route::get('locations/{location}/edit/{param?}', [
        'as' => 'locations.edit',
        'uses' => 'LocationsController@edit',
    ]);

    Route::get("locations/download/{param}", array(
        'uses' => 'LocationsController@Download',
        'as' => 'locations.download',
    ));
    Route::resource('locations', 'LocationsController',
        ['except' => ['index', 'show', 'create', 'edit']]);

    /*==========location end here=============*/

    /*==============zone start here=============*/
    Route::get('zones/{param?}', [
        'as' => 'zones.index',
        'uses' => 'ZonesController@index',
    ]);
    Route::get('zones/create/{param?}', [
        'as' => 'zones.create',
        'uses' => 'ZonesController@create',
    ]);
    Route::get('zones/{zone}/edit/{param?}', [
        'as' => 'zones.edit',
        'uses' => 'ZonesController@edit',
    ]);

    Route::get("zones/download/{param}", array(
        'uses' => 'ZonesController@Download',
        'as' => 'zones.download',
    ));
    Route::resource('zones', 'ZonesController',
        ['except' => ['index', 'show', 'create', 'edit']]);
    /*============zone end here========================*/

    Route::get('brands/download', [
        'as' => 'brands.download',
        'uses' => 'BrandsController@download',
    ]);
    Route::resource('brands', 'BrandsController',
        ['except' => ['show']]);

    Route::get('sizes/download', [
        'as' => 'sizes.download',
        'uses' => 'SizesController@download',
    ]);
    Route::resource('sizes', 'SizesController',
        ['except' => ['show']]);

    Route::get('damage_types/download', [
        'as' => 'damage_types.download',
        'uses' => 'DamageTypesController@download',
    ]);
    Route::resource('damage_types', 'DamageTypesController',
        ['except' => ['show']]);

    Route::match(['get', 'put'], "depots/hold-df-qty", array(
        'uses' => 'DepotsController@holdDFQty',
        'as' => 'depots.holdDFQty',
    ));
    Route::get("depots/download", array(
        'uses' => 'DepotsController@Download',
        'as' => 'depots.download',
    ));
    Route::resource('depots', 'DepotsController',
        ['except' => ['show']]);

    /*============designations start here========================*/
    Route::any('designations-sorting', [
        'as' => 'designations.sort',
        'uses' => 'DesignationsController@sort',
    ]);
    Route::get('designations/download', [
        'as' => 'designations.download',
        'uses' => 'DesignationsController@download',
    ]);
    Route::resource('designations', 'DesignationsController',
        ['except' => ['show']]);
    /*============designations end here========================*/

    /*============departments start here========================*/
    Route::resource('departments', 'DepartmentsController',
        ['except' => ['show']]);

    Route::get('departments/download', [
        'as' => 'departments.download',
        'uses' => 'DepartmentsController@download',
    ]);
    
    /*============departments end here========================*/

    /*============Office locations start here========================*/
    Route::resource('officelocations', 'OfficeLocationsController',
        ['except' => ['show']]);

    Route::get('officelocations/download', [
        'as' => 'officelocations.download',
        'uses' => 'OfficeLocationsController@download',
    ]);

    /*============Office locations end here========================*/

    /*============Region start here========================*/
    Route::resource('regions', 'RegionsController',
        ['except' => ['show']]);

    Route::get('regions/download', [
        'as' => 'regions.download',
        'uses' => 'RegionsController@download',
    ]);

    /*============Region end here========================*/

    /*============Company/Organization start here========================*/
    Route::resource('organizations', 'OrganizationsController',
        ['except' => ['show']]);
    
    Route::get('organizations/download', [
        'as' => 'organizations.download',
        'uses' => 'OrganizationsController@download',
    ]);
    
    /*============Company/Organization end here========================*/

    /*
    ============staging start here========================
    */
    Route::get('stages/{modules}', [
        'as' => 'stages.index',
        'uses' => 'StagingsController@index',
    ]);
    Route::get('stages/{modules}/create', [
        'as' => 'stages.create',
        'uses' => 'StagingsController@create',
    ]);
    Route::post('stages/{modules}', [
        'as' => 'stages.store',
        'uses' => 'StagingsController@store',
    ]);
    Route::get('stages/{modules}/edit/{stage}', [
        'as' => 'stages.edit',
        'uses' => 'StagingsController@edit',
    ]);
    Route::put('stages/{modules}/{stage}', [
        'as' => 'stages.update',
        'uses' => 'StagingsController@update',
    ]);
    Route::delete('stages/{modules}/{stages}', [
        'as' => 'stages.destroy',
        'uses' => 'StagingsController@destroy',
    ]);
    Route::delete('stage-untag/{modules}/{stageDetail}/{stage}', [
        'as' => 'stage.details.untag',
        'uses' => 'StagingsController@untag',
    ]);

    Route::any('stage-sorting/{modules}', [
        'as' => 'stages.sort',
        'uses' => 'StagingsController@sort',
    ]);
    /*
    ============staging end here========================
     */
    /*
    ============sms start here========================
     */
    
    Route::get('sms', [
        'as' => 'sms.index',
        'uses' => 'SmsController@index',
    ]);

    Route::match(['get', 'put'], "sms/{params}/edit", array(
        'as' => 'sms.edit',
        'uses' => 'SmsController@edit',
    ));
    
    /*
    ============sms end here========================
     */
    /*
    ============ Uploads start here=============
     */
    Route::any('uploads/shops/{distributor?}', [
        'as' => 'uploads.shops',
        'uses' => 'UploadsController@shops',
    ]);
    Route::any('uploads/inventory', [
        'as' => 'uploads.inventory',
        'uses' => 'UploadsController@generateInventory',
    ]);

    /*
    ============ Uploads end here=============
     */

    /*
    ============ Settlement start here=============
     */
    Route::get('settlements/{param}/continue-list', [
        'as' => 'settlements.continueList',
        'uses' => 'SettlementsController@continueSettlementList',
    ]);
    Route::get('settlements/{param}/closed-list', [
        'as' => 'settlements.closedList',
        'uses' => 'SettlementsController@closedSettlementList',
    ]);

    Route::post('settlements/pay-to-outlet', [
        'as' => 'settlements.payToOutlet',
        'uses' => 'SettlementsController@payToOutlet',
    ]);

    Route::get('settlements/download-money-receipt/{id}', [
        'as' => 'settlements.downloadMoneyReceipt',
        'uses' => 'SettlementsController@downloadMoneyReceipt',
    ]);
    /*
    ============ Settlement end here=============
     */

    /*
    ============ Promotional SMS start here=============

    
     
    */
    Route::post('sms_promotionals/create/{param}', [
        'as' => 'smsPromotionals.create',
        'uses' => 'SmsPromotionalsController@create',
    ]);
    Route::get('sms_promotionals/sendSms/{param}', [
        'as' => 'smsPromotionals.send',
        'uses' => 'SmsPromotionalsController@send',
    ]);
    /*
    Route::get('sms-promotionals/{group}', [
        'as' => 'smsPromotionals.index',
        'uses' => 'SmsPromotionalsController@index',
    ]);
    
    Route::match(['GET', 'POST'], 'sms-promotionals/{group}/send', [
        'as' => 'smsPromotionals.send',
        'uses' => 'SmsPromotionalsController@send',
    ]);
    Route::match(['GET', 'POST'], 'sms-promotionals/{id}/re-send', [
        'as' => 'smsPromotionals.reSend',
        'uses' => 'SmsPromotionalsController@reSend',
    ]);
    */
    /*
    ============ Promotional SMS end here=============
     */
    


    //====distributor start here=====

    Route::get('distributor/download', [
        'as' => 'distributor.download',
        'uses' => 'DistributorsController@download',
    ]);

    Route::get('distributor/shops/{param}', [
        'as' => 'distributor.shops',
        'uses' => 'DistributorsController@distributorShopList',
    ]);

    Route::any('distributors-profile', [
        'as' => 'distributors.showProfile',
        'uses' => 'DistributorsController@showProfile',
    ]);

    Route::resource('distributors', 'DistributorsController',
        ['except' => ['show']]);

    //====distributor start here=====

});
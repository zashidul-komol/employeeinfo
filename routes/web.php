<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\ZonesController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\DamageTypesController;
use App\Http\Controllers\DepotsController;
use App\Http\Controllers\DesignationsController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\OfficeLocationsController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\StagingsController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\UploadsController;
use App\Http\Controllers\SettlementsController;
use App\Http\Controllers\SmsPromotionalsController;
use App\Http\Controllers\DistributorsController;

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
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    //Route::get('/', [HomeController::class, 'contactDirectories'])->name('contactdirectories');
    Route::get('/home', [HomeController::class, 'index']);
    //Route::get('/home', [HomeController::class, 'contactDirectories']);

    Route::get('dashboard/Job-crud', [HomeController::class, 'store'])->name('dashboards.Job-crud');
    Route::get('dashboard/updateEmployee', [HomeController::class, 'index'])->name('dashboards.index');
    Route::get('dashboard/contactDirectories', [HomeController::class, 'contactDirectories'])->name('dashboards.contactdirectories');
    Route::any('dashboard/BmParticipation/', [HomeController::class, 'BmParticipation'])->name('dashboards.bmparticipation');

    Route::get('dashboard/ParticipantList', [HomeController::class, 'participantlist'])->name('dashboards.participantlist');

    Route::match(['GET', 'POST'], 'update-bmparticipant-entry', [HomeController::class, 'updateBMparticipant'])->name('bmparticipant.updateBMparticipant');

    Route::match(['GET', 'POST'], 'room-key-delivery', [HomeController::class, 'roomKeyDelivery'])->name('bmparticipant.roomKeyDelivery');

    //Route::get('dashboards', [HomeController::class, 'index']);

    Route::post('example', [HomeController::class, 'example'])->name('example');

    // start for template all page , it should be remove for production
    Route::get('pages/{name}', [HomeController::class, 'pages'])->name('template');
    // end for template all page , it should be remove for production

    /* =====================Ajax Route Start================== */

    Route::get('get-item-details', [AjaxController::class, 'getItemDetailsBySeraial'])->name('ajax.items.getItemDetailsBySeraial');
    Route::get('get-bm-details', [AjaxController::class, 'getBMParticipantDetails'])->name('ajax.bm.getBMParticipantDetails');

    Route::get('get-key-delivery', [AjaxController::class, 'getBMKeyDelivery'])->name('ajax.key.getBMKeyDelivery');

    Route::post('get-district', [AjaxController::class, 'getDistricts']);
    Route::post('get-thanas', [AjaxController::class, 'getThanas']);
    Route::post('get-areas', [AjaxController::class, 'getAreas']);
    Route::get('stage-action-oparation/{id}/{functionName}/{stage}/{module?}', [AjaxController::class, 'stageActionOparation'])->name('ajax.stage.action');
    Route::post('stage-action-oparation-save/{module?}', [AjaxController::class, 'saveStageAction'])->name('ajax.stage.saveAction');

    Route::post('get-multi-district', [AjaxController::class, 'getMultiDistricts'])->name('ajax.getMultiDistricts');
    Route::post('get-multi-thana', [AjaxController::class, 'getMultiThanas'])->name('ajax.getMultiThanas');
    Route::post('get-multi-distributor', [AjaxController::class, 'getMultiDistributor'])->name('ajax.getMultiDistributor');
    Route::post('get-region-wise-depots', [AjaxController::class, 'getRegionWiseDepots'])->name('ajax.getRegionWiseDepots');
    Route::post('get-depot-codes', [AjaxController::class, 'getDepotCodes'])->name('ajax.getDepotCodes');

    Route::get('settlements-ajax/{param}/continue-list', [AjaxController::class, 'continueList'])->name('ajax.settlements.continueList');
    Route::get('settlements-ajax/{param}/closed-list', [AjaxController::class, 'closedList'])->name('ajax.settlements.closedList');

    Route::post('get-multi-technician', [AjaxController::class, 'getMultiTechnician'])->name('ajax.getMultiTechnician');
    Route::post('profile-picture-upload', [AjaxController::class, 'uploadProfilePicture'])->name('ajax.uploadProfilePicture');
    //Route::get('get-sms-promotionals/{param?}', [AjaxController::class, 'getPromotionalSmsWithPaginate'])->name('ajax.smsPromotionals.get');
    Route::get('get-distributors', [AjaxController::class, 'getDistributorsWithPaginate'])->name('ajax.distributor.get');
    /* =====================Ajax route End==================== */
});

Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Auth::routes();

Route::group(['middleware' => ['auth', 'auth.access']], function () {

    Route::resource('site_settings', SiteSettingsController::class)->only(['edit', 'update']);
    Route::resource('roles', RolesController::class)->except(['show']);

    /*==============User start here==============*/
    Route::get('/users', [RegisterController::class, 'showUserLists'])->name('users.index');
    Route::get('/users/profile/{params?}', [RegisterController::class, 'showUser'])->name('users.show');
    Route::get('/users/{user}/edit', [RegisterController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [RegisterController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [RegisterController::class, 'destroyUser'])->name('users.destroy');
    Route::any('/password/change-user-password/{user}', [RegisterController::class, 'changeUserPassword'])->name('password.changeUserPassword');
    Route::any('/password/change', [RegisterController::class, 'changePassword'])->name('password.change');
    Route::get('/users/list/download', [RegisterController::class, 'download'])->name('users.download');

    /*==============User start here==============*/

    /*==============location start here==============*/
    Route::get('locations/{param?}', [LocationsController::class, 'index'])->name('locations.index');
    Route::get('locations/create/{param?}', [LocationsController::class, 'create'])->name('locations.create');
    Route::get('locations/{location}/edit/{param?}', [LocationsController::class, 'edit'])->name('locations.edit');

    Route::get("locations/download/{param}", [LocationsController::class, 'Download'])->name('locations.download');
    Route::resource('locations', LocationsController::class)->except(['index', 'show', 'create', 'edit']);

    /*==========location end here=============*/

    /*==============zone start here=============*/
    Route::get('zones/{param?}', [ZonesController::class, 'index'])->name('zones.index');
    Route::get('zones/create/{param?}', [ZonesController::class, 'create'])->name('zones.create');
    Route::get('zones/{zone}/edit/{param?}', [ZonesController::class, 'edit'])->name('zones.edit');

    Route::get("zones/download/{param}", [ZonesController::class, 'Download'])->name('zones.download');
    Route::resource('zones', ZonesController::class)->except(['index', 'show', 'create', 'edit']);
    /*============zone end here========================*/

    Route::get('brands/download', [BrandsController::class, 'download'])->name('brands.download');
    Route::resource('brands', BrandsController::class)->except(['show']);

    Route::get('sizes/download', [SizesController::class, 'download'])->name('sizes.download');
    Route::resource('sizes', SizesController::class)->except(['show']);

    Route::get('damage_types/download', [DamageTypesController::class, 'download'])->name('damage_types.download');
    Route::resource('damage_types', DamageTypesController::class)->except(['show']);

    Route::match(['get', 'put'], "depots/hold-df-qty", [DepotsController::class, 'holdDFQty'])->name('depots.holdDFQty');
    Route::get("depots/download", [DepotsController::class, 'Download'])->name('depots.download');
    Route::resource('depots', DepotsController::class)->except(['show']);

    /*============designations start here========================*/
    Route::any('designations-sorting', [DesignationsController::class, 'sort'])->name('designations.sort');
    Route::get('designations/download', [DesignationsController::class, 'download'])->name('designations.download');
    Route::resource('designations', DesignationsController::class)->except(['show']);
    /*============designations end here========================*/

    /*============departments start here========================*/
    Route::resource('departments', DepartmentsController::class)->except(['show']);

    Route::get('departments/download', [DepartmentsController::class, 'download'])->name('departments.download');
    
    /*============departments end here========================*/

    /*============Office locations start here========================*/
    Route::resource('officelocations', OfficeLocationsController::class)->except(['show']);

    Route::get('officelocations/download', [OfficeLocationsController::class, 'download'])->name('officelocations.download');

    /*============Office locations end here========================*/

    /*============Region start here========================*/
    Route::resource('regions', RegionsController::class)->except(['show']);

    Route::get('regions/download', [RegionsController::class, 'download'])->name('regions.download');

    /*============Region end here========================*/

    /*============Company/Organization start here========================*/
    Route::resource('organizations', OrganizationsController::class)->except(['show']);
    
    Route::get('organizations/download', [OrganizationsController::class, 'download'])->name('organizations.download');
    
    /*============Company/Organization end here========================*/

    /*
    ============staging start here========================
    */
    Route::get('stages/{modules}', [StagingsController::class, 'index'])->name('stages.index');
    Route::get('stages/{modules}/create', [StagingsController::class, 'create'])->name('stages.create');
    Route::post('stages/{modules}', [StagingsController::class, 'store'])->name('stages.store');
    Route::get('stages/{modules}/edit/{stage}', [StagingsController::class, 'edit'])->name('stages.edit');
    Route::put('stages/{modules}/{stage}', [StagingsController::class, 'update'])->name('stages.update');
    Route::delete('stages/{modules}/{stages}', [StagingsController::class, 'destroy'])->name('stages.destroy');
    Route::delete('stage-untag/{modules}/{stageDetail}/{stage}', [StagingsController::class, 'untag'])->name('stage.details.untag');

    Route::any('stage-sorting/{modules}', [StagingsController::class, 'sort'])->name('stages.sort');
    /*
    ============staging end here========================
     */
    /*
    ============sms start here========================
     */
    
    Route::get('sms', [SmsController::class, 'index'])->name('sms.index');

    Route::match(['get', 'put'], "sms/{params}/edit", [SmsController::class, 'edit'])->name('sms.edit');
    
    /*
    ============sms end here========================
     */
    /*
    ============ Uploads start here=============
     */
    Route::any('uploads/shops/{distributor?}', [UploadsController::class, 'shops'])->name('uploads.shops');
    Route::any('uploads/inventory', [UploadsController::class, 'generateInventory'])->name('uploads.inventory');

    /*
    ============ Uploads end here=============
     */

    /*
    ============ Settlement start here=============
     */
    Route::get('settlements/{param}/continue-list', [SettlementsController::class, 'continueSettlementList'])->name('settlements.continueList');
    Route::get('settlements/{param}/closed-list', [SettlementsController::class, 'closedSettlementList'])->name('settlements.closedList');

    Route::post('settlements/pay-to-outlet', [SettlementsController::class, 'payToOutlet'])->name('settlements.payToOutlet');

    Route::get('settlements/download-money-receipt/{id}', [SettlementsController::class, 'downloadMoneyReceipt'])->name('settlements.downloadMoneyReceipt');
    /*
    ============ Settlement end here=============
     */

    /*
    ============ Promotional SMS start here=============
    */
    Route::post('sms_promotionals/create/{param}', [SmsPromotionalsController::class, 'create'])->name('smsPromotionals.create');
    Route::get('sms_promotionals/sendSms/{param}', [SmsPromotionalsController::class, 'send'])->name('smsPromotionals.send');
    /*
    Route::get('sms-promotionals/{group}', [SmsPromotionalsController::class, 'index'])->name('smsPromotionals.index');
    
    Route::match(['GET', 'POST'], 'sms-promotionals/{group}/send', [SmsPromotionalsController::class, 'send'])->name('smsPromotionals.send');
    Route::match(['GET', 'POST'], 'sms-promotionals/{id}/re-send', [SmsPromotionalsController::class, 'reSend'])->name('smsPromotionals.reSend');
    */
    /*
    ============ Promotional SMS end here=============
     */

    //====distributor start here=====

    Route::get('distributor/download', [DistributorsController::class, 'download'])->name('distributor.download');

    Route::get('distributor/shops/{param}', [DistributorsController::class, 'distributorShopList'])->name('distributor.shops');

    Route::any('distributors-profile', [DistributorsController::class, 'showProfile'])->name('distributors.showProfile');

    Route::resource('distributors', DistributorsController::class)->except(['show']);

    //====distributor start here=====
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\InventoriesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\FamilyDetailsController;
use App\Http\Controllers\ChildDetailsController;
use App\Http\Controllers\JobExperiancesController;
use App\Http\Controllers\RelationshipsController;
use App\Http\Controllers\EmployeeEducationsController;
use App\Http\Controllers\CertificationCoursesController;
use App\Http\Controllers\ProfDegreesController;
use App\Http\Controllers\SiblingDetailsController;

/*====================Ajax part start==============*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('get-stocks', [AjaxController::class, 'getStocks'])->name('ajax.stocks.get');
    Route::get('get-stock-details/{param}', [AjaxController::class, 'getStockDetails'])->name('ajax.stocks.details');
    Route::get('get-allocation-details/{param}', [AjaxController::class, 'getAllocationDetails'])->name('ajax.allocation.details');
    Route::get('allocation-receive/{param}', [AjaxController::class, 'depotStockAccept'])->name('ajax.allocation.receive');
    Route::get('get-allocations', [AjaxController::class, 'getAllocations'])->name('ajax.allocation.index');
    Route::get('get-depot-allocations/{stockId?}', [AjaxController::class, 'getDepotAllocations'])->name('ajax.depotAllocation.index');
    Route::get('get-items/{param}', [AjaxController::class, 'getItems'])->name('ajax.items.index');

    Route::get("stock-transfer-show/{stock_transfer_id}", [AjaxController::class, 'stockTransferShow'])->name('inventories.stockTransferShow');

    Route::get("stock-transfer-edit/{from_depot}/{transfer_id}", [AjaxController::class, 'stockTransferEdit'])->name('inventories.stockTransferEdit');
    
    Route::get("get-df-code-lists", [AjaxController::class, 'dfcodeLists'])->name('ajax.inventories.dfcodeLists');
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::group(['middleware' => ['auth', 'auth.access']], function () {
    Route::resource('suppliers', SuppliersController::class)->except(['show']);

    Route::match(['GET', 'POST'], "stocks/create", [InventoriesController::class, 'stockCreate'])->name('inventories.stockCreate');
    
    Route::get("stock-index/{param?}", [InventoriesController::class, 'stockIndex'])->name('inventories.stockIndex');
    
    Route::match(['GET', 'PUT', 'PATCH'], "stocks/{stocks}/edit", [InventoriesController::class, 'stockEdit'])->name('inventories.stockEdit');
    
    Route::delete("stocks/{stocks}", [InventoriesController::class, 'stockDestroy'])->name('inventories.stockDestroy');
    
    Route::match(['GET', 'POST'], "stocks/{stocks}/stock-allocate", [InventoriesController::class, 'stockAllocate'])->name('inventories.stockAllocate');
    
    Route::get("allocations", [InventoriesController::class, 'allocatedStockIndex'])->name('inventories.allocatedStockIndex');

    Route::match(['GET', 'PUT', 'PATCH'], "allocations/{stocks}/edit", [InventoriesController::class, 'allocatedStockEdit'])->name('inventories.allocatedStockEdit');

    Route::delete("allocations/{stocks}", [InventoriesController::class, 'allocatedStockDelete'])->name('inventories.allocatedStockDelete');

    Route::get("depot/allocations/{stocks?}", [InventoriesController::class, 'depotAllocatedStockIndex'])->name('inventories.depotAllocatedStockIndex');
    
    Route::get("allocation/{stocks}/print", [InventoriesController::class, 'allocationPrint'])->name('inventories.allocationPrint');
    
    Route::post("allocation/{stock}/approve", [InventoriesController::class, 'allocationApprove'])->name('inventories.allocationApprove');
    
    Route::match(['GET', 'POST'], "items/create", [InventoriesController::class, 'allocatedStockReceive'])->name('inventories.allocatedStockReceive');
    
    Route::post("items/input-item-serial", [InventoriesController::class, 'inputItemSerial'])->name('inventories.inputItemSerial');
    
    Route::get("items/{param?}", [InventoriesController::class, 'itemIndex'])->name('inventories.itemIndex');
    
    Route::post("items/return-support-df", [InventoriesController::class, 'returnSupportDf'])->name('inventories.returnSupportDf');
    
    Route::post("item/change-status", [InventoriesController::class, 'changeItemStatus'])->name('inventories.changeItemStatus');
    
    Route::get("item/item-export/{param}", [InventoriesController::class, 'itemExport'])->name('inventories.itemExport');
    
    Route::match(['GET', 'POST'], "stock-transfer/create/{depot?}", [InventoriesController::class, 'stockTransferCreate'])->name('inventories.stockTransferCreate');

    Route::get("stock-transfer-lists", [InventoriesController::class, 'stockTransferLists'])->name('inventories.stockTransferLists');

    Route::post("stock-transfer-receive", [InventoriesController::class, 'stockTransferReceive'])->name('inventories.stockTransferReceive');

    Route::post("stock-transfer-update", [InventoriesController::class, 'stockTransferUpdate'])->name('inventories.stockTransferUpdate');

    Route::match(['GET', 'POST'], "stock-transfer-approve/{transfer_id}", [InventoriesController::class, 'stockTransferApprove'])->name('inventories.stockTransferApprove');

    Route::post("stock-transfer-cancel", [InventoriesController::class, 'stockTransferCancel'])->name('inventories.stockTransferCancel');

    Route::get("stock-transfer-chanal/{transfer_id}", [InventoriesController::class, 'StockTransferChalan'])->name('inventories.getStockTransferChalan');

    Route::match(['POST', 'GET'], 'generate/df-code', [InventoriesController::class, 'generateDFCode'])->name('inventories.generateDFCode');
    
    Route::match(['POST'], 'download/df-code', [InventoriesController::class, 'downloadDFCode'])->name('inventories.downloadDFCode');

    /*============Employee start here========================*/
    
    Route::get('employee/view_employeeBaten/{param}', [EmployeesController::class, 'viewEmployee'])->name('employee.view_employeeBaten');

    Route::get('employees/download', [EmployeesController::class, 'download'])->name('employees.download');

    Route::get('employees/participantListdownload', [EmployeesController::class, 'participantListdownload'])->name('employees.participantListdownload');

    Route::get('employees/childparticipantListdownload', [EmployeesController::class, 'childparticipantListdownload'])->name('employees.childparticipantListdownload');

    Route::get('employees/familyDetailsdownload', [EmployeesController::class, 'familyDetailsdownload'])->name('employees.familyDetailsdownload');

    Route::get('employees/TotalparticipantList', [EmployeesController::class, 'totalparticipantlist'])->name('employees.totalparticipantlist');

    Route::any('employees/upload', [EmployeesController::class, 'uploadEmployee'])->name('employees.uploads');
    
    Route::any('employee/updateEmployee/{param}', [EmployeesController::class, 'updateEmployee'])->name('employees.updateEmployee');
    
    Route::any('employee/BmParticipation/{param}', [EmployeesController::class, 'BmParticipation'])->name('employees.BmParticipation');

    Route::match(['GET', 'POST'], 'update-bmparticipant-entry', [EmployeesController::class, 'updateBMparticipant'])->name('bmparticipant.updateBMparticipant');

    Route::get('employees/birthday', [EmployeesController::class, 'birthday'])->name('employees.birthday');

    Route::get('employees/transfer_promotion/{param}', [EmployeesController::class, 'transferPromotion'])->name('employees.transfer_promotion');

    Route::get('employees/marriageday', [EmployeesController::class, 'marriageday'])->name('employees.marriageday');

    Route::get('employee/view_employeeDowload/{param}', [EmployeesController::class, 'viewEmployeeDowload'])->name('employees.view_employeeDowload');
    
    Route::resource('employees', EmployeesController::class)->except(['show']);

    /*============Employee end here========================*/

    /*============Family Details start here========================*/

    Route::get('familyDetails/download', [FamilyDetailsController::class, 'download'])->name('familyDetails.download');
    
    Route::any('familyDetails/uploadFamily', [FamilyDetailsController::class, 'uploadFamilyDetails'])->name('familyDetails.uploadsFamily');

    Route::resource('familyDetails', FamilyDetailsController::class)->except(['show']);

    /*============Family Details end here========================*/

    /*============Child Details start here========================*/
    Route::resource('childDetails', ChildDetailsController::class)->except(['show']);

    Route::get('childDetails/download', [ChildDetailsController::class, 'download'])->name('childDetails.download');

    /*============Child Details end here========================*/

    /*============Job Experiance start here========================*/
    Route::resource('jobExperiances', JobExperiancesController::class)->except(['show']);

    Route::get('jobExperiances/download', [JobExperiancesController::class, 'download'])->name('jobExperiances.download');

    /*============Job Experiance end here========================*/

    /*============Relationship start here========================*/
    Route::resource('relationships', RelationshipsController::class)->except(['show']);
    
    Route::get('relationships/download', [RelationshipsController::class, 'download'])->name('relationships.download');
    
    /*============Relationship end here========================*/

    /*============Employee Education start here========================*/
    Route::resource('employeeEducations', EmployeeEducationsController::class)->except(['show']);

    Route::get('employeeEducations/download', [EmployeeEducationsController::class, 'download'])->name('employeeEducations.download');

    /*============Employee Education end here========================*/

    /*============Certification Course start here========================*/
    Route::resource('certificationCourses', CertificationCoursesController::class)->except(['show']);

    Route::get('certificationCourses/download', [CertificationCoursesController::class, 'download'])->name('certificationCourses.download');

    /*============Certification Course end here========================*/

    /*============Professional Degree start here========================*/
    Route::resource('profDegrees', ProfDegreesController::class)->except(['show']);

    Route::get('profDegrees/download', [ProfDegreesController::class, 'download'])->name('profDegrees.download');

    /*============Professional Degree end here========================*/

    /*============Sibling Detail start here========================*/
    Route::resource('siblingDetails', SiblingDetailsController::class)->except(['show']);

    Route::get('siblingDetails/download', [SiblingDetailsController::class, 'download'])->name('siblingDetails.download');

    /*============Sibling Detail end here========================*/
});
/*====================Permission part end==============*/
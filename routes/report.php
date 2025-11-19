<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Report\InventoryReportsController;
use App\Http\Controllers\Report\ServiceReportsController;

Route::group(['prefix' => 'report', 'middleware' => ['auth']], function () {

    Route::any('inventory/{param?}', [InventoryReportsController::class, 'index'])->name('inventoryreports.index');

    Route::any('depot-df-status', [InventoryReportsController::class, 'getDepotDFStatus'])->name('inventoryreports.getDepotDFStatus');

    Route::any('size-wise-df-status/{param?}', [InventoryReportsController::class, 'getSizeWiseDFStatus'])->name('inventoryreports.getSizeWiseDFStatus');

    Route::any('size-wise-distributor-df-status/{param?}', [InventoryReportsController::class, 'getSizeWiseDistributorDFStatus'])->name('inventoryreports.getSizeWiseDistributorDFStatus');

    Route::any('brand-wise-df-status/{param?}', [InventoryReportsController::class, 'getBrandWiseDFStatus'])->name('inventoryreports.getBrandWiseDFStatus');

    Route::any('migration/{year}', [InventoryReportsController::class, 'migration'])->name('inventoryreports.migration');

    //Service Module Start

    Route::any('service', [ServiceReportsController::class, 'index'])->name('servicereports.index');

    Route::any('df-wise-complain/{param?}', [ServiceReportsController::class, 'dfWiseComplain'])->name('servicereports.dfWiseComplain');

    Route::any('size-wise-complain/{param?}', [ServiceReportsController::class, 'sizeWiseComplain'])->name('servicereports.sizeWiseComplain');

    Route::any('type-wise-complain/{param?}', [ServiceReportsController::class, 'typeWiseComplain'])->name('servicereports.typeWiseComplain');

    Route::any('date-wise-complain/{param?}', [ServiceReportsController::class, 'dateWiseComplain'])->name('servicereports.dateWiseComplain');

    Route::any('long-pending-complain', [ServiceReportsController::class, 'longPendingComplain'])->name('servicereports.longPendingComplain');

    Route::any('job-card-complain', [ServiceReportsController::class, 'jobCardComplain'])->name('servicereports.jobCardComplain');

    Route::any('damaged-report-lists', [ServiceReportsController::class, 'damagedLists'])->name('servicereports.damagedLists');

});
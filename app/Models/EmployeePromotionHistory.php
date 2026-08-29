<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeePromotionHistory extends Model
{
    protected $table = 'employee_promotion_histories';

    protected $guarded = ['id'];

    protected $fillable = [
        'employee_id',

        'previous_designation_id',
        'previous_department_id',
        'previous_grade',
        'previous_office_location_id',

        'promotion_type',
        'effective_date',
        'year',

        'new_designation_id',
        'new_department_id',
        'new_grade',
        'previous_reporting_to',
        'new_reporting_to',
        'new_office_location_id',

        'promotion_reason',
        'remarks',
    ];

    public function employee()
    {
        return $this->belongsTo(
            Employee::class,
            'employee_id',
            'id'
        );
    }

     /*
    |--------------------------------------------------------------------------
    | Previous Designation
    |--------------------------------------------------------------------------
    */

    public function previousDesignation()
    {
        return $this->belongsTo(
            Designation::class,
            'previous_designation_id',
            'id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | New Designation
    |--------------------------------------------------------------------------
    */

    public function newDesignation()
    {
        return $this->belongsTo(
            Designation::class,
            'new_designation_id',
            'id'
        );
    }

    public function previousDepartment()
    {
        return $this->belongsTo(
            Department::class,
            'previous_department_id',
            'id'
        );
    }

    public function newDepartment()
    {
        return $this->belongsTo(
            Department::class,
            'new_department_id',
            'id'
        );
    }

    public function previousOfficeLocation()
    {
        return $this->belongsTo(
            OfficeLocation::class,
            'previous_office_location_id',
            'id'
        );
    }

    public function newOfficeLocation()
    {
        return $this->belongsTo(
            OfficeLocation::class,
            'new_office_location_id',
            'id'
        );
    }

    public function previousReportingTo()
    {
        return $this->belongsTo(
            Employee::class,
            'previous_reporting_to',
            'id'
        );
    }

    public function newReportingTo()
    {
        return $this->belongsTo(
            Employee::class,
            'new_reporting_to',
            'id'
        );
    }
}

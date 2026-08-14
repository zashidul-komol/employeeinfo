<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeTransferHistory extends Model
{
    protected $table = 'employee_transfer_histories';

    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(
            Employee::class,
            'employee_id',
            'id'
        );
    }

    public function previous_department()
    {
        return $this->belongsTo(
            Department::class,
            'previous_department_id',
            'id'
        );
    }

    public function new_department()
    {
        return $this->belongsTo(
            Department::class,
            'new_department_id',
            'id'
        );
    }

    public function previous_office_location()
    {
        return $this->belongsTo(
            OfficeLocation::class,
            'previous_office_location_id',
            'id'
        );
    }

    public function new_office_location()
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
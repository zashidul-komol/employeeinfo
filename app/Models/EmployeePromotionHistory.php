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
}

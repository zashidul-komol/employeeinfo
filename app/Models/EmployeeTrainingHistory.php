<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeTrainingHistory extends Model
{
    protected $table = 'employee_training_histories';

    protected $guarded = ['id'];

    protected $fillable = [
        'employee_id',
        'training_name',
        'training_type',
        'training_provider',
        'start_date',
        'end_date',
        'duration',
        'training_location',
        'certificate_path',
        'status',
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
}
<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Organization;
use App\Models\OfficeLocation;
use App\Models\FamilyDetail;
use App\Models\BusinessMeet;
use App\Models\Participation;
use App\Models\Location;
use App\Models\EmployeeEducation;
use App\Models\SiblingDetail;
use App\Models\CertificationCourse;
use App\Models\ChildDetail;
use App\Models\JobExperiance;
use App\Models\ProfDegree;
use App\Models\Region;
use App\Models\Relationship;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $guarded = array('id');

    //public $timestamps = false;
    protected $fillable = ['polar_id',	'name', 'organization_id',	'dept_id',	'desig_id',	'office_loc_id','region_id',	'mobile', 'emergency_contact_person', 'relationship', 'emergency_contact_no', 'nid', 'tin', 'passportno', 'hiredate', 'jobstartdate', 'birthdate', 'highest_education', 'institution',	'grade', 'height_feet', 'height_inch', 'email',	'bloodgroup',	'gender', 'employee_type',	'job_status',	'maritial_status',	'present_address', 'division_id', 'district_id', 'thana_id',	'permanent_address', 'hobby',	'status'];


    public function designation() {
        return $this->belongsTo(Designation::class,'desig_id');
    }

 	public function department() {
        return $this->belongsTo(Department::class,'dept_id');
    }
    public function organization() {
        return $this->belongsTo(Organization::class,'organization_id');
    }

    public function office_location() {
        return $this->belongsTo(OfficeLocation::class, 'office_loc_id');
    }

    public function family_details() {
        return $this->hasOne(FamilyDetail::class);
    }

    public function business_meets() {
        return $this->hasOne(BusinessMeet::class);
    }
    public function participations() {
        return $this->hasOne(Participation::class);
    }
    public function division() {
        return $this->belongsTo(Location::class);
    }

    public function district() {
        return $this->belongsTo(Location::class);
    }

    public function thana() {
        return $this->belongsTo(Location::class);
    }
    public function employee_educations() {
        return $this->hasOne(EmployeeEducation::class);
    }
    public function certification_courses() {
        return $this->hasMany(CertificationCourse::class);
    }
    public function child_details() {
        return $this->hasMany(ChildDetail::class);
    }
    public function job_experiances() {
        return $this->hasMany(JobExperiance::class);
    }
    public function prof_degrees() {
        return $this->hasMany(ProfDegree::class);
    }
    public function sibling_details() {
        return $this->hasMany(SiblingDetail::class);
    }
    public function user() {
        return $this->hasOne(User::class);
    }
    public function regions() {
        return $this->belongsTo(Region::class, 'region_id');
    }
    public function relationships() {
        return $this->hasMany(Relationship::class, 'employee_id');
    }
}




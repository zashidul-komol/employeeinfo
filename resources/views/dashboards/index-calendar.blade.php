@extends('layouts.admin')
@section('content')

<div class="content-header">
    <div class="text-center">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Only Green Color Field is Editable..</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-md-2">
        <!--CONTACT INFO-->
        <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
            <div class="panel-content">
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    
                    @if(auth()->user()->avatar)
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/images/avatar/'.auth()->user()->avatar) }}" alt="User profile picture">
                    @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" />
                    @endif
                    {!! $errors->first('avatar', '<p class="text-danger">:message</p>' ) !!}

                    <h5 class="profile-username text-center">{{$employees->name or ''}}</h5>

                    <p class="text-muted text-center">{{$employees->designation->title or ''}}</p>

                  </div>
            <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    {{ Form::model($employees,array('route' => array('employees.updateEmployee',$employees->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
    <div class="col-sm-5">
        <h4 class="section-subtitle"><b>Employee Information</b></h4>
        
        <div class="panel">
            <div class="panel-content">
                
              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Full Name</label>
                          <div class="col-sm-9">
                            {{Form::text('name',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Company Name</label>
                          <div class="col-sm-9">
                            {{Form::text('name',$employees->organization->organization,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">Department</label>
                            <div class="col-xs-9">
                                {{Form::text('name',$employees->department->name,array('class' => 'form-control', 'readonly' => 'true'))}}
                                {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                        <div class="form-group">                          
                          <label for="inputName" class="col-sm-3 ">Designation</label>
                          <div class="col-xs-9">
                             {{Form::text('title',$employees->designation->title,array('class' => 'form-control', 'readonly' => 'true'))}}
                             {!! $errors->first('title', '<p class="text-danger">:message</p>' ) !!} 
                          </div>
                        </div>
                        <div class="form-group">                          
                          <label for="inputName" class="col-sm-3 ">Current Location</label>
                          <div class="col-xs-9">
                             {{Form::text('name',$employees->office_location->name,array('class' => 'form-control', 'readonly' => 'true'))}}
                             {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!} 
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">ID No.</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                   {{Form::text('polar_id',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('polar_id', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div>                               
                            <label for="inputName" class="col-sm-2 ">Gendar</label>
                            <div class="col-xs-3">
                                <div class="input-group">
                                   {{Form::text('gender',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('gender', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Mobile No.</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                   {{Form::text('mobile',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('mobile', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div>                               
                            <label for="inputName" class="col-sm-2 ">Grade</label>
                            <div class="col-xs-3">
                                <div class="input-group">
                                   {{Form::text('grade',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('grade', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">E-mail</label>
                            <div class="col-xs-9">
                                {{Form::text('email',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                                 {!! $errors->first('email', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">Height</label>
                            <div class="col-xs-3">
                                {{Form::text('height_feet',null,array('class' => 'form-control'))}}
                                 {!! $errors->first('height_feet', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <label for="inputName" class="col-sm-2 ">feet</label>
                            <div class="col-xs-3">
                                <div class="input-group">
                                   {{Form::text('height_inch',null,array('class' => 'form-control'))}}
                              {!! $errors->first('height_inch', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>inch               
                        </div>

                        <div class="form-group">
                          @if($employees->maritial_status == 'Unmarried')
                          <label for="inputName" class="col-sm-3 ">Maritial Status</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                   {{Form::select('maritial_status',[''=>'--Please Select Maritial status--']+['Married'=>'Married', 'Unmarried'=>'Unmarried'],null,array('class' => 'form-control'))}}
                                   {!! $errors->first('maritial_status', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div>
                            @else
                            <label for="inputName" class="col-sm-3 ">Marital Status</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                   {{Form::text('maritial_status',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('maritial_status', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div>
                            @endif                             
                            <label for="inputName" class="col-sm-2 ">Blood Group</label>
                            <div class="col-xs-3">
                                <div class="input-group">
                                   {{Form::text('bloodgroup',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('bloodgroup', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">NID</label>
                            <div class="col-xs-9">
                                {{Form::text('nid',null,array('class' => 'form-control' ,'placeholder'=>'Please insert NID'))}}
                                 {!! $errors->first('nid', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">TIN</label>
                            <div class="col-xs-9">
                                {{Form::text('tin',null,array('class' => 'form-control' ,'placeholder'=>'Please insert TIN No.'))}}
                                 {!! $errors->first('tin', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">Passport No.</label>
                            <div class="col-xs-9">
                                {{Form::text('passportno',null,array('class' => 'form-control' ,'placeholder'=>'Please insert Passport no.'))}}
                                 {!! $errors->first('passportno', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Birth Date</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                   {{Form::text('birthdate',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('birthdate', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div>  
                            <label for="inputName" class="col-sm-2 ">Joining Date</label>
                            <div class="col-xs-3">
                                <div class="input-group">
                                   {{Form::text('hiredate',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('hiredate', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">Age (Till Today)</label>
                            <div class="col-xs-7">
                                {{\Carbon\Carbon::parse($employees->birthdate)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}
                            </div>               
                        </div>
                        <h6 class="section-subtitle"><b>Present Address : </b></h6>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3">Residential Address</label>
                            <div class="col-xs-9">
                                {{Form::text('present_address',null,array('class' => 'form-control max-length','rows' => 2, 'cols' => 2,'maxlength'=>'150'))}}
                                 {!! $errors->first('present_address', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                        <h6 class="section-subtitle"><b>Permanent Address : </b></h6>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Division</label>
                          <div class="col-sm-9">
                            @php
                              $division = '';
                              if(!empty($employees->division)){
                              $division = $employees->division->name;
                            }
                            @endphp
                            {{Form::text('name',$division,array('class' => 'form-control', 'readonly' => 'true'))}}
                            {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">District</label>
                          <div class="col-sm-9">
                            @php
                              $district = '';
                              if(!empty($employees->district)){
                              $district = $employees->district->name;
                            }
                            @endphp
                            {{Form::text('name',$district,array('class' => 'form-control', 'readonly' => 'true'))}}
                            {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                                
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Thana</label>
                          <div class="col-sm-9">
                            @php
                              $thana = '';
                              if(!empty($employees->thana)){
                              $thana = $employees->thana->name;
                            }
                            @endphp
                            {{Form::text('name',$thana,array('class' => 'form-control', 'readonly' => 'true'))}}
                            {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Residential Address</label>
                          <div class="col-sm-9">
                            {{Form::textarea('permanent_address',null,array('class' => 'form-control max-length','rows' => 2, 'cols' => 2,'maxlength'=>'150', 'readonly' => 'true'))}}
                            {!! $errors->first('permanent_address', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        
                       
                 
                  <!-- /.form-horizontal -->
              </div>

              <!-- Blank Page End Here --> 
            </div>
        </div>
    </div>

    <div class="col-sm-5">
        <h4 class="section-subtitle"><b>Family Information</b></h4>
          
        <div class="panel">
            <div class="panel-content">

              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  
                        <div class="form-group">
                          <label for="inputName" class="col-sm-4 ">Father's Name</label>
                          <div class="col-sm-7">
                            @php
                              $fathername = '';
                              if(!empty($employees->family_details)){
                              $fathername = $employees->family_details->father_name;
                            }
                            @endphp
                            {{Form::text('father_name',$fathername, array('class' => 'form-control', 'placeholder'=>"Please insert Father's Name"))}}
                             {!! $errors->first('father_name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4 ">Father's Occupation</label>
                            <div class="col-xs-4">
                              @php
                              $fatherOccupation = '';
                              if(!empty($employees->family_details)){
                              $fatherOccupation = $employees->family_details->father_occupation;
                            }
                            @endphp
                                {{Form::text('father_occupation',$fatherOccupation, array('class' => 'form-control' , 'placeholder'=>"Please insert Fathers Occupation"))}}
                                 {!! $errors->first('father_occupation', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group">
                                  @php
                                    $fatherLiveStatus = '';
                                    if(!empty($employees->family_details)){
                                    $fatherLiveStatus = $employees->family_details->father_live_status;
                                  }
                                  @endphp
                                   {{Form::text('father_live_status',$fatherLiveStatus, array('class' => 'form-control', 'placeholder'=>"Alive Status"))}}
                              {!! $errors->first('father_live_status', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>                
                        </div>
                        <div class="form-group">                          
                          <label for="inputName" class="col-sm-4 ">Mother's Name</label>
                          <div class="col-xs-7">
                            @php
                              $mothername = '';
                              if(!empty($employees->family_details)){
                              $mothername = $employees->family_details->mother_name;
                            }
                            @endphp
                             {{Form::text('mother_name',$mothername,array('class' => 'form-control', 'placeholder'=>"Please insert Mother's Name"))}}
                              {!! $errors->first('mother_name', '<p class="text-danger">:message</p>' ) !!} 
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4 ">Mother's Occupation</label>
                            <div class="col-xs-4">
                              @php
                              $motherOccupation = '';
                              if(!empty($employees->family_details)){
                              $motherOccupation = $employees->family_details->mother_occupation;
                            }
                            @endphp
                                {{Form::text('mother_occupation',$motherOccupation, array('class' => 'form-control', 'placeholder'=>"Please insert Mother's Occupation"))}}
                                 {!! $errors->first('mother_occupation', '<p class="text-danger">:message</p>' ) !!}
                            </div> 
                            <div class="col-xs-3">
                                <div class="input-group">
                                  @php
                                    $motherLiveStatus = '';
                                    if(!empty($employees->family_details)){
                                    $motherLiveStatus = $employees->family_details->mother_live_status;
                                  }
                                  @endphp
                                   {{Form::text('mother_live_status',$motherLiveStatus, array('class' => 'form-control', 'placeholder'=>"Alive Status"))}}
                              {!! $errors->first('mother_live_status', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>               
                        </div>
                        
                        <h6 class="section-subtitle"><b>Sibling's Information</b></h6>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-4 ">Number of Brother</label>
                            <div class="col-xs-2">
                                <div class="input-group">
                                  @php
                                    $brother = '';
                                    if(!empty($employees->family_details)){
                                    $brother = $employees->family_details->no_of_brothers;
                                  }
                                  @endphp
                                   {{Form::text('no_of_brothers',$brother, array('class' => 'form-control'))}}
                              {!! $errors->first('no_of_brothers', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div> 
                           <label for="inputName" class="col-sm-3 ">Your Position</label>
                            <div class="col-xs-2">
                                <div class="input-group">
                                  @php
                                    $brother_position = '';
                                    if(!empty($employees->family_details)){
                                    $brother_position = $employees->family_details->brother_position;
                                  }
                                  @endphp
                                   {{Form::text('brother_position',$brother_position, array('class' => 'form-control'))}}
                              {!! $errors->first('brother_position', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-4 ">Number of Sister</label>
                            <div class="col-xs-2">
                                <div class="input-group">
                                  @php
                                    $sister = '';
                                    if(!empty($employees->family_details)){
                                    $sister = $employees->family_details->no_of_sisters;
                                  }
                                  @endphp
                                   {{Form::text('no_of_sisters',$sister, array('class' => 'form-control'))}}
                              {!! $errors->first('no_of_sisters', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div> 
                            <label for="inputName" class="col-sm-3 ">Your Position</label>
                            <div class="col-xs-2">
                                <div class="input-group">
                                  @php
                                    $sister_position = '';
                                    if(!empty($employees->family_details)){
                                    $sister_position = $employees->family_details->sister_position;
                                  }
                                  @endphp
                                   {{Form::text('sister_position',$sister_position, array('class' => 'form-control'))}}
                              {!! $errors->first('sister_position', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>
                          </div>
                        
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4">Overall Your Position</label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                      @php
                                        $overall_position = '';
                                        if(!empty($employees->family_details)){
                                        $overall_position = $employees->family_details->overall_position;
                                      }
                                      @endphp
                                       {{Form::text('overall_position',$overall_position, array('class' => 'form-control'))}}
                                  {!! $errors->first('overall_position', '<p class="text-danger">:message</p>' ) !!} 
                                       
                                    </div>
                                </div>
                          
                        </div>
                        
                 
                  <!-- /.form-horizontal -->
              </div>

              <!-- Blank Page End Here --> 
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <h6 class="section-subtitle"><b>Spouse Information</b></h6>
        
        <div class="panel">
            <div class="panel-content">

              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  
                        <div class="form-group">                          
                          <label for="inputName" class="col-sm-4 ">Spouse Name</label>
                          <div class="col-xs-7">
                            @php
                              $spousename = '';
                              if(!empty($employees->family_details)){
                              $spousename = $employees->family_details->wife_name;
                            }
                            @endphp
                             {{Form::text('wife_name',$spousename, array('class' => 'form-control'))}}
                              {!! $errors->first('wife_name', '<p class="text-danger">:message</p>' ) !!} 
                          </div>
                        </div>
                        <div class="form-group">                          
                          <label for="inputName" class="col-sm-4 ">Date of Marriage</label>
                            <div class="col-xs-7">
                              @php
                              $marriage_date = '';
                              if(!empty($employees->family_details)){
                              $marriage_date = $employees->family_details->marriage_date;
                            }
                            @endphp
                              {{Form::text('marriage_date',$marriage_date,array('class' => 'form-control', 'placeholder'=>"Format: 2019-12-30"))}}
                            </div>
                        </div>
                        <div class="form-group">                          
                          <label for="inputName" class="col-sm-4 ">Spouse Education</label>
                          <div class="col-xs-7">
                            @php
                              $spouseEducation = '';
                              if(!empty($employees->family_details)){
                              $spouseEducation = $employees->family_details->spouse_education;
                            }
                            @endphp
                             {{Form::text('spouse_education',$spouseEducation, array('class' => 'form-control'))}}
                              {!! $errors->first('spouse_education', '<p class="text-danger">:message</p>' ) !!} 
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4 ">Spouse Occupation</label>
                            <div class="col-xs-7">
                              @php
                                $wife_occupation = '';
                                if(!empty($employees->family_details)){
                                $wife_occupation = $employees->family_details->wife_occupation;
                              }
                              @endphp
                              {{Form::select('wife_occupation',[''=>'--Please Select Occupation--']+['Service'=>'Service', 'House Wife'=>'House Wife', 'Student'=>'Student', 'Others'=>'Others'],null,array('class' => 'form-control','onchange'=>'showItemList(this.value)'))}}
                                {!! $errors->first('wife_occupation', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                       
                        <div id="comment-wraper" class="hidden form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <label for="inputName" class="col-sm-4 ">Name of Company</label>
                            <div class="col-xs-7">
                              @php
                                $spouse_nameofcompany = '';
                                if(!empty($employees->family_details)){
                                $spouse_nameofcompany = $employees->family_details->spouse_nameofcompany;
                              }
                              @endphp
                                {{Form::text('spouse_nameofcompany',$spouse_nameofcompany, array('class' => 'form-control'))}}
                                 {!! $errors->first('spouse_nameofcompany', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                            <label for="inputName" class="col-sm-4 ">Present Position</label>
                            <div class="col-xs-7">
                              @php
                                $spouse_presentposition = '';
                                if(!empty($employees->family_details)){
                                $spouse_presentposition = $employees->family_details->spouse_presentposition;
                              }
                              @endphp
                                {{Form::text('spouse_presentposition',$spouse_presentposition, array('class' => 'form-control'))}}
                                 {!! $errors->first('spouse_presentposition', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                        
                 
                  <!-- /.form-horizontal -->
              </div>

              <!-- Blank Page End Here --> 
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <h6 class="section-subtitle"><b>Education</b></h6>
        
        <div class="panel">
            <div class="panel-content">

              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Highest Degree</label>
                          <div class="col-sm-8">
                            
                            {{Form::text('highest_education',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                            {!! $errors->first('last_education', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Institution</label>
                          <div class="col-sm-8">
                            
                            {{Form::text('institution',null,array('class' => 'form-control'))}}
                            {!! $errors->first('institution', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        
                           
                 
                  <!-- /.form-horizontal -->
              </div>

              <!-- Blank Page End Here --> 
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <h6 class="section-subtitle"><b>Emergency Contact Information</b></h6>
        
        <div class="panel">
            <div class="panel-content">

              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3">Contact Person Name</label>
                          <div class="col-sm-8">
                            
                            {{Form::text('emergency_contact_person',null,array('class' => 'form-control' ,'placeholder'=>'Please insert Name of contact Person'))}}
                            {!! $errors->first('emergency_contact_person', '<p class="text-danger" placeholder="maximum length should be 600">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Relationship</label>
                          <div class="col-sm-8">
                            
                            {{Form::text('relationship',null,array('class' => 'form-control' ,'placeholder'=>'Please insert relationship with contact person.'))}}
                            {!! $errors->first('relationship', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Contact No.</label>
                          <div class="col-sm-8">
                            
                            {{Form::text('emergency_contact_no',null,array('class' => 'form-control' ,'placeholder'=>'Please insert Contact no.'))}}
                            {!! $errors->first('emergency_contact_no', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-5 col-sm-10">
                            <button type="submit" class="btn btn-primary"> Update</button>
                          </div>
                        </div>
                           
                 
                  <!-- /.form-horizontal -->
              </div>

              <!-- Blank Page End Here --> 
            </div>
        </div>
    </div>
   {{ Form::close() }} 
  </div>
  @if(($employees->maritial_status == 'Married') && (!empty($employees->child_details)))
  <div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Children's Information</b></h4>
        <span class="pull-right"> 
          <button type="button" name="create_ChildInfo" id="create_ChildInfo" class="btn btn-success btn-sm" >Add Child Information</button></span>
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Child Name</th>
                        <th>Date of Birth</th>
                        <th> Age (Till Today)</th>
                        <th>Gendar</th>
                        <th>Occupation</th>
                        <th>Grade/Class</th>
                        <th>Education</th>
                        <th>Institution/Company</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($employees->child_details as $data)
                        <tr>
                        <td>{{$data->child_name or ''}}</td>
                        <td>{{$data->date_of_birth or ''}}</td>

                        <td>{{\Carbon\Carbon::parse($data->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</td>
                        <td>{{$data->gender or ''}}</td>
                        <td>{{$data->occupation or ''}}</td>
                        <td>{{$data->class_name or ''}}</td>
                        <td>{{$data->education or ''}}</td>
                        <td>{{$data->institution or ''}}</td>
                      </tr>
                     
                        @php ($i=$i+1)
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
   
  </div>
  @endif
  <div id="formModalChild" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Child Information</h4>
        </div>
        <div class="modal-body">
          <span id="form_result_Child"></span>
          {{ Form::model(request()->old(),array('route' => array('childDetails.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
          <form method="post" id="child_form" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label class="control-label col-md-4">Child Name : </label>
              <div class="col-md-6">
                <input type="text" name="child_name" id="child_name" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Date of Birth : </label>
              <div class="col-md-6">
                <input type="text" name="date_of_birth" id="date_of_birth" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Gendar : </label>
              <div class="col-md-6">
                {{Form::select('gender',[''=>'--Please Select Gender--']+['Male'=>'Male', 'Female'=>'Female'],null,array('class' => 'form-control'))}}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Occupation : </label>
              <div class="col-md-6">
                {{Form::select('occupation',[''=>'--Please Select Occupation--']+['Infant'=>'Infant','Student'=>'Student', 'Service'=>'Service'],null,array('class' => 'form-control'))}}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Institution/Company : </label>
              <div class="col-md-6">
                <input type="text" name="institution" id="institution" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Education : </label>
              <div class="col-md-6">
                {{Form::select('education',[''=>'--Please Select Education--']+['Pre-Primary'=>'Pre-Primary','Primary'=>'Primary', 'High School'=>'High School','College'=>'College','University'=>'University'],null,array('class' => 'form-control'))}}
                                {!! $errors->first('education', '<p class="text-danger">:message</p>' ) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Name of Class/Grade : </label>
              <div class="col-md-6">
                <input type="text" name="class_name" id="class_name" class="form-control"/>
              </div>
            </div>
            <br/>
            <div class="form-group" align="center">
              <input type="hidden" name="hidden_id" id="hidden_id"/>
              <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
            </div>
          </form>
        </div>
      </div>
      
    </div>
    
  </div>
  <div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Job Experiances</b></h4>
        <span class="pull-right"> 
          <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm" >Add Job Experiances</button></span>
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Name of Company</th>
                        <th>Last Position</th>
                        <th>Join Date</th>
                        <th>Released Date</th>
                        <th>Duration</th>
                        <th>Edit</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($employees->job_experiances as $data)
                      <tr>
                        <td>{{$data->name_company or ''}}</td>
                        <td>{{$data->position or ''}}</td>
                        <td>{{$data->start_date or ''}}</td>
                        <td>{{$data->end_date or ''}}</td>
                        <td>{{\Carbon\Carbon::parse($data->start_date)->diff(\Carbon\Carbon::parse($data->end_date))->format('%y years, %m months and %d days')}}</td>
                        <td>
                          {!!  Html::decode(link_to_route('jobExperiances.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
                        </td>
                        
                      </tr>
                      
                        @php ($i=$i+1)
                        @endforeach
                      <tr>
                        <td>{{$employees->organization->organization or ''}}</td>
                        <td>{{$employees->designation->title or ''}}</td>
                        <td>{{$employees->hiredate or ''}}</td>
                        <td></td>
                        <td>{{\Carbon\Carbon::parse($employees->hiredate)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</td>
                        <td></td>
                        
                      </tr>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
   
  </div>

  <div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Previous Job Record</h4>
        </div>
        <div class="modal-body">
          <span id="form_result"></span>
          {{ Form::model(request()->old(),array('route' => array('jobExperiances.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
          <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label class="control-label col-md-4">Name of Company : </label>
              <div class="col-md-6">
                <input type="text" name="name_company" id="name_company" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Last Position : </label>
              <div class="col-md-6">
                <input type="text" name="position" id="position" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Join Date : </label>
              <div class="col-md-6">
                <input type="text" name="start_date" id="start_date" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Released Date : </label>
              <div class="col-md-6">
                <input type="text" name="end_date" id="end_date" class="form-control"/>
              </div>
            </div>
            <br/>
            <div class="form-group" align="center">
              <input type="hidden" name="hidden_id" id="hidden_id"/>
              <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
            </div>
          </form>
        </div>
      </div>
      
    </div>
    
  </div>
  
@endsection
@section('css')
<style type="text/css">

  input:invalid {
    background-color: #FFDDDD;
}


input:valid {
    background-color: #99ff99;
}

/* Other Styles*/
* {
    font-family: "Trebuchet MS";
}
input {
    border: 1px solid #99ff99;
    padding: 3px;
    border-radius: 3px;
    width: 200px;
    margin: 5px;
}
::-webkit-input-placeholder { color:#99ff99; }
::-moz-placeholder { color:#99ff99; } /* firefox 19+ */
:-ms-input-placeholder { color:#99ff99; } /* ie */
input:-moz-placeholder { color:#99ff99; }

textarea::-webkit-input-placeholder {
color: #99ff99;
}

textarea:-moz-placeholder { /* Firefox 18- */
color: #99ff99;  
}

textarea::-moz-placeholder {  /* Firefox 19+ */
color: #99ff99;  
}

textarea:-ms-input-placeholder {
color: #99ff99;  
}
/* ===================map css start =======*/
	.st0{fill-opacity:0;stroke:#000000;}
	.st1{fill:none;stroke:#024C43;stroke-width:3.125;stroke-opacity:0.9922;stroke-dasharray:25,6.25,3.125,6.25;}
	.st2{fill:none;stroke:#000000;}
	.st3{fill:none;}
	.st4{fill:#FFE000;stroke:#FFFFFF;stroke-width:2;}
	.st5{fill:#FFE000;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
	.st6{fill:#FFFF00;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
	.st7{fill:#FFFF00;stroke:#FFFFFF;stroke-width:2;}
	.st8{opacity:0.5;enable-background:new    ;}
	.st9{fill:#FFFFFF;}
	.st10{font-family:'Arial-BoldMT';}
	.st11{font-size:50px;}
	.st12{font-size:40px;}
	.st13{font-family:'ArialMT';}
	.st14{font-size:24px;}
	.st15{fill:#FF0000;}
	.st16{fill:#FF0000;stroke:#FFFFFF;stroke-width:2;}
	.st17{fill:#FF0000;stroke:#FFFFFF;stroke-width:0.75;}
	.st18{fill:#FF0000;stroke:#FFFFFF;stroke-width:0.5;}
	.st19{fill:#EE82EE;stroke:#FFFFFF;stroke-width:2;}
	.st20{fill:#008000;}
	.st21{fill:#008000;stroke:#FFFFFF;stroke-width:3;}
	.st22{fill:#008000;stroke:#FFFFFF;stroke-width:2;}
	.st23{fill:#FFA500;stroke:#FFFFFF;stroke-width:2;}
	.st24{fill:#000080;stroke:#FFFFFF;stroke-width:2;}
	.st25{fill:#000080;stroke:#FFFFFF;stroke-miterlimit:10;}
	.st26{fill:#000080;stroke:#FFFFFF;stroke-width:0.5;}
	.info{transition:all 500ms; opacity:0;}
	.infoWrap{cursor:pointer}
	.infoWrap:hover .info{opacity:1}

 /* ===================map css end =======*/
.dash-box-height{
    height:262px;
    padding: 10px 10px 0;
}
.dash-box-height-2{
    height:238px;
}
.widget-list.list-left-element.minwidth .left-element {
    min-width: 80px !important;
}
.nano > .nano-content.dashboard{
    position: relative !important;
}
.dropup, .dropdown{
    display: inline-block;
}
.dropdown-menu{
    right: 0;
    left:auto;
}
.middle-align{
    position:absolute;
    width: 100%;
    text-align: center;
    font-size: 18px;
    top:50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

   /* -------------------- */
.dash-box-height h4{
    padding: 0;
    margin:0;
}
.dash-box-height h5{
    padding:10px 0 0;
    margin:0;
    font-size: 20px;
    line-height:26px;
}
.dash-box-heightIn {
    padding:10px;
    margin-bottom:8px;
    position: relative;
    height:calc(100% - 9px);
    background-color: #ededed;
}
   /* ---------------------------------- */
   select option:hover{
    content: attr(title);
    background: #666;
    color: #fff;
    position: absolute;
    width: 100%;
    left: 0;
    border: none;
}

.manageHgt a{
    display: block;
    height:100%;

}
.dash-box-heightIn img{ height: 40px; }
.mild{
    width:100%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}
.manageHgt:first-child:nth-last-child(1) {
  height: 100%;
}

/* two items */
.manageHgt:first-child:nth-last-child(2),
.manageHgt:first-child:nth-last-child(2) ~ .manageHgt {
  height: 50%;
}

/* three items */
.manageHgt:first-child:nth-last-child(3),
.manageHgt:first-child:nth-last-child(3) ~ .manageHgt {
  height: 33.3333%;
}

/* four items */
.manageHgt:first-child:nth-last-child(4),
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt {
  height: 25%;
}

/* five items */
.manageHgt:first-child:nth-last-child(5),
.manageHgt:first-child:nth-last-child(5) ~ .manageHgt {
  height: 20%;
}
.manageHgt .col-md-6,
.manageHgt .col-sm-6,
.manageHgt .col-xs-6,
.manageHgt .row{ height: 100% }
.fourBox .dash-box-heightIn{padding:10px 10px; }
.fourBox .subtitle{
    padding-bottom:38px;
}
.fourBox>div:nth-child(odd){
    padding-right: 5px;

}
.fourBox>div:nth-child(even){
    padding-left: 5px;

}
.six-box .row>div:first-child{
    padding-right: 5px;
}
.six-box .row>div:last-child{
    padding-left: 5px;
}
.six-box h4{
    padding-bottom:10px;
    font-size: 12px;
}
.six-box img{
    height:24px;
    margin-top: 7px;
}

.manageHgt:first-child:nth-last-child(4) .subtitle,
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt .subtitle{
    font-size: 12px;

}
.manageHgt:first-child:nth-last-child(4) .title,
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt .title{
    font-size: 14px;
    padding:0;
}
.manageHgt:first-child:nth-last-child(4) img,
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt img{
    height: 24px;
}
#bar-chart{
    height:240px !important;
}
@media only screen and (max-width: 640px) {
    .dash-box-height{height: auto;}
    .fourBox>div:nth-child(odd),
    .six-box .row>div:first-child{padding-right:15px;}
    .fourBox>div:nth-child(even),
    .six-box .row>div:last-child{padding-left:15px;}
    .fourBox .dash-box-heightIn{padding:9px 10px;}
    .six-box h4,
    .fourBox .subtitle{ padding-bottom:0; }

}
</style>
@stop
@section('script')
    <!--Gallery with Magnific popup-->
    <script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    {{-- <script src="{{ asset('js/examples/dashboard.js') }}"></script> --}}
    <script src="{{ asset('vendor/chart-js/chart.min.js') }}"></script>
    
<script>

  $('#create_record').click(function(){
    $('#formModal').modal('show');
  });

  $('#sample_form').on('submit', function(event){
    event.preventDefault();
    if ($('#action').val() == 'Add') 
    {
        $.ajax({
            url:"{{ route('dashboards.index') }}",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success:function(data)
            {
              var html = '';
              if (data.errors) 
              {
                html = '<div class="alert alert-danger">';
                for(var count = 0; count < data.errors.length; count++)
                {
                  html += '<p>' + data.errors[count] + '</p>';

                }
                html += '</div>';
              }
              if (data.success) 
              {
                html = '<div class="alert alert-success">' + data.success + '</div>';
                $('#sample_form')[0].reset();
                $('#user_table').DataTable().ajax.reload();
              }
              $('#form_result').html(html);
            }
        })
    }
  });         
</script>
<script>

  $('#create_ChildInfo').click(function(){
    $('#formModalChild').modal('show');
  });

  $('#child_form').on('submit', function(event){
    event.preventDefault();
    if ($('#action').val() == 'Add') 
    {
        $.ajax({
            url:"{{ route('dashboards.index') }}",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success:function(data)
            {
              var html = '';
              if (data.errors) 
              {
                html = '<div class="alert alert-danger">';
                for(var count = 0; count < data.errors.length; count++)
                {
                  html += '<p>' + data.errors[count] + '</p>';

                }
                html += '</div>';
              }
              if (data.success) 
              {
                html = '<div class="alert alert-success">' + data.success + '</div>';
                $('#child_form')[0].reset();
                $('#user_table').DataTable().ajax.reload();
              }
              $('#form_result_Child').html(html);
            }
        })
    }
  });  

  var call=false;
        function showItemList(val){
            if(val=='Service'){
                call=true;
                $('#current-df').html('<select name="current_df" class="form-control"><option value="" selected="selected">Please select current DF</option></select>');
                $('#current-df-wraper').removeClass('hidden');
                $('#comment-wraper').removeClass('hidden');
                if (shopId){
                    getCurrentDfs(shopId);
                }
            }else{
                call=false;
               $('#current-df-wraper').addClass('hidden');
               $('#comment-wraper').addClass('hidden');
            }
        }

        if('{{old('type')}}'){
            showItemList('{{old('type')}}');
        }       
</script>
@stop
@component('common_pages.selectize')
    @include('common_pages.max_length')

     <script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">

        $('.datepicker').datepicker({ format: "yyyy-mm-dd",todayHighlight: true,autoclose:true});

        //get shops or distributor
        function getExecutiveDepotShop(depotId){
          $('#shop-list').html('');
          $.ajax({
              type: 'Get',
              url:"{{ route('ajax.getShops') }}",
              data:{depot_id:depotId,distributor:1}
            }) .done(function(response) {
             $('#shop-list').html(response);
           //Select2 basic example
             $.fn.select2.defaults.set( "theme", "bootstrap" );
              $(".select2").select2({
                 // placeholder: function(){
                 //     $(this).data('placeholder');
                 // },
                 allowClear: true
             });
            if('{{old('shop_id')}}'){
              $("#shop_id").val('{{old('shop_id')}}').change();
            }

          })
          .fail(function(response) {
          });
        }
    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent


<div class="col-xs-4">
                                {{Form::select('division_id',$divisions,null,array('class' => 'form-control', '@change'=>'getDistricts'))}}
                                {!! $errors->first('division_id', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 require">District</label>
                            <div class="col-xs-4">
                                {{Form::select('district_id',$districts,null,array('class' => 'form-control', '@change'=>'getThanas'))}}
                                {!! $errors->first('district_id', '<p class="text-danger">:message</p>' ) !!}
                                
                            </div>


<!-- Test Code Dashboards Index Pages----->
  
<script>
  $('#create_record').click(function(){
    $('#formModal').modal('show');
  });

  $('#sample_form').on('submit', function(event){
    event.preventDefault();
    if ($('#action').val() == 'Add') 
    {
        $.ajax({
            url:"{{ route('dashboards.index') }}",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success:function(data)
            {
              var html = '';
              if (data.errors) 
              {
                html = '<div class="alert alert-danger">';
                for(var count = 0; count < data.errors.length; count++)
                {
                  html += '<p>' + data.errors[count] + '</p>';

                }
                html += '</div>';
              }
              if (data.success) 
              {
                html = '<div class="alert alert-success">' + data.success + '</div>';
                $('#sample_form')[0].reset();
                $('#user_table').DataTable().ajax.reload();
              }
              $('#form_result').html(html);
            }
        })
    }
  }); 
  </script>
  <script>        

  $('#create_ChildInfo').click(function(){
    $('#formModalChild').modal('show');
  });

  $('#child_form').on('submit', function(event){
    event.preventDefault();
    if ($('#action').val() == 'Add') 
    {
        $.ajax({
            url:"{{ route('dashboards.index') }}",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success:function(data)
            {
              var html = '';
              if (data.errors) 
              {
                html = '<div class="alert alert-danger">';
                for(var count = 0; count < data.errors.length; count++)
                {
                  html += '<p>' + data.errors[count] + '</p>';

                }
                html += '</div>';
              }
              if (data.success) 
              {
                html = '<div class="alert alert-success">' + data.success + '</div>';
                $('#child_form')[0].reset();
                $('#user_table').DataTable().ajax.reload();
              }
              $('#form_result_Child').html(html);
            }
        })
    }
  });  
  </script>
  <script>
  var call=false;
        function showItemList(val){
            if(val=='Service'){
                call=true;
                $('#current-df').html('<select name="current_df" class="form-control"><option value="" selected="selected">Please select current DF</option></select>');
                $('#current-df-wraper').removeClass('hidden');
                $('#comment-wraper').removeClass('hidden');
                if (shopId){
                    getCurrentDfs(shopId);
                }
            }else{
                call=false;
               $('#current-df-wraper').addClass('hidden');
               $('#comment-wraper').addClass('hidden');
            }
        }

        if('{{old('type')}}'){
            showItemList('{{old('type')}}');
        }       
</script>
<!-- Test Code Dashboards Index Pages----->


@extends('layouts.admin')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
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
                    @php
                      $avatar = '';
                      if(!empty($employees->user)){
                      $avatar = $employees->user->avatar;
                    }
                    @endphp
                    @if($avatar)
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/images/avatar/'.$avatar) }}" alt="User profile picture">
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
    {{ Form::model($employees,array('route' => array('employees.updateEmployee',$employees),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
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
                             {{Form::text('title',$employees['designation']['title'],array('class' => 'form-control', 'readonly' => 'true'))}}
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
                                {{Form::text('height_feet',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                                 {!! $errors->first('height_feet', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <label for="inputName" class="col-sm-2 ">feet</label>
                            <div class="col-xs-3">
                                <div class="input-group">
                                   {{Form::text('height_inch',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('height_inch', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>inch               
                        </div>

                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Maritial Status</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                   {{Form::text('maritial_status',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('maritial_status', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div>
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
                                {{Form::text('nid',null,array('class' => 'form-control' , 'readonly' => 'true'))}}
                                 {!! $errors->first('nid', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">TIN</label>
                            <div class="col-xs-9">
                                {{Form::text('tin',null,array('class' => 'form-control' , 'readonly' => 'true'))}}
                                 {!! $errors->first('tin', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">Passport No.</label>
                            <div class="col-xs-9">
                                {{Form::text('passportno',null,array('class' => 'form-control' , 'readonly' => 'true'))}}
                                 {!! $errors->first('passportno', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Birth Date</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                  <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('birthdate',null,array('class' => 'form-control', 'readonly' => 'true'))}}
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
                                {{Form::textarea('present_address',null,array('class' => 'form-control max-length','rows' => 2, 'cols' => 2,'maxlength'=>'150', 'readonly' => 'true'))}}
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
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Personal Interest / Hobby</label>
                          <div class="col-sm-9">
                            {{Form::textarea('hobby',null,array('class' => 'form-control max-length','rows' => 2, 'cols' => 2,'maxlength'=>'150', 'readonly' => 'true'))}}
                            {!! $errors->first('hobby', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        
                       
                 
                  <!-- /.form-horizontal -->
              </div>

              <!-- Blank Page End Here --> 
            </div>
        </div>
    </div>
@section('vuescript')
<script>
    laravelObj.division_id='{{ $employees[0]->division_id or '' }}';
    laravelObj.districts =JSON.parse('{!! $districts or '' !!}');
    laravelObj.district_id='{{ $employees[0]->district_id or '' }}';
    laravelObj.thanas =JSON.parse('{!! $thanas or '' !!}');
    laravelObj.thana_id ='{{ $employees[0]->thana_id or '' }}';
</script>
@stop
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
                            {{Form::text('father_name',$fathername, array('class' => 'form-control', 'readonly' => 'true'))}}
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
                                {{Form::text('father_occupation',$fatherOccupation, array('class' => 'form-control' , 'readonly' => 'true'))}}
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
                                   {{Form::text('father_live_status',$fatherLiveStatus, array('class' => 'form-control', 'readonly' => 'true'))}}
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
                             {{Form::text('mother_name',$mothername,array('class' => 'form-control', 'readonly' => 'true'))}}
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
                                {{Form::text('mother_occupation',$motherOccupation, array('class' => 'form-control', 'readonly' => 'true'))}}
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
                                   {{Form::text('mother_live_status',$motherLiveStatus, array('class' => 'form-control', 'readonly' => 'true'))}}
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
                                   {{Form::text('no_of_brothers',$brother, array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('no_of_brothers', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div> 
                           <label for="inputName" class="col-sm-3 ">Your Serial</label>
                            <div class="col-xs-2">
                                <div class="input-group">
                                  @php
                                    $brother_position = '';
                                    if(!empty($employees->family_details)){
                                    $brother_position = $employees->family_details->brother_position;
                                  }
                                  @endphp
                                   {{Form::text('brother_position',$brother_position, array('class' => 'form-control', 'readonly' => 'true'))}}
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
                                   {{Form::text('no_of_sisters',$sister, array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('no_of_sisters', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div> 
                            <label for="inputName" class="col-sm-3 ">Your Serial</label>
                            <div class="col-xs-2">
                                <div class="input-group">
                                  @php
                                    $sister_position = '';
                                    if(!empty($employees->family_details)){
                                    $sister_position = $employees->family_details->sister_position;
                                  }
                                  @endphp
                                   {{Form::text('sister_position',$sister_position, array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('sister_position', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>
                          </div>
                        
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4">Overall Your Serial</label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                      @php
                                        $overall_position = '';
                                        if(!empty($employees->family_details)){
                                        $overall_position = $employees->family_details->overall_position;
                                      }
                                      @endphp
                                       {{Form::text('overall_position',$overall_position, array('class' => 'form-control', 'readonly' => 'true'))}}
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
                             {{Form::text('wife_name',$spousename, array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('wife_name', '<p class="text-danger">:message</p>' ) !!} 
                          </div>
                        </div>
                        <div class="form-group">                          
                          <label for="inputName" class="col-sm-4 ">Date of Marriage</label>
                            <div class="col-xs-7">
                                <div class="input-group">
                                  <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    @php
                                      $marriage_date = '';
                                      if(!empty($employees->family_details)){
                                      $marriage_date = $employees->family_details->marriage_date;
                                    }
                                    @endphp
                                    {{Form::text('marriage_date',$marriage_date,array('class' => 'form-control' , 'readonly' => 'true'))}}
                                </div> 
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
                             {{Form::text('spouse_education',$spouseEducation, array('class' => 'form-control', 'readonly' => 'true'))}}
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
                             {{Form::text('wife_occupation',$wife_occupation, array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('wife_occupation', '<p class="text-danger">:message</p>' ) !!} 

                              
                            </div>               
                        </div>
                       
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4 ">Name of Company</label>
                            <div class="col-xs-7">
                              @php
                                $spouse_nameofcompany = '';
                                if(!empty($employees->family_details)){
                                $spouse_nameofcompany = $employees->family_details->spouse_nameofcompany;
                              }
                              @endphp
                                {{Form::text('spouse_nameofcompany',$spouse_nameofcompany, array('class' => 'form-control', 'readonly' => 'true'))}}
                                 {!! $errors->first('spouse_nameofcompany', '<p class="text-danger">:message</p>' ) !!}
                            </div> 
                        </div>
                        <div class="form-group">              
                            <label for="inputName" class="col-sm-4 ">Present Position</label>
                            <div class="col-xs-7">
                              @php
                                $spouse_presentposition = '';
                                if(!empty($employees->family_details)){
                                $spouse_presentposition = $employees->family_details->spouse_presentposition;
                              }
                              @endphp
                                {{Form::text('spouse_presentposition',$spouse_presentposition, array('class' => 'form-control', 'readonly' => 'true'))}}
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
                            
                            {{Form::text('institution',null,array('class' => 'form-control', 'readonly' => 'true'))}}
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
                            
                            {{Form::text('emergency_contact_person',null,array('class' => 'form-control' , 'readonly' => 'true'))}}
                            {!! $errors->first('emergency_contact_person', '<p class="text-danger" placeholder="maximum length should be 600">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Relationship</label>
                          <div class="col-sm-8">
                            
                            {{Form::text('relationship',null,array('class' => 'form-control' , 'readonly' => 'true'))}}
                            {!! $errors->first('relationship', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Contact No.</label>
                          <div class="col-sm-8">
                            
                            {{Form::text('emergency_contact_no',null,array('class' => 'form-control' , 'readonly' => 'true'))}}
                            {!! $errors->first('emergency_contact_no', '<p class="text-danger">:message</p>' ) !!}
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
  
  <div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Job Experiances</b></h4>
        
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Name of Company</th>
                        <th>Last Position</th>
                        <th>Joining Date</th>
                        <th>Released Date</th>
                        <th>Duration</th>
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
                      </tr>
                      
                        @php ($i=$i+1)
                        @endforeach
                      <tr>
                        <td>{{$employees->organization->organization or ''}}</td>
                        <td>{{$employees['designation']['title'] or ''}}</td>
                        <td>{{$employees->hiredate or ''}}</td>
                        <td></td>
                        <td>{{\Carbon\Carbon::parse($employees->hiredate)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>Overall Career Length : </td>
                        <td></td>
                        <td></td>
                        <td>{{\Carbon\Carbon::parse($employees->jobstartdate)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</td>
                                                
                      </tr>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
   
  </div>

  

@endsection


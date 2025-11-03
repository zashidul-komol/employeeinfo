@extends('layouts.admin')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Employee</a></li>
            <li><a>Profile</a></li>
        </ul>
    </div>
</div>
 <!-- ========================================================= -->
 <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    
<div class="content-wrapper">
    <!-- Main Content -->
    <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="{{asset('dist/img/Pic008.jpg')}}" alt="User profile picture">

                  <h3 class="profile-username text-center">{{$user->name or ''}}</h3>

                  <p class="text-muted text-center">{{$user->designation->title or ''}}</p>

                </div>
            <!-- /.box-body -->
          </div>
          <!-- /.Profile Image -->

          <!-- About Me Box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">About Me</h3>
                </div>
            <!-- /.box-header -->
                <div class="box-body">
                  <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                  <p class="text-muted">
                    B.Sc. in Computer Science & Engineering
                  </p>
                  <hr>
                  <strong><i class="fa fa-map-marker margin-r-5"></i> Last Updated</strong>
                  <span class="label label-danger" >   :  13th April, 2019</span>
                  <hr>
                  <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                  <p class="text-muted">Head Office, Dhaka</p>
                </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col col-md-3 -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#personal" data-toggle="tab">Personal</a></li>
                  <li><a href="#family" data-toggle="tab">Family</a></li>
                  <li><a href="#child" data-toggle="tab">Child</a></li>
                  <li><a href="#employment" data-toggle="tab">Employment</a></li>
                  <li><a href="#education" data-toggle="tab">Education</a></li>
                  <li><a href="#training" data-toggle="tab">Training</a></li>
                  <li><a href="#degree" data-toggle="tab">Professional</a></li>
                  <li><a href="#sibling" data-toggle="tab">Sibling</a></li>
                </ul>
                <div class="tab-content">
                       <!-- .tab-pane -->
                        <div class="active tab-pane" id="personal">
                            {{ Form::model($user,array('route' => array('employees.update',$user->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
                                <div class="form-group">
                                  <label for="inputName" class="col-sm-2 control-label">Name</label>

                              <div class="col-sm-10">
                                <input class="form-control" value={{$user->name or ''}}>
                               
                              </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputName" class="col-sm-2 control-label">Department</label>
                                    <div class="col-xs-4">
                                      <input type="text" class="form-control" placeholder="Designation">
                                    </div>
                                    
                                    <label for="inputName" class="col-sm-2 control-label">Designation</label>
                                    <div class="col-xs-4">
                                        <input name="title" value="<?php echo $user->designation->title ?>" class="from-control">
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Polar ID</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Polar ID">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Location</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Location">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Hire Date</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Hire Date">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Birth Date</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Birth Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Hobby</label>

                                    <div class="col-sm-10">
                                      <textarea class="form-control" id="inputExperience" placeholder="Hobby"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Mobile</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Mobile">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Gender</label>
                                    <div class="col-xs-4">
                                        {{Form::select('gender',[''=>'--Please Select Gender--']+['Male'=>'Male', 'Female'=>'Female'],null,array('class' => 'form-control'))}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Blood Group</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Blood Group">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Grade</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Grade">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Email</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Maritial Status</label>
                                    <div class="col-xs-4">
                                        {{Form::select('marital_status',[''=>'--Please Select Marital status--']+['Married'=>'Married', 'Unmarried'=>'Unmarried'],null,array('class' => 'form-control'))}}
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputExperience" class="col-sm-2 control-label">Present Address</label>

                                  <div class="col-sm-4">
                                    {{Form::textarea('present_address',null,array('class' => 'form-control max-length','rows' => 3, 'cols' => 2,'maxlength'=>'150'))}}
                                      {!! $errors->first('present_address', '<p class="text-danger">:message</p>' ) !!}
                                  </div>
                                  <label for="inputExperience" class="col-sm-2 control-label">Permanent Address</label>

                                  <div class="col-sm-4">
                                    {{Form::textarea('permanent_address',null,array('class' => 'form-control max-length','rows' => 3, 'cols' => 2,'maxlength'=>'150'))}}
                                      {!! $errors->first('permanent_address', '<p class="text-danger">:message</p>' ) !!}
                                  </div>
                              </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-danger"> Go To Next Steps</button>
                                    </div>
                                </div>
                          </form>
                            <!-- /.form-horizontal -->
                        </div>
                        <!-- /.tab-pane -->

                        <!-- .tab-pane -->
                        <div class="tab-pane" id="family">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Father's Name</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="Father Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Occupation</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Occupation">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Alive or Not</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Alive or Not">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Mother's Name</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="Mother Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Occupation</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Occupation">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Alive or Not</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Alive or Not">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Wife's Name</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="Wife Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Occupation</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Occupation">
                                    </div>
                                      <label for="inputName" class="col-sm-2 control-label">Date of Birth</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Date of Birth">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">No of Brothers</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="No of Brothers">
                                    </div>
                                      <label for="inputName" class="col-sm-2 control-label">No of Sisters</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="No of Sisters">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-danger"> Go To Next Steps</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.form-horizontal -->
                        </div>
                        <!-- /.tab-pane -->
                        <!-- .tab-pane -->
                        <div class="tab-pane" id="child">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Child Name</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="Child Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Occupation</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Occupation">
                                    </div>
                                      <label for="inputName" class="col-sm-2 control-label">Gender</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Gender">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Birth Date</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Birth Date">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Age</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Age">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">School/College/University</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="School/College/University">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name of Class</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Name of Class">
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-danger"> Go To Next Steps</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.form-horizontal -->
                        </div>
                        <!-- /.tab-pane -->

                        <!-- .tab-pane -->
                        <div class="tab-pane" id="employment">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name of Company</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="Name of Company">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Position</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Position">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Join Date</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Join Date">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Released Date</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Released date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Job Duration</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="Duration">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-danger"> Go To Next Steps</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.form-horizontal -->
                        </div>
                        <!-- /.tab-pane -->

                        <!-- .tab-pane -->
                        <div class="tab-pane" id="education">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name of Last Education</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="Name of Last Education">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">School / College / university</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="School / College / university">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Passing Year</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Passing Year">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Results</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Results">
                                    </div>
                                   
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Remarks</label>

                                    <div class="col-sm-10">
                                      <textarea class="form-control" id="inputExperience" placeholder="Remarks"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-danger"> Go To Next Steps</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.form-horizontal -->
                        </div>
                        <!-- /.tab-pane -->

                        <!-- .tab-pane -->
                        <div class="tab-pane" id="training">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name of Course</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="Name of Course">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Institution</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Institution">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Passing Year</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Passing Year">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Results</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Results">
                                    </div>
                                   
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Remarks</label>

                                    <div class="col-sm-10">
                                      <textarea class="form-control" id="inputExperience" placeholder="Remarks"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-danger"> Go To Next Steps</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.form-horizontal -->
                        </div>
                        <!-- /.tab-pane -->

                        <!-- .tab-pane -->
                        <div class="tab-pane" id="degree">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name of Professional Degree</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="Name of Professional Degree">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Institution</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Institution">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Passing Year</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Passing Year">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Results</label>

                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Results">
                                    </div>
                                   
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Remarks</label>

                                    <div class="col-sm-10">
                                      <textarea class="form-control" id="inputExperience" placeholder="Remarks"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-danger"> Go To Next Steps</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.form-horizontal -->
                        </div>
                        <!-- /.tab-pane -->

                         <!-- .tab-pane -->
                        <div class="tab-pane" id="sibling">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label"> Name</label>

                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Occupation</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Occupation">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Gender</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Gender">
                                    </div>
                                    <label for="inputName" class="col-sm-2 control-label">Age</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Age">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-danger"> Go To Next Steps</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.form-horizontal -->
                        </div>
                        <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</div>
@endsection
@section('css')
<style>
.profile-photo{
    position:relative;
}
.profile-photo input[type=file] {
  position:absolute;
  left:0;
  top:0;
  width:100%;
  height:100%;
  opacity: 0;
  cursor:pointer;
}

</style>
@endsection
@section('script')
<script>
$("#profile-picture").change(function() {
	var file = document.getElementById("profile-picture").value;
	var fileExtension = file.split('.').pop().toLowerCase();
	if(fileExtension == 'jpeg' || fileExtension == 'jpg' || fileExtension == 'png'){
		document.getElementById("uploadProfilePicture").submit();
	}
	
});
</script>
<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
@stop
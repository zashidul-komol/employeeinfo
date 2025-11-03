@extends('layouts.admin')
@section('title', 'Add Employee')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Employee</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
  <!-- Theme style -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<div class="content-wrapper">
    <!-- Main Content -->
    <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="{{asset('dist/img/Pic008.jpg')}}" alt="User profile picture">

                  <h3 class="profile-username text-center">Zashidul Alam Sarker</h3>

                  <p class="text-muted text-center">IT Manager</p>

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

                  <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                      <p>
                        <span class="label label-danger">UI Design</span>
                        <span class="label label-success">Coding</span>
                        <span class="label label-info">Javascript</span>
                        <span class="label label-warning">PHP</span>
                      </p>

                  <hr>

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
                            {{ Form::model(request()->old(),array('route' => array('designations.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label for="inputName" class="col-sm-2 control-label">Department</label>
                                    <div class="col-xs-4">
                                      {{Form::select('department_id',$departments,null,array('class' => 'form-control'))}}
                                    </div>
                                    
                                    <label for="inputName" class="col-sm-2 control-label">Designation</label>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Designation">
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

                                    <div class="col-sm-10">
                                      <textarea class="form-control" id="inputExperience" placeholder="Present Address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Permanent Address</label>

                                    <div class="col-sm-10">
                                      <textarea class="form-control" id="inputExperience" placeholder="Permanent Address"></textarea>
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
<!-- /.content-wrapper -->


<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- Page script -->
@endsection
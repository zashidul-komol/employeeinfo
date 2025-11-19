
<div class="row animated fadeInRight">
    <div class="col-md-3">
        <!--CONTACT INFO-->
        <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
            <div class="panel-content">
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    
                    @php
                      $avatar = '';
                      if(!empty($employees[0]->user)){
                      $avatar = $employees[0]->user->avatar;
                    }
                    @endphp
                    @if($avatar)
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/images/avatar/'.$avatar) }}" alt="User profile picture">
                    @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" />
                    @endif
                    {!! $errors->first('avatar', '<p class="text-danger">:message</p>' ) !!}

                    <h5 class="profile-username text-center">{{$employees[0]->name ?? ''}}</h5>

                    <p class="text-muted text-center">{{$employees[0]->designation->title ?? ''}}</p>

                  </div>
            <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <h4 class="section-subtitle"><b>Employee Information</b></h4>
        
        <div class="panel">
            <div class="panel-content">
                
              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Full Name</label>
                          <div class="col-sm-9">
                            {{Form::text('name',$employees[0]->name,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Company Name</label>
                          <div class="col-sm-9">
                            {{Form::text('name',$employees[0]->organization->organization,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">Department</label>
                            <div class="col-xs-9">
                                {{Form::text('name',$employees[0]->department->name,array('class' => 'form-control', 'readonly' => 'true'))}}
                                {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                        <div class="form-group">                          
                          <label for="inputName" class="col-sm-3 ">Designation</label>
                          <div class="col-xs-9">
                             {{Form::text('title',$employees[0]['designation']['title'],array('class' => 'form-control', 'readonly' => 'true'))}}
                             {!! $errors->first('title', '<p class="text-danger">:message</p>' ) !!} 
                          </div>
                        </div>
                        <div class="form-group">                          
                          <label for="inputName" class="col-sm-3 ">Current Location</label>
                          <div class="col-xs-9">
                             {{Form::text('name',$employees[0]->office_location->name,array('class' => 'form-control', 'readonly' => 'true'))}}
                             {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!} 
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Mobile No.</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                   {{Form::text('mobile',$employees[0]->mobile,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('mobile', '<p class="text-danger">:message</p>' ) !!} 
                                    
                                </div>
                            </div>                               
                            <label for="inputName" class="col-sm-2 ">Grade</label>
                            <div class="col-xs-3">
                                <div class="input-group">
                                   {{Form::text('grade',$employees[0]->grade,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('grade', '<p class="text-danger">:message</p>' ) !!} 
                                   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 ">E-mail</label>
                            <div class="col-xs-9">
                                {{Form::text('email',$employees[0]->email,array('class' => 'form-control', 'readonly' => 'true'))}}
                                 {!! $errors->first('email', '<p class="text-danger">:message</p>' ) !!}
                            </div>               
                        </div>
                        
                       
                 
                  <!-- /.form-horizontal -->
              </div>

              <!-- Blank Page End Here --> 
            </div>
        </div>
    </div>
</div>

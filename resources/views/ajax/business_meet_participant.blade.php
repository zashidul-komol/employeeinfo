<form id="updateBMparticipant" style="position: relative;overflow: hidden;" 
    action="{{ route('bmparticipant.updateBMparticipant') }}" method="post">
    <input type="hidden" name="bm_id" value="{{$bm_id}}">
    <input type="hidden" name="requisition_status" id="requisition_status" value="">
  {{ csrf_field() }}
<div class="row animated fadeInRight">
    <div class="col-md-3">
        <!--CONTACT INFO-->
        <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
            <div class="panel-content">
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    
                    @php
                      $avatar = '';
                      if(!empty($bmparticipants[0]->employees->user)){
                      $avatar = $bmparticipants[0]->employees->user->avatar;
                    }
                    @endphp
                    @if($avatar)
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/images/avatar/'.$avatar) }}" alt="User profile picture">
                    @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" />
                    @endif
                    {!! $errors->first('avatar', '<p class="text-danger">:message</p>' ) !!}

                    <h5 class="profile-username text-center">{{$bmparticipants[0]->employees->name or ''}}</h5>

                    <p class="text-muted text-center">{{$bmparticipants[0]->employees->designation->title or ''}}</p>

                  </div>
            <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel">
            <div class="panel-content">
                
              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Full Name</label>
                          <div class="col-sm-9">
                            {{Form::text('name',$bmparticipants[0]->employees->name,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        @if($bmparticipants[0]->spouse_participation == 'Yes')
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Spouse Name</label>
                          <div class="col-sm-9">
                            {{Form::text('wife_name',$bmparticipants[0]->employees->family_details->wife_name,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('wife_name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        @endif
                        @php ($i=1)
                        @foreach ($bmparticipants[0]->employees->child_details as $data)
                            @if($data->child_participation == 'Yes')
                            <div class="form-group">
                              <label for="inputName" class="col-sm-3 ">Children's Name</label>
                              <div class="col-sm-9">
                                {{Form::text('child_name',$data->child_name. '- ('. $data->gender. ') - '.\Carbon\Carbon::parse($data->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years, %m months'),array('class' => 'form-control', 'readonly' => 'true'))}}
                              </div>
                              
                            </div>
                            @endif
                        @php ($i=$i+1)
                        @endforeach

                  <!-- /.form-horizontal -->
              </div>

              <!-- Blank Page End Here --> 
            </div>
        </div>
    </div>
    <div class="col-md-8 form-group">
      {{Form::label('  &nbsp; &nbsp; ',null,array('class' => 'control-label', 'hidden'=>'true'))}}
      
    </div>
    <div class="col-md-9 form-group">
        <label for="inputName" class="col-sm-3 ">Room One:</label>
        <div class="input-group"> 
               {{Form::text('room_one',$bmparticipants[0]->room_one,array('class' => 'form-control'))}}
          {!! $errors->first('room_one', '<p class="text-danger">:message</p>' ) !!} 
                
            
        </div>                               
        <label for="inputName" class="col-sm-3 ">Room Two:</label>
        <div class="input-group">
               {{Form::text('room_two',$bmparticipants[0]->room_two,array('class' => 'form-control'))}}
          {!! $errors->first('room_two', '<p class="text-danger">:message</p>' ) !!} 
               
        
        </div>
    </div>
    
    <div class="col-md-6 form-group">
        <button type="submit" class="btn btn-success" id="approve" onclick="$('#requisition_status').val('approve')">Submit</button> 
        <button type="button" class="btn btn-danger" id="btnclose" data-dismiss="modal">Close</button>           
    </div>
</div>
</form>

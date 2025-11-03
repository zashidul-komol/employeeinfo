<form id="updateBMparticipant" style="position: relative;overflow: hidden;" 
    action="{{ route('bmparticipant.roomKeyDelivery') }}" method="post">
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
                      if(!empty($roomKeydeliveries[0]->employees->user)){
                      $avatar = $roomKeydeliveries[0]->employees->user->avatar;
                    }
                    @endphp
                    @if($avatar)
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/images/avatar/'.$avatar) }}" alt="User profile picture">
                    @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" />
                    @endif
                    {!! $errors->first('avatar', '<p class="text-danger">:message</p>' ) !!}

                    <h5 class="profile-username text-center">{{$roomKeydeliveries[0]->employees->name or ''}}</h5>

                    <p class="text-muted text-center">{{$roomKeydeliveries[0]->employees->designation->title or ''}}</p>

                  </div>
            <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8 form-group">
      {{Form::label('  &nbsp; &nbsp; ',null,array('class' => 'control-label', 'hidden'=>'true'))}}
      
    </div>
    <div class="col-md-9 form-group">
        <label for="inputName" class="col-sm-2 ">Room One :</label>
          <div class="col-xs-2">
              <div class="input-group">
                 {{Form::text('room_one',$roomKeydeliveries[0]->room_one,array('class' => 'form-control' , 'readonly' => 'true'))}}
          {!! $errors->first('room_one', '<p class="text-danger">:message</p>' ) !!} 
                  
              </div>
          </div>                               
          <label for="inputName" class="col-sm-3 ">Key Delivery :</label>
          <div class="col-xs-2">
              <div class="input-group">
                @if(!empty($roomKeydeliveries[0]->room_one_key))
                 {{Form::text('room_one_key',$roomKeydeliveries[0]->room_one_key,array('class' => 'form-control', 'readonly' => 'true' ))}}
                 @else
                 {{Form::text('room_one_key',$roomKeydeliveries[0]->room_one,array('class' => 'form-control' ))}}
                 @endif
          {!! $errors->first('room_one_key', '<p class="text-danger">:message</p>' ) !!} 
                 
              </div>
          </div>
      </div>
      <div class="col-md-9 form-group">
        <label for="inputName" class="col-sm-2 ">Room Two :</label>
          <div class="col-xs-2">
              <div class="input-group">
                 {{Form::text('room_two',$roomKeydeliveries[0]->room_two,array('class' => 'form-control' , 'readonly' => 'true'))}}
          {!! $errors->first('room_two', '<p class="text-danger">:message</p>' ) !!} 
                  
              </div>
          </div>                               
          <label for="inputName" class="col-sm-3 ">Key Delivery :</label>
          <div class="col-xs-2">
              <div class="input-group">
                @if($roomKeydeliveries[0]->room_two == '')
                 {{Form::text('room_two_key',$roomKeydeliveries[0]->room_two,array('class' => 'form-control', 'readonly' => 'true'))}}
                 @elseif(!empty($roomKeydeliveries[0]->room_two_key))
                 {{Form::text('room_two_key',$roomKeydeliveries[0]->room_two_key,array('class' => 'form-control', 'readonly' => 'true'))}}
                 @else
                 {{Form::text('room_two_key',$roomKeydeliveries[0]->room_two,array('class' => 'form-control' ))}}
                 @endif
          {!! $errors->first('room_two_key', '<p class="text-danger">:message</p>' ) !!} 
                 
              </div>
          </div>
      </div>
    
    <div class="col-md-6 form-group">
        <button type="submit" class="btn btn-success" id="approve" onclick="$('#requisition_status').val('approve')">Room Key Delivered</button> 
        <button type="button" class="btn btn-danger" id="btnclose" data-dismiss="modal">Close</button>           
    </div>
  
</div>
</form>

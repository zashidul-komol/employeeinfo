@extends('layouts.admin')
<style type="text/css">
  input:valid {
    background-color: #99ff99;
}
select:valid {
    background-color: #99ff99;
}
textarea:valid {
    background-color: #99ff99;
}
</style>

@section('content')
<div class="content-header">
    <div class="text-center">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#"><h4 class="section-subtitle"><b>Business Meet-2023</b></h4></a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-md-3">
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

                    
                  </div>
            <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    {{ Form::model($employees[0],array('route' => array('employees.BmParticipation',$employees[0]['id']),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
    <div class="col-sm-6">
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
                            <label for="inputName" class="col-sm-3 ">Department</label>
                            <div class="col-xs-9">
                                {{Form::text('department',$employees[0]->department->name,array('class' => 'form-control', 'readonly' => 'true'))}}
                                {!! $errors->first('department', '<p class="text-danger">:message</p>' ) !!}
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
                             {{Form::text('office_location',$employees[0]->office_location->name,array('class' => 'form-control', 'readonly' => 'true'))}}
                             {!! $errors->first('office_location', '<p class="text-danger">:message</p>' ) !!} 
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Email</label>
                          <div class="col-sm-9">
                            {{Form::text('email',$employees[0]->email,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('email', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 ">Mobile No.</label>
                          <div class="col-sm-9">
                            {{Form::text('mobile',$employees[0]->mobile,array('class' => 'form-control', 'readonly' => 'true'))}}
                              {!! $errors->first('mobile', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          
                        </div>
                        
                  <!-- /.form-horizontal -->
              </div>

              <!-- Blank Page End Here --> 
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <!--CONTACT INFO-->
        <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
            <div class="panel-content">
                <div class="box box-primary">
                  <div class="box-body box-profile">
                                         
                    {!! $errors->first('avatar', '<p class="text-danger">:message</p>' ) !!}

                  </div>
            <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <td>প্রিয় সহকর্মী</br>
                            আস্সালামু আলাইকুম</br></br> 

                            মাননীয় ব্যবস্থাপনা পরিচালক মহোদয়ের বিশেষ আমন্ত্রনে এই বছর আমরা স্ব-পরিবারে কক্সবাজারে বিজনেস মিট - ২০২৩ করতে যাচ্ছি। 
                        </br></br>

                            এই বিশাল আয়োজনে পরিবারের সদস্যদের নিরাপত্তাই আমাদের সকলের কাছে মুখ্য বিষয়। তাই পরিবারের সামগ্রীক নিরাপত্তা বিবেচনা করে কর্তৃপক্ষ সবাইকে একই নিয়মে চলার জন্য কিছু দিক নির্দেশনা দিয়েছেন। এই নির্দেশনা গুলো অবশ্যই সবাইকে মেনে চলতে হবেঃ</br></br>

                            <b>১. বর্তমান কর্ম এলাকা থেকে কক্সবাজার ভ্রমনে অবশ্যই কোম্পানির ব্যবস্থাপনায় যাতায়াত করতে হবে। <u>নিজ ব্যবস্থাপনায় /উদ্যোগে কোনোভাবেই যাওয়া যাবে না। </u></br>
                            ২. ১৮ তারিখ নির্ধারিত পয়েন্টে যাত্রার শুরু থেকে ২২ তারিখ হোটেল চেক আউট পর্যন্ত সম্পূর্ণ সময় কোম্পানির প্রদত্ত  শিডিউল/ অনুষ্ঠানসূচী মেনে চলতে হবে। </br>
                            ৩. নিরাপত্তার কথা বিবেচনা করে এই সময়ের মধ্যে নির্বাচিত ইভেন্ট/ জায়গা ছাড়া অন্য কোথাও যাওয়া যাবে না। </br>
                            ৪. যদি কেহ ২২ তারিখ হোটেল চেক আউটের পর নিজ ব্যবস্থাপনায় কক্সবাজারে অবস্থান এবং ফেরত আসতে চান, তাহলে অবশ্যই অগ্রীম ছুটি নিতে হবে।<b> </br>
                        </td>
                    </tr>
                    </thead>
                    
                </table>
              </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Return Confirmation</b></h4>
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <tbody style="background-color: blue;">
                        
                      <tr>
                        <td style="width: 40%;">আপনি কি ছুটি নিয়ে আলাদা ভ্রমনসূচীতে ঢাকা ফেরত আসতে চান ? </td>
                        
                        <td style="width: 20%;" align="left">@php
                              $return_confirmation = '';
                              if(!empty($employees[0]->business_meets)){
                              $return_confirmation = $employees[0]->business_meets->return_confirmation;
                            }
                            @endphp
                            {{Form::select('return_confirmation',[''=>'--Please Select Yes/No--']+['Yes'=>'Yes', 'No'=>'No'],$return_confirmation,array('class' => 'form-control'))}}
                        {!! $errors->first('return_confirmation', '<p class="text-danger">:message</p>' ) !!}</td>
                        <td style="width: 35%;" align="left">অবশ্যই  ঘরটিতে  Yes  অথবা  No সিলেক্ট করতে হবে </td>
                        <td style="width: 5%;" align="left"></td>
                          
                      </tr>

                     
                        
                    </tbody>
                    
                </table>
              </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Participant Details</b></h4>
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th width="25%">Name</th>
                        <th width="10%">Gender</th>
                        <th width="10%">T-Shirt Size</th>
                        <th width="10%">Participation</th>
                        <th width="15%">Update NID</th>
                        <th width="30%">Uploaded NID</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                      <tr>
                        <td>{{$employees[0]->name or ''}}</td>
                        <td>{{$employees[0]->gender or ''}}</td>
                        <td>@php
                              $tshirt = '';
                              if(!empty($employees[0]->business_meets)){
                              $tshirt = $employees[0]->business_meets->tshirt;
                            }
                            @endphp
                            {{Form::text('tshirt',$tshirt,array('class' => 'form-control', 'readonly' => 'true'))}}
                        {!! $errors->first('tshirt', '<p class="text-danger">:message</p>' ) !!}</td>
                        <td>@php
                              $employee_participation = '';
                              if(!empty($employees[0]->business_meets)){
                              $employee_participation = $employees[0]->business_meets->employee_participation;
                            }
                            @endphp
                            {{Form::select('employee_participation',[''=>'--Please Select Yes/No--']+['Yes'=>'Yes', 'No'=>'No'],$employee_participation,array('class' => 'form-control'))}}
                        {!! $errors->first('employee_participation', '<p class="text-danger">:message</p>' ) !!}</td>
                        <td>
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <input type="file" name="employee_nid" ><font>NID must be both sided in pdf format. </font>
                                </div>
                            </div>
                        </td>
                        <td>@php
                              $employee_nid = '';
                              if(!empty($employees[0]->business_meets)){
                              $employee_nid = $employees[0]->business_meets->employee_nid;
                            }
                            @endphp 
                            <a href="{{ asset('storage/Employee_nid/'.$employee_nid) }}" target="_blank">{{ $employee_nid }}
                        {!! $errors->first('employee_nid', '<p class="text-danger">:message</p>' ) !!}</a></td>  
                      </tr>

                     
                        
                    </tbody>
                    
                </table>
              </div>
            </div>
        </div>
    </div>
    @if($employees[0]->maritial_status == 'Married')
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Family Details</b></h4>
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    
                      <thead>
                      <tr>
                        <th width="25%">Spouse Name</th>
                        <th width="15%">Gender</th>
                        <th width="15%">Participation</th>
                        <th width="15%">Update NID</th>
                        <th width="30%">Uploaded NID</th>
                      </tr>
                    </thead>
                      <tr>
                        <td>{{Form::text('wife_name',$employees[0]->family_details->wife_name,array('class' => 'form-control', 'readonly' => 'true'))}}
                        </td>
                        <td>@php
                              $spouse_gender = '';
                              if($employees[0]->gender=='Male'){
                              $spouse_gender = 'Female';
                            }else{
                               $spouse_gender = 'Male'; 
                            }
                            @endphp
                            {{Form::text('spouse_gender',$spouse_gender,array('class' => 'form-control', 'readonly' => 'true'))}}</td>
                        <td>@php
                              $spouse_participation = '';
                              if(!empty($employees[0]->business_meets)){
                              $spouse_participation = $employees[0]->business_meets->spouse_participation;
                            }
                            @endphp
                            {{Form::select('spouse_participation',[''=>'--Please Select Yes/No--']+['Yes'=>'Yes', 'No'=>'No'],$spouse_participation,array('class' => 'form-control'))}}
                            {!! $errors->first('spouse_participation', '<p class="text-danger">:message</p>' ) !!}</td>
                        <td>
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <input type="file" name="spouse_nid" ><font>NID must be both sided in pdf format. </font> 
                                    {!! $errors->first('spouse_nid', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </td>
                        <td>@php
                              $spouse_nid = '';
                              if(!empty($employees[0]->business_meets)){
                              $spouse_nid = $employees[0]->business_meets->spouse_nid;
                            }
                            @endphp 
                            <a href="{{ asset('storage/Spouse_nid/'.$spouse_nid) }}" target="_blank">{{ $spouse_nid }}
                            {!! $errors->first('spouse_nid', '<p class="text-danger">:message</p>' ) !!}</a></td>
                      </tr>
                    </table>
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th width="25%">Child Name</th>
                        <th width="15%">Current Age</th>
                        <th width="10%">Gender</th>
                        <th width="10%">Participation</th>
                        <th width="10%">Update Photo</th>
                        <th width="30%">Children's Photo</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php ($i=1)
                      @foreach ($employees[0]->child_details as $data)
                      <tr>
                        <td>{{Form::text('child_name[]',$data->child_name,array('class' => 'form-control', 'readonly' => 'true'))}}</td>
                        <td>{{Form::text('child_age[]',\Carbon\Carbon::parse($data->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years, %m months'),array('class' => 'form-control', 'readonly' => 'true'))}}</td>
                        <td>{{Form::text('child_gender[]',$data->gender,array('class' => 'form-control', 'readonly' => 'true'))}}</td>
                        <td>{{Form::select('child_participation[]',[''=>'--Please Select Yes/No--']+['Yes'=>'Yes', 'No'=>'No'],$data->child_participation,array('class' => 'form-control'))}}</td>
                        <td>
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <input type="file" name="child_photo[]" > 
                                    {!! $errors->first('child_photo[]', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                            
                        </td>
                        <td>
                            
                            <a href="{{ asset('storage/Child_nid/'.$data['child_photo']) }}" target="_blank">{{$data['child_photo']}}</a>
                        </td>
                        
                        <input type="hidden" name="child_id[]" value="{{$data->id}}">
                      </tr>
                     
                        @php ($i=$i+1)
                        @endforeach
                    </tbody>
                    
                </table>
              </div>

            </div>

        </div>

    </div>
    @endif
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                        
                      <tr style="display:none;">
                        <th width="100%"><input class="checks" type="checkbox"/>  I acknowledge that I have read and agree to the "Terms & Conditions" as well as follow the provided Instrauctions & Guidelines.</th>
                      </tr>
                      <tr>
                        <th>
                          <button type="submit" id="submit" class="btn btn-primary"> I Agree with The Terms & Conditionds</button>
                        </th>
                        
                      </tr>
                      
                    </thead>
                    
                    
                </table>
              
              </div>
              

            </div>

        </div>
        
    </div>
    
    {{ Form::close() }} 
   
</div>
  
@endsection

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

            $('#submit').prop("disabled", true);
            $('input:checkbox').click(function() {
             if ($(this).is(':checked')) {
             $('#submit').prop("disabled", false);
             } else {
             if ($('.checks').filter(':checked').length < 1){
             $('#submit').attr('disabled',true);}
             }
            });
    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot

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

@endcomponent


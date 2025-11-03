<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="{{ public_path().'/css/pdf.min.css' }}">

<style>
body{
    margin:0;
}
td{
    padding:0px 0px;
    font-size:11px;
    line-height:11px;
    font-family:Arial, Helvetica, sans-serif;
    border:0px solid #000;
}

h1{
    padding:0;
    margin:0;
    font-size:26px;
    line-height:30px;
}
h2{
    padding:0;
    margin:0;
    font-size:18px;
    line-height:24px;
}
h2 span{
    padding-left:10px;
    margin:0;
    font-size:18px;
    line-height:24px;
    font-weight:normal;
}

</style>
</head>
<body>
    <table id="main-table" cellpadding="0" cellspacing="0" border="1">
        <thead>
            <tr>
                <th width="20%">
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
                </th>
                <th width="80%">
                    <h2 class="header uppercase">{{$employees->name or '' }}</h2>
                    <h3 class="sub-header">{{ $employees->designation->title or '' }}</h3>
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%"></span><span class="data no-border" style="width: 70%"></span></td>
                            <td width="45%"><span class="title" style="width: 45%"></span><span class="data no-border" style="width: 55%"></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable" cellpadding="0" cellspacing="0" border="1">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Employee Information </span><span class="data no-border" style="width: 70%"></span></td>
                            <td width="45%"><span class="title" style="width: 45%">Family Information</span><span class="data no-border" style="width: 55%"></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Full Name </span><span class="data no-border" style="width: 70%">:{{ $employees->name or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 45%">Father Name</span><span class="data no-border" style="width: 55%">:&nbsp;&nbsp;{{ $employees->family_details->father_name or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Company Name</span><span class="data no-border" style="width: 70%">:{{ $employees->organization->organization or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 45%">Father's Occupation</span><span class="data no-border" style="width: 42%">:&nbsp;&nbsp;{{ $employees->family_details->father_occupation or '' }}</span><span class="data no-border" style="width: 13%">{{ $employees->family_details->father_live_status or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Department</span><span class="data no-border" style="width: 70%">:{{ $employees->department->name or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 45%">Mother Name</span><span class="data no-border" style="width: 55%">:&nbsp;&nbsp;{{ $employees->family_details->mother_name or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Designation</span><span class="data no-border" style="width: 70%">:{{ $employees->designation->title or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 45%">Mother's Occupation</span><span class="data no-border" style="width: 42%">:&nbsp;&nbsp;{{ $employees->family_details->mother_occupation or '' }}</span><span class="data no-border" style="width: 13%">{{ $employees->family_details->mother_live_status or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Current Location</span><span class="data no-border" style="width: 70%">:{{ $employees->office_location->name or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 45%">Spouse Name</span><span class="data no-border" style="width: 55%">:&nbsp;&nbsp;{{ $employees->family_details->wife_name or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">ID No </span><span class="data no-border" style="width: 25%">:{{ $employees->polar_id or '' }}</span>
                            <span class="title" style="width: 25%">Gendar </span><span class="data no-border" style="width: 40%">:{{ $employees->gender or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 45%">Spouse Occupation</span><span class="data no-border" style="width: 55%">:&nbsp;&nbsp;{{ $employees->family_details->wife_occupation or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Mobile </span><span class="data no-border" style="width: 25%">:{{ $employees->mobile or '' }}</span>
                            <span class="title" style="width: 25%">Grade </span><span class="data no-border" style="width: 40%">:{{ $employees->grade or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 30%">Sibling's Information </span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">E-mail </span><span class="data no-border" style="width: 70%">:{{ $employees->email or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 40%">No of Brother: </span><span class="data no-border" style="width:30%">&nbsp;&nbsp;{{ $employees->family_details->no_of_brothers or '' }}</span><span class="data no-border" style="width: 30%">Your Serial : {{ $employees->family_details->brother_position or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Height</span><span class="data no-border" style="width: 27%">:{{ $employees->height_feet or '' }}'{{ $employees->height_inch or '' }}"</span><span class="title" style="width: 10%">NID</span><span class="data no-border" style="width: 30%">:{{ $employees->nid or '' }}</td>
                            <td width="45%"><span class="title" style="width: 40%">No of Sister: </span><span class="data no-border" style="width:30%">&nbsp;&nbsp;{{ $employees->family_details->no_of_sisters or '' }}</span><span class="data no-border" style="width: 30%">Your Serial : {{ $employees->family_details->sister_position or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Passport</span><span class="data no-border" style="width: 27%">:{{ $employees->passportno or '' }}</span><span class="title" style="width: 10%">TIN</span><span class="data no-border" style="width: 30%">:{{ $employees->tin or '' }}</td>
                            <td width="45%"><span class="title" style="width: 40%">Overall Your Serial: </span><span class="data no-border" style="width:30%">&nbsp;&nbsp;{{ $employees->family_details->overall_position or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Maritial Status </span><span class="data no-border" style="width: 27%">:{{ $employees->maritial_status or '' }}</span>
                            <span class="title" style="width: 25%">Blood Group </span><span class="data no-border" style="width: 15%">:{{ $employees->bloodgroup or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 35%">Highest Degree</span><span class="data no-border" style="width: 65%">&nbsp;&nbsp;:{{ $employees->highest_education or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Birth Date </span><span class="data no-border" style="width: 70%">:{{ $employees->birthdate or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 35%">Institution</span><span class="data no-border" style="width: 65%">&nbsp;&nbsp;:{{ $employees->institution or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 30%">Joining Date</span><span class="data no-border" style="width: 70%">:{{ $employees->hiredate or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 30%">Emergency Contact Information</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 40%">Age </span><span class="data no-border" style="width: 60%">:{{\Carbon\Carbon::parse($employees->birthdate)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</span></td>
                            <td width="45%"><span class="title" style="width: 30%">Name </span><span class="data no-border" style="width: 70%">&nbsp;&nbsp;:{{ $employees->emergency_contact_person or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 40%">Length of Service in Polar </span><span class="data no-border" style="width: 60%">:{{\Carbon\Carbon::parse($employees->hiredate)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</span></td>
                            <td width="45%"><span class="title" style="width: 30%">Relationship</span><span class="data no-border" style="width: 70%">&nbsp;&nbsp;:{{ $employees->relationship or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 23%">Present Residential Address: </span><span class="data" style="width: 77%">&nbsp;&nbsp;@if ($employees->present_address){{ $employees->present_address or '' }}@endif</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 8%">Permanent Address: </span><span class="data no-border" style="width: 92%"></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="35%"><span class="title" style="width: 29%">Division: </span><span class="data" style="width: 71%">&nbsp;&nbsp;{{ $employees->division->name or '' }}</span></td>
                            <td width="30%"><span class="title" style="width: 29%">District: </span><span class="data" style="width: 71%">&nbsp;&nbsp;{{ $employees->district->name or '' }}</span></td>
                            <td width="35%"><span class="title" style="width: 29%">Thana: </span><span class="data" style="width: 71%">&nbsp;&nbsp;{{ $employees->thana->name or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%">
                                <span class="title" style="width: 9%">Address: </span>
                                <span class="data" style="width: 91%">&nbsp;&nbsp;: {{ $employees->permanent_address or '' }}</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 20%">Personal Interest / Hobby : </span><span class="data" style="width: 80%">&nbsp;&nbsp;@if ($employees->hobby){{ $employees->hobby or '' }}@endif</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            @if(($employees->maritial_status == 'Married') && (!empty($employees->child_details)))
            <tr>
                <td width="70%">
                    <span class="title" style="width: 9%">Children's Information : </span>
                    <span class="data no-border" style="width: 80%"></span>
                </td>
                        
            </tr>
           
            <tr>
                <td colspan="2">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Child Name</th>
                        <th>Birth Date</th>
                        <th>Age (Till Today)</th>
                        <th>Gendar</th>
                        <th>Occupation</th>
                        <th>Grade/Class</th>
                        <th>Institution/Company</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($employees->child_details as $data)
                      <tr>
                        <td width="20%">{{$data->child_name or ''}}</td>
                        <td width="10%">{{$data->date_of_birth or ''}}</td>
                        <td width="23%">{{\Carbon\Carbon::parse($data->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</td>
                        <td width="8%">{{$data->gender or ''}}</td>
                        <td width="10%">{{$data->occupation or ''}}</td>
                        <td width="9%">{{$data->class_name or ''}}</td>
                        <td width="20%">{{$data->institution or ''}}</td>
                        
                      </tr>
                        @php ($i=$i+1)
                        @endforeach
                    </tbody>
                </table>
                </td>
            </tr>
            @endif
            <tr>
                <td width="70%">
                    <span class="title" style="width: 9%"></span>
                    <span class="data no-border" style="width: 80%"></span>
                </td>
                        
            </tr>
            
            <tr>
                <td width="70%">
                    <span class="title" style="width: 9%">Job Experiances :  </span>
                    <span class="data no-border" style="width: 80%"></span>
                </td>
                        
            </tr>
            <tr>
                <td colspan="2">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Name of Company</th>
                        <th>Last Position</th>
                        <th>Join Date</th>
                        <th>Release Date</th>
                        <th>Duration</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($employees->job_experiances as $data)
                      <tr>
                        <td width="27%">{{$data->name_company or ''}}</td>
                        <td width="30%">{{$data->position or ''}}</td>
                        <td width="9%">{{$data->start_date or ''}}</td>
                        <td width="11%">{{$data->end_date or ''}}</td>
                        <td width="23%">{{\Carbon\Carbon::parse($data->start_date)->diff(\Carbon\Carbon::parse($data->end_date))->format('%y years, %m months and %d days')}}</td>
                      </tr>
                        @php ($i=$i+1)
                        @endforeach
                    </tbody>
                    <tr>
                        <td>{{$employees->organization->organization or ''}}</td>
                        <td>{{$employees->designation->title or ''}}</td>
                        <td>{{$employees->hiredate or ''}}</td>
                        <td></td>
                        <td>{{\Carbon\Carbon::parse($employees->hiredate)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</td>
                        <td></td>
                        
                      </tr>
                      <tr>
                        <td></td>
                        <td>Overall Career Length : </td>
                        <td></td>
                        <td></td>
                        <td>{{\Carbon\Carbon::parse($employees->jobstartdate)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}</td>
                                                
                      </tr>
                    </table>
                </td>
            </tr>
            
        </tbody>
    </table>
</body>
</html>
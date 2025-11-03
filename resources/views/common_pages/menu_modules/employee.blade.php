<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.employees')) }}">
    <a><i class="fa fa-wpforms" aria-hidden="true"></i><span>Employee Module</span></a>
     <ul class="nav child-nav level-1">

        <!-- Employee Managements start-->
        @if(isMenuRender(['EmployeesController@create','EmployeesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['EmployeesController']) }}">
                <a><span>Employee Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('EmployeesController@create',$menu_list))
                        <li @if($current_location=='EmployeesController@create') class="active-item" @endif><a href="{{ route('employees.create',[]) }}">Add Employee</a></li>
                    @endif
                    @if(isMenuRender('EmployeesController@index',$menu_list))
                        <li @if($current_location=='EmployeesController@index') class="active-item" @endif><a href="{{ route('employees.index',[]) }}">Employee Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Employee Managements end-->

        <!-- Requisition Managements start-->
        @if(isMenuRender(['RequisitionsController@create','RequisitionsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['RequisitionsController']) }}">
                <a><span>Requisition Manage</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('RequisitionsController@create',$menu_list))
                        <li @if($current_location=='RequisitionsController@create') class="active-item" @endif><a href="{{ route('requisitions.create',[]) }}">Add Requisition</a></li>
                    @endif
                    @if(isMenuRender('RequisitionsController@index',$menu_list))
                        <li @if($current_location=='RequisitionsController@index') class="active-item" @endif><a href="{{ route('requisitions.index',['new']) }}">Requisition Lists</a></li>
                    @endif
                    {{--
                    @if(isMenuRender('RequisitionsController@deedPapergenerate',$menu_list))
                        <li @if($current_location=='RequisitionsController@deedPapergenerate') class="active-item" @endif><a href="{{ route('requisitions.deedPapergenerate') }}">Deed Paper</a></li>
                    @endif
                    --}}
                </ul>
            </li>
        @endif
        <!-- Requisition Managements end-->
    </ul>
</li>

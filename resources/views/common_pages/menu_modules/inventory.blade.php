<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.inventory')) }}">
    <a><i class="fa fa-archive" aria-hidden="true"></i><span>Employees Module</span></a>
     <ul class="nav child-nav level-1">

          <!-- Supplier Managements start-->
        @if(isMenuRender(['SuppliersController@create','SuppliersController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['SuppliersController']) }}">
                <a><span>Supplier Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('SuppliersController@create',$menu_list))
                        <li @if($current_location=='SuppliersController@create') class="active-item" @endif><a href="{{ route('suppliers.create',[]) }}">Add Supplier</a></li>
                    @endif
                    @if(isMenuRender('SuppliersController@index',$menu_list))
                        <li @if($current_location=='SuppliersController@index') class="active-item" @endif><a href="{{ route('suppliers.index',[]) }}">Supplier Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Supplier Managements end-->

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
                    @if(isMenuRender('EmployeesController@uploadEmployee',$menu_list))
                        <li @if($current_location=='EmployeesController@uploadEmployee') class="active-item" @endif><a href="{{ route('employees.uploads',[]) }}">Employee Uploads</a></li>
                    @endif
                    @if(isMenuRender('EmployeesController@birthday',$menu_list))
                        <li @if($current_location=='EmployeesController@birthday') class="active-item" @endif><a href="{{ route('employees.birthday',[]) }}">Employees Birthday</a></li>
                    @endif
                    @if(isMenuRender('EmployeesController@marriageday',$menu_list))
                        <li @if($current_location=='EmployeesController@marriageday') class="active-item" @endif><a href="{{ route('employees.marriageday',[]) }}">Employees Marriageday</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Employee Managements end-->

        <!-- Family Details Managements start-->
        @if(isMenuRender(['FamilyDetailsController@create','FamilyDetailsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['FamilyDetailsController']) }}">
                <a><span>Family Details</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('FamilyDetailsController@create',$menu_list))
                        <li @if($current_location=='FamilyDetailsController@create') class="active-item" @endif><a href="{{ route('familyDetails.create',[]) }}">Add Family Details</a></li>
                    @endif
                    @if(isMenuRender('FamilyDetailsController@index',$menu_list))
                        <li @if($current_location=='FamilyDetailsController@index') class="active-item" @endif><a href="{{ route('familyDetails.index',[]) }}">Family Details Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Family Details Managements end-->

        <!-- Child Details Managements start-->
        @if(isMenuRender(['ChildDetailsController@create','ChildDetailsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['ChildDetailsController']) }}">
                <a><span>Child Details</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('ChildDetailsController@create',$menu_list))
                        <li @if($current_location=='ChildDetailsController@create') class="active-item" @endif><a href="{{ route('childDetails.create',[]) }}">Add Child Details</a></li>
                    @endif
                    @if(isMenuRender('ChildDetailsController@index',$menu_list))
                        <li @if($current_location=='ChildDetailsController@index') class="active-item" @endif><a href="{{ route('childDetails.index',[]) }}">Child Details Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Child Details Managements end-->

        <!-- Job Experiances Managements start-->
        @if(isMenuRender(['JobExperiancesController@create','JobExperiancesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['JobExperiancesController']) }}">
                <a><span>Job Experiance Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('JobExperiancesController@create',$menu_list))
                        <li @if($current_location=='JobExperiancesController@create') class="active-item" @endif><a href="{{ route('jobExperiances.create',[]) }}">Add Job Experiance</a></li>
                    @endif
                    @if(isMenuRender('JobExperiancesController@index',$menu_list))
                        <li @if($current_location=='JobExperiancesController@index') class="active-item" @endif><a href="{{ route('jobExperiances.index',[]) }}">Job Experiance Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Job Experiances Managements end-->

        <!-- Employee Education Managements start-->
        @if(isMenuRender(['EmployeeEducationsController@create','EmployeeEducationsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['EmployeeEducationsController']) }}">
                <a><span>Emp Education Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('EmployeeEducationsController@create',$menu_list))
                        <li @if($current_location=='EmployeeEducationsController@create') class="active-item" @endif><a href="{{ route('employeeEducations.create',[]) }}">Add Employee Education</a></li>
                    @endif
                    @if(isMenuRender('EmployeeEducationsController@index',$menu_list))
                        <li @if($current_location=='EmployeeEducationsController@index') class="active-item" @endif><a href="{{ route('employeeEducations.index',[]) }}">Employee Education Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Employee Education Managements end-->

        <!-- Certification Cours Managements start-->
        @if(isMenuRender(['CertificationCoursesController@create','CertificationCoursesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['CertificationCoursesController']) }}">
                <a><span>Training Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('CertificationCoursesController@create',$menu_list))
                        <li @if($current_location=='CertificationCoursesController@create') class="active-item" @endif><a href="{{ route('certificationCourses.create',[]) }}">Add Training</a></li>
                    @endif
                    @if(isMenuRender('CertificationCoursesController@index',$menu_list))
                        <li @if($current_location=='CertificationCoursesController@index') class="active-item" @endif><a href="{{ route('certificationCourses.index',[]) }}">Training Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Certification Cours Managements end-->

        <!-- Professional Degree Managements start-->
        @if(isMenuRender(['ProfDegreesController@create','ProfDegreesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['ProfDegreesController']) }}">
                <a><span>Prof Degree Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('ProfDegreesController@create',$menu_list))
                        <li @if($current_location=='ProfDegreesController@create') class="active-item" @endif><a href="{{ route('profDegrees.create',[]) }}">Add Prof Degree</a></li>
                    @endif
                    @if(isMenuRender('ProfDegreesController@index',$menu_list))
                        <li @if($current_location=='ProfDegreesController@index') class="active-item" @endif><a href="{{ route('profDegrees.index',[]) }}">Prof Degree Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Professional Degree Managements end-->

        <!-- Sibling Details Managements start-->
        @if(isMenuRender(['SiblingDetailsController@create','SiblingDetailsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['SiblingDetailsController']) }}">
                <a><span>Sibling Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('SiblingDetailsController@create',$menu_list))
                        <li @if($current_location=='SiblingDetailsController@create') class="active-item" @endif><a href="{{ route('siblingDetails.create',[]) }}">Add Sibling details</a></li>
                    @endif
                    @if(isMenuRender('SiblingDetailsController@index',$menu_list))
                        <li @if($current_location=='SiblingDetailsController@index') class="active-item" @endif><a href="{{ route('siblingDetails.index',[]) }}">Sibling details Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Sibling Details Managements end-->

          <!-- stockCreate start-->
        @if(isMenuRender('InventoriesControler@stockCreate',$menu_list))
             <li @if($current_location=='InventoriesControler@stockCreate') class="active-item" @endif>
                <a href="{{ route('inventories.stockCreate',[]) }}">Create Stock</a>
            </li>
        @endif
        <!-- stockCreate end=======-->

        <!-- generateDFCode start-->
        @if(isMenuRender('InventoriesControler@generateDFCode',$menu_list))
             <li @if($current_location=='InventoriesControler@generateDFCode') class="active-item" @endif>
                <a href="{{ route('inventories.generateDFCode',[]) }}">Generate DF Code</a>
            </li>
        @endif
        <!-- generateDFCode end=======-->

         <!-- stockIndex start-->
        @if(isMenuRender('InventoriesControler@stockIndex',$menu_list))
             <li @if($current_location=='InventoriesControler@stockIndex') class="active-item" @endif>
                <a href="{{ route('inventories.stockIndex',[]) }}">Stock Lists</a>
            </li>
        @endif
        <!-- stockIndex end=======-->

        <!-- allocatedStockIndex start-->
        @if(isMenuRender('InventoriesControler@allocatedStockIndex',$menu_list))
             <li @if($current_location=='InventoriesControler@allocatedStockIndex') class="active-item" @endif>
                <a href="{{ route('inventories.allocatedStockIndex',[]) }}">Allocation Lists</a>
            </li>
        @endif
        <!-- allocatedStockIndex end=======-->

        <!-- depotAllocatedStockIndex start-->
        @if(isMenuRender('InventoriesControler@depotAllocatedStockIndex',$menu_list))
             <li @if($current_location=='InventoriesControler@depotAllocatedStockIndex') class="active-item" @endif>
                <a href="{{ route('inventories.depotAllocatedStockIndex',[]) }}">Depot Allocation Lists</a>
            </li>
        @endif
        <!-- depotAllocatedStockIndex end======-->

        <!-- itemIndex start-->
        @if(isMenuRender('InventoriesControler@itemIndex',$menu_list))
             <li @if($current_location=='InventoriesControler@itemIndex') class="active-item" @endif>
                <a href="{{ route('inventories.itemIndex',[]) }}">DF Lists</a>
            </li>
        @endif
        <!-- itemIndex end======-->

          <!-- Stock Transfer Managements start-->
        @if(isMenuRender(['InventoriesControler@stockTransferCreate','InventoriesControler@stockTransferLists'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['InventoriesControler']) }}">
                <a><span>Stock Transfer</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('InventoriesControler@stockTransferCreate',$menu_list))
                        <li @if($current_location=='InventoriesControler@stockTransferCreate') class="active-item" @endif><a href="{{ route('inventories.stockTransferCreate',[]) }}">Create</a></li>
                    @endif

                    @if(isMenuRender('InventoriesControler@stockTransferLists',$menu_list))
                        <li @if($current_location=='InventoriesControler@stockTransferLists') class="active-item" @endif><a href="{{ route('inventories.stockTransferLists',[]) }}">Lists</a></li>
                    @endif

                </ul>
            </li>
        @endif
        <!-- Stock Transfer Managements end-->

    </ul>
</li>

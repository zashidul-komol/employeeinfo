@php
    $current_location=class_basename(Route::currentRouteAction());
@endphp
<div class="left-sidebar">
    <!-- left sidebar HEADER -->
    <div class="left-sidebar-header">
        <div class="left-sidebar-title">&nbsp;</div>
        <div onclick="addcollapsibleclass('left-sidebar-collapsed')" class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
            <span></span>
        </div>
    </div>
    <!-- ==========================NAVIGATION =====================-->
    <div id="left-nav" class="nano">
        <div class="nano-content">
            <nav>
                <ul class="nav nav-left-lines" id="main-nav">
                    <!--HOME-->
                    <li @if($current_location=='HomeController@index') class="active-item" @endif>
                        <a href="{{ route('dashboard') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li @if($current_location=='HomeController@participantlist') class="active-item" @endif>
                        <a href="{{ route('dashboards.participantlist') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>BM Participant List</span>
                        </a>
                    </li>
                    <li @if($current_location=='HomeController@contactDirectories') class="active-item" @endif>
                        <a href="{{ route('dashboards.contactdirectories') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Contact Directories</span>
                        </a>
                    </li>
                    

                    <!-- =========Configuraion Module start===================-->
                    @if(isMenuRender(config('myconfig.menu.configaration'),$controller_list))
                        @include('common_pages.menu_modules.configuration')
                    @endif
                    <!-- ==============Configuraion Module end================-->

                    <!-- ==============User Module start====================-->
                    @if(isMenuRender(config('myconfig.menu.user'),$controller_list))
                        @include('common_pages.menu_modules.user')
                    @endif
                    <!-- ==============User Module end========================-->
                    
                    <!-- ==============Inventory Module start====================-->
                    @if(isMenuRender(config('myconfig.menu.inventory'),$controller_list))
                        @include('common_pages.menu_modules.inventory')
                    @endif
                    <!-- =============Inventory Module end============-->

                    <!-- ==============employee Module start====================-->
                    @if(isMenuRender(config('myconfig.menu.employee'),$controller_list))
                        @include('common_pages.menu_modules.employee')
                    @endif
                    <!-- =============employee Module end============-->

                     <!-- ==============SMS Promotionals Module start====================-->
                    @if(isMenuRender(config('myconfig.menu.sms_promotionals'),$controller_list))
                        @include('common_pages.menu_modules.sms_promotionals')
                    @endif
                    <!-- ==============SMS Promotionals Module end========================-->

                     <!-- ==============SMS Module start====================-->
                    @if(isMenuRender(config('myconfig.menu.sms'),$controller_list))
                        @include('common_pages.menu_modules.sms')
                    @endif
                    <!-- ==============SMS Promotionals Module end========================-->
                    
                    <!-- ==========Requisition Module start===================-->
                    @if(isMenuRender(config('myconfig.menu.requisition'),$controller_list))
                        @include('common_pages.menu_modules.requisition')
                     @endif
                    <!-- =============Requisition Module end============-->

                    <!-- ==============Rport Module start====================-->
                    @if(isMenuRender(config('myconfig.menu.report'),$controller_list))
                        @include('common_pages.menu_modules.report')
                     @endif
                    <!-- =============Report Module end============-->

                    @if (env('APP_ENV') === 'local')
                        @include('common_pages.menu_modules.template_menu')
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
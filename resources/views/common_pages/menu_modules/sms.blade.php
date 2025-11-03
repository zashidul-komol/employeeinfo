<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.sms')) }}">
    <a><i class="fa fa-wpforms" aria-hidden="true"></i><span>Send SMS</span></a>
     <ul class="nav child-nav level-1">
        @if(isMenuRender(['SmsController@index'],$menu_list))
             <li @if($current_location=='SmsController@index') class="active-item" @endif>
                <a href="{{ route('sms.index',[]) }}">SMS List</a>
            </li>
        @endif
    </ul>
</li>

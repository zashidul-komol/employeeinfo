<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.sms_promotionals')) }}">
    <a><i class="fa fa-wpforms" aria-hidden="true"></i><span>SMS Module</span></a>
     <ul class="nav child-nav level-1">
        @if(isMenuRender(['SmsPromotionalsController@send'],$menu_list))
             <li @if($current_location=='SmsPromotionalsController@send') class="active-item" @endif>
                <a href="{{ route('smsPromotionals.send',[config('myconfig.promotional_sms_group.sales_team')]) }}">Send SMS</a>
            </li>
        @endif
    </ul>
</li>

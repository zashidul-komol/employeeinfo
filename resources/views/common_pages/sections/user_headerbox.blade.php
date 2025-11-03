 <div class="header-section" id="user-headerbox">
    <div class="user-header-wrap">
        <div class="user-photo">
        @if(auth()->user()->avatar)
        	<img alt="profile photo" src="{{ asset('storage/images/avatar/'.auth()->user()->avatar) }}" title="{{auth()->user()->name}}"/>
        @else
        	<img alt="profile photo" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" title="{{auth()->user()->name}}"/>
        @endif
        </div>
        <div class="user-info">
            <span class="user-name" title="{{auth()->user()->name}}">{{ auth()->user()->name }}</span>
            
        </div>
        <i class="fa fa-plus icon-open" aria-hidden="true" title=""></i>
        <i class="fa fa-minus icon-close" aria-hidden="true" title=""></i>
    </div>
    <div class="user-options dropdown-box">
        <div class="drop-content basic">
            <ul>
                <li> <a href="{{ route('users.show') }}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                <li> <a href="{{ route('password.change') }}"><i class="fa fa-edit" aria-hidden="true"></i> Change Passwrod</a></li>
               {{--  <li> <a href="{{ route('template',array('pages_lock-screen')) }}"><i class="fa fa-lock" aria-hidden="true"></i> Lock Screen</a></li>
                <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i> Configurations</a></li> --}}
            </ul>
        </div>
    </div>
</div>
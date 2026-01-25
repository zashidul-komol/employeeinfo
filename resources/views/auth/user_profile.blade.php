@extends('layouts.admin')
@section('content')
 <!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-copy" aria-hidden="true"></i><a href="#">User</a></li>
            <li><a>Profile</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row">
    <div class="col-md-8 col-lg-8">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--PROFILE-->
        <div>
            <div class="profile-photo">
              {{ Form::model(request()->old(),array('route' => array('ajax.uploadProfilePicture'),'enctype'=>'multipart/form-data','id'=>'uploadProfilePicture')) }}
                <input type="file" name="avatar" id="profile-picture" accept="image/*"/>
                {{ Form::close() }}
                @if(auth()->user()->avatar)
                  <img alt="User photo" src="{{ asset('storage/images/avatar/'.auth()->user()->avatar) }}" />
                @else
                  <img alt="profile photo" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" />
                @endif
                <div id="avatarError" class="text-danger mt-2" style="display:none;"></div>
                @if ($errors->has('avatar'))
                <div class="alert alert-danger mt-2" style="padding:8px 12px;">
                    {{ $errors->first('avatar') }}
                </div>
                @endif
            </div>

            <div class="user-header-info">
                <h2 class="user-name">{{ $user->username }}</h2>
                <h5 class="user-position">{{ $user->designation->title ?? '' }} ({{ $user->designation->short_name ?? '' }})</h5>
                {{-- <div class="user-social-media">
                    <span class="text-lg"><a href="#" class="fa fa-twitter-square"></a> <a href="#" class="fa fa-facebook-square"></a> <a href="#" class="fa fa-linkedin-square"></a> <a href="#" class="fa fa-google-plus-square"></a></span>
                </div> --}}
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
         <!--CONTACT INFO-->
        <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
            <div class="panel-content">
                <h4> <b>Contact Information</b></h4>
                <ul class="user-contact-info ph-sm">
                    <li><b><i class="color-primary mr-sm fa fa-envelope"></i></b>{{ $user->email }}</li>
                    <li><b><i class="color-primary mr-sm fa fa-phone"></i></b> {{ $user->mobile }}</li>
                   {{--  <li><b><i class="color-primary mr-sm fa fa-globe"></i></b> Helsinki, Finland</li> --}}
                </ul>
            </div>
        </div>

         <!--About-->
        <div class="panel b-primary bt-sm mt-xl">
            <div class="panel-content">
                 <h4 class=""><b>About</b></h4>
                  <ul class="user-contact-info ph-sm">
                    <li class="mt-sm"><strong>Role: </strong><span class="text-danger">{{ $user->role->name }}</span></li>
                    
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('css')
<style>
.profile-photo{
    position:relative;
}
.profile-photo input[type=file] {
  position:absolute;
  left:0;
  top:0;
  width:100%;
  height:100%;
  opacity: 0;
  cursor:pointer;
}

</style>
@endsection
@section('script')
<script>
document.getElementById('profile-picture').addEventListener('change', function () {
  const el = document.getElementById('avatarError');
  el.style.display = 'none';
  el.innerText = '';

  const file = this.files[0];
  if (!file) return;

  const allowed = ['image/jpeg', 'image/png'];
  const maxBytes = 1024 * 1024; // 1MB

  if (!allowed.includes(file.type)) {
    el.innerText = 'Only JPG, JPEG, PNG images are allowed.';
    el.style.display = 'block';
    this.value = '';
    return;
  }

  if (file.size > maxBytes) {
    el.innerText = 'Maximum image size is 1MB.';
    el.style.display = 'block';
    this.value = '';
    return;
  }

  document.getElementById('uploadProfilePicture').submit();
});
</script>
@stop
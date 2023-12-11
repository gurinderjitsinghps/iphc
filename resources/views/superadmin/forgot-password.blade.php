@extends('superadmin.layouts.simple')
@section('title', 'Reset Password')
@section('content')
<div id="wrapper" class="auth-page">
    <div class="small-circle"></div>

  <img class="overlay-image" src="/assets/images/back-shape.png">
     <div class="height-100v">
        <div class="card-authentication2">
           <div class="card-groups">
              <div class="cards mb-0">
                 <div class="card-body">
                    <div class="card-content p-3 form-box ">
                   <div class="left-image">
                        <img class="logo-image" src="/assets/images/logo.png" class="">
                       

                        <img class="welcome-hand" src="/assets/images/welcome-hand.png">
                    </div>
                    <div class="card-title text-center py-3">Reset Password</div>
                       <p class="mt-0 mb-4">Enter your registered email ID to reset new password.</p>
                       @if(session('pass_sent_email'))
                           <h2 class="green">{{ session('pass_sent_email') }}</h2>
                       @else
                       
                       <form class="authentication-form" method="POST" action="{{ route('superadmin.password.email') }}">
                        @csrf
                          <div class="form-group">
                             <div class="position-relative has-icon-left auth-form-grp">
                                <img class="form--grp-icon"  src="/assets/images/icons/person.png"/>
                                <input type="email" class="form-control" placeholder="Email" name="email">
                             </div>
                          </div>
                          @error('email')
                          <div class="error red" role="alert">
                              <strong>{{ $message }}</strong>
                          </div>
                      @enderror
                      <button type="submit" class="btn btn-danger mb-2 mt-2" style="width: 100%">Reset Password</button>

                        <div class="text-center mt-2">
                          <a href="{{ route('superadmin.login') }}" class="yellow-link">Log In</a>
                   </div>
                          <!-- <div class="form-row mr-0 ml-0">
                             <div class="form-group col-12 text-center mt-3">
                                <a href="forgot-password.html" class="redirect-link">Terms & Conditions</a>
                             </div>
                          </div> -->
                       </form>
                       @endif
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
     <!--Start Back To Top Button-->
     <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
     <!--End Back To Top Button-->

     <div class="big-circle"></div>
  </div>

@endsection

@extends('superadmin.layouts.simple')
@section('title', 'Login')
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
                    <div class="card-title text-center py-3 mb-3">Log In To Admin</div>

                       <form class="authentication-form" method="POST" action="{{ route('superadmin.login.store') }}" >
                        @csrf
                          <div class="form-group">
                             <div class="position-relative has-icon-left auth-form-grp">
                                <img class="form--grp-icon"  src="/assets/images/icons/person.png"/>
                                <input type="text" class="form-control" placeholder="Username" name="email">
                             </div>
                          </div>
                          <div class="form-group">
                             <div class="position-relative has-icon-right  auth-form-grp">
                                <img class="form--grp-icon"  src="/assets/images/icons/key.png"/>
                                <input type="password" id="exampleInputPassword" class="form-control" placeholder="Password" name="password">
                                <div class="form-control-position">
                                   <i class="icon-eye input-group-icone"></i>
                                </div>
                             </div>
                          </div>
                          <div class="form-group">
                          <div class="row">
                             <div class="col-12 col-lg-6">
                              <div class="form-check form-check_label">
<label class="form-check-label">
<input type="checkbox" name="remember" style="margin-top: 2px;" class="form-check-input" value="">Remember me
</label>
</div>
</div>
                             <div class="col-12 col-lg-6 text-right">
<a href="{{ route('superadmin.forgot-password') }}" class="forg_passeord">Forgot password?</a>
                                </div>
                             </div>
                          </div>
                          @error('email')
                          <div class="d-block invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </div>
                      @enderror
                      @error('password')
                      <div class="d-block invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </div>
                  @enderror
                          <button type="submit" class="btn btn-danger mb-2 mt-2" style="width: 100%">Login</button>
                          <!-- <div class="form-row mr-0 ml-0">
                             <div class="form-group col-12 text-center mt-3">
                                <a href="forgot-password.html" class="redirect-link">Terms & Conditions</a>
                             </div>
                          </div> -->
                       </form>
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

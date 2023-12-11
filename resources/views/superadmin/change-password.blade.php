@extends('superadmin.layouts.app')
@section('title', 'Change Password')
{{-- @push('styles')
<link href="/superadmin/css/profile.css" rel="stylesheet">
<link href="/superadmin/css/helper.css" rel="stylesheet">
@endpush
 --}}
@section('content')

<div class="content-wrapper mt-3">
  <div class="container-fluid">
    <!--Start Dashboard Content-->
    <div class="row mt-4">
      <div class="col-lg-12">
        <div class="card card-dark-blue" style="border:none !important;">
         
          <div class="card-body cpform">
            <div class="row">
              <div class="col-lg-10">
                <div class="form-group mb-3 row align-items-center">
                  <label for="Contribute As" class="col-sm-2 col-form-label">Current Password</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <input type="password" class="form-control custum-input2"  name="current_password">
                    </div>
                  </div>
                </div>
                <div class="form-group mb-3 row align-items-center">
                  <label for="Contribute As" class="col-sm-2 col-form-label">New Password</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <input type="passsword" class="form-control custum-input2" name="password">
                    </div>
                  </div>
                </div>
                <div class="form-group mb-3 row align-items-center">
                  <label for="Contribute As" class="col-sm-2 col-form-label">Retype Password</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <input type="password" class="form-control custum-input2" name="password_confirmation">
                    </div>
                  </div>
                </div>
                <br>
                <div class="form-group  row align-items-center">
            <div class="offset-md-2 col-lg-10 btnCont">
              <button type="button" class="updatePassword btn btn-danger mb-2 mt-2 pl-5 pr-5" style="">Change Password</button>
            </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--End Row-->
    <!--End Dashboard Content-->
    <!--start overlay-->
    <div class="overlay toggle-menu"></div>
    <!--end overlay-->
  </div>
  <!-- End container-fluid-->
</div>
@endsection
@push('scripts')
<script>

$(document).on('click','.cpform .updatePassword', function(ev){
    postReq($(this),'superadmin/profile/updatePassword','.cpform');
});
</script>
@endpush
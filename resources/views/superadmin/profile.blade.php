@extends('superadmin.layouts.app')
@section('title', 'Edit Profile')
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
            <div class="card-header cus-card-header border-0">
                <span><a href="{{ route('superadmin.dashboard') }}" style="color: inherit;">Back</a> &gt; Edit Profile</span>
                <div class="card-action">
                  <a class="btn btn-link" href="{{ route('superadmin.profile.changePassword') }}">Change Password</a>
                </div>     
              </div>
            <div class="card-body fform" >
              <div class="row">
                <div class="col-lg-10">
                  <div class="form-group mb-3 row align-items-center">
                    <label for="Contribute As" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <input type="tex" class="form-control custum-input2" placeholder="John" name="name" value="{{ $superadmin->name }}">
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-3 row align-items-center">
                    <label for="Contribute As" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <input type="text" class="form-control custum-input2" placeholder="s@elorvordr.com" readonly value="{{ $superadmin->email }}">
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-3 row align-items-center">
                    <label for="Contribute As" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-10">
                      <div class="row">
                        <div class="col-lg-3">
                          <select type="select" class="form-control custum-input2" style="width: 100%" name="phonecode">
                            <option value="+33">+33</option>
                          </select>
                        </div>
                        <div class="col-lg-9">
                          <input type="text" class="form-control custum-input2" placeholder="19 250 1232" name="phone" value="{{ $superadmin->phone }}">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-3 row align-items-center">
                    <label for="Contribute As" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <input type="text" class="form-control custum-input2" placeholder="" value="{{ $superadmin->phone }}">
                      </div>
                    </div>
                  </div>
                  <br>
                <div class="btnCont">
                <button type="button" class="btn btn-danger mb-2 mt-2 pl-5 pr-5 updateProfile" style="">Save</button>
            </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group mb-3">
                    <div class="position-relative image-upload-box-wrap">
                      <div class="image-upload-box image-upload-box2">
                        <div class="preview-image">
                          <div class="image-preview image-preview2">
                            @if($superadmin->profile_image)
                          <img id="preview" src="/storage/{{$superadmin->profile_image}}" alt="" class="rounded-circle me-4">
                          @else
                          <img  src="/assets/images/avatars/profile.png" alt="" id="preview" />
                          @endif
                            
                          </div>
                        </div>
                        <div class="file-upload">
                          <input type="file" name="profile_image" id="fileInput" accept="image/*" />
                          <label for="fileInput" class="custom-file-upload custom-file-upload2 mb-0 ml-3"><span class="icon-camera icons"></span></label>
                          </div>
                      </div>
                          
                      
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

$(document).on('click','.fform .updateProfile', function(ev){
    postReq($(this),'superadmin/updateProfile','.fform');
});
$(document).on('click','#password .updatePassword', function(ev){
    postReq($(this),'superadmin/profile/changePassword','.fform');

});
$('input[name="profile_image"]').on('change', function () {
      previewImage($(this));
    });
</script>
@endpush
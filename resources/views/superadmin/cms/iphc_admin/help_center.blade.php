@extends('superadmin.layouts.app')
@section('title', 'Edit Help Center')
@section('content')
@push('styles')
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush
<div class="content-wrapper mt-3">
  <div class="container-fluid">
    <!--Start Dashboard Content-->
    <div class="row mt-4">
      <div class="col-lg-12">
        <div class="card card-dark-blue" style="border:none !important;">
          <div class="card-header cus-card-header border-0">
            <span><a href="{{ route('superadmin.cms','t=admin') }}" style="color: inherit;">Back</a> >Edit Help Center</span>     
          </div>
          <div class="card-body" id="cform">
            <div class="row">
              <div class="col-lg-12">
                
                <div class="form-group mb-3 row align-items-center">
                  <label for="Contribute As" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <input type="email" name="text1" class="form-control" placeholder="Email"  value="{{$help ? $help->text1 : ''}}" />
                    </div>
                  </div>
                </div>
                <div class="form-group mb-3 row align-items-center">
                  <label for="Contribute As" class="col-sm-2 col-form-label">Mobile</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <input type="text" name="text2" class="form-control" placeholder="Mobile"  value="{{$help ? $help->text2 : ''}}" />
                    </div>
                  </div>
                </div>
                  <div class="form-group mb-3 row align-items-center btnCont">
                    <div class="offset-md-2 col-sm-10">
                      <button class="btn btn-danger mb-2 mt-2 pl-5 pr-5 submit">Save</button>
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
<script defer>
    $(document).on('click','.submit', function(ev){
        let e = $(this);
        let formdata = [
          {'_method' :'put'},
          {'type' :'help_center'}
        ];
        postReq($(this),'superadmin/cms/update','#cform',formdata);
  });

</script>
@endpush
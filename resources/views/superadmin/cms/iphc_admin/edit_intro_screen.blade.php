@extends('superadmin.layouts.app')
@section('title', 'Splash Screen')
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
            <span><a href="{{ route('superadmin.cms.intro_screens') }}" style="color: inherit;">Back</a> > Edit Intro Screen {{$id}}</span>     
          </div>
          <div class="card-body" id="cform">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group mb-3 row align-items-center">
                  <label for="Contribute As" class="col-sm-2 col-form-label">Image</label>
                  <div class="col-sm-10">
                    <div class="image-upload-box">
                      <div class="preview-image">
                        <div class="image-preview">
                          @if ($intro && $intro->attachment)
                            <img width="100%"  src="/storage/{{ $intro->attachment }}" />
                            @else
                          <img width="100%"  src="" />
                          @endif
                        </div>
                      </div>
                      <div class="file-upload">
                        <input type="file" name="attachment" id="fileInput" accept="image/*" >
                        <label for="fileInput" class="custom-file-upload mb-0 ml-3">Choose File <img src="/assets/images/icons/publish.svg"></label>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <div class="form-group mb-3 row align-items-center">
                  <label for="Contribute As" class="col-sm-2 col-form-label">Details</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <input type="text" name="text1" class="form-control" placeholder="Details"  value="{{$intro ? $intro->text1: ''}}" />
                    </div>
                  </div>
                </div>
                <div class="form-group mb-3 row align-items-center">
                  <label for="Contribute As" class="col-sm-2 col-form-label">Details</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <textarea type="textarea" name="text2" class="form-control custum-textarea2" placeholder="Details ">{{$intro ? $intro->text2 : ''}}</textarea>
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
$('input[name="attachment"]').on('change', function () {
      previewImage($(this));
    });
    $(document).on('click','.submit', function(ev){
        let e = $(this);
        let formdata = [
          {'_method' :'put'},
          {'type' :'intro_screen{{$id}}'}
        ];
        postReq($(this),'superadmin/cms/update','#cform',formdata);
  });

</script>
@endpush
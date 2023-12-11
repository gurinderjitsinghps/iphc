@extends('superadmin.layouts.app')
@section('title', 'Edit Advertisement')
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
            <span><a href="{{ route('superadmin.cms','t=user') }}" style="color: inherit;">Back</a> > Edit Code of Conduct</span>     
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
                          @if ($code_conduct && $code_conduct->attachment)
                          @php
                            $extension = pathinfo($code_conduct->attachment, PATHINFO_EXTENSION);
                          @endphp     
                          @if ($extension == 'pdf' || $extension == 'doc')
                          <img width="100%" id="preview" src="/assets/images/icons/pdf.png" />
                            @else
                            <img width="100%" id="preview" src="/storage/{{ $code_conduct->attachment }}" />
                          @endif
                          @else
                          <img width="100%" id="preview" src="" />
                          @endif
                        </div>
                      </div>
                      <div class="file-upload">
                        <input name="attachment" type="file" id="fileInput" accept="image/*,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" onchange="previewImage()" />
                        <label for="fileInput" class="custom-file-upload mb-0 ml-3">Choose File
                
                            <img src="/assets/images/icons/publish.svg">
                         
                        </label>
                      </div>
                    </div>
                    <script type="text/javascript">
                      function previewImage() {
                        const fileInput = document.getElementById('fileInput');
                        const preview = document.getElementById('preview');
                      
                        if (fileInput.files && fileInput.files[0]) {
                            const reader = new FileReader();
                      
                            reader.onload = function(e) {
                              if (fileInput.files[0].type.startsWith('image')) {
                                preview.src = e.target.result;
                              }else{
                                preview.src = '/assets/images/icons/pdf.png';
                              }
                            };
                      
                            reader.readAsDataURL(fileInput.files[0]);
                        } else {
                            preview.src = '';
                        }
                      }
                      
                    </script>
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
          {'type' :'code_conduct'}
        ];
        postReq($(this),'superadmin/cms/update','#cform',formdata);
  });
    $(document).on('click','.editAdvert', function(ev){
        let e = $(this);
        let aid = e.attr('aid');
        let formdata = [{
        'id' :'aid'
        }
        ];
        postReq($(this),'superadmin/adverts/get','#edit-adverts-modal',formdata);
  });
    $(document).on('click','.editAdvert', function(ev){
        let e = $(this);
        postReq($(this),'superadmin/adverts','#edit-adverts-modal');
  });

    $(document).on('click','.deleteadvert', function(ev){
  if (!window.confirm("Do you really want to Delete Advert?")) {
            return false;
        }
        let e = $(this);
        let aid = e.attr('aid');
        let formdata = [{
        '_method' :'delete'
        }
        ];
    postReq(e,'superadmin/adverts/'+aid+'','.fform',formdata);

});

</script>
@endpush
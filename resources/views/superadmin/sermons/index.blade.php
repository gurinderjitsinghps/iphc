@extends('superadmin.layouts.app')
@section('title', 'Sermons')
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
          
          <div class="card-header border-0 pb-4">
            <span><span class="cp back-btn" style="color: inherit;">Back</span> > List of Sermons</span> 
         <div class="card-action d-flex">
              <button class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#add-sermon-modal">Add New Sermon</button>
            </div>    
          </div>
        
        <div class="car-body">
          <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
            <table id="sermons-table" class="table align-items-center table-flush stripped-cus-stable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Video</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              
               </table>
          
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

  <div class="modal fade" id="add-sermon-modal">
    <div class="modal-dialog modal-dialog-centered modal-md modal-two">
      <div class="modal-content animated bounceIn">
        <div class="modal-header border-0 mb-2">
          <h5 class="modal-title">Add Sermon</h5>
          <button type="button" class="close fs-14  ti-close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body pt-0 pb-4">
          <div class="row align-items-center">
            <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Title</label>
                      <input class="form-control" name="title" placeholder=""/>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Date</label>
                      <input class="form-control" name="date" placeholder="" type="date" />
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="input-box">
                      <label>Thumbnail</label>
                                                  <div class="image-upload-box">
                            <div class="preview-image">
                              <div class="image-preview">
                                <img id="preview" src="" alt="">
                              </div>
                            </div>
                            <div class="file-upload">
                              <input type="file" name="thumbnail" id="fileInput"  onchange="previewImage()">
                              <label for="fileInput" class="custom-file-upload mb-0 ml-3">Choose File <img src="/assets/images/icons/publish.svg"></label>
                            </div>
                          </div>
                          <script type="text/javascript">
                            function previewImage() {
                              const fileInput = document.getElementById('fileInput');
                              const preview = document.getElementById('preview');
                            
                              if (fileInput.files && fileInput.files[0]) {
                                  const reader = new FileReader();
                            
                                  reader.onload = function(e) {
                                      preview.src = e.target.result;
                                  };
                            
                                  reader.readAsDataURL(fileInput.files[0]);
                              } else {
                                  preview.src = '';
                              }
                            }
                            
                          </script>

                    </div>
                  </div>
          </div>
        </div>
                              <div class="modal-footer border-0 btnCont">
                      <button type="button" class="btn btn-danger addSermon">Submit</button>
                      {{-- <button type="button" class="btn btn-light">Reset</button> --}}
                    </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="edit-sermon-modal">
    <div class="modal-dialog modal-dialog-centered modal-md modal-two">
      <div class="modal-content animated bounceIn">
        <div class="modal-header border-0 mb-2">
          <h5 class="modal-title">Edit Sermon</h5>
          <button type="button" class="close fs-14  ti-close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body pt-0 pb-4">
          <div class="row align-items-center">
            <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Title</label>
                      <input class="form-control" name="title" placeholder=""/>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Date</label>
                      <input class="form-control" name="date" placeholder="" type="date" />
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="input-box">
                      <label>Thumbnail</label>
                                                  <div class="image-upload-box">
                            <div class="preview-image">
                              <div class="image-preview">
                                <img id="preview1" src="" alt="">
                              </div>
                            </div>
                            <div class="file-upload">
                              <input type="file" name="thumbnail" id="fileInput1"  onchange="previewImage()">
                              <label for="fileInput1" class="custom-file-upload mb-0 ml-3">Choose File <img src="/assets/images/icons/publish.svg"></label>
                            </div>
                          </div>
                          <script type="text/javascript">
                            function previewImage() {
                              const fileInput = document.getElementById('fileInput1');
                              const preview = document.getElementById('preview1');
                            
                              if (fileInput.files && fileInput.files[0]) {
                                  const reader = new FileReader();
                            
                                  reader.onload = function(e) {
                                      preview.src = e.target.result;
                                  };
                            
                                  reader.readAsDataURL(fileInput.files[0]);
                              } else {
                                  preview.src = '';
                              }
                            }
                            
                          </script>

                    </div>
                  </div>
          </div>
        </div>
                              <div class="modal-footer border-0 btnCont">
                      <button type="button" class="btn btn-danger updateSermon">Submit</button>
                      {{-- <button type="button" class="btn btn-light">Reset</button> --}}
                    </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let sermonsDatatable;
    sermonsDatatable =  $('#sermons-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'l<"toolbar">frtip',
   
   ajax: window.location.href,

        
        columns: [
            { data: 'number', name: 'number' },
            { data: 'thumbnailH', name: 'thumbnail' },
            { data: 'title', name: 'title' },
            { data: 'date', name: 'date' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
      
});
    $(document).on('click','.addSermon', function(ev){
        let e = $(this);
        let formdata = [
          {'dTable' :'#sermons-table'},
          {'bModal' :'#add-sermon-modal'}
        ];
        postReq($(this),'superadmin/sermons','#add-sermon-modal',formdata);
      

  });
    $(document).on('click','.editSermon', function(ev){
        let e = $(this);
        let sid = e.attr('sid');
        let formdata = [
          {'id':sid},
          {'bModalData' :'#edit-sermon-modal'}
        ];
        $('#edit-sermon-modal .updateSermon').attr('sid',sid);
        postReq($(this),'superadmin/sermons_get','#edit-sermon-modal',formdata);
  });
    $(document).on('click','.updateSermon', function(ev){
        let e = $(this);
        let sid = e.attr('sid');
        let formdata = [
          {'_method':'put'},
          {'dTable' :'#sermons-table'},
          {'bModal' :'#edit-sermon-modal'}
    ];
        postReq($(this),'superadmin/sermons/'+sid,'#edit-sermon-modal',formdata);
  });

    $(document).on('click','.deleteSermon', function(ev){
  if (!window.confirm("Do you really want to Delete Sermon?")) {
            return false;
        }
        let e = $(this);
        let sid = e.attr('sid');
        let formdata = [
          {'_method' :'delete'},
          {'dTable' :'#sermons-table'}
        ];
    postReq(e,'superadmin/sermons/'+sid+'','.fform',formdata);

});
$(".back-btn").click(function () {
    window.history.back();
  });
  $('#add-sermon-modal').on('hidden.bs.modal', function (e) {
    $('#add-sermon-modal .message').remove();
resetForm('#add-sermon-modal');
});
</script>
@endpush
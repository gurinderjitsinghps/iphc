@extends('superadmin.layouts.app')
@section('title', 'News Feed')
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
            <span><a href="{{ route('superadmin.news') }}" style="color: inherit;">Back</a> > List of News</span> 
         <div class="card-action d-flex">
              <button class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#add-news-modal">Add News</button>
            </div>    
          </div>
        
        <div class="car-body">
          <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
            <table id="news-table" class="table align-items-center table-flush stripped-cus-stable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Thumbnail</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Posted at</th>
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

  <div class="modal fade" id="add-news-modal">
    <div class="modal-dialog modal-dialog-centered modal-md modal-two">
      <div class="modal-content animated bounceIn">
        <div class="modal-header border-0 mb-2">
          <h5 class="modal-title">Add News</h5>
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
                      <label>Description</label>
                      <input class="form-control" name="description" placeholder=""/>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Date</label>
                      <input class="form-control" name="posted_at" placeholder="" type="date" />
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
                              <input type="file" name="thumbnail" id="fileInput" accept="image/*" onchange="previewImage()">
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
                      <button type="button" class="btn btn-danger addNews">Submit</button>
                      {{-- <button type="button" class="btn btn-light">Reset</button> --}}
                    </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="edit-news-modal">
    <div class="modal-dialog modal-dialog-centered modal-md modal-two">
      <div class="modal-content animated bounceIn">
        <div class="modal-header border-0 mb-2">
          <h5 class="modal-title">Edit News</h5>
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
                      <label>Description</label>
                      <input class="form-control" name="description" placeholder=""/>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Date</label>
                      <input class="form-control" name="posted_at" placeholder="" type="date" />
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
                              <input type="file" name="thumbnail" id="fileInput" accept="image/*" onchange="previewImage()">
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
                      <button type="button" class="btn btn-danger updateNews">Submit</button>
                      {{-- <button type="button" class="btn btn-light">Reset</button> --}}
                    </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let newsDatatable;
    newsDatatable =  $('#news-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'l<"toolbar">frtip',
   
   ajax: window.location.href,

        
        columns: [
            { data: 'number', name: 'number' },
            { data: 'thumbnailH', name: 'thumbnail' },
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'posted_at', name: 'posted_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
      
});
    $(document).on('click','.addNews', function(ev){
        let e = $(this);
        let formdata = [
          {'dTable' :'#news-table'},
          {'bModal' :'#add-news-modal'}
        ];
        postReq($(this),'superadmin/news','#add-news-modal',formdata);
      

  });
    $(document).on('click','.editNews', function(ev){
        let e = $(this);
        let sid = e.attr('sid');
        let formdata = [
          {'id':sid},
          {'bModalData' :'#edit-news-modal'}
        ];
        $('#edit-news-modal .updateNews').attr('sid',sid);
        postReq($(this),'superadmin/news_get','#edit-news-modal',formdata);
  });
    $(document).on('click','.updateNews', function(ev){
        let e = $(this);
        let sid = e.attr('sid');
        let formdata = [
          {'_method':'put'},
          {'dTable' :'#news-table'},
          {'bModal' :'#edit-news-modal'}
    ];
        postReq($(this),'superadmin/sermons/'+sid,'#edit-news-modal',formdata);
  });

    $(document).on('click','.deleteNews', function(ev){
  if (!window.confirm("Do you really want to Delete News?")) {
            return false;
        }
        let e = $(this);
        let sid = e.attr('sid');
        let formdata = [
          {'_method' :'delete'},
          {'dTable' :'#news-table'}
        ];
    postReq(e,'superadmin/news/'+sid+'','.fform',formdata);

});

</script>
@endpush
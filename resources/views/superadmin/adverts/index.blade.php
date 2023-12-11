@extends('superadmin.layouts.app')
@section('title', 'Adverts')
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
          
          <div class="card-header border-0">
            <span> List all Adverts</span> 
         <div class="card-action d-flex">
            

              <a href="#" data-toggle="modal" data-target="#add-adverts-modal" style="line-height: 28px" class="btn btn-outline-danger">Add Adverts</a>
            </div>    
          </div>
        

             <div class="modal fade" id="add-adverts-modal">
<div class="modal-dialog modal-dialog-centered modal-md modal-two">
  <div class="modal-content animated bounceIn">
    <div class="modal-header border-0 mb-2">
      <h5 class="modal-title">Add Adverts</h5>
      <button type="button" class="close fs-14  ti-close " data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true"></span>
      </button>
    </div>
    <div class="modal-body pt-0 pb-4">
      <div class="row align-items-center">
        <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Title</label>
                  <input class="form-control" name="title" placeholder="Lorem ipsum"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Details</label>
                  <textarea  class="form-control" name="details" placeholder="Lorem ipsum"></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-box mb-3">
                  <label>Seller Name</label>
                  <input class="form-control" type="text" name="seller" placeholder="Seller name"/>
                </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-box mb-3">
                  <label>Email</label>
                  <input class="form-control" type="email" name="email" placeholder="email"/>
                </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Phone</label>
                  <input class="form-control" name="phone" placeholder="Phone"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Url</label>
                  <input class="form-control" name="url" placeholder="Url"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-box mb-3">
                  <label>Start Date</label>
                  <input class="form-control" type="date" name="start_date" placeholder="21/05/2023"/>
                </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-box mb-3">
                  <label>End Date</label>
                  <input class="form-control" type="date" name="end_date" placeholder="21/05/2023"/>
                </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Cost</label>
                  <input class="form-control" name="cost" placeholder="R 50"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Image</label>
                  <div class="">
                      <div class="image-upload-box">
                        <div class="preview-image">
                          <div class="image-preview">
                            <img id="preview" src="" alt="">
                          </div>
                        </div>
                        <div class="file-upload">
                          <input type="file" multiple name="attachments[]" id="fileInput" accept="image/*" >
                          <label for="fileInput" class="custom-file-upload mb-0 ml-3">Choose File <img src="/assets/images/icons/publish.svg"></label>
                        </div>
                      </div>
                      
                    </div>
                </div>
              </div>
      </div>
    </div>
                          <div class="modal-footer border-0 btnCont">
                  <button type="button" class="btn btn-danger addAdvert">Submit</button>
                  <button type="button" class="btn btn-light resetform">Reset</button>
                </div>
  </div>
</div>
</div>


       <div class="modal fade" id="edit-adverts-modal">
<div class="modal-dialog modal-dialog-centered modal-md modal-two">
  <div class="modal-content animated bounceIn">
    <div class="modal-header border-0 mb-2">
      <h5 class="modal-title">Edit Adverts</h5>
      <button type="button" class="close fs-14  ti-close " data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true"></span>
      </button>
    </div>
    <div class="modal-body pt-0 pb-4">
      <div class="row align-items-center">
        <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Title</label>
                  <input class="form-control" name="title" placeholder="Lorem ipsum"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Details</label>
                  <input  class="form-control" name="details" placeholder="Lorem ipsum"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-box mb-3">
                  <label>Seller Name</label>
                  <input class="form-control" type="text" name="seller" placeholder="Seller name"/>
                </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-box mb-3">
                  <label>Email</label>
                  <input class="form-control" type="email" name="email" placeholder="email"/>
                </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Phone</label>
                  <input class="form-control" name="phone" placeholder="Phone"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Url</label>
                  <input class="form-control" name="url" placeholder="Url"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-box mb-3">
                  <label>Start Date</label>
                  <input class="form-control" type="date" name="start_date" placeholder="21/05/2023"/>
                </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-box mb-3">
                  <label>End Date</label>
                  <input class="form-control" type="date" name="end_date" placeholder="21/05/2023"/>
                </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Cost</label>
                  <input class="form-control" name="cost" placeholder="R 50"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-box mb-3">
                  <label>Image</label>
                  <div class="">
                      <div class="image-upload-box">
                        <div class="preview-image">
                          <div class="image-preview">
                            <img id="preview" src="" alt="">
                          </div>
                        </div>
                        <div class="file-upload">
                          <input type="file" multiple name="attachments[]" id="fileInput" accept="image/*" >
                          <label for="fileInput" class="custom-file-upload mb-0 ml-3">Choose File <img src="/assets/images/icons/publish.svg"></label>
                        </div>
                      </div>
                      
                    </div>
                </div>
              </div>
      </div>
    </div>
                          <div class="modal-footer border-0 btnCont">
                  <button type="button" class="btn btn-danger updateadvert">Update</button>
                  {{-- <button type="button" class="btn btn-light">Reset</button> --}}
                </div>
  </div>
</div>
</div>

        <div class="car-body">
          <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
            <table id="adverts-table" class="table align-items-center table-flush stripped-cus-stable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Costs</th>
                  <th>Seller Name</th>
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

    
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let usersDatatable;
    usersDatatable =  $('#adverts-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'l<"toolbar">frtip',
   
   ajax: window.location.href,

        
        columns: [
            { data: 'number', name: 'number' },
            { data: 'title', name: 'title' },
            { data: 'start_date', name: 'start_date' },
            { data: 'end_date', name: 'end_date' },
            { data: 'cost', name: 'cost' },
            { data: 'seller', name: 'seller' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
      
});
$('input[name="attachments[]"]').on('change', function () {
      previewImage($(this));
    });
    $(document).on('click','.addAdvert', function(ev){
        let e = $(this);
        postReq($(this),'superadmin/adverts','#add-adverts-modal');
  });
  //   $(document).on('click','.editAdvert', function(ev){
  //       let e = $(this);
  //       let aid = e.attr('aid');
  //       let formdata = [{
  //       'id' :'aid'
  //       }
  //       ];
  //       postReq($(this),'superadmin/adverts/get','#edit-adverts-modal',formdata);
  // });
  $(document).on('click','.editadvert', function(ev){
        let e = $(this);
        let aid = e.attr('aid');
        let formdata = [
          {'id':aid},
          {'bModalData' :'#edit-adverts-modal'}
        ];
        $('#edit-adverts-modal .updateadvert').attr('aid',aid);
        postReq($(this),'superadmin/adverts_get','#edit-adverts-modal',formdata);
  });
  $(document).on('click','.updateadvert', function(ev){
        let e = $(this);
        let aid = e.attr('aid');
        let formdata = [
          {'id':aid},
          {'_method':'put'},
          {'dTable' :'#adverts-table'},
          {'bModal' :'#edit-adverts-modal'}
    ];
        postReq($(this),'superadmin/adverts/'+aid+'','#edit-adverts-modal',formdata);
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
$('#add-adverts-modal').on('hidden.bs.modal', function (e) {
resetForm('#add-adverts-modal');
});

</script>
@endpush
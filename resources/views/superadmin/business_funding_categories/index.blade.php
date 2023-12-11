@extends('superadmin.layouts.app')
@section('title', 'Business Funding Categories')
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
              @if($currentCategory)
              <span><span class="cp back-btn" style="color: inherit;color: inherit;">Back</span> &gt; All {{ $currentCategory->name }} </span>
              @else
              <span>List All Business Funding Categories </span> 
              @endif

           <div class="card-action d-flex">
                <button class="btn btn-outline-danger addCategory" >Add Category</button>                
              </div>    
            </div>
          
          <div class="car-body">
            <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
              <table id="business-fcategories-table" class="table align-items-center table-flush stripped-cus-stable">
                <thead>
                    <tr>
                        <th>Registered Number</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Total Applications</th>
                        <th>Actions</th>
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
   
    <div class="modal fade" id="add-category-modal" typ="add">
        <div class="modal-dialog modal-dialog-centered modal-md modal-two">
          <div class="modal-content animated bounceIn">
            <div class="modal-header border-0 mb-2">
              <h5 class="modal-title">Add Category</h5>
              <button type="button" class="close fs-14  ti-close closeaeModal" >
              <span aria-hidden="true"></span>
              </button>
            </div>
            <div class="modal-body pt-0 pb-4">
              <div class="row align-items-center">
                <div class="col-sm-12">
                        <div class="input-box mb-3">
                          <label>Name</label>
                          <input class="form-control" name="name"/>
                          <input class="form-control" name="action" type="hidden" value="add"/>
                        </div>
                      </div>
                <div class="col-sm-12">
                        <div class="input-box mb-3">
                          <label>Size</label>
                          <input class="form-control" name="size"/>
                        </div>
                      </div>
                <div class="col-sm-12">
                        <div class="input-box mb-3">
                          <label>Interests</label>
                          <input class="form-control" name="interests"/>
                        </div>
                      </div>
                <div class="col-sm-12">
                        <div class="input-box mb-3">
                          <label>Inclusions</label>
                          <input class="form-control" name="inclusions"/>
                        </div>
                      </div>
                <div class="col-sm-12">
                        <div class="input-box mb-3">
                          <label>Other</label>
                          <input class="form-control" name="other"/>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="input-box">
                          <label>Thumbnail</label>
                          <div class="image-upload-box">
                                <div class="preview-image">
                                  <div class="image-preview">
                                    <img src="" alt="">
                                  </div>
                                </div>
                                <div class="file-upload">
                                  <input type="file" name="image" id="fileInput" accept="image/*" >
                                  <label for="fileInput" class="custom-file-upload mb-0 ml-3">Choose File <img src="/assets/images/icons/publish.svg"></label>
                                </div>
                              </div>
                              
    
                        </div>
                      </div>
              </div>
            </div>
            <div class="modal-footer border-0 btnCont">
    <button type="button" class="btn btn-danger submit">Submit</button>
           </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="edit-category-modal" typ="add">
        <div class="modal-dialog modal-dialog-centered modal-md modal-two">
          <div class="modal-content animated bounceIn">
            <div class="modal-header border-0 mb-2">
              <h5 class="modal-title">Edit Category</h5>
              <button type="button" class="close fs-14  ti-close closeaeModal" >
              <span aria-hidden="true"></span>
              </button>
            </div>
            <div class="modal-body pt-0 pb-4">
              <div class="row align-items-center">
                <div class="col-sm-12">
                        <div class="input-box mb-3">
                          <label>Name</label>
                          <input class="form-control" name="name"/>
                        
                        </div>
                      </div>
                <div class="col-sm-12">
                        <div class="input-box mb-3">
                          <label>Size</label>
                          <input class="form-control" name="size"/>
                        </div>
                      </div>
                <div class="col-sm-12">
                        <div class="input-box mb-3">
                          <label>Interests</label>
                          <input class="form-control" name="interests"/>
                        </div>
                      </div>
                <div class="col-sm-12">
                        <div class="input-box mb-3">
                          <label>Inclusions</label>
                          <input class="form-control" name="inclusions"/>
                        </div>
                      </div>
                <div class="col-sm-12">
                        <div class="input-box mb-3">
                          <label>Other</label>
                          <input class="form-control" name="other"/>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="input-box">
                          <label>Thumbnail</label>
                          <div class="image-upload-box">
                                <div class="preview-image">
                                  <div class="image-preview">
                                    <img src="" alt="">
                                  </div>
                                </div>
                                <div class="file-upload">
                                  <input type="file" name="image" id="fileInput1" accept="image/*" >
                                  <label for="fileInput1" class="custom-file-upload mb-0 ml-3">Choose File <img src="/assets/images/icons/publish.svg"></label>
                                </div>
                              </div>
                              
    
                        </div>
                      </div>
              </div>
            </div>
            <div class="modal-footer border-0 btnCont">
    <button type="button" class="btn btn-danger updateCategory">Update</button>
           </div>
          </div>
        </div>
      </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let businessCategoriesDatatable;
    businessCategoriesDatatable =  $('#business-fcategories-table').DataTable({
        processing: true,
        serverSide: true,
        "dom": 'lfrtip' ,
        ajax: window.location.href,
      
        columns: [
            { data: 'registered_number', name: 'registered_number' },
            { data: 'image', name: 'image' },
            { data: 'cname', name: 'name' },
            { data: 'total', name: 'total' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
});

 
$(document).on('click','.addCategory', function(ev){
  $('#add-category-modal').attr('typ','add');
  $('#add-category-modal input[name=action]').val('add');
  $('#add-category-modal .modal-body .input-box input[name="id"]').remove();
  $('#add-category-modal .modal-title').html('Add Category');
  $('#add-category-modal').modal('show');
  $('#add-category-modal input[name=name]').val('');

});

$('input[name="image"]').on('change', function () {
      previewImage($(this));
    });
$(document).on('click','.editcategory', function(ev){
        let e = $(this);
        let cid = e.parents('.acCont').attr('cid');
        let formdata = [
          {'id':cid},
          {'bModalData' :'#edit-category-modal'}
        ];
        $('#edit-category-modal .updateCategory').attr('cid',cid);
        postReq($(this),'superadmin/business_funding_categories_get','#edit-category-modal',formdata);
  });
    $(document).on('click','.updateCategory', function(ev){
        let e = $(this);
        let cid = e.attr('cid');
        let formdata = [
          {'id':cid},
          {'action':'edit'},
          {'dTable' :'#business-fcategories-table'},
          {'bModal' :'#edit-category-modal'}
    ];
        postReq($(this),'superadmin/business_funding_categories','#edit-category-modal',formdata);
  });
$(document).on('click','#add-category-modal .submit', function(ev){
  let formdata = [
          {'dTable' :'#business-fcategories-table'},
          {'bModal' :'#add-category-modal'}
        ];
        if( $('input[name=parent_id]').length){
          formdata.push({'parent_id' :$('input[name=parent_id]').val()});
        }
    postReq($(this),'superadmin/business_funding_categories','#add-category-modal',formdata);
});
$(document).on('click','#business-fcategories-table .deletecategory', function(ev){
        // console.log('ev',ev);
        let e = $(this);
        const formData = new FormData();
             let id = e.parents('.acCont').attr('cid');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (!window.confirm("Do you really want to Delete?")) {
            return false;
        }
        axios.delete(""+BASE_URL+"/superadmin/business_funding_categories/"+id+"",{
            headers: {
              "Content-Type": "multipart/form-data", // Important for file uploads
              'X-CSRF-TOKEN': csrfToken, // Include the CSRF token
            },
          })
        .then(response => {
      
                if(response.data.status){
                    businessCategoriesDatatable.ajax.reload();                  
                }
                // window.alert(response.data.message);
        
        })
        .catch(error => {
            // Handle error, e.g., show an error message or log the error
            window.alert(error.response.data.message);
        });
    
    });
    $(".back-btn").click(function () {
    window.history.back();
  });
  $('#addeditcategory-modal').on('hidden.bs.modal', function (e) {
    $('#addeditcategory-modal .message').remove();
resetForm('#addeditcategory-modal');
});
</script>
@endpush
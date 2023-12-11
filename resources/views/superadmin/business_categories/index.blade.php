@extends('superadmin.layouts.app')
@section('title', 'Business Categories')
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
            @php
            $cVal = 'main';
              if($currentCategory){
                if($currentCategory->type == 'main'){
                  $cVal = $currentCategory->slug;
                }else{
                  if($currentCategory->type == 'region'){
                    $cVal = 'branch';
                  }else{
                    $cVal =  $currentCategory->slug;
                  }
                }
              }
            @endphp
            <div class="card-header cus-card-header border-0">
              @if($currentCategory)
              <span><span class="cp back-btn" style="color: inherit;color: inherit;">Back</span> &gt; All {{ $currentCategory->name }} </span>
              @else
              <span>List All Business Categories </span> 
              @endif

           <div class="card-action d-flex">
                <button class="btn btn-outline-danger addCategory" >Add Category</button>                
              </div>    
            </div>
          
          <div class="car-body">
            <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
              <table id="business-categories-table" class="table align-items-center table-flush stripped-cus-stable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Total</th>
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
    @if($currentCategory)
    <input class="form-control" name="parent_id" type="hidden" value="{{ $currentCategory->id }}"/>
    @endif
    <div class="modal fade" id="addeditcategory-modal" typ="add">
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
                          <label>Category</label>
                          <input class="form-control" name="name"/>
                         
                          @if($currentCategory)
                          <input class="form-control" name="type" type="hidden" value="{{ $cVal }}"/>
                          {{-- <input class="form-control" name="parent_id" type="hidden" value="{{ $currentCategory->id }}"/> --}}
                          @else
                          <input class="form-control" name="type" type="hidden" value="main"/>
                          @endif
                          <input class="form-control" name="action" type="hidden" value="add"/>
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
                                  <input type="file" name="image" id="fileInput" accept="image/*" onchange="previewImage()">
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
    <button type="button" class="btn btn-danger submit">Submit</button>
           </div>
          </div>
        </div>
      </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let businessCategoriesDatatable;
    businessCategoriesDatatable =  $('#business-categories-table').DataTable({
        processing: true,
        serverSide: true,
        "dom": 'lfrtip' ,
        ajax: window.location.href,
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndexFull + 1;
            $('td:first', nRow).html(index);
        },
        columns: [
            { data: 'index', name: '#' },
            { data: 'cname', name: 'name' },
            { data: 'total', name: 'total' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
});

 
$(document).on('click','.addCategory', function(ev){
  $('#addeditcategory-modal').attr('typ','add');
  $('#addeditcategory-modal input[name=action]').val('add');
  $('#addeditcategory-modal .modal-body .input-box input[name="id"]').remove();
  $('#addeditcategory-modal .modal-title').html('Add Category');
  $('#addeditcategory-modal').modal('show');
  $('#addeditcategory-modal input[name=name]').val('');

});
$(document).on('click','.closeaeModal', function(){
  $('#addeditcategory-modal').modal('hide');
});
$(document).on('click','#business-categories-table .editcategory', function(ev){
  let e = $(this);
  let bid = e.parents('.acCont').attr('bid');
  let cVal = e.parents('.si-rw').find('td:eq(1)').text();
  $('#addeditcategory-modal').attr('typ','edit');
  $('#addeditcategory-modal input[name=action]').val('edit');
  $('#addeditcategory-modal input[name=name]').val(cVal);
  $('#addeditcategory-modal .modal-body .input-box').append(' <input class="form-control" name="id" type="hidden" value="'+bid+'"/>');
  $('#addeditcategory-modal .modal-title').html('Edit Category');
  $('#addeditcategory-modal').modal('show')
});
$(document).on('click','#addeditcategory-modal .submit', function(ev){
  let formdata = [
          {'dTable' :'#business-categories-table'},
          {'bModal' :'#addeditcategory-modal'}
        ];
        if( $('input[name=parent_id]').length){
          formdata.push({'parent_id' :$('input[name=parent_id]').val()});
        }
    postReq($(this),'superadmin/business_categories','#addeditcategory-modal',formdata);
});
$(document).on('click','#business-categories-table .deletecategory', function(ev){
        // console.log('ev',ev);
        let e = $(this);
        const formData = new FormData();
             let id = e.parents('.acCont').attr('bid');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (!window.confirm("Do you really want to Delete?")) {
            return false;
        }
        axios.delete(""+BASE_URL+"/superadmin/business_categories/"+id+"",{
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
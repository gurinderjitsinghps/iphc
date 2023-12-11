@extends('superadmin.layouts.app')
@section('title', 'Administration Role Management')
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
            $currentCategory =false;
            @endphp
            {{-- @php
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
            @endphp --}}
            <div class="card-header cus-card-header border-0">
              <span>List All Administration Roles </span> 

           <div class="card-action d-flex">
            <div >
              <select name="userRoles" id="userRoles" style="    width: 124px;
              margin-right: 10px;
              margin-top: 4px;">
               <option value="">Select Role</option>
               @foreach ($roles as $k => $role)
               <option value="{{$k}}">{{$role}}</option>
               @endforeach
               
              </select>
             </div>
                <button class="btn btn-outline-danger " href="#" data-toggle="modal" data-target="#add-user-modal">Add New User</button>
                
              </div>    
            </div>
          
          <div class="car-body">
            <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
              <table id="users-table" class="table align-items-center table-flush stripped-cus-stable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Region</th>
                        <th>Role</th>
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

    <div class="modal fade" id="add-user-modal">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-two">
        <div class="modal-content animated bounceIn">
          <div class="modal-header border-0 mb-2">
            <h5 class="modal-title">Add New User</h5>
            <button type="button" class="close fs-14  ti-close " data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
            </button>
          </div>
          <div class="modal-body pt-0 pb-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group mb-3 row align-items-center">
                  <label for="Name" class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" class="form-control" name="name" placeholder="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group mb-3 row align-items-center">
                  <label for="Name" class="col-sm-3 col-form-label">Role</label>
                  <div class="col-sm-9">
                  <div class="input-group">
                    <select type="select" name="role" class="form-control">
                      @foreach ($roles as $k => $role)
                      <option value="{{$k}}">{{$role}}</option>
                      @endforeach
                      {{-- <option>Select Role</option> --}}
                    </select>
                    <input type="hidden" name="role_level"  value="branch"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group mb-3 row align-items-center">
                  <label for="Name" class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" placeholder="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group mb-3 row align-items-center">
                  <label for="Name" class="col-sm-3 col-form-label">Phone</label>
                  <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" name="phone" class="form-control" placeholder="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group mb-3 row align-items-center">
                  <label for="Name" class="col-sm-3 col-form-label">Region/Branch</label>
                  <div class="col-sm-9">
                  <div class="input-group">
                    <select type="select" name="category_id" class="form-control">
                      @foreach ($categories as $k => $category)
                      <option typ="{{$category->type}}" @if ($k ==4)
                        {{'selected'}}
                      @endif value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                      {{-- <option>Select Role</option> --}}
                    </select>
                     </div>
                  </div>
                </div>
              </div>
              
              
            
           </div>
          </div>
                                <div class="modal-footer border-0 btnCont">
                        <button type="button" class="btn btn-danger addUser">Submit</button>
                        {{-- <button type="button" class="btn btn-light">Reset</button> --}}
                      </div>
        </div>
      </div>
    </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let usersDatatable;
    usersDatatable =  $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'l<"toolbar">frtip',
  // initComplete: function() {
  //   $("div.toolbar").html('<button type="button" id="myButton">My Button</button>');
  // },       
  ajax: {
                url:  window.location.href,
                data: function(d) {
                    d.role = $('#userRoles').val();
                }
            },
  //  ajax: window.location.href,
        // "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //     var index = iDisplayIndexFull + 1;
        //     $('td:first', nRow).html(index);
        // },
        
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'region', name: 'region' },
            { data: 'role', name: 'role' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
      
});
$('#userRoles').change(function() {
  usersDatatable.ajax.reload();
        });
$(document).on('change','select[name="role"]', function(ev){

  let e = $(this);
  var parts = e.val().split('_');
  var result = parts[0];
  let role_level = 'national';
  if(result =='nop'||result =='comforters' || result=='external'){
role_level = 'national';
  }else{
    role_level = result;
  }
  $('input[name=role_level]').val(role_level);
  $('select[name=category_id] option').show();
  if (role_level !== 'all') {
    if(role_level=='regional') role_level='region';
        $('select[name=category_id] option[typ!=' + role_level + ']').hide();
        $('select[name=category_id] option:visible:first').prop('selected', true);
      }
  console.log(result);
});
$(document).on('click','.addUser', function(ev){
        let e = $(this);
        let formdata = [
          {'dTable' :'#users-table'},
          {'bModal' :'#add-user-modal'}
        ];
        postReq($(this),'superadmin/administration_roles','#add-user-modal',formdata);
      

  });
    $(document).on('click','.deleteuser', function(ev){
  if (!window.confirm("Do you really want to Delete User?")) {
            return false;
        }
        let e = $(this);
        let uid = e.attr('uid');
        let formdata = [{
        '_method' :'delete'
        },
        {'dTable' :'#users-table'}
        ];
    postReq(e,'superadmin/administration_roles/'+uid+'','.fform',formdata);

});
$(document).on('click','.blockuser', function(ev){
  let act = $(this).attr('act');
 let butxt = (act == 0) ? 'UnBlock' : 'Block';
  if (!window.confirm("Do you really want to "+butxt+" User?")) {
            return false;
        }
        let e = $(this);
        let uid = e.attr('uid');
        let formdata = [
          {'is_blocked':act},
          {'dTable' :'#users-table'}
        ];
    postReq(e,'superadmin/administration_roles/block/'+uid+'','.fform',formdata);

});
$('#add-user-modal').on('hidden.bs.modal', function (e) {
resetForm('#add-user-modal');
});
</script>
@endpush
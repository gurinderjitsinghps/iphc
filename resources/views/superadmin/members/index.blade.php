@extends('superadmin.layouts.app')
@section('title', 'End User Management')
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
              <span>List All Members </span> 

           <div class="card-action d-flex">
                {{-- <button class="btn btn-outline-danger " href="#" data-toggle="modal" data-target="#add-user-modal">Add New User</button> --}}
                
              </div>    
            </div>
          
          <div class="car-body">
            <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
              <table id="members-table" class="table align-items-center table-flush stripped-cus-stable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Branch</th>
                        <th>Logged in At</th>
                        <th>Type</th>
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

    
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let usersDatatable;
    usersDatatable =  $('#members-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'l<"toolbar">frtip',
  // initComplete: function() {
  //   $("div.toolbar").html('<button type="button" id="myButton">My Button</button>');
  // },       
   ajax: window.location.href,
        // "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //     var index = iDisplayIndexFull + 1;
        //     $('td:first', nRow).html(index);
        // },
        
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'branch', name: 'branch' },
            { data: 'created_at', name: 'created_at' },
            { data: 'type', name: 'type' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
      
});
$(document).on('change','select[name="role"]', function(ev){

  let e = $(this);
  var parts = e.val().split('_');
  var result = parts[0];
  let role_level = 'national';
  if(result =='comforters' || result=='external'){
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
          {'dTable' :'#members-table'},
          {'bModal' :'#add-user-modal'}
        ];
        postReq($(this),'superadmin/members','#add-user-modal',formdata);
      

  });
    $(document).on('click','.deletemember', function(ev){
  if (!window.confirm("Do you really want to Delete Member?")) {
            return false;
        }
        let e = $(this);
        let uid = e.attr('uid');
        let formdata = [{
        '_method' :'delete'
        },
        {'dTable' :'#members-table'}
        ];
    postReq(e,'superadmin/members/'+uid+'','.fform',formdata);

});
$(document).on('click','.blockmember', function(ev){
  let act = $(this).attr('act');
 let butxt = (act == 0) ? 'UnBlock' : 'Block';
  if (!window.confirm("Do you really want to "+butxt+" Member?")) {
            return false;
        }
        let e = $(this);
        let uid = e.attr('uid');
        let formdata = [
          {'is_blocked':act},
          {'dTable' :'#members-table'}
        ];
    postReq(e,'superadmin/members/block/'+uid+'','.fform',formdata);

});
</script>
@endpush
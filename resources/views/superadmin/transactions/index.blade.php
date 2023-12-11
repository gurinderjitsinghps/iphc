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
          
          <div class="card-header border-0 pb-4 d-flex" style="display: flex;
justify-content: space-between;">
            <span>                <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
              <a class="nav-link active pl-0" data-toggle="pill" href="#piil-13"> <span class="hidden-xs">Donations</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#piil-14"> <span class="hidden-xs">Transactions</span></a>
            </li>
          </ul>
</span> 

         <div class="card-action d-flex">
              <!-- Default Design -->
              <div class="dropdown-container mr-3 cust-drop-container cust-drop-container2 d-flex align-items-center cust-drop-container-bx">
                <div class="dropdown-toggle click-dropdown">
                  Select Region
                </div>
                <div class="dropdown-menu">
                  <ul>
                    <li><a href="#">All</a></li>
                    <li><a href="#">Limpopo 3</a></li>
                    <li><a href="#">Mpumalanga 3</a></li>
                    <li><a href="#">Waterberg</a></li>
                  </ul>
                </div>
              </div>

            </div>    
          </div>
        <div class="card-body p-0"> 

          <!-- Tab panes -->
          <div class="tab-content p-0">
            <div id="piil-13" class="container tab-pane fade active show">
         <div class="table-responsive text-center table-dark-blue" style="padding: 0 10px">
            <table id="id2" class="table align-items-center table-flush stripped-cus-stable">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Branch</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tr class="si-rw">
                <td><img class="no-path" src="assets/images/avatars/NoPath.png">Alex</td>
                <td>alex@gmail.com</td>
                <td>Centurion</td>
                <td>21/05/2023</td>
                <td>R 2536.22</td>
                <td>
                  <a class="ml-1" href="transaction-details.html"><span class="zmdi zmdi-delete icon-eye icons text-success"></span></a>
                  <a class="ml-1" href="#" data-toggle="modal" data-target="#edit-modal"><span class="zmdi zmdi-delete text-secondary ti-import"></span></a>
                  <a class="ml-2"><span class="ti-na text-warning"></span></a>
                </td>
              </tr>
            </table>
          <div class="pt-3 pb-3 row align-items-center bg-white">
            <div class="col-lg-6 text-left">
              <p class=" show-tble-entries"> Showing 5 out of 25 entries </p>
            </div>
            <div class="col-lg-6 text-right">
              <ul class="pagination pagination-flat-primary align-items-center tble-pag">
                <li class="page-item mr-0"><a class="page-link" style="border:none !important;" href="javascript:void();">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="javascript:void();">1</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void();">2</a></li>
                <li class="page-item ml-0"><a class="page-link" style="border:none !important;" href="javascript:void();">Next</a></li>
              </ul>
            </div>
          </div>
          </div>
            </div>
            <div id="piil-14" class="container tab-pane fade">
              <div class="table-responsive table-dark-blue" style="padding: 0 10px">
                <table style="width:100% !important;" id="transactions-table" class="table align-items-center table-flush stripped-cus-stable">
              <thead>
                <tr>
                  <th>Name</th>
                  {{-- <th>Role</th> --}}
                  <th>Branch</th>
                  <th>Date</th>
                  <th>Amount</th>
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
    usersDatatable =  $('#transactions-table').DataTable({
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
            { data: 'branch', name: 'branch' },
            { data: 'service_date', name: 'service_date' },
            { data: 'amount', name: 'amount' },
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
          {'dTable' :'#transactions-table'},
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
        {'dTable' :'#transactions-table'}
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
          {'dTable' :'#transactions-table'}
        ];
    postReq(e,'superadmin/members/block/'+uid+'','.fform',formdata);

});

</script>
@endpush
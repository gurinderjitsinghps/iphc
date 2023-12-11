@extends('superadmin.layouts.app')
@section('title', 'View User')
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
            <span><a href="{{route('superadmin.administration_roles')}}" style="color: inherit;color: #CD0508;">Back</a> > {{$user->name}} ({{$user->role_name}}) Details</span>     
          </div>
        
        <div class="card-body">
           <div class="row">
              <div class="col-lg-2">
                <div class="">
                  @if($user->profile_image)
                  <img src="/storage/{{$user->profile_image}}" alt="" class="rounded-circle me-4" width="100">
                  @else
                  <img src="/assets/images/avatars/NoPath.png"  style="width: 100%">
                  @endif
                 
                  <br>
                  <button class="btn btn-danger mb-2 mt-2 deleteuser" style="width: 100%">Delete</button>
                  @if($user->is_blocked)
                  <button class="btn btn-outline-danger blockuser" act="0"  style="width: 100%">UnBlock</button>
                  @else
                  <button class="btn btn-outline-danger blockuser" act="1" style="width: 100%">Block</button>
                  @endif
                </div>
              </div>
              <div class="col-lg-10">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$user->name}}" class="form-control" placeholder="Alex">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$user->role_name}}" class="form-control" placeholder="Branch Priest">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$user->email}}" class="form-control" placeholder="astid@gmail.com">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Contact</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$user->phone}}" class="form-control" placeholder="+8125489662256">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Joined at</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$user->created_at}}" class="form-control" placeholder="20/07/2023">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="Active" class="form-control" placeholder="Active">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Branch</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$category->name}}" class="form-control" placeholder="{{$category->name}}">
                          </div>
                        </div>
                      </div>
                    </div>
                    @if($category->region)
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Region</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$category->region->name}}" class="form-control" placeholder="Pretoria">
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                    <div class="col-lg-12">
                      <div class="" style="border:none !important;">
          <div class="card-header mt-4 border-0 pb-4 pl-0">
            <span class="fs-12 inner-header-card">Work Details</span> 
          </div>
          <div class="table-responsive text-center table-dark-blue table-two">
            <table id="reports-table" class="table align-items-center table-flush stripped-cus-stable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Region</th>
                  <th>Invoice</th>
                  <th>Type</th>
                  <th>Grand total</th>
                  <th>Billing Date</th>
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

          </div>
        </div>
      </div>
    </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let reportsDatatable;
   reportsDatatable =  $('#reports-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'lfrtip',
        ajax: window.location.href,
  // initComplete: function() {
  //   $("div.toolbar").html('<button type="button" id="myButton">My Button</button>');
  // },        ajax: window.location.href,
  //       // "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
  //       //     var index = iDisplayIndexFull + 1;
  //       //     $('td:first', nRow).html(index);
  //       // },
        
        columns: [
            { data: 'number', name: '#' },
            { data: 'region', name: 'region' },
            { data: 'invoice_no', name: 'invoice_no' },
            { data: 'report_type', name: 'report_type' },
            { data: 'grand_total', name: 'grand_total' },
            { data: 'billing_date', name: 'billing_date' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
      
});

$(document).on('click','.deleteuser', function(ev){
  if (!window.confirm("Do you really want to Delete User?")) {
            return false;
        }
        let formdata = [
          {'_method':'delete'}
        ]
    postReq($(this),'superadmin/administration_roles/{{$user->id}}','.fform',formdata);

});
$(document).on('click','.blockuser', function(ev){
  let act = $(this).attr('act');
  let butxt = (act == 1) ? 'UnBlock' : 'Block';
  if (!window.confirm("Do you really want to "+butxt+" User?")) {
            return false;
        }
        let formdata = [
          {'is_blocked':act}
        ];
    postReq($(this),'superadmin/administration_roles/block/{{$user->id}}','.fform',formdata);

});
</script>
@endpush
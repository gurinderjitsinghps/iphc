@extends('superadmin.layouts.app')
@section('title', 'Team Categories')
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
            <span><span class="cp back-btn" style="color: inherit;">Back</span> >List Of Team Categories</span> 
            <div class="card-action d-flex">
              <button class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#add-team-modal">Add Team</button>
            </div>    
          </div>
        
        <div class="car-body">
          <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
            <table id="teams-table" class="table align-items-center table-flush stripped-cus-stable">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Total Membership Plans</th>
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



  <div class="modal fade" id="add-team-modal">
    <div class="modal-dialog modal-dialog-centered modal-md modal-two">
      <div class="modal-content animated bounceIn">
        <div class="modal-header border-0 mb-2">
          <h5 class="modal-title">Add Team</h5>
          <button type="button" class="close fs-14  ti-close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body pt-0 pb-4">
          <div class="row align-items-center">
            
            <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Name</label>
                      <input class="form-control" name="name" type="text" />
                    </div>
                  </div>
          </div>
        </div>
          <div class="modal-footer border-0 btnCont">
          <button type="button" class="btn btn-danger addTeam">Submit</button>
                    </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="tmp-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-two">
      <div class="modal-content animated bounceIn">
        <div class="modal-header border-0 mb-2">
          <h5 class="modal-title">Team > Membership Plans</h5>
          <button type="button" class="close fs-14  ti-close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body pt-0 pb-4">
          <div class="row align-items-center">
            
            <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Name</label>
                      <input class="form-control" name="name" type="text" />
                    </div>
              </div>
              <div class="col-sm-12 d-flex justify-content-between">
                <div>Membership Plans</div>
                 <div>
                  <div class="ml-1 cp addmpRow"  tid=""><span class="zmdi zmdi-delete text-danger ti-plus icons"></span></div>
                </div>
              </div>
              <table id="tmp-form-table" class="table align-items-center table-flush stripped-cus-stable">
                <thead>
                  <tr>
                    <th>Months</th>
                    <th>Amount Min</th>
                    <th>Amount Max</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" name="plans[0][month]" class="form-control" /></td>
                    <td><input type="text" name="plans[0][amount_min]" class="form-control" /></td>
                    <td><input type="text" name="plans[0][amount_max]" class="form-control" /></td>
                    <td><div class="ml-1 cp deletetcmp"  tid=""><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div></td>    
                  </tr>
                </tbody>
                 </table>
              
          </div>
        </div>
          <div class="modal-footer border-0 btnCont">
          <button type="button" class="btn btn-danger updatetc">Submit</button>
                    </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let teamsDatatable;
    teamsDatatable =  $('#teams-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'l<"toolbar">frtip',
   
   ajax: window.location.href,

        
        columns: [
            { data: 'name', name: 'name' },
            { data: 'plans', name: 'plans' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
      
});
$(document).on('click','.addmpRow', function(ev){
        let e = $(this);
        let countr =  $('#tmp-form-table tbody tr').length;
    $('#tmp-form-table tbody').prepend(' <tr><td><input type="text" name="plans['+countr+'][month]" class="form-control" /></td><td><input type="text" name="plans['+countr+'][amount_min]" class="form-control" /></td><td><input type="text" name="plans['+countr+'][amount_max]" class="form-control" /></td><td><div class="ml-1 cp deletetcmp"  fid=""><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div></td></tr>');
  });
    $(document).on('click','.addTeam', function(ev){
        let e = $(this);
        let formdata = [
          {'dTable' :'#teams-table'},
          {'bModal' :'#add-team-modal'}
        ];
        postReq($(this),'superadmin/teamcategories','#add-team-modal',formdata);
      

  });
  $(document).on('click','.edittc', function(ev){
        let e = $(this);
        let tid = e.attr('tid');
        let formdata = [
          {'id':tid},
          {'bModalData' :'#tmp-modal'}
        ];
        $('#tmp-modal .updatetc').attr('tid',tid);
        postReq($(this),'superadmin/teamcategories_get','#tmp-modal',formdata);
  });
    $(document).on('click','.updatetc', function(ev){
        let e = $(this);
        let tid = e.attr('tid');
        let formdata = [
          {'_method':'put'},
          {'dTable' :'#teams-table'},
          {'bModal' :'#tmp-modal'}
    ];
        postReq($(this),'superadmin/teamcategories/'+tid,'#tmp-modal',formdata);
  });

    $(document).on('click','.deletetcmp', function(ev){

        let e = $(this);
        let fid = e.attr('fid');
        if(!fid){
          e.parents('tr').remove();
          return true;
        }
        if (!window.confirm("Do you really want to Delete Team Membership Plan?")) {
            return false;
        }
        let formdata = [
          {'_method' :'delete'},
          {'dTable' :'#teams-table'}
        ];
    postReq(e,'superadmin/flgmembershipplans/'+fid+'','.fform',formdata);
    e.parents('tr').remove();
});
$(document).on('click','.deletetc', function(ev){
  if (!window.confirm("Do you really want to Delete Team Plan?")) {
    return false;
}
let e = $(this);
let tid = e.attr('tid');

let formdata = [
  {'_method' :'delete'},
  {'dTable' :'#teams-table'}
];
postReq(e,'superadmin/teamcategories/'+tid+'','.fform',formdata);

});

$(".back-btn").click(function () {
    window.history.back();
  });

  $('#add-team-modal').on('hidden.bs.modal', function (e) {
    $('#add-team-modal .message').remove();
resetForm('#add-team-modal');
});

</script>
@endpush
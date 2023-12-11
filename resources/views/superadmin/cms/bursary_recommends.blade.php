@extends('superadmin.layouts.app')
@section('title', 'Bursary  Recommends')
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
            <span><span class="cp back-btn" style="color: inherit;">Back</span> >List Of Bursary Recommends</span> 
            <div class="card-action d-flex">
              <button class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#add-bursaryr-modal">Add </button>
            </div>    
          </div>
        
        <div class="car-body">
          <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
            <table id="brs-table" class="table align-items-center table-flush stripped-cus-stable">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Location</th>
                  <th>Total Applicants</th>
                  <th>Closing Date</th>
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



  <div class="modal fade" id="add-bursaryr-modal">
    <div class="modal-dialog modal-dialog-centered modal-md modal-two">
      <div class="modal-content animated bounceIn">
        <div class="modal-header border-0 mb-2">
          <h5 class="modal-title">Add Bursary Recommend</h5>
          <button type="button" class="close fs-14  ti-close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body pt-0 pb-4">
          <div class="row align-items-center">
            
            <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Title</label>
                      <input class="form-control" name="title" type="text" />
                    </div>
                  </div>
          <div class="col-sm-12">
            <div class="input-box mb-3">
              <label>Location</label>
              <input class="form-control" name="location" type="text" />
            </div>
          </div>
    <div class="col-sm-12">
            <div class="input-box mb-3">
              <label>Closing Date</label>
              <input class="form-control" name="closing_date" type="date" />
            </div>
          </div>
        </div>

        </div>
          <div class="modal-footer border-0 btnCont">
          <button type="button" class="btn btn-danger addBr">Submit</button>
                    </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="edit-br-modal">
    <div class="modal-dialog modal-dialog-centered modal-md modal-two">
      <div class="modal-content animated bounceIn">
        <div class="modal-header border-0 mb-2">
          <h5 class="modal-title">Edit Bursary Recommend</h5>
          <button type="button" class="close fs-14  ti-close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body pt-0 pb-4">
          <div class="row align-items-center">
            
            <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Title</label>
                      <input class="form-control" name="title" type="text" />
                    </div>
                  </div>
          <div class="col-sm-12">
            <div class="input-box mb-3">
              <label>Location</label>
              <input class="form-control" name="location" type="text" />
            </div>
          </div>
    <div class="col-sm-12">
            <div class="input-box mb-3">
              <label>Closing Date</label>
              <input class="form-control" name="closing_date" type="date" />
            </div>
          </div>
        </div>

        </div>
          <div class="modal-footer border-0 btnCont">
          <button type="button" class="btn btn-danger updatebr">Submit</button>
                    </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let teamsDatatable;
    teamsDatatable =  $('#brs-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'l<"toolbar">frtip',
   
   ajax: window.location.href,

        
        columns: [
            { data: 'title', name: 'title' },
            { data: 'location', name: 'location' },
            { data: 'total', name: 'total' },
            { data: 'closing_date', name: 'closing_date' },
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
  $(document).on('click','.addBr', function(ev){
        let e = $(this);
        let formdata = [
          {'dTable' :'#brs-table'},
          {'bModal' :'#add-bursaryr-modal'}
        ];
        postReq($(this),'superadmin/bursary_recommends','#add-bursaryr-modal',formdata);
      

  });
  $(document).on('click','.editbr', function(ev){
        let e = $(this);
        let bid = e.attr('bid');
        let formdata = [
          {'id':bid},
          {'bModalData' :'#edit-br-modal'}
        ];
        $('#edit-br-modal .updatebr').attr('bid',bid);
        postReq($(this),'superadmin/bursary_recommends_get','#edit-br-modal',formdata);
  });
    $(document).on('click','.updatebr', function(ev){
        let e = $(this);
        let bid = e.attr('bid');
        let formdata = [
          {'_method':'put'},
          {'dTable' :'#brs-table'},
          {'bModal' :'#edit-br-modal'}
    ];
        postReq($(this),'superadmin/bursary_recommends/'+bid,'#edit-br-modal',formdata);
  });

    $(document).on('click','.deletebr', function(ev){
  if (!window.confirm("Do you really want to Recommendation?")) {
            return false;
        }
        let e = $(this);
        let bid = e.attr('bid');
        let formdata = [
          {'_method' :'delete'},
          {'dTable' :'#brs-table'}
        ];
    postReq(e,'superadmin/bursary_recommends/'+bid+'','.fform',formdata);

});
$(".back-btn").click(function () {
    window.history.back();
  });

  $('#add-bursaryr-modal').on('hidden.bs.modal', function (e) {
    $('#add-bursaryr-modal .message').remove();
resetForm('#add-bursaryr-modal');
});
</script>
@endpush
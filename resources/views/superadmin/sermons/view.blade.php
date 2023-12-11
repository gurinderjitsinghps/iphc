@extends('superadmin.layouts.app')
@section('title', 'Sermon')
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
            <span><a href="{{ route('superadmin.sermons') }}" style="color: inherit;">Back</a> > View Advert</span>     
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group mb-3 row align-items-center">
                  <label for="Contribute As" class="col-sm-2 col-form-label">Image</label>
                  <div class="col-sm-10">
                    <div class="image-upload-box">
                      <div class="preview-image">
                        <div class="image-preview">
                          @if($advert->attachments && $advert->attachments[0])
                          <img style="
                          width: 100%;
                          border-radius: unset !IMPORTANT;
                      " src="/storage/{{$advert->attachments[0]->file_path}}" alt="" class="rounded-circle me-4">
                          @else
                          <img src="/assets/images/avatars/NoPath.png"  style="width: 100%">
                          @endif                        </div>
                      </div>
                      
                    </div>
                    
                  </div>
                </div>
                  <div class="form-group mb-3 row align-items-center">
                    <label for="Contribute As" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <p>{{ $advert->title }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                <div class="form-group mb-3 row align-items-center">
                    <label for="Contribute As" class="col-sm-4 col-form-label">Start Date</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <p>{{ $advert->start_date }}</p>
                      </div>
                    </div>
                  </div>
                    </div>
                    <div class="col-sm-6">
                                                <div class="form-group mb-3 row align-items-center">
                    <label for="Contribute As" class="col-sm-4 col-form-label">End Date</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <p>{{ $advert->end_date }}</p>
                      </div>
                    </div>
                  </div>
                    </div>
                  </div>
                                          <div class="form-group mb-3 row align-items-center">
                    <label for="Costs" class="col-sm-2 col-form-label">Costs</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <p>{{ $advert->cost }}</p>
                      </div>
                    </div>
                  </div>

                                          <div class="form-group mb-3 row align-items-center">
                    <label for="Costs" class="col-sm-2 col-form-label">Seller Name</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <p>{{ $advert->seller }}</p>
                      </div>
                    </div>
                  </div>

                                          <div class="form-group mb-3 row align-items-center">
                    <label for="Costs" class="col-sm-2 col-form-label">Emailer Address</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <p>{{ $advert->email }}</p>
                      </div>
                    </div>
                  </div>

                                          <div class="form-group mb-3 row align-items-center">
                    <label for="Costs" class="col-sm-2 col-form-label">Phone Number</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <p>{{ $advert->phone }}</p>
                      </div>
                    </div>
                  </div>
                  {{-- <div class="form-group mb-3 row align-items-center">
                    <div class="offset-md-2 col-sm-10">
                      <button class="btn btn-danger mb-2 mt-2 pl-5 pr-5">Save</button>
                    </div>
              </div> --}}
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
<!-- End container-fluid-->
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
    postReq($(this),'superadmin/administration_roles/{{$advert->id}}','.fform',formdata);

});
$(document).on('click','.blockuser', function(ev){
  if (!window.confirm("Do you really want to Block User?")) {
            return false;
        }
        let act = $(this).attr('act');
        let formdata = [
          {'is_blocked':act}
        ];
    postReq($(this),'superadmin/administration_roles/block/{{$advert->id}}','.fform',formdata);

});
</script>
@endpush
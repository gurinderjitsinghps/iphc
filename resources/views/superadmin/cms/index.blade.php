@extends('superadmin.layouts.app')
@section('title', 'CMS')
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
            <span>Content Management System</span> 
          </div>
        
        <div class="car-body">
          <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
            <table id="id2" class="table align-items-center table-flush stripped-cus-stable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Page List</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tr class="si-rw">
                <td>1</td>
                <td>End User Application</td>
                <td>
                  <a class="ml-1" href="{{ route('superadmin.cms','t=user') }}"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></a>
                </td>
              </tr>
              <tr class="si-rw">
                <td>1</td>
                <td>IPHC admin System</td>
                <td>
                  <a class="ml-1" href="{{ route('superadmin.cms','t=admin') }}"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></a>
                </td>
              </tr>
            </table>
          <div class="pt-3">
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
    $(document).on('click','.addAdvert', function(ev){
        let e = $(this);
        postReq($(this),'superadmin/adverts','#add-adverts-modal');
  });
    $(document).on('click','.editAdvert', function(ev){
        let e = $(this);
        let aid = e.attr('aid');
        let aid = e.attr('aid');
        let formdata = [{
        'id' :'aid'
        }
        ];
        postReq($(this),'superadmin/adverts/get','#edit-adverts-modal',formdata);
  });
    $(document).on('click','.editAdvert', function(ev){
        let e = $(this);
        postReq($(this),'superadmin/adverts','#edit-adverts-modal');
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

</script>
@endpush
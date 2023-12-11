@extends('superadmin.layouts.app')
@section('title', 'Business Categories > Businesses')
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
              <span><a href="{{route('superadmin.business_categories')}}" style="color: inherit;color: inherit;">Back</a> &gt; All {{ $currentCategory->name }} > Businesses</span>
              @else
              <span>List Businesses </span> 
              @endif

           <div class="card-action d-flex">
                {{-- <button class="btn btn-outline-danger addCategory" >Add Category</button>                 --}}
              </div>    
            </div>
          
          <div class="car-body">
            <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
              <table id="business-categories-table" class="table align-items-center table-flush stripped-cus-stable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Owner Address</th>
                        <th>Website</th>
                        <th>Services</th>
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
  let businessCategoriesDatatable;
    businessCategoriesDatatable =  $('#business-categories-table').DataTable({
        processing: true,
        serverSide: true,
        "dom": 'lfrtip' ,
        ajax: window.location.href,
        columns: [
            { data: 'name', name: 'name' },
            { data: 'type', name: 'type' },
            { data: 'email', name: 'email' },
            { data: 'owner_address', name: 'owner_address' },
            { data: 'website', name: 'website' },
            { data: 'services_offered', name: 'services_offered' },
            // { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
});

 

$(document).on('click','.closeaeModal', function(){
  $('#addeditcategory-modal').modal('hide');
});

</script>
@endpush
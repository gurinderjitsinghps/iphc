@extends('superadmin.layouts.app')
@section('title', 'Business Funding Categories > Funding Applications')
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
              <span><a href="{{route('superadmin.business_funding_categories')}}" style="color: inherit;color: inherit;">Back</a> &gt; All {{ $currentCategory->name }} > Funding Applications</span>
              @else
              <span>List Business Funding Categories > Funding Applications </span> 
              @endif

           <div class="card-action d-flex">
                {{-- <button class="btn btn-outline-danger addCategory" >Add Category</button>                 --}}
              </div>    
            </div>
          
          <div class="car-body">
            <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
              <table id="business-fcategories-table" class="table align-items-center table-flush stripped-cus-stable">
                <thead>
                    <tr>
                        <th>Organization Name</th>
                        <th>Organization Address</th>
                        <th>SSn/TIN</th>
                        <th>Website</th>
                        <th>President</th>
                        <th>Project Name</th>
                        <th>Total Budget</th>
                        <th>Requested Amount</th>
                        <th>Percent Of budget</th>
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
    businessCategoriesDatatable =  $('#business-fcategories-table').DataTable({
        processing: true,
        serverSide: true,
        "dom": 'lfrtip' ,
        ajax: window.location.href,
      
        columns: [
            { data: 'oragnization_name', name: 'oragnization_name' },
            { data: 'oragnization_address', name: 'oragnization_address' },
            { data: 'ssn_tin', name: 'ssn_tin' },
            { data: 'oragnization_website', name: 'oragnization_website' },
            { data: 'oragnization_president', name: 'oragnization_president' },
            { data: 'project_name', name: 'project_name' },
            { data: 'total_budget', name: 'total_budget' },
            { data: 'requested_amount', name: 'requested_amount' },
            { data: 'total_budget_percentage', name: 'total_budget_percentage' },
            // { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
});

$(document).on('click','.closeaeModal', function(){
  $('#add-category-modal').modal('hide');
});
</script>
@endpush
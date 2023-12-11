@extends('superadmin.layouts.app')
@section('title', 'View Member')
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
            <span><a href="{{route('superadmin.transactions')}}" style="color: inherit;color: #CD0508;">Back</a> > {{$transaction->name}}  Details</span>     
          </div>
        
        <div class="card-body">
           <div class="row">
              <div class="col-lg-2">
                <div class="">
                  @if($transaction->profile_image)
                  <img src="/storage/{{$transaction->profile_image}}" alt="" class="rounded-circle me-4" width="100">
                  @else
                  <img src="/assets/images/avatars/NoPath.png"  style="width: 100%">
                  @endif
                 
                  <br>
                  <button class="btn btn-danger mb-2 mt-2 deletemember" style="width: 100%">Delete</button>

                </div>
              </div>
              <div class="col-lg-10">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$transaction->name}}" class="form-control" placeholder="Alex">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$transaction->amount}}" class="form-control" placeholder="Branch Priest">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$transaction->service_date}}" class="form-control" placeholder="astid@gmail.com">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Branch</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$transaction->branch->name}}" class="form-control" placeholder="">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Approved</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$transaction->is_approved ? 'Yes' : 'No'}}" class="form-control" placeholder="">
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
    </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
 
$(document).on('click','.deletemember', function(ev){
  if (!window.confirm("Do you really want to Delete Member?")) {
            return false;
        }
        let formdata = [
          {'_method':'delete'}
        ]
    postReq($(this),'superadmin/transactions/{{$transaction->id}}','.fform',formdata);

});
$(document).on('click','.blockmember', function(ev){
  let act = $(this).attr('act');
  let butxt = (act == 0) ? 'UnBlock' : 'Block';
  if (!window.confirm("Do you really want to "+butxt+" Member?")) {
            return false;
        }
        let formdata = [
          {'is_blocked':act}
        ];
    postReq($(this),'superadmin/transactions/block/{{$transaction->id}}','.fform',formdata);

});
</script>
@endpush
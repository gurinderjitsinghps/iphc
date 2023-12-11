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
            <span><a href="{{route('superadmin.members')}}" style="color: inherit;color: #CD0508;">Back</a> > {{$member->name}}  Details</span>     
          </div>
        
        <div class="card-body">
           <div class="row">
              <div class="col-lg-2">
                <div class="">
                  @if($member->profile_image)
                  <img src="/storage/{{$member->profile_image}}" alt="" class="rounded-circle me-4" width="100">
                  @else
                  <img src="/assets/images/avatars/NoPath.png"  style="width: 100%">
                  @endif
                 
                  <br>
                  <button class="btn btn-danger mb-2 mt-2 deletemember" style="width: 100%">Delete</button>
                  @if($member->is_blocked)
                  <button class="btn btn-outline-danger blockmember" act="0"  style="width: 100%">UnBlock</button>
                  @else
                  <button class="btn btn-outline-danger blockmember" act="1" style="width: 100%">Block</button>
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
                          <input type="text" readonly value="{{$member->name}}" class="form-control" placeholder="Alex">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$member->name}}" class="form-control" placeholder="Branch Priest">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$member->email}}" class="form-control" placeholder="astid@gmail.com">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$member->address}}" class="form-control" placeholder="+8125489662256">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">City</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$member->city}}" class="form-control" placeholder="+8125489662256">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">State</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$member->state}}" class="form-control" placeholder="+8125489662256">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Zipcode</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$member->zipcode}}" class="form-control" placeholder="+8125489662256">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Contact</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$member->phone}}" class="form-control" placeholder="+8125489662256">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Joined at</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$member->created_at}}" class="form-control" placeholder="20/07/2023">
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
                          <input type="text" readonly value="{{$member->branch->name}}" class="form-control" placeholder="{{$member->branch->name}}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 row align-items-center">
                        <label for="Name" class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" readonly value="{{$member->type->name}}" class="form-control" placeholder="{{$member->type->name}}">
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
    postReq($(this),'superadmin/members/{{$member->id}}','.fform',formdata);

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
    postReq($(this),'superadmin/members/block/{{$member->id}}','.fform',formdata);

});
</script>
@endpush
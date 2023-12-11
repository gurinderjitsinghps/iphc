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
          
          <div class="card-header border-0 pb-4">
            <span><a href="{{ route('superadmin.cms') }}" style="color: inherit;">Back</a> >List Of Questionaire</span> 
         <div class="card-action d-flex">
              {{-- <button class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#add-sermon-modal">Answered Questions</button> --}}
            </div>    
          </div>
        
        <div class="car-body">
          <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
            <table id="qas-table" class="table align-items-center table-flush stripped-cus-stable">
              <thead>
                <tr>
                  <th>User Name</th>
                  <th>Question</th>
                  <th>Answer</th>
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



  <div class="modal fade" id="qa-modal">
    <div class="modal-dialog modal-dialog-centered modal-md modal-two">
      <div class="modal-content animated bounceIn">
        <div class="modal-header border-0 mb-2">
          <h5 class="modal-title">Add Answer</h5>
          <button type="button" class="close fs-14  ti-close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body pt-0 pb-4">
          <div class="row align-items-center">
            <div class="col-sm-12">
              <div class="input-box mb-3">
                <label>Question</label>
                <p class="mques"></p>
              </div>
            </div>
            <div class="col-sm-12">
                    <div class="input-box mb-3">
                      <label>Answer</label>
                      <textarea class="form-control" name="answer" ></textarea>
                    </div>
                  </div>
                  
                  
          </div>
        </div>
          <div class="modal-footer border-0 btnCont">
          <button type="button" class="btn btn-danger updateqa">Submit</button>
                    </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script defer>
  let qasDatatable;
    qasDatatable =  $('#qas-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'l<"toolbar">frtip',
   
   ajax: window.location.href,

        
        columns: [
            { data: 'user.name', name: 'user.name' },
            { data: 'question', name: 'question' },
            { data: 'answer', name: 'answer' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
      
});
    $(document).on('click','.addSermon', function(ev){
        let e = $(this);
        let formdata = [
          {'dTable' :'#qas-table'},
          {'bModal' :'#add-sermon-modal'}
        ];
        postReq($(this),'superadmin/sermons','#add-sermon-modal',formdata);
      

  });
    $(document).on('click','.editqa', function(ev){
        let e = $(this);
        let qid = e.attr('qid');
        $('#qa-modal').modal('show'); 
        $('#qa-modal .updateqa').attr('qid',qid);
        let ques = e.parents('tr.si-rw').find('td:eq(1)').html();
        let ans = e.parents('tr.si-rw').find('td:eq(2)').html();
        $('#qa-modal .mques').html(ques);
        $('#qa-modal textarea[name="answer"]').val(ans);
        
  });
    $(document).on('click','.updateqa', function(ev){
        let e = $(this);
        let qid = e.attr('qid');
        let formdata = [
          {'_method':'put'},
          {'id' :qid},
          {'dTable' :'#qas-table'},
          {'bModal' :'#qa-modal'}
    ];
        postReq($(this),'superadmin/qas/','#qa-modal',formdata);
  });

    $(document).on('click','.deleteqa', function(ev){
  if (!window.confirm("Do you really want to Delete QA?")) {
            return false;
        }
        let e = $(this);
        let qid = e.attr('qid');
        let formdata = [
          {'_method' :'delete'},
          {'dTable' :'#qas-table'}
        ];
    postReq(e,'superadmin/qas/'+qid+'','.fform',formdata);

});

</script>
@endpush
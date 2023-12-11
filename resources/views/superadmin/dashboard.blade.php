@extends('superadmin.layouts.app')
@section('title', 'Dashboard')
@push('styles')
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<style type="text/css">
    .table.align-items-center td {
    border-bottom: 2px solid #edecec;
    }
  </style>
@endpush
@push('scripts')
 <!-- simplebar js -->
 <script src="/assets/plugins/simplebar/js/simplebar.js"></script>
 <!-- waves effect js -->
 <script src="/assets/js/waves.js"></script>
 <!-- sidebar-menu js -->
 <script src="/assets/js/sidebar-menu.js"></script>
 <!-- Custom scripts -->
 <script src="/assets/js/app-script.js"></script>
 <!-- Vector map JavaScript -->
 <script src="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
 <script src="/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
 <!-- Chart js -->
 <script src="/assets/plugins/Chart.js/Chart.min.js"></script>
 <script src="/assets/plugins/Chart.js/Chart.extension.js"></script>
 <!-- Index js -->
 <script src="/assets/js/index.js"></script>
 <!-- Bootstrap core CSS-->
 <link rel="stylesheet" href="/assets/plugins/c3/css/c3.min.css">
 <!-- c3 Charts -->
 <script src="/assets/plugins/d3/d3.min.js"></script>
 <script src="/assets/plugins/c3/js/c3.min.js"></script>
 <script src="/assets/plugins/c3/js/c3.js"></script>
 <script type="text/javascript">
   // Get all the dropdown from document
   document.querySelectorAll('.dropdown-toggle').forEach(dropDownFunc);
   
   // Dropdown Open and Close function
   function dropDownFunc(dropDown) {
       console.log(dropDown.classList.contains('click-dropdown'));
   
       if(dropDown.classList.contains('click-dropdown') === true){
           dropDown.addEventListener('click', function (e) {
               e.preventDefault();        
       
               if (this.nextElementSibling.classList.contains('dropdown-active') === true) {
                   // Close the clicked dropdown
                   this.parentElement.classList.remove('dropdown-open');
                   this.nextElementSibling.classList.remove('dropdown-active');
       
               } else {
                   // Close the opend dropdown
                   closeDropdown();
       
                   // add the open and active class(Opening the DropDown)
                   this.parentElement.classList.add('dropdown-open');
                   this.nextElementSibling.classList.add('dropdown-active');
               }
           });
       }
   
       if(dropDown.classList.contains('hover-dropdown') === true){
   
           dropDown.onmouseover  =  dropDown.onmouseout = dropdownHover;
   
           function dropdownHover(e){
               if(e.type == 'mouseover'){
                   // Close the opend dropdowns
                   closeDropdown();
   
                   // add the open and active class(Opening the DropDown)
                   this.parentElement.classList.add('dropdown-open');
                   this.nextElementSibling.classList.add('dropdown-active');
                   
               }
   
               // if(e.type == 'mouseout'){
               //     // close the dropdown after user leave the list
               //     e.target.nextElementSibling.onmouseleave = closeDropdown;
               // }
           }
       }
   
   };
   
   
   // Listen to the doc click
   window.addEventListener('click', function (e) {
   
       // Close the menu if click happen outside menu
       if (e.target.closest('.dropdown-container') === null) {
           // Close the opend dropdown
           closeDropdown();
       }
   
   });
   
   
   // Close the openend Dropdowns
   function closeDropdown() { 
       console.log('run');
       
       // remove the open and active class from other opened Dropdown (Closing the opend DropDown)
       document.querySelectorAll('.dropdown-container').forEach(function (container) { 
           container.classList.remove('dropdown-open')
       });
   
       document.querySelectorAll('.dropdown-menu').forEach(function (menu) { 
           menu.classList.remove('dropdown-active');
       });
   }
   
   // close the dropdown on mouse out from the dropdown list
   document.querySelectorAll('.dropdown-menu').forEach(function (dropDownList) { 
       // close the dropdown after user leave the list
       dropDownList.onmouseleave = closeDropdown;
   });
   
 </script>
@endpush
@section('content')
<div class="content-wrapper mt-3">
    <div class="container-fluid">
      <!--Start Dashboard Content-->
      <div class="row mt-3">
        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card red-card border-left-sm">
            <div class="card-body card_body">
              <div class="media align-items-center">
                <div class="media-body text_info text-left">
                  <h4 class="text-info mb-0"><img src="/assets/images/icons/crowdsource.svg"> <span>Total Donations</span></h4>
                  <div class="text_bottom_info"><span>R {{$donations}}</span> <img src="/assets/images/icons/monitorings.svg"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card yellow-card border-left-sm">
            <div class="card-body card_body">
              <div class="media align-items-center">
                <div class="media-body text_info text-left">
                  <h4 class="text-info mb-0"><img src="/assets/images/icons/unique-visitor.png"> <span>Visitors</span></h4>
                  <div class="text_bottom_info"><span>{{$visitors}}</span> <img src="/assets/images/icons/database.svg"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card yellow-card border-left-sm">
            <div class="card-body card_body">
              <div class="media align-items-center">
                <div class="media-body text_info text-left">
                  <h4 class="text-info mb-0"><img src="/assets/images/icons/box.png"> <span>Expenditure</span></h4>
                  <div class="text_bottom_info"><span>R  {{$total_expenditure}}</span> <img src="/assets/images/icons/sales.png"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
          <div class="card yellow-card border-left-sm">
            <div class="card-body card_body">
              <div class="media align-items-center">
                <div class="media-body text_info text-left">
                  <h4 class="text-info mb-0"><img src="/assets/images/icons/lab_profile.svg"> <span>Reports</span></h4>
                  <div class="text_bottom_info"><span>{{ $reports_count }}</span> <img src="/assets/images/icons/sales.png"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--End Row-->
      <div class="row">
        <div class="col-lg-8">
          <div class="card card-dark-blue" style="border:none !important;">
            <div class="card-header card_header border-0">
              <span>Submissions Report </span>
              <div class="card-action d-flex">
                <!-- Default Design -->
                <div class="dropdown-container mr-3 cust-drop-container cust-drop-container2 d-flex align-items-center cust-drop-container-bx cust-drop-container-wrap">
                  <div class="dropdown-toggle click-dropdown">
                    Select Region
                  </div>
                  <div class="dropdown-menu">
                    <ul>
                      @foreach ($regions as $region)
                      <li><a href="#">{{$region->name}}</a></li>
                      @endforeach
                     
                    </ul>
                  </div>
                </div>
                <input type="date" class="form-control date-control" name="" placeholder="2023">
              </div>
            </div>
            <div class="card-body pt-0">
              <ul class="nav nav-pills nav-pills-info" role="tablist">
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#piil-13"><span class="hidden-xs">Region</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="pill" href="#piil-14">National</span></a>
                </li>
                <div></div>
              </ul>
              <div class="tab-content">
                <div id="piil-13" class="container tab-pane fade active show">
                  <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                </div>
                <div id="piil-14" class="container tab-pane">
                  <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
                </div>
              </div>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
              <script>
                const xValues = [100,200,300,400,500,600,700,800,900,1000];
                
                new Chart("myChart", {
                  type: "line",
                  data: {
                    labels: xValues,
                    datasets: [{ 
                      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
                      borderColor: "red",
                      fill: false
                    }, { 
                      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
                      borderColor: "green",
                      fill: false
                    }, { 
                      data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
                      borderColor: "blue",
                      fill: false
                    }]
                  },
                  options: {
                    legend: {display: false}
                  }
                });
              </script>
              <script>
                const xValues2 = [100,200,300,400,500,600,700,800,900,1000];
                
                new Chart("myChart2", {
                  type: "line",
                  data: {
                    labels: xValues2,
                    datasets: [{ 
                      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
                      borderColor: "red",
                      fill: false
                    }, { 
                      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
                      borderColor: "green",
                      fill: false
                    }, { 
                      data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
                      borderColor: "blue",
                      fill: false
                    }]
                  },
                  options: {
                    legend: {display: false}
                  }
                });
              </script>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-dark-blue" style="border:none !important;">
            <div class="card-header border-0">
              <span>Expenditure by Category </span>
              <div class="d-flex mt-2">
                <!-- Default Design -->
                <div class="dropdown-container mr-3 cust-drop-container cust-drop-container2 d-flex align-items-center cust-drop-container-bx cust-drop-container-wrap">
                  <div class="dropdown-toggle click-dropdown">
                    Select Region
                  </div>
                  <div class="dropdown-menu">
                    <ul>
                      @foreach ($regions as $region)
                      <li><a href="#">{{$region->name}}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                <input type="date" class="form-control date-control" name="" placeholder="2023">
              </div>
            </div>
            <div class="card-body pt-0">
              <canvas id="myChart3" style="width:100%;max-width:600px"></canvas>
              <script>
                var xValues3 = ["Rent", "Maintenance", "Regional", "Transport", "Instrument", "Others"];
                var yValues3 = [55, 49, 44, 24, 15];
                var barColors = [
                  "#b91d47",
                  "#00aba9",
                  "#CD0508;",
                  "#172074",
                  "#2F7099"
                ];
                
                new Chart("myChart3", {
                  type: "doughnut",
                  data: {
                    labels: xValues3,
                    datasets: [{
                      backgroundColor: barColors,
                      data: yValues3
                    }]
                  },
                  options: {
                    title: {
                      display: true,
                      text: "World Wide Wine Production 2018"
                    }
                  }
                });
              </script>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card card-dark-blue" style="border:none !important;">
            <div class="card-header card_header border-0">
              <span>Church Donations </span>
              <div class="card-action d-flex">
                <input type="date" class="form-control date-control mr-3" name="" placeholder="2023">
                <!-- Default Design -->
                <div class="dropdown-container cust-drop-container cust-drop-container2 d-flex align-items-center cust-drop-container-bx cust-drop-container-wrap">
                  <div class="dropdown-toggle click-dropdown">
                    Select Region
                  </div>
                  <div class="dropdown-menu">
                    <ul>
                      @foreach ($regions as $region)
                    <li><a href="#">{{$region->name}}</a></li>
                    @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
              <canvas id="myChart4" style="width:100%;max-width:600px;"></canvas>
              <script>
                var xValues4 = ["Jan", "Feb", "Mar", "Apr", "May"];
                var yValues4 = [55, 49, 44, 24, 15];
                var barColors4 = ["#F91717", "#F91717","#F91717","#F91717","#F91717"];
                
                new Chart("myChart4", {
                  type: "bar",
                  data: {
                    labels: xValues4,
                    datasets: [{
                      backgroundColor: barColors4,
                      data: yValues4
                    }]
                  },
                  options: {
                    legend: {display: false},
                    title: {
                      display: true,
                      text: "World Wine Production 2018"
                    }
                  }
                });
              </script>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card card-dark-blue" style="border:none !important;">
            <div class="card-header card_header border-0">
              <span>Daily Transactions </span>
              {{-- <a class="delete-notification d-block" href="#"><span class="text-danger fs-12">See all</span></a>  --}}
            </div>
            <div class="card-body pt-0">
              <div class="notification-box Transactions-wrap">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <div class="left-content">
                      <img src="/assets/images/avatars/noPath.png">
                      <div class="info-bx">
                        <h4>Mathew J</h4>
                        <p class="text-black">Transaction ID -2563569956</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <p class="date_info">Tue, 28 Jun 2023</p>
                    <a class="delete-notification d-block" href="#"><span class="text-danger fs-12">More --></span></a>
                  </div>
                </div>
              </div>
              <div class="notification-box Transactions-wrap">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <div class="left-content">
                      <img src="/assets/images/avatars/noPath.png">
                      <div class="info-bx">
                        <h4>Mathew J</h4>
                        <p class="text-black">Transaction ID -2563569956</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <p class="date_info">Tue, 28 Jun 2023</p>
                    <a class="delete-notification d-block" href="#"><span class="text-danger fs-12">More --></span></a>
                  </div>
                </div>
              </div>
              <div class="notification-box Transactions-wrap">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <div class="left-content">
                      <img src="/assets/images/avatars/noPath.png">
                      <div class="info-bx">
                        <h4>Mathew J</h4>
                        <p class="text-black">Transaction ID -2563569956</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <p class="date_info">Tue, 28 Jun 2023</p>
                    <a class="delete-notification d-block" href="#"><span class="text-danger fs-12">More --></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-dark-blue" style="border:none !important;">
            <div class="card-header border-0 pb-2">
              <span>List of Administration Users</span> 
              <div class="card-action d-flex align-items-center">
               
                <!-- Default Design -->
                <div >
                  <select name="userRoles" id="userRoles" style="    width: 124px;
                  margin-right: 10px;
                  margin-top: 4px;">
                   <option value="">Select Role</option>
                   @foreach ($roles as $k => $role)
                   <option value="{{$k}}">{{$role}}</option>
                   @endforeach
                   
                  </select>
                 </div>
                <a class="delete-notification d-block" href="{{ route('superadmin.administration_roles') }}"><span class="text-danger fs-12">See all</span></a>
              </div>
            </div>
            <div class="table-responsive table-dark-blue" style="padding: 0 20px">
              <table id="users-table" class="table align-items-center table-flush stripped-cus-stable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Region</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
            <br>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-dark-blue" style="border:none !important;">
            <div class="card-header border-0 pb-2">
              <span>Recent Users</span> 
                <div class="card-action d-flex align-items-center">
               
                {{-- <a class="delete-notification d-block" href="end-user-management.html"><span class="text-danger fs-12">See all</span></a> --}}
              </div>
            </div>
            <div class="table-responsive text-center table-dark-blue" style="padding: 0 20px">
              <table id="id2" class="table align-items-center table-flush stripped-cus-stable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Branch</th>
                    <th>Region</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody><tr class="si-rw">
                  <td><img class="no-path" src="/assets/images/avatars/NoPath.png"></td>
                  <td>Anderson</td>
                  <td>Witern</td>
                  <td>Preto</td>
                  <td>xyz@gmail.com</td>
                  <td><span class="text-danger fs-14">Member</span></td>
                  <td>
                    <a class="ml-1" href="user-details.html"><span class="zmdi zmdi-delete icon-eye icons text-success"></span></a>
                    <a class="ml-1" href="#"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></a>
                  </td>
                </tr>
              </tbody></table>
            <br>
            </div>
          </div>
        </div>
      </div>
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
  let usersDatatable;
    usersDatatable =  $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'l<"toolbar">frtip',
  // initComplete: function() {
  //   $("div.toolbar").html('<button type="button" id="myButton">My Button</button>');
  // },       
  //  ajax: window.location.href,
  ajax: {
                url:  window.location.href,
                data: function(d) {
                    d.role = $('#userRoles').val();
                }
            },
        // "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //     var index = iDisplayIndexFull + 1;
        //     $('td:first', nRow).html(index);
        // },
        
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'region', name: 'region' },
            { data: 'role', name: 'role' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
      
});
$('#userRoles').change(function() {
  usersDatatable.ajax.reload();
        });
$(document).on('change','select[name="role"]', function(ev){

  let e = $(this);
  var parts = e.val().split('_');
  var result = parts[0];
  let role_level = 'national';
  if(result =='comforters' || result=='external'){
role_level = 'national';
  }else{
    role_level = result;
  }
  $('input[name=role_level]').val(role_level);
  $('select[name=category_id] option').show();
  if (role_level !== 'all') {
    if(role_level=='regional') role_level='region';
        $('select[name=category_id] option[typ!=' + role_level + ']').hide();
        $('select[name=category_id] option:visible:first').prop('selected', true);
      }
  console.log(result);
});
$(document).on('click','.addUser', function(ev){
        let e = $(this);
        let formdata = [
          {'dTable' :'#users-table'},
          {'bModal' :'#add-user-modal'}
        ];
        postReq($(this),'superadmin/administration_roles','#add-user-modal',formdata);
      

  });
    $(document).on('click','.deleteuser', function(ev){
  if (!window.confirm("Do you really want to Delete User?")) {
            return false;
        }
        let e = $(this);
        let uid = e.attr('uid');
        let formdata = [{
        '_method' :'delete'
        },
        {'dTable' :'#users-table'}
        ];
    postReq(e,'superadmin/administration_roles/'+uid+'','.fform',formdata);

});
$(document).on('click','.blockuser', function(ev){
  let act = $(this).attr('act');
 let butxt = (act == 0) ? 'UnBlock' : 'Block';
  if (!window.confirm("Do you really want to "+butxt+" User?")) {
            return false;
        }
        let e = $(this);
        let uid = e.attr('uid');
        let formdata = [
          {'is_blocked':act},
          {'dTable' :'#users-table'}
        ];
    postReq(e,'superadmin/administration_roles/block/'+uid+'','.fform',formdata);

});
</script>
@endpush
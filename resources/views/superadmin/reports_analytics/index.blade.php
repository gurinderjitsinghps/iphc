@extends('superadmin.layouts.app')
@section('title', 'Report & Analytics')
@section('content')
@push('styles')
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush
<div class="content-wrapper mt-3">
  <div class="container-fluid">
    <!--Start Dashboard Content-->
    <div class="row mt-3">
      <div class="col-12 col-lg-6 col-xl-3">
        <div class="card red-card border-left-sm blue-border-card">
          <div class="card-body card_body">
            <div class="media align-items-center">
              <div class="media-body text_info text-left">
                <h4 class="text-info mb-0"><img src="/assets/images/icons/crowdsource2.svg"> <span>Total Donations</span></h4>
                <div class="text_bottom_info"><span>R {{ $donations }}</span> <img src="/assets/images/icons/monitoring2.svg"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-3">
        <div class="card yellow-card border-left-sm blue-border-card">
          <div class="card-body card_body">
            <div class="media align-items-center">
              <div class="media-body text_info text-left">
                <h4 class="text-info mb-0"><img src="/assets/images/icons/unique-visitor.png"> <span>Visitors</span></h4>
                <div class="text_bottom_info"><span>{{ $visitors }}</span> <img src="/assets/images/icons/database.svg"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-3">
        <div class="card yellow-card border-left-sm blue-border-card">
          <div class="card-body card_body">
            <div class="media align-items-center">
              <div class="media-body text_info text-left">
                <h4 class="text-info mb-0"><img src="/assets/images/icons/box.png"> <span>Expenditure</span></h4>
                <div class="text_bottom_info"><span>R  {{ $total_expenditure }}</span> <img src="/assets/images/icons/sales.png"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-3">
        <div class="card yellow-card border-left-sm blue-border-card">
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
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-dark-blue" style="border:none !important;">
          <div class="card-header card_header border-0">
            <span>Church Donations </span>
            <div class="card-action d-flex">
              <!-- Default Design -->
              <select name="dregion" id="" class="form-control">
                <option value="all">Select Region</option>
                @foreach ($regions as $region)
                <option value="{{ $region->id }}">{{$region->name}}</option>
                    @endforeach
               
              </select>
              {{-- <div class="dropdown-container mr-3 cust-drop-container cust-drop-container2 d-flex align-items-center cust-drop-container-bx cust-drop-container-wrap">
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
              </div> --}}
              <input type="date" class="form-control date-control" name="dyear" placeholder="2023">
            </div>
          </div>
          <div class="card-body pt-0">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <canvas id="myChart4" style="width:100%;max-width:600px"></canvas>
            
          </div>
        </div>
      </div>
      

    
      <div class="col-lg-8">
        <div class="card card-dark-blue" style="border:none !important;">
          <div class="card-header card_header border-0">
            <span>Monthly Expenditure</span>
            <div class="d-flex mt-2">
              <!-- Default Design -->
              <select name="eregion" id="" class="form-control">
                <option value="">Select Region</option>
                @foreach ($regions as $region)
                <option value="{{ $region->id }}">{{$region->name}}</option>
                    @endforeach
               
              </select>
              {{-- <div class="dropdown-container mr-3 cust-drop-container cust-drop-container2 d-flex align-items-center cust-drop-container-bx cust-drop-container-wrap">
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
              </div> --}}
              <input type="date" class="form-control date-control" name="eyear" placeholder="2023">
            </div>
          </div>
          <div class="card-body pt-0">
            <canvas id="expenditureChart" style="width:100%;max-width:600px"></canvas>
            {{-- <script>
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
            </script> --}}
{{-- <div style="width: 80%; margin: auto;">
  <canvas id="expenditureChart"></canvas>
</div> --}}
<style>
  #submissions-by-region {
      width: 100%;
      height: 400px;
  }
</style>
<canvas id="submissions-by-region"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card card-dark-blue" style="border:none !important;">
          <div class="card-header card_header border-0">
            <span>Branches </span><a class="delete-notification d-block" href="#"><span class="text-secondary fs-12 ti-search"></span></a> 
          </div>
          <div class="card-body pt-0">
            <ul class="branches_list">
              @foreach ($branches as $branch)
              <li><span class="blue_list circle_list"></span>{{$branch->name}}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--End content-wrapper-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
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
   // Create a new Chart.js chart
   const ctx = $("#submissions-by-region").get(0).getContext("2d");

// Define the chart data
const data = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [
        {
            label: "Centurion",
            data: [700, 600, 500, 400, 300, 200, 100, 0],
            borderColor: "red",
            fill: false
        },
        {
            label: "Mamelodi",
            data: [600, 500, 400, 300, 200, 100, 0, 0],
            borderColor: "blue",
            fill: false
        }
    ]
};

// Define the chart options
const options = {
    title: {
        display: true,
        text: "Submissions by Region (2023)"
    },
    legend: {
        display: true,
        position: "top"
    },
    scales: {
        yAxes: [
            {
                ticks: {
                    beginAtZero: true
                }
            }
        ]
    }
};

// Create the chart
const chart = new Chart(ctx, {
    type: "line",
    data: data,
    options: options
});
  let sermonsDatatable;
    sermonsDatatable =  $('#sermons-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'l<"toolbar">frtip',
   
   ajax: window.location.href,

        
        columns: [
            { data: 'number', name: 'number' },
            { data: 'thumbnailH', name: 'thumbnail' },
            { data: 'title', name: 'title' },
            { data: 'date', name: 'date' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
    }).on( 'draw', function (row) {
      $(row.currentTarget).find('tbody tr').addClass('si-rw');
      
});
    $(document).on('click','.addSermon', function(ev){
        let e = $(this);
        let formdata = [
          {'dTable' :'#sermons-table'},
          {'bModal' :'#add-sermon-modal'}
        ];
        postReq($(this),'superadmin/sermons','#add-sermon-modal',formdata);
      

  });
    $(document).on('click','.editSermon', function(ev){
        let e = $(this);
        let sid = e.attr('sid');
        let formdata = [
          {'id':sid},
          {'bModalData' :'#edit-sermon-modal'}
        ];
        $('#edit-sermon-modal .updateSermon').attr('sid',sid);
        postReq($(this),'superadmin/sermons_get','#edit-sermon-modal',formdata);
  });
    $(document).on('click','.updateSermon', function(ev){
        let e = $(this);
        let sid = e.attr('sid');
        let formdata = [
          {'_method':'put'},
          {'dTable' :'#sermons-table'},
          {'bModal' :'#edit-sermon-modal'}
    ];
        postReq($(this),'superadmin/sermons/'+sid,'#edit-sermon-modal',formdata);
  });

    $(document).on('click','.deleteSermon', function(ev){
  if (!window.confirm("Do you really want to Delete Sermon?")) {
            return false;
        }
        let e = $(this);
        let sid = e.attr('sid');
        let formdata = [
          {'_method' :'delete'},
          {'dTable' :'#sermons-table'}
        ];
    postReq(e,'superadmin/sermons/'+sid+'','.fform',formdata);

});
var monthlyDonations = @json($monthlyDonations);
var monthlyExpenditures = @json($monthlyExpenditures);

// var monthNames = [
// 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
// 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
// ];       

// new Chart("myChart4", {
// type: "bar",
// data: {
// labels: monthlyDonations.map(donation => monthNames[donation.month - 1]), // Adjusted to use month names
// datasets: [{
// backgroundColor: '#F91717',
// data: monthlyDonations.map(donation => donation.total),
// }]
// },
// options: {
// legend: {display: false},
// title: {
// display: true,
// text: "Donations"
// },
// scales: {
// y: {
//   beginAtZero: true
// },
// x: {
//   beginAtZero: true
// }
// }
// }
// });
$(document).on('change','input[name=dyear]', function(ev){
    let ciname = $(this).attr('name');
        let e = $(this);
            let params = {
      [ciname]: e.val(),
    };

axios.get(""+BASE_URL+'/superadmin/donations_graph' , { params })
  .then(response => {
    console.log(response.data);
    // monthlyDonations = response.data.data;
    updateChartData(response.data.data,e.val());
  })
  .catch(error => {
    console.error(error);
  });

});

$(document).on('change','input[name=eyear],select[name=eregion]', function(ev){
    let ciname = $(this).attr('name');
    let eregion = $('select[name=eregion]').val();
    let eyear = $('input[name=eyear]').val();
        let e = $(this);
            let params = {
      eregion: eregion,
      eyear: eyear,
    };

axios.get(""+BASE_URL+'/superadmin/withdrawals_graph' , { params })
  .then(response => {
    console.log(response.data);
    // monthlyDonations = response.data.data;
    updateExChartData(response.data.data,e.val());
  })
  .catch(error => {
    console.error(error);
  });

});
function updateChartData(monthlyDonations, year) {
            var monthNames = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ];

            var ctx = document.getElementById('myChart4').getContext('2d');
            if (window.myChart) {
                window.myChart.destroy(); // Destroy the existing chart instance
            }

            window.myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: monthlyDonations.map(donation => monthNames[donation.month - 1]),
                    datasets: [{
                        label: 'Monthly Donations',
                        data: monthlyDonations.map(donation => donation.total),
                        backgroundColor: 'red',
                        borderColor: 'red',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Initial chart creation
        updateChartData(monthlyDonations,{{ date('Y') }});
        function updateExChartData(monthlyExpenditures, year) {
            var monthNames = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ];

            var ctx = document.getElementById('expenditureChart').getContext('2d');
            if (window.myExChart) {
                window.myExChart.destroy(); // Destroy the existing chart instance
            }

            window.myExChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: monthlyExpenditures.map(expenditure => monthNames[expenditure.month - 1]),
                    datasets: [{
                        label: 'Monthly Expenditures',
                        data: monthlyExpenditures.map(expenditure => expenditure.total),
                        fill: false,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Initial chart creation
        updateExChartData(monthlyExpenditures,{{date('Y')}});
</script>
@endpush
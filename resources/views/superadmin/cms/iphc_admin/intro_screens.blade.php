@extends('superadmin.layouts.app')
@section('title', 'Splash Screen')
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
                              <span><a href="{{ route('superadmin.cms') }}" style="color: inherit;">Back</a> &gt; 
List of Intro Screens
</span> 
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
                <td>Intro Screen 1</td>
                <td>
                  <a class="ml-1" href="{{ route('superadmin.cms.intro_screens.edit',1) }}"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></a>
                </td>
              </tr>
              <tr class="si-rw">
                <td>2</td>
                <td>Intro Screen 2</td>
                <td>
                  <a class="ml-1" href="{{ route('superadmin.cms.intro_screens.edit',2) }}"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></a>
                </td>
              </tr>
              <tr class="si-rw">
                <td>3</td>
                <td>Intro Screen 3</td>
                <td>
                  <a class="ml-1" href="{{ route('superadmin.cms.intro_screens.edit',3) }}"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></a>
                </td>
              </tr>
              <tr class="si-rw">
                <td>4</td>
                <td>Intro Screen 4</td>
                <td>
                  <a class="ml-1" href="{{ route('superadmin.cms.intro_screens.edit',4) }}"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></a>
                </td>
              </tr>
              <tr class="si-rw">
                <td>5</td>
                <td>Intro Screen 5</td>
                <td>
                  <a class="ml-1" href="{{ route('superadmin.cms.intro_screens.edit',5) }}"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></a>
                </td>
              </tr>
              <tr class="si-rw">
                <td>16</td>
                <td>Intro Screen 6</td>
                <td>
                  <a class="ml-1" href="{{ route('superadmin.cms.intro_screens.edit',6) }}"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></a>
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
  <!--End Row-->
  <!--End Dashboard Content-->
  <!--start overlay-->
  <div class="overlay toggle-menu"></div>
  <!--end overlay-->
</div>
<!-- End container-fluid-->
</div>

    
@endsection

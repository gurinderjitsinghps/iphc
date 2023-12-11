<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vaye') }} - @yield('title')</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.1/chart.umd.js" integrity="sha512-ffRiucC+agltyOFQv5837tFGHFHq9tvevCk+mLE7pawA7SVgRS9TXFOT1bmHF8/aG/Pt7Bq7q94RSfuem/qKvw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" integrity="sha512-16esztaSRplJROstbIIdwX3N97V1+pZvV33ABoG1H2OyTttBxEGkTsoIVsiP1iaTtM8b3+hu2kB6pQ4Clr5yug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js" integrity="sha512-Ic9xkERjyZ1xgJ5svx3y0u3xrvfT/uPkV99LBwe68xjy/mGtO+4eURHZBW2xW4SZbFrF1Tf090XqB+EVgXnVjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
       
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">Forgot Password</div>
              <div class="card-body">
                @if (isset($success) && $success)
                <div class="alert alert-success">
                     Password Reset Successfully.
                      </div>
                @else
                <form action="{{ route('password.store') }}" method="POST">
                    @csrf
                
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    <input type="hidden" name="route" value="{{ request()->query('route') }}">
                  <div class="mb-3">
                    <label for="email" class="form-label">{{__('Email')}}</label>
                    <input type="email" name="email" id="email" class="form-control"  value="{{old('email', request()->email)}}" required autofocus>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">{{__('Password')}}</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your new password" >
                  </div>
                  <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{__('Confirm Password')}}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm your new password">
                  </div>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              
                  <div class="d-grid gap-2">
                    
                    <button type="submit" class="btn btn-primary">  {{ __('Reset Password') }}</button>
                  </div>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
        

</body>
</html>



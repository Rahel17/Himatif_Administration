<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('asset/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('asset/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link href="{{ asset('asset/images/logo-himatif.png') }}" rel="shortcut icon">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <img src="{{ asset('asset/images/logo-himatif.png') }}" alt="logo" class="logo-center">
              </div>
              <h4>Belum Punya Akun?</h4>
              <h6 class="font-weight-light">Mudah kok, ayo ikuti langkahnya!</h6>

              <!-- Form Start -->
              <form method="POST" action="{{ route('register') }}" class="pt-3">
                @csrf

                <!-- Name -->
                <div class="form-group">
                  <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Nama" value="{{ old('name') }}" required autofocus>
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                  <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="Email" value="{{ old('email') }}" required>
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- NPM -->
                <div class="form-group">
                  <input type="npm" id="npm" name="npm" class="form-control form-control-lg" placeholder="NPM" required>
                  @error('npm')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Bidang -->
                <div class="form-group">
                  <input type="bidang" id="bidang" name="bidang" class="form-control form-control-lg" placeholder="Bidang (Inti|PSDM|Kerohanian|Humas|Kominfo|Danus|Minbak)" required>
                  @error('bidang')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- No HP -->
                <div class="form-group">
                  <input type="no_hp" id="no_hp" name="no_hp" class="form-control form-control-lg" placeholder="No HP (maks 15)" required>
                  @error('no_hp')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                  <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                  @error('password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" placeholder="Konfirmasi Password" required>
                  @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">DAFTAR</button>
                </div>

                <!-- Already Registered -->
                <div class="text-center mt-4 font-weight-light">
                  Sudah Punya Akun? <a href="{{ route('login') }}" class="text-primary">MASUK</a>
                </div>
              </form>
              <!-- Form End -->

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('asset/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
 
  <script src="{{ asset('asset/js/off-canvas.js') }}"></script>
  <script src="{{ asset('asset/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('asset/js/template.js') }}"></script>
  <script src="{{ asset('asset/js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>

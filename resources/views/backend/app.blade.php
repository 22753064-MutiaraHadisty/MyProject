<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Tables - Kaiadmin Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ url('backend/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ url('backend/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ url('backend/assets/css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ url('backend/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('backend/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ url('backend/assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ url('backend/assets/css/demo.css') }}" />

    <!-- SweetAlert2 (Popup Notification) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  </head>
  
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('backend._partials.sidebar')

      <div class="main-panel">
      <!-- Header -->
      @include('backend._partials.header')

      <!-- Main Content -->
      @yield('content')
    

      <!-- Footer -->
      @include('backend._partials.footer')
    </div>
</div>

    <!-- Core JS Files -->
    <script src="{{ url('backend/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ url('backend/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('backend/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ url('backend/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{ url('backend/assets/js/kaiadmin.min.js') }}"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ url('backend/assets/js/setting-demo2.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      @yield('script')

    <!-- Flash Message Notification -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          @if(session('success'))
              Swal.fire({
                  icon: 'success',
                  title: 'Berhasil!',
                  text: "{{ session('success') }}",
                  showConfirmButton: false,
                  timer: 3000
              });
          @endif

          @if(session('error'))
              Swal.fire({
                  icon: 'error',
                  title: 'Gagal!',
                  text: "{{ session('error') }}",
                  showConfirmButton: false,
                  timer: 3000
              });
          @endif
      });
    </script>

  </body>
</html>

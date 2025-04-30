<!DOCTYPE html>
<html lang="zxx" dir="ltr" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title> @yield('title') </title>
    <link rel="icon" type="image/png" href="assets/images/logo/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="{{ asset('assets/css/rt-plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/js/settings.js') }}" sync></script>

    <!-- CSS DINAMIS -->
    @stack('styles')
</head>

<body class=" font-inter dashcode-app" id="body_class">
    <main class="app-wrapper">
        <!-- Sidebar -->
        @include('components.sidebar')

        <div class="flex flex-col justify-between min-h-screen">
            <div>
                @include('components.navbar')
                <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
                    <div class="page-content">
                        <div class="transition-all duration-150 container-fluid" id="page_layout">
                            <div id="content_layout">
                                <!-- Content Utama -->
                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer  -->
            @include('components.footer')
        </div>
    </main>
    @if(session('success'))
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
        });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonColor: "#d33",
                confirmButtonText: "OK"
            });
        </script>
    @endif
    <!-- scripts global-->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/rt-plugins.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- script dinamis -->
    @stack('scripts')

    @vite('resources/js/app.js')
</body>
</html>
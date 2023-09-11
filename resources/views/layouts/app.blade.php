<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} | @yield('page')</title>

    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/auth.css') }}">
    @yield('import_css')
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                <i class="bi bi-box me-2"></i>
                {{ env('APP_NAME') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primaryc lowercase" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->username }}
                            <i class="bi bi-person-circle ms-2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end mt-3">
                            <li>
                                <a href="{{ route('dashboard.logout') }}" id="logout" class="dropdown-item"
                                    type="button">
                                    Sign Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start border-0 shadow-sm pt-5" data-bs-scroll="true" data-bs-backdrop="false"
        tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-body pt-4">
            <div class="mb-2">
                <a href="{{ route('dashboard.index') }}"
                    class="btn {{ Request::routeIs('dashboard.index') ? 'btn-primaryc' : 'btn-primaryc3' }} py-2 mb-2 w-100 text-start">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>
            </div>

            <div class="mb-2">
                <a href="{{ route('dashboard.board.index') }}"
                    class="btn {{ Request::routeIs('dashboard.board.*') ? 'btn-primaryc' : 'btn-primaryc3' }} py-2 mb-2 w-100 text-start">
                    <i class="bi bi-view-list me-2"></i>
                    Manage Board
                </a>
            </div>
        </div>
    </div>

    <main class="container-fluid mt-5">
        @yield('content')
    </main>

    <footer class="mt-5 pb-3 text-end me-3 fixed-bottom">
        <span class="text-footer">
            {{ date('Y') }} &copy; {{ env('APP_NAME') }} - All Right Reserved
        </span>
    </footer>

    <script type="text/javascript" src="{{ asset('/js/jquery-3.6.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/auth.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/sweetalert2.js') }}"></script>

    @if (Session::has('success'))
        <script type="text/javascript">
            Swal.fire(
                "Success!",
                "{{ Session::get('success') }}",
                "success"
            );
        </script>
    @endif

    @if (Session::has('error'))
        <script type="text/javascript">
            Swal.fire(
                "W0pzzz!",
                "{{ Session::get('error') }}",
                "error"
            );
        </script>
    @endif

    @yield('javascript')
    @yield('import_js')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/auth.css') }}">
</head>

<body class="bg-light">
    <div id="particles-js"></div>
    <form class="row signin justify-content-center" method="POST" action="{{ route('handleSignup') }}"
        style="padding-top: 7% !important;" autocomplete="off">
        @csrf

        <div class="col-sm-3 bg-white rounded-0 shadow-lg p-5">
            <h3 class="text-primaryc">{{ env('APP_NAME') }} | Sign Up</h3>
            <div class="mt-5">
                <label for="fullname">Fullname</label>
                <input type="text" class="form-control shadow-none" name="fullname" id="fullname"
                    aria-autocomplete="none" autocomplete="off" />
            </div>
            <div class="mt-3">
                <label for="username">Username</label>
                <input type="text" class="form-control shadow-none" name="username" id="username"
                    aria-autocomplete="none" autocomplete="off" />
            </div>
            <div class="mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control shadow-none" name="password" id="password"
                    aria-autocomplete="none" autocomplete="off" />
            </div>
            <div class="mt-4">
                <button type="submit" name="signup" class="btn btn-primaryc py-2 w-100">
                    Sign Up
                </button>

                <a href="{{ route('googleAuth') }}" class="btn bg-white py-2 w-100 mt-3 text-primary">
                    <i class="bi bi-google text-primary"></i>
                </a>

                <a href="{{ route('login') }}" class="btn text-secondary py-2 mt-3 w-100" style="font-size: 13px;">
                    SignIn Now
                </a>
            </div>
        </div>

    </form>
    <footer class="mt-5 pb-3 text-end me-3 fixed-bottom">
        <span class="text-footer">
            {{ date('Y') }} &copy; {{ env('APP_NAME') }} - All Right Reserved
        </span>
    </footer>
    <script type="text/javascript" src="{{ asset('/js/jquery-3.6.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/particles.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/particles-app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/sweetalert2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/auth.js') }}"></script>

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
</body>

</html>

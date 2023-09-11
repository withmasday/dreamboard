<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} | Dream Board - {{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/client.css') }}">
</head>

<body>
    <div id="particles-js"></div>
    <h1 class="text-center text-white brand-name">
        {{ env('APP_NAME') }}
        <span class="heading"> | {{ $title }}</span>
    </h1>

    @if ($publish || $password == $sess_password)
        <button type="button" class="btn bg-transparent btn-plus" onclick="dreamModal()">
            <span class="bi bi-plus-square"></span>
        </button>

        @foreach ($data as $dream)
            <div class="box shadow-sm" id="box-dreamer-{{ $dream->id }}" box-id="{{ $dream->id }}"
                style="color: {{ $dream->color }};background-color: {{ $dream->background }};">
                {{ $dream->text }}
                <div class="text-center {{ $dream->user_id == $user_id ? 'hider' : '' }}">
                    <div class="writter" style="color: {{ $dream->color }};">
                        {{ $dream->username == null ? 'Anonymous' : $dream->username }}</div>
                    <div class="date" style="color: {{ $dream->color }};">
                        {{ date('d/m/Y', strtotime($dream->created_at)) }}
                    </div>
                </div>

                @if ($dream->user_id == $user_id)
                    @php $removeURI = route('api.rmdreamer', [$dream->board_id, $dream->id]) @endphp
                    <div class="remover">
                        <button type="button" class="btn btn-dangerc" onclick="rmdreamer('{{ $removeURI }}')">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                @endif
            </div>
        @endforeach

        <div class="modal fade" id="dreamerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="dreamerModalLabel" aria-hidden="true"
            style="z-index: 99999999999999 !important;border-radius:0px !important;">
            <div class="modal-dialog modal-lg" style="z-index: 99999999999999 !important;border-radius:0px !important;">
                <div class="modal-content" style="z-index: 99999999999999 !important;border-radius:0px !important;">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Create New</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row" method="POST" action="{{ route('board.dream.store', $board_id) }}">
                            @csrf
                            <div class="col-sm-12 p-3">
                                <label for="text" class="mb-2">Dream Text</label>
                                <textarea class="form-control shadow-none" name="text" rows="10"></textarea>
                            </div>
                            <div class="col-sm-2 p-3">
                                <label for="color" class="mb-2 d-block">Text Color</label>
                                <input id="color" class="form-control form-control-color w-100" type="color"
                                    name="color" value="#ffffff">
                            </div>

                            <div class="col-sm-3 p-3">
                                <label for="background" class="mb-2 d-block">Box Background</label>
                                <input id="background" class="form-control form-control-color w-100" type="color"
                                    name="background" value="#30336b">
                            </div>
                            <div class="col-sm-4 p-3">
                                <label for="incognito" class="mb-2 d-block">Incognito (Anonymous)</label>
                                <input id="incognito" class="form-check-input w-100" type="checkbox"
                                    data-toggle="toggle" name="incognito">
                            </div>
                            <div class="col-sm-12 border-bottom"></div>

                            <div class="offset-sm-9 col-sm-3 mt-3">
                                <button type="submit" class="btn btn-primaryc w-100" name="create">
                                    Create Now
                                </button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center" style="padding-top: 20%;">
            <form class="col-sm-3 bg-white p-3 text-center" method="POST"
                action="{{ route('board.dream.openaccess') }}">
                @csrf
                <input id="password" class="form-control" type="text" name="password" placeholder="Password">
                <button type="submit" class="btn btn-primaryc mt-3 w-100">Open Access</button>
            </form>
        </div>
    @endif

    <script type="text/javascript" src="{{ asset('/js/particles.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/particles-app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery-3.6.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap-toggle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/sweetalert2.js') }}"></script>
    <script type="text/javascript">
        (function() {
            @foreach ($data as $dream)
                posistionGenerate(document.getElementById("box-dreamer-{{ $dream->id }}"), {{ $dream->top }},
                    {{ $dream->left }});
                dragger(document.getElementById("box-dreamer-{{ $dream->id }}"));
            @endforeach
        })();


        function posistionGenerate(elmnt, posTop, posLeft) {
            elmnt.style.top = posTop + "px";
            elmnt.style.left = posLeft + "px";
        }

        function dragger(elmnt) {
            var pos1 = 0,
                pos2 = 0,
                pos3 = 0,
                pos4 = 0;
            if (document.getElementById(elmnt.id)) {
                document.getElementById(elmnt.id).onmousedown = dragMouseDown;
            } else {
                elmnt.onmousedown = dragMouseDown;
            }

            function dragMouseDown(e) {
                e = e || window.event;
                e.preventDefault();
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.onmouseup = closeDragElement;
                document.onmousemove = elementDrag;
            }

            function elementDrag(e) {
                e = e || window.event;
                e.preventDefault();
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
            }

            function closeDragElement() {
                document.onmouseup = null;
                document.onmousemove = null;

                let dreamID = elmnt.getAttribute("box-id");
                let boardID = '{{ $board_id }}';
                let positionTOP = (elmnt.offsetTop - pos2);
                let positionLEFT = (elmnt.offsetLeft - pos1);
                let endpoint = "{{ route('api.dreamposition') }}";

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post(endpoint, {
                    top: positionTOP,
                    left: positionLEFT,
                    board_id: boardID,
                    dream_id: dreamID
                });
            }
        }

        function dreamModal() {
            $('#dreamerModal').modal('show');
        }

        function rmdreamer(uri) {
            Swal.fire({
                title: "Do you want to remove this dream text?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Yes, remove now.",
                denyButtonText: "No, cancle it.",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: uri,
                        success: function(data) {
                            Swal.fire("Success remove dream text.", "", "success");
                            return location.reload();
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire("Cancle to remove dream text.", "", "info");
                }
            });
        }
    </script>

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

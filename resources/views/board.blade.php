<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} | Dream Board - {{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/client.css') }}">
</head>

<body>
    <div id="particles-js"></div>
    <h1 class="text-center text-white brand-name">
        {{ env('APP_NAME') }}
        <span class="heading"> | {{ $title }}</span>
    </h1>

    @foreach ($data as $dream)
        <div class="box shadow-sm" id="box-dreamer-{{ $dream->id }}" box-id="{{ $dream->id }}"
            style="color: {{ $dream->color }};background-color: {{ $dream->background }};">
            {{ $dream->text }}
            <div class="text-center">
                <div class="writter" style="color: {{ $dream->color }};">{{ $dream->username }}</div>
                <div class="date" style="color: {{ $dream->color }};">
                    {{ date('d/m/Y', strtotime($dream->created_at)) }}
                </div>
            </div>
        </div>
    @endforeach


    <script>
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
    </script>
    <script type="text/javascript" src="{{ asset('/js/particles.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/particles-app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery-3.6.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
</body>

</html>

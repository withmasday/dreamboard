<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/client.css') }}">
</head>

<body id="particles-js">
    <h1 class="text-center heading">Wake Up</h1>
    <div class="box shadow-sm" id="box-1-trustsec" style="color: #ffffff;background-color: #30336b;">
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make
        a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
        Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions
        of Lorem Ipsum.
        <div class="text-center">
            <div class="writter" style="color: #ffffff;">Muhammad Hidayat</div>
            <div class="date" style="color: #ffffff;">11/10/2023</div>
        </div>
    </div>

    <div class="box shadow-sm" id="box-2-trustsec" style="color: #ffffff;background-color: #30336b;">
        Aku sayang ibu
        <div class="text-center">
            <div class="writter" style="color: #ffffff;">Muhammad Hidayat</div>
            <div class="date" style="color: #ffffff;">11/10/2023</div>
        </div>
    </div>

    <script>
        (function() {
            posistionGenerate(document.getElementById("box-1-trustsec"), 30, 50);
            dragger(document.getElementById("box-1-trustsec"));

            posistionGenerate(document.getElementById("box-2-trustsec"), 100, 200);
            dragger(document.getElementById("box-2-trustsec"));
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
                console.log(`OFFSET LEFT : ${pos3}`)
                console.log(`OFFSET TOP  : ${pos4}`)
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

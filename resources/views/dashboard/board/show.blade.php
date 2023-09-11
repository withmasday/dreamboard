@extends('layouts.app')

@section('page', 'Manage Board')

@section('content')
    <div class="row justify-content-end pt-4 adminsp-mobile">
        <div class="col-sm-9 bg-white rounded-3 shadow-sm pt-3 pb-2 me-4">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="text-primaryc pt-2">
                        <i class="bi bi-view-list me-2"></i> Our Dreamer :
                        {{ $title }}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-end pt-2 adminsp-mobile mt-3">
        <div class="col-sm-9 bg-white rounded-3 shadow-sm pt-3 pb-2 me-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-secondary text-center">Dream Text</th>
                            <th scope="col" class="text-secondary text-center">Dreamer</th>
                            <th scope="col" class="text-secondary text-center" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dream)
                            <tr>
                                <td class="text-secondary">
                                    {{ strlen($dream->text) > 230 ? substr_replace($dream->text, '...', 250) : $dream->text }}
                                </td>
                                <td class="text-secondary text-center">
                                    {{ $dream->username == null ? 'anonymous' : $dream->username }}
                                </td>
                                @php $readURI = route('api.dreamer', [$dream->board_id, $dream->id]) @endphp
                                @php $removeURI = route('api.rmdreamer', [$dream->board_id, $dream->id]) @endphp
                                <td class="text-secondary text-center">
                                    <button type="button" onclick="dreamer('{{ $readURI }}')"
                                        class="btn btn-primaryc mx-1">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button class="btn btn-dangerc mx-1" onclick="rmdreamer('{{ $removeURI }}')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="paginate mb-3 mt-3">
                {{ $data->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="dreamerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="dreamerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="h1-modal"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="p-modal" style="font-size: 14px; font-weight: 400;"></p>
                    <span class="text-dark" style="font-size: 13px;font-weight:600;" id="span-modal"></span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        function dreamer(uri) {
            $.ajax({
                url: uri,
                success: function(data) {
                    let dater = new Date(data.data['created_at']);
                    $('#h1-modal').text('Dreamer : ' + data.data['username']);
                    $('#p-modal').text(data.data['text']);
                    $('#span-modal').text(`${dater.getDate()}/${dater.getMonth()}/${dater.getFullYear()}`);
                    $('#dreamerModal').modal('show');
                }
            });
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
@endsection

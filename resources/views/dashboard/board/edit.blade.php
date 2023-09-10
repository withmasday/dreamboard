@extends('layouts.app')
@section('page', 'Update Board - ' . $data->title)

@section('import_css')
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-toggle.min.css') }}">
@endsection

@section('content')
    <div class="row justify-content-end pt-4 adminsp-mobile">
        <div class="col-sm-9 bg-white rounded-3 shadow-sm pt-3 pb-3 me-4">
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="text-primaryc pt-2">
                        <i class="bi bi-plus-square me-2"></i> Update : {{ $data->title }}
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <form class="row justify-content-end pt-2 adminsp-mobile" method="POST"
        action="{{ route('dashboard.board.update', $data->id) }}">
        @csrf

        <div class="col-sm-9 bg-white rounded-3 shadow-sm pt-3 pb-3 me-4">
            <div class="row">
                <div class="col-sm-10 p-3">
                    <label for="title" class="mb-2">Board Title</label>
                    <input type="text" class="form-control shadow-none" name="title" id="title" autocomplete="off"
                        required value="{{ $data->title }}" />
                </div>

                <div class="col-sm-2 p-3">
                    <label for="title" class="mb-2">Publish Board</label>
                    <input id="publish" class="form-check-input" type="checkbox" {{ $data->publish ? 'checked' : '' }}
                        data-toggle="toggle" name="publish">
                </div>

                <div class="col-sm-12 p-3 d-none" id="board-pass">
                    <label for="password" class="mb-2">Board Password</label>
                    <input type="text" class="form-control shadow-none" name="password" id="password" autocomplete="off"
                        value="{{ $data->password }}" />
                </div>

                <div class="col-sm-2 p-3">
                    <a href="{{ route('dashboard.board.index') }} " class="btn btn-secondaryc w-100">Back</a>
                </div>
                <div class="col-sm-8"></div>
                <div class="col-sm-2 p-3">
                    <button type="submit" class="btn btn-primaryc w-100" name="update">
                        Update Now
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('javascript')
    <script type="text/javascript">
        function validate() {
            const status = $('#publish').prop('checked');
            status ? $('#board-pass').addClass('d-none') : $('#board-pass').removeClass('d-none')
        }

        $(function() {
            validate();
            $('#publish').change(function() {
                validate();
            })
        })
    </script>
@endsection

@section('import_js')
    <script type="text/javascript" src="{{ asset('/js/bootstrap-toggle.min.js') }}"></script>
@endsection

@extends('layouts.app')

@section('page', 'Manage Board')

@section('content')
    <div class="row justify-content-end pt-4 adminsp-mobile">
        <div class="col-sm-9 bg-white rounded-3 shadow-sm pt-3 pb-2 me-4">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="text-primaryc pt-2">
                        <i class="bi bi-view-list me-2"></i> Manage Board
                    </h4>
                </div>
                <div class="col-sm-5"></div>
                <div class="col-sm-3">
                    <a href="{{ route('dashboard.board.create') }}" class="btn btn-primaryc w-100">
                        <i class="bi bi-plus-square me-2"></i> Create New Board
                    </a>
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
                            <th scope="col" class="text-secondary text-center">Board Title</th>
                            <th scope="col" class="text-secondary text-center">Publish Status</th>
                            <th scope="col" class="text-secondary text-center">Board Password</th>
                            <th scope="col" class="text-secondary text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $board)
                            <tr>
                                <td class="text-secondary">{{ $board->title }}</td>
                                <td class="text-secondary text-center">
                                    @if ($board->publish == true)
                                        <span class="badge btn-successc" style="font-size: 10px !important;">PUBLISH</span>
                                    @else
                                        <span class="badge btn-dangerc" style="font-size: 10px !important;">PRIVATE</span>
                                    @endif
                                </td>
                                <td class="text-secondary text-center">
                                    {{ $board->password == null ? '-' : $board->password }}</td>
                                <td class="text-secondary text-center">
                                    <a href="{{ route('dashboard.board.show', $board->id) }}" class="btn btn-primaryc mx-1">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('dashboard.board.edit', $board->id) }}" class="btn btn-infoc mx-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-dangerc mx-1" onclick="dataRemove(this)" uri="#">
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
@endsection

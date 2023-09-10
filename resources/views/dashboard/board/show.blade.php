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

                                <td class="text-secondary text-center">
                                    <a href=#" class="btn btn-primaryc mx-1">
                                        <i class="bi bi-eye-fill"></i>
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

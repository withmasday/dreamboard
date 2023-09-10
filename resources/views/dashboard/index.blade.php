@extends('layouts.app')

@section('page', 'Dashboard')

@section('content')
    <div class="row justify-content-end pt-4 adminsp-mobile">
        <div class="col-sm-9 bg-white rounded-3 shadow-sm pt-3 pb-2 me-4">
            <div class="alert text-primaryc" role="alert">
                Hi, Welcome To Dashboard <b>{{ Auth::user()->fullname }}!</b>
            </div>
        </div>
    </div>
@endsection

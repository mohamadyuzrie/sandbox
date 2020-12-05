@extends('layouts.adminlte.master', ['noBackButton' => true])

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Home
        </div>
        <div class="card-body">
            Welcome
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @include('training.js')
@endpush
@extends('layouts.layout');

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <p> خوش آمدید{{$user->name}}</p>
        </div>
    </div>
</div>

@endsection

@extends('layouts.main')

@section('title', 'Mark Events')

@section('content')
    @if ($id != null)
        <p>Exibindo produto id: {{$id}}</p>
    @endif
@endsection
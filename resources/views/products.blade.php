@extends('layouts.main')

@section('title', 'Produto')

@section('content')

    <h1>Tela de produtos</h1>
    @if (isset($busca) && ($busca != ''))
        <p>O usuário está buscando por: {{$busca}}</p>
    @endif

@endsection
@extends('layouts.main')

@section('title', 'Mark Events')

@section('content')

{{--<h1>Algum título</h1>
<img src="/img/banner.jpg" alt="Banner">
@if(10 > 5) <!--Esse @ é diretiva do Blade-->
    <p>True</p>
@else
    <p>False</p>
@endif

<p> {{$nome}}</p> <!--Esse nome veio da rota (em web.php)-->

<!--diretiva para if e else-->
@if($nome == "Marcos")
    <p>O nome é Marcos e ele tem {{$idade}} anos</p>
@else
    <p>O nome não é Marcos, e sim {{$nome}} e ele tem {{$idade}} anos</p>
@endif

<p>Índice - Conteudo</p>
<!--diretiva para 'for'-->
@for ($i = 0; $i < count($arr); $i++)
    <p>{{$i}} - {{$arr[$i]}}</p>
@endfor

@foreach ($nomes as $nome)
    <p>{{$nome}}</p>
@endforeach

<!--diretiva para códigos PHP-->
@php
    //comentário em PHP 
    $text = "Texto em PHP";
    echo $text;
@endphp

<!-- Comentário do HTML (irá aprecer ao inspecionar o elemento)-->
{{-- Comentário do Blade (não aparecerá nem na View, nem ao inspecionar o elemento) --}}

@endsection
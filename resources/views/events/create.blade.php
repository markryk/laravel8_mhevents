@extends('layouts.main')

@section('title', 'Criar evento')

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1> Crie um evento </h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image"> Imagem do evento: </label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
        <br>
        <div class="form-group">
            <label for="title">Evento: </label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Nome do evento">
        </div>
        <br>
        <div class="form-group">
            <label for="date"> Data do evento: <label>
	        <input type="date" id="date" name="date" class="form-control">
        </div>
        <br>
        <div class="form-group">
            <label for="city">Cidade: </label>
            <input type="text" name="city" id="city" class="form-control" placeholder="Local do evento">
        </div>
        <br>
        <div class="form-group">
            <label for="title">O evento é privado? </label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="title">Descrição: </label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?"></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="title"> Adicione itens de infraestrutura: </label>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="" value="Cadeiras"> Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="" value="Palco"> Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="" value="Cerveja grátis"> Cerveja grátis
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="" value="Open food"> Open food
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" id="" value="Brindes"> Brindes
            </div>
        </div>
        <br>
        <input type="submit" value="Criar evento" class="btn btn-primary">
    </form>
</div>

@endsection
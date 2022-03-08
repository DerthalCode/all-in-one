@extends('main')
@section('content')
<h2 class="text-center dispay-5 my-3">Keisti imones duomenis</h2>
@include('_partials.errors')
<form action="/update/{{$company['id']}}" method="POST" enctype="multipart/form-data" >
    @csrf
    <div class="form-group mb-2">
        <input type="text" class="form-control" name="name" id="name" placeholder="imones pavadinimas" value="{{$company['name']}}"}>
    </div>
    <div class="form-group mb-2">
        <input type="text" class="form-control" name="code" id="code" placeholder="imones kodas" value="{{$company['code']}}">
    </div>
    <div class="form-group mb-2">
        <input type="text" class="form-control" name="vat" id="vat" placeholder="imones pvm kodas" value="{{$company['vat']}}">
    </div>
    <div class="form-group mb-2">
        <input type="text" class="form-control" name="address" id="address" placeholder="imones adresas" value="{{$company['address']}}">
    </div>
    <div class="form-group mb-2">
        <input type="text" class="form-control" name="head" id="head" placeholder="imones vadovas" value="{{$company['head']}}">
    </div>
    <div class="form-group mb-2">
        <textarea name="description" id="description" placeholder="imones aprasymas" cols="30" rows="10" class="form-control">{{$company['description']}}</textarea>
    </div>
    <div class="form-group mb-2">
        <label for="logo">Logotipas</label>
        <input type="file" class="form-control" name="logo" id="logo" >
    </div>
    <button type="submit" class="btn btn-primary">Atnaujinti</button>
</form>
  
@endsection
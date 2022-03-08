@extends('main')
@section('content')
<h2 class="text-center dispay-5 my-3">Prideti nauja imone</h2>
@include('_partials.errors')
<div class="col-8 m-auto mt-4">
    <form action="/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-2">
            <input type="text" class="form-control" name="name" id="name" placeholder="imones pavadinimas">
        </div>
        <div class="form-group mb-2">
            <input type="text" class="form-control" name="code" id="code" placeholder="imones kodas">
        </div>
        <div class="form-group mb-2">
            <input type="text" class="form-control" name="vat" id="vat" placeholder="imones pvm kodas">
        </div>
        <div class="form-group mb-2">
            <select name="category" class="form-select">
                <option value="" selected>--Pasirinkite imone--</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-2">
            <input type="text" class="form-control" name="address" id="address" placeholder="imones adresas">
        </div>
        <div class="form-group mb-2">
            <input type="text" class="form-control" name="head" id="head" placeholder="imones vadovas">
        </div>
        <div class="form-group mb-2">
            <textarea name="description" id="description" placeholder="imones aprasymas" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group mb-2">
            <label for="logo">Logotipas</label>
            <input type="file" class="form-control" name="logo" id="logo" >
        </div>
        <button type="submit" class="btn btn-primary" name="save">Saugoti</button>
    </form>
</div>
@endsection
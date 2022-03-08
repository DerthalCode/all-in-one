@extends('main')
@section('content')
<div class="mx-3 my-2">
    <h2>Prideti nauja imoniu kategorija</h2>
    @include('_partials.errors')
    @include('_partials.success-alert')
    <form action="/create-category" method="post">
        @csrf
        <div class="col-3 d-flex justify-content-between mt-4">
            <div class="col-10">
                <input type="text" name="category" placeholder="Imones kategorija" class="form-control form-control-lg">
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-success btn-lg">Prideti</button>
            </div>
        </div>
    </form>
</div>
@endsection
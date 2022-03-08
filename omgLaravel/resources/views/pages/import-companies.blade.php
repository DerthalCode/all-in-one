@extends('main')
@section('content')
<div class="imports">
    @include('_partials.errors')
    <form action="/parse-companies" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group col-5 ms-5 mt-5 d-flex flex-column">
            <label for="companies">importuokite imones (failo tipas csv)</label>
            <input type="file" name="companies_csv" class="form-control mt-2" >
            <button class="btn btn-primary mt-2 align-self-end" type="submit">Uzkrauti</button>
        </div>
    </form>
</div>
@endsection
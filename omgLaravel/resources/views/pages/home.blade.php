@extends('main')
@section('content')
<div class="container-fluid">
    <h4>Filtras</h4>
    <form class="row align-items-center">
        <div class="col">
            <label for="name">Pavadinimas</label>
            <select name="name" class="form-select">
                <option value="" selected disabled>--Pasirinkite imone--</option>
                @foreach ($companyNames as $name)
                <option value="{{$name}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="code">Kodas</label>
            <input type="text" class="form-control" name="code">
        </div>
        <div class="col">
            <label for="date">Registracijos data</label>
            <select name="date" class="form-select">
                <option value="asc">Seniausi</option>
                <option value="desc">Naujausi</option>
            </select>
        </div>
        <div class="col-auto mt-4">
            <button class="btn btn-primary" type="submit">
                Filtruoti
            </button>
        </div>
    </form>
    @include('_partials.errors')
    @include('_partials.success-alert')
    <h2>Imones</h2>
    <table class="table table-bordered">
        <tr>
            <th>Pavadinimas</th>
            <th>Kodas</th>
            <th>PVM kodas</th>
            <th>Platesne info</th>
        </tr>
        @foreach ($companies as $company)
            <tr>
                <td>{{$company['name']}}</td>
                <td>{{$company['code']}}</td>
                <td>{{$company['vat']}}</td>
                <td><a href="/company/{{$company['id']}}">Placiau...</a></td>
                <td><a class="btn btn-danger" href="/delete/company/{{$company['id']}}">Salinti</a></td>
                <td><a class="btn btn-success" href="/update/company/{{$company['id']}}">Keisti</a></td>
            </tr>
        @endforeach
    </table>
    {!! $companies->links() !!}
</div>
@endsection
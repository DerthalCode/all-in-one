@extends('main')
@section('content')
<div class='px-3 py-3'>
    <h2>Imones pagal kategorijas</h2>
    <form class="d-flex">
        <div class="col-5 me-2">
            <select name="category" class="form-select form-select-lg">
                <option value="" selected>--Pasirinkite kategorija--</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-success btn-lg">Filtruoti</button>
        </div>
    </form>
    @if(count($companies))
        <table class="table table-bordered mt-4">
            <tr>
                <th>Imones Pavadinimas</th>
                <th>Adresas</th>
                <th>Vadovas</th>
                <th>Aprasymas</th>
                <th>Kategorija</th>
            </tr>
            @foreach ($companies as $company)
                <tr>
                    <td>{{$company->name}}</td>
                    <td>{{$company->address}}</td>
                    <td>{{$company->head}}</td>
                    <td>{{$company->description}}</td>
                    <td>{{$company->category->category}}</td>
                </tr>
            @endforeach
        </table>
    @endif
</div>
@endsection
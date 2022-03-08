@extends('main')
@section('content')
<div class="col-11">
    <table class="table table-bordered">
        <tr>
            <th>Pavadinimas</th>
            <th>Kategorija</th>
            <th>Kodas</th>
            <th>PVM kodas</th>
            <th>Adresas</th>
            <th>Miestas</th>
            <th>Vadovas</th>
            <th>Aprasymas</th>
            <th>Logo</th>
        </tr>
        @foreach ($companies as $company)
            <tr>
                @foreach ($company as $index=>$data)
                    @if ($index == 8)
                        @continue
                    @endif
                    <td>{{$data}}</td>
                @endforeach
                <td><img src={{asset($company[8])}} alt="logo" height="60" width="100"></td>
            </tr>
        @endforeach
    </table>
    <form action="/store-companies-import" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="importCompanies" style="display: none" value={{$fileId}}>
        <button type="submit" class="btn btn-primary" >Importuoti</button>
    </form>
</div>
@endsection
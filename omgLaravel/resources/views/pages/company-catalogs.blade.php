@extends('main')
@section('content')
<div class="p-4">
    <h2 class="text-center">Imoniu katalogai</h2>
    <div class="col-8 border m-auto row row-cols-3 g-3">
        @foreach ($companies as $company)
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="{{asset($company->logo)}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$company->name}}</h5>
                        <p class="card-text">{{$company->description}}</p>
                        <a href="/catalog/{{$company->id}}" class="btn btn-primary">Katalogas</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
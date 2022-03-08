@extends('main')
@section('content')
<div class="px-3 py-3 col-10 m-auto">
    <h2 class="text-center mb-5">{{$companyName}} prekiu katalogas</h2>

    @include('_partials.success-alert')
    <div class="row gx-3">
        @foreach ($goods as $commodity)
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$commodity->name}}</h5>
                        <p class="card-text">kaina: {{$commodity->price}} $</p>
                        <div class="description">
                            <p class="m-0 fs-5">Aprasymas:</p>
                            <p>{{$commodity->description}}</p>
                        </div>

                        <a href="/order/{{$commodity->id}}" class="btn btn-primary">Uzsakyti</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
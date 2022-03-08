@extends('main')
@section('content')
<div class="container-fluid">
    @include('_partials.success-alert')
    <h1 class="mt-4">{{$company['name']}}</h1>
    <div class="col-6">
        <table class='company-table'>
            <tr>
                @if($company->logo) 
                    <img src="{{ asset($company->logo) }}" alt="logo" height="150" width="250">
                @endif
            </tr>
            <tr>
                <td class="fs-5">Imones kodas</td>
                <td>{{$company['code']}}</td>
            </tr>
            <tr>
                <td class="fs-5">PVM kodas</td>
                <td>{{$company['code']}}</td>
            </tr>
            <tr>
                <td class="fs-5">Adresas</td>
                <td>{{$company['address']}}</td>
            </tr>
            <tr>
                <td class="fs-5">Vadovas</td>
                <td>{{$company['head']}}</td>
            </tr>
        </table>
        <div class="about">
            <p class="m-0 fs-5">Aprasymas</p>
            <div>
                <p class="mt-2">{{$company['description']}}</p>
            </div>
        </div>
        <div class="comments">
            @if(count($company->comments))
                <h3>Komentarai</h3>
                <ul class="list-group mb-2">
                    @foreach ($company->comments as $comment)
                        <li class="fs-4 list-group-item"><span class="fs-5 text-muted">Vartotojas:</span> {{$comment->user->name}}</li>
                        <li class="list-group-item">{{$comment->body}}</li>                    
                    @endforeach
                </ul>
            @endif
        </div>
        <form action="/company/{{$company->id}}/comment" method="post">
            @csrf
            <div class="form-group">
                <textarea name="body" placeholder="jusu komentaras" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary mt-2">Komentuoti</button>
        </form>
    </div>
</div>
@endsection
@extends('main')
@section('content')
<div class="px-3 py-3 col-11 m-auto">
    @include('_partials.success-alert')
    <div class="row justify-content-between">
        <div class="col-6 companies-dash border rounded py-3 ps-3">
            <h4>Prekiu valdymas</h4>
            @foreach ($companies as $company)
                <div class="card mb-1">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            {{$company->name}}    
                        </div>
                        <div>
                            {{$company->code}}    
                        </div>
                        <div>
                            {{$company->vat}}    
                        </div>
                        <div>
                            <a href="/add-goods/{{$company->id}}" class="btn btn-primary">Prideti prekiu</a>    
                        </div>
                        <div>
                            <a href="" class="btn btn-warning">Pasalinti prekes</a>    
                        </div>  
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-4 orders-dash border rounded py-3 ps-3">
            <h4>Mano uzakymai</h4>
            @foreach ($orders as $order)
                <div class="card mb-1">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="fw-bold">
                            {{$order->goods->name}}
                        </div>
                        <div>
                            {{$order->goods->company->name}}
                        </div>
                        <div>
                            {{$order->goods->price}} $
                        </div>
                        <div>
                            <a href="" class="btn btn-danger">Atsaukti</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4">
        <div class="col-5 border rounded py-3 px-3 categories-dash">
            <h4>Kategoriju valdymas</h4>
            @foreach ($companies as $company)
            <div class="card mb-1">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        {{$company->code}}    
                    </div>
                    <div>
                        {{$company->name}}    
                    </div>
                    <form action="/update-category/{{$company->id}}" method="post" class="d-flex">
                        @csrf
                        <div>
                            <select name="category"class="form-select">
                                <option value="{{$company->category->id}}" selected>{{$company->category->category}}</option>
                                @foreach ($categories as $category)
                                    @if ($category->id == $company->category->id)
                                        @continue
                                    @endif
                                    <option value="{{$category->id}}">{{$category->category}}</option>
                                @endforeach    
                            </select>    
                        </div>
                        <div class="ms-2">
                            <button type="submit" class="btn btn-primary">Keisti</button>    
                        </div>    
                    </form>  
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
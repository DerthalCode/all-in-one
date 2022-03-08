@if($errors->any())
    <div class="alert alert-danger my-3">
        @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif
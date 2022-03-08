<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <button class="btn btn-primary" id="sidebarToggle">Perjungti meniu</button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                @if(Auth::check())
                    <p class="m-0 fs-4 mx-2">{{Auth::user()->name}}</p>
                    <a class="btn btn-danger m-auto" href="/logout">Atsijungti</a>
                @else
                    <a href="/login" class="btn btn-success me-2">Prisijungti</a>
                    <a href="/register" class="btn btn-success">Registruotis</a>
                @endif
            </ul>
        </div>
    </div>
</nav>
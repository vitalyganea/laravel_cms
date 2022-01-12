<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                @foreach (\App\Http\Controllers\TablesController::getMenu() as $menu_element)
                    <li class="nav-item">
                        <a class="nav-link {{ $menu_element->id == request()->id ? "active" : "" }} " href="/admin/table/{{$menu_element->id}}">{{$menu_element->table_text}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

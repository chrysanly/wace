<ul class="nav nav-pills">
    <li class="nav-item"><a href="/" class="nav-link {{session('navActive') == 'home' ? 'active' : ''}}"
            aria-current="page">Home</a></li>
    <li class="nav-item"><a href="{{route('book.index')}}" class="nav-link {{session('navActive') == 'book' ? 'active' : ''}}">Books</a></li>
    @guest
        <li class="nav-item"><a href="{{ route('user.login') }}" class="nav-link">Login</a></li>
    @endguest
    @auth
        <li class="nav-item"><a href="{{ route('user.logout') }}" class="nav-link">Logout</a></li>
        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @endauth


</ul>

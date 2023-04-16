<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block" onclick="event.preventDefault(); document.getElementById('logOutForm').submit();">
        <a href="#" style="font-weight: 900; margin-left: 800%; color:black"  class="nav-link">LOGOUT</a>
      </li>

      <form id="logOutForm" action="{{route('logout')}}" method = "POST"  class="d-none">
        @csrf
      </form>

    </ul>

  </nav>

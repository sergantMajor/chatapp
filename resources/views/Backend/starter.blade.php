<!DOCTYPE html>
<html lang="en">
<head>
@include('Backend.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
@include('Backend.navbar')
@include('Backend.sidebar')

<div class="content-wrapper">
    @yield('content')
</div>
</div>

@include('Backend.script')
</body>
</html>



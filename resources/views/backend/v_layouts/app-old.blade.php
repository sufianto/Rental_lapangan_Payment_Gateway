<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>tokoonline</title>
</head>
<body>
<a href="{{ route('backend.beranda') }}">Beranda</a> |
<a href="#">User</a> |
<a href="{{ route('backend.logout') }}"
onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
Keluar
</a>


<p></p>
<!-- @yieldAwal -->
@yield('content')
<!-- @yieldAkhir-->
<!-- keluarApp -->
<form id="logout-form" action="{{ route('backend.logout') }}" method="POST" style="display: none;">
    @csrf
   </form>
<!-- keluarAppEnd -->
</body>
</html>

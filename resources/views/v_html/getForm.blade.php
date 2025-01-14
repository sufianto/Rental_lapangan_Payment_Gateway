@extends('backend.v_layouts.app')
@section('content')
<form action="/action_page.php">
    <label for="NIM">NIM</label><br>
    <input type="text" id="NIM" name="NIM" value=""><br>
    <label for="Nama_Lengkap">Nama Lengkap</label><br>
    <input type="text" id="Nama_Lengkap" name="Nama_Lengkap" value=""><br>
    <label for="Kelas">Kelas</label><br>
    <input type="text" id="Kelas" name="Kelas" value=""><br>
    <br>
    <input type="submit" value="Simpan">
  </form> 
  @endsection
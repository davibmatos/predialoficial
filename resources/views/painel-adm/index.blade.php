@extends('templates.painel-adm')
@section('title', 'Painel Administrativo')
@section('content')
<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] != 'admin'){ 
  echo "<script language='javascript'> window.location='./' </script>";
}
?>
Home do Administrador
   
@endsection
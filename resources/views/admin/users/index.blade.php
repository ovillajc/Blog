@extends('adminlte::page')

@section('title', 'Blog Jetstream')

@section('content_header')

    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.users.index')}}">Nuevo usuario</a>

    <h1>Lista de usuarios</h1>
@stop

@section('content')
    @livewire('admin.users-index')
@stop

@extends('adminlte::page')

@section('title', 'Blog Jetstream')

@section('content_header')
    <h1>Crear etiqueta</h1>
@stop

@section('content')

    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            {{-- Cuando usamos laravel collective, ya no hay que colocar el @csrf --}}
            {!! Form::open(['route' => 'admin.tags.store']) !!}
                @include('admin.tags.partials.form')
                {!! Form::submit('Crear etiqueta', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Toma el valor del label name
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                // Asigna el valor del label name transformado al label slug
                getPut: '#slug',
                space: '-'
            });
        });
    </script>
@endsection

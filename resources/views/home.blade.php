@extends('layouts.app')

@section('content')

    <div id="MovieApp" >
        
        <nav-movie-type></nav-movie-type>
        <list></list>
        <Display></Display>
        <pagination></pagination>

    </div>

@endsection

<!--vue script-->
@section('css')
    <link href="{{ asset('css/Movies.css') }}" rel="stylesheet">  
@endsection



<!--vue script-->
@section('vue')
    <script src="{{ asset('js/Movies.js')}}" type="text/javascript"></script>   
@endsection





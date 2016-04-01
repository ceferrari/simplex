@extends('layouts.main')

@section('content')
    @if(isset($variaveis) && isset($restricoes))
        @include('partials.variables')
    @else
        @include('partials.constraints')
    @endif
@stop
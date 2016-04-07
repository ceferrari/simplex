@extends('layouts.main')

@section('content')
    @if(isset($tabela))
        @include('partials.table')
    @elseif(isset($variaveis) && isset($restricoes))
        @include('partials.variables')
    @else
        @include('partials.constraints')
    @endif
@stop

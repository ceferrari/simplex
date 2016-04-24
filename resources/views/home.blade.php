@extends('layouts.main')

@section('content')
@if(isset($sensitivity))
    @include('partials.sensitivity')
@elseif(isset($solution))
    @include('partials.solution')
@elseif(isset($table))
    @include('partials.table')
@elseif(isset($variables) && isset($constraints))
    @include('partials.variables')
@else
    @include('partials.settings')
@endif
@stop

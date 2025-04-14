@extends('components.layouts.base')

@section('header')
    @if (auth()->user()->is_admin == 1)
        @include('components.admin.header')
    @else
        @include('components.client.header')
    @endif
@endsection

@section('sidebar')
    @if (auth()->user()->is_admin == 1)
        @include('components.admin.sidebar')
    @else
        @include('components.client.sidebar')
    @endif
@endsection

@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Categorias')
@section('pretitle', 'Overview')
@section('pageHeader', 'Categorias')

@section('content')   

    @livewire('categories')     

@endsection
@push('scripts')
<script>
    ;
</script>
@endpush
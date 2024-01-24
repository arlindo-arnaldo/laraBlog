@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Categorias')
@section('pretitle', 'Overview')
@section('pageHeader', 'Categorias')

@section('content')   

    @livewire('categories')     

@endsection
@push('scripts')
<script>
    window.addEventListener('hide_category_modal', function(){
        $('#category-modal').modal('hide');
    });
    window.addEventListener('show_category_modal', function(){
        $('#category-modal').modal('show');
    });
    window.addEventListener('hide_subcategory_modal', function(){
        $('#subcategory-modal').modal('hide');
    });
    window.addEventListener('show_subcategory_modal', function(){
        $('#subcategory-modal').modal('show');
    });
    $(window).on('hidden.bs.modal', function(){
        Livewire.emit('DisbleUpdateMode');
    });
</script>
@endpush
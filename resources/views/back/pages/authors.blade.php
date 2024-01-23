@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Autores')
@section('pretitle', 'Overview')
@section('pageHeader', 'Autores')

@section('content')
    
    @livewire('author')
@endsection
@push('scripts')
    <script>

        $(document).ready(function(){
            
        });

        $(window).on('hidden.bs.modal', function(){
            Livewire.emit('resetForms')
        });
        window.addEventListener('hide_add_author_modal', function() {
            $('#modal-report').modal('hide');
        });
        window.addEventListener('show_success_modal', function(){
           alert("Autor adicionado com sucesso");
        });
        window.addEventListener('show_edit_author_modal', function(){
            $('#modal-edit-author').modal('show');
        });
        window.addEventListener('hide_edit_author_modal', function(){
            $('#modal-edit-author').modal('hide');
            alert('Autor Actualizado');
        });
        window.addEventListener('show_delete_confirm_modal', function(){
            $('#modal-danger').modal('show');
        });
        window.addEventListener('hide_delete_confirm_modal', function(){
            $('#modal-danger').modal('show');
        });

    </script>
@endpush
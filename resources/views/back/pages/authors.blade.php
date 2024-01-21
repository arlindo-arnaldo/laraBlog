@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Autores')
@section('pretitle', 'Overview')
@section('pageHeader', 'Autores')

@section('content')
    
    @livewire('author')
@endsection
@push('scripts')
    <script>

    

        $(window).on('hidden.bs.modal', function(){
            Livewire.emit('resetForms')
        });
        window.addEventListener('hide_add_author_modal', function() {
            $('#modal-report').modal('hide');
        });
        window.addEventListener('show_success_modal', function(){
           alert("Autor adicionado com sucesso");
        });
    </script>
@endpush
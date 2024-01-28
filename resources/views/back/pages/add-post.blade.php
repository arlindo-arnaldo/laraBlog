@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'posts')
@section('pageHeader', 'Novo Post')

@section('content')
    @livewire('add-post')
@endsection
@push('scripts')
<script>
    function previewImage(){
        var img = document.querySelector('input[name=image]').files[0];
        var preview = document.querySelector('#preview');
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result
        }
        if(image){
            reader.readAsDataURL(img)
            preview.onclick = function(){
                document.querySelector("#image").click()
            }
        }else{
            preview.src = ''
        }   
    }
  </script>
@endpush

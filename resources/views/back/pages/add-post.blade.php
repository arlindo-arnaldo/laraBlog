@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'posts')
@section('pageHeader', 'Novo Post')

@section('content')

    @livewire('add-post')

@endsection
    <div class="modal modal-blur fade" id="postSavedModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-success"></div>
            <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
            <h3>Post Adicionado</h3>
            </div>
            
        </div>
        </div>
    </div>

@push('scripts')
<script>
    function previewImage(){
        var img = document.querySelector('input[name=image]').files[0];
        var preview = document.querySelector('#preview');
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
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
  <script>
    window.addEventListener('show_post_success_modal', function(){
        $('#postSavedModal').modal('show');
    });
    window.addEventListener('show_post_error_modal', function(){
        $('#postSvedModal').modal('show');
    });
  </script>

@endpush

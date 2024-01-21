@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@section('pageHeader', 'Perfil')

@section('content')


@livewire('author-profile-header')
<br><br>



<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
      <li class="nav-item">
        <a href="#tabs-home-3" class="nav-link active" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
          Detalhes Pessoais</a>
      </li>
      <li class="nav-item">
        <a href="#tabs-profile-3" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
          Alterar senha</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active show" id="tabs-home-3">
        <h4>Informações Pessoais</h4>
        <div>

          @livewire('author-personal-datails')
          
        </div>
      </div>
      <div class="tab-pane" id="tabs-profile-3">
        <h4>Alterar minha Senha</h4>
        <div>

          @livewire('author-change-password')

        </div>
      </div>
    </div>
  </div>
  <div class="modal modal-blur fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-success"></div>
        <div class="modal-body text-center py-4">
          <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
          <h3>Perfil actualizado</h3>
          <div class="text-muted">Os seus dados foram actualizados com sucesso!</div>
        </div>
        
      </div>
    </div>
  </div>


  
</div>
</div>
@endsection
@push('scripts')
<script>
  $('#changeAuhorPictureFile').ijaboCropTool({
     preview : '',
     setRatio:1,
     allowedExtensions: ['jpg', 'jpeg','png'],
     buttonsText:['RECORTAR','CANCELAR'],
     buttonsColor:['#30bf7d','#ee5155', -15],
     processUrl:'{{ route("author.change-profile-picture") }}',
     withCSRF:['_token','{{ csrf_token() }}'],
     onSuccess:function(message, element, status){
        //alert(message);
        Livewire.emit('updateAuthorProfileHeader');
        Livewire.emit('updateTopHeader');
     },
     onError:function(message, element, status){
       alert(message);
     }
  });
</script>

<script>
  window.addEventListener('show_modal_updated_profile', function(){
    $('#modal-success').modal('show');
  });
</script>
@endpush
@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Settings')
@section('pretitle', 'Overview')
@section('pageHeader', 'Settings')

@section('content')
<div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
        <li class="nav-item">
          <a href="#tabs-home-3" class="nav-link active" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
            Configurações gerais</a>
        </li>
        <li class="nav-item">
          <a href="#tabs-profile-3" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
            
            Logo & Favicon</a>
        </li>
        <li class="nav-item">
          <a href="#tabs-profile-4" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
           
            Redes Sociais</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane active show" id="tabs-home-3">
          <h4>Configurações gerais</h4>
          <div>
  
          @livewire('author-general-settings')
            
          </div>
        </div>
        <div class="tab-pane" id="tabs-profile-3">
          <h4>Alterar minha Senha</h4>
          <div>
  
            @livewire('author-change-password')
  
          </div>
        </div>
        <div class="tab-pane" id="tabs-profile-4">
          <h4>Defina os links das tuas redes sociais</h4>
          <div>
  
            @livewire('update-blog-social-media')
  
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Users
            </h2>
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <div class="d-flex">
              <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Buscar autor..." wire:model="search"/>
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-report">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Novo Autor
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <br>
  <div class="row row-cards">
    @forelse ($authors as $author)
      <div class="col-md-6 col-lg-3">
        <div class="card">
          <div class="card-body p-4 text-center">
            <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{$author->picture}})"></span>
            <h3 class="m-0 mb-1"><a href="#">{{$author->name}}</a></h3>
            <div class="text-muted">{{$author->email}}</div>
            <div class="mt-3">
              <span class="badge bg-purple-lt">{{$author->authorType->name}}</span>
            </div>
          </div>
          <div class="d-flex">
            <a href="#" wire:click.prevent="editAuthor({{$author}})" class="card-btn"><!-- Download SVG icon from http://tabler-icons.io/i/mail -->
              
              Editar</a>
            <a href="#" class="card-btn" wire:click.prevent="showDeleteModal({{$author}})"><!-- Download SVG icon from http://tabler-icons.io/i/phone -->
              
              Deletar</a>
          </div>
        </div>
      </div>
        @empty
        <span class="text-danger 800"> Nehum autor Encontrado! </span>
     @endforelse
    </div>
    <div class="row mt-4">
      {{$authors->links('livewire::simple-bootstrap')}}
    </div>
   
    <!--add author modal-->
    <div wire:ignore.self class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Novo Autor</h5>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="addAuthor()">
                <div class="mb-3">
                  <label class="form-label">Nome</label>
                  <input type="text" wire:model="name" class="form-control" name="example-text-input" placeholder="Enter The Author Name">
                  <span class="text-danger">@error('name'){{$message}}@enderror</span>
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="text" wire:model="email" class="form-control" name="example-text-input" placeholder="Enter The Author Name">
                  <span class="text-danger">@error('email'){{$message}}@enderror</span>
                </div>
                <div class="mb-3">
                  <label class="form-label">Nome de usuário</label>
                  <input type="text" wire:model="username" class="form-control" name="example-text-input" placeholder="Enter The Author Name">
                  <span class="text-danger">@error('username'){{$message}}@enderror</span>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="mb-3">
                      <label class="form-label">Tipo de Autor</label>
                      <select class="form-select" wire:model="author_type">
                        <option value="" selected>-- No Selected ---</option>
                        @foreach (\App\Models\Type::all() as $type)
                          <option value="{{$type->id}}">{{$type->name}}</option>    
                        @endforeach
                      </select>
                      <span class="text-danger">@error('author_type'){{$message}}@enderror</span>
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="mb-3">
                      <div>
                        <label class="form-label">Publicador direito?</label>
                        <label class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" wire:model="direct_publisher" name="radios-inline"  value="0" checked>
                          <span class="form-check-label">Não</span>
                        </label>
                        <label class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" wire:model="direct_publisher" name="radios-inline" value="1">
                          <span class="form-check-label">Sim</span>
                        </label>
                      </div>
                      <span class="text-danger">@error('direct_publisher'){{$message}}@enderror</span>
                    </div>
                  </div>
                  
                </div>
            </div>
              <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                  Cancelar
                </a>
                <button class="btn btn-primary ms-auto" type="submit" wire:submit.prevent="addAuthor()">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  Adicionar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div> <!--end add author modal-->

      <!--update author modal-->
      <div wire:ignore.self class="modal modal-blur fade" id="modal-edit-author" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Novo Autor</h5>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="updateAuthor()">
                <div class="mb-3">
                  <label class="form-label">Nome</label>
                  <input type="text" wire:model="name" class="form-control" name="example-text-input" placeholder="Enter The Author Name">
                  <span class="text-danger">@error('name'){{$message}}@enderror</span>
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="text" wire:model="email" class="form-control" name="example-text-input" placeholder="Enter The Author Name">
                  <span class="text-danger">@error('email'){{$message}}@enderror</span>
                </div>
                <div class="mb-3">
                  <label class="form-label">Nome de usuário</label>
                  <input type="text" wire:model="username" class="form-control" name="example-text-input" placeholder="Enter The Author Name">
                  <span class="text-danger">@error('username'){{$message}}@enderror</span>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="mb-3">
                      <label class="form-label">Tipo de Autor</label>
                      <select class="form-select" wire:model="author_type">
                        @foreach (\App\Models\Type::all() as $type)
                          <option value="{{$type->id}}">{{$type->name}}</option>    
                        @endforeach
                      </select>
                      <span class="text-danger">@error('author_type'){{$message}}@enderror</span>
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="mb-3">
                      <div>
                        <label class="form-label">Publicador direito?</label>
                        <label class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" wire:model="direct_publisher" name="radios-inline"  value="0" checked>
                          <span class="form-check-label">Não</span>
                        </label>
                        <label class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" wire:model="direct_publisher" name="radios-inline" value="1">
                          <span class="form-check-label">Sim</span>
                        </label>
                      </div>
                      <span class="text-danger">@error('direct_publisher'){{$message}}@enderror</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="">
                    <div class="form-label">Blockeado ?</div>
                    <label class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" wire:model="blocked" >
                    </label>
                    
                  </div>
                </div>
            </div>
              <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                  Cancelar
                </a>
                <button class="btn btn-primary ms-auto" type="submit" wire:submit.prevent="addAuthor()">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  Actualizar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div> <!--end update author modal-->


      <!--Modal Danger-->

      <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
              <h3>Você tem a certeza?</h3>
              <div class="text-muted">Você realmente quer eliminar este usuário? O que for feito não pode ser desfeito</div>
            </div>
            <div class="modal-footer">
              <div class="w-100">
                <div class="row">
                  <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                      Cancelar
                    </a></div>
                  <div class="col">
                    <form action="" wire:submit.prevent="deleteAuthorAction()">
                      <input type="hidden" wire:model="author">
                      <button  class="btn btn-danger w-100">
                        Deletar
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Modal Danger-->

</div>
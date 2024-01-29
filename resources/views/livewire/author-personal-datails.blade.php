<div>
    <form class="card" method="POST" wire:submit.prevent="UpdateDetails()">
        <div class="card-body">
          <h3 class="card-title"></h3>
          <div class="row row-cards">
            <div class="col-md-5">
              <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control"  placeholder="Company" wire:model="name">
                <span class="text-danger">@error('name') {{$message}}@enderror</span>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="mb-3">
                <label class="form-label">Nome de usuário</label>
                <input type="text" class="form-control" placeholder="Username" value="" wire:model="username">
                <span class="text-danger">@error('username') {{$message}}@enderror</span>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="mb-3">
                <label class="form-label">Endereço de email</label>
                <input type="email" class="form-control" placeholder="Email" disabled  wire:model="email">
                <span class="text-danger">@error('email') {{$message}}@enderror</span>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="mb-3 mb-0">
                <label class="form-label">Sobre mim</label>
                <textarea rows="5" class="form-control" placeholder="Here can be your description" wire:model="biography">

                </textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-end">
          <button type="submit" class="btn btn-primary">Actualizar perfil</button>
        </div>
      </form>
</div>

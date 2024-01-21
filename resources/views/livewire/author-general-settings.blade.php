<div>
    <form class="card" method="POST" wire:submit.prevent="UpdateGeneralSettings()">
        <div class="card-body">
          <h3 class="card-title"></h3>
          <div class="row row-cards">
            <div class="col-md-5">
              <div class="mb-3">
                <label class="form-label">Nome do Blog</label>
                <input type="text" class="form-control"  placeholder="nome para o seu blog" wire:model="blog_name">
                <span class="text-danger">@error('blog_name') {{$message}}@enderror</span>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="mb-3">
                <label class="form-label">Email do Blog</label>
                <input type="text" class="form-control" placeholder="Email do seu blog" value="" wire:model="blog_email">
                <span class="text-danger">@error('blog_email') {{$message}}@enderror</span>
              </div>
            </div>
            
            
            <div class="col-md-12">
              <div class="mb-3 mb-0">
                <label class="form-label">Descrição do Blog</label>
                <textarea rows="5" class="form-control" placeholder="Fale um pouco do que o seu blog trata" wire:model="blog_description"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-end">
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
</div>

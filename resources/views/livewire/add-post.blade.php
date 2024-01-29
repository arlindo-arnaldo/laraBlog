<div>
    <div class="card">
        <div class="card-body">
            <form  wire:submit.prevent="addPost()" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Título do post</label>
                            <input type="text" class="form-control" wire:model="post_title">
                            <span class="text-danger">@error('post_title'){{$message}} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Conteúdo do post</label>
                            <textarea class="form-control" rows="10" wire:model="post_content"></textarea>
                            <span class="text-danger">@error('post_content'){{$message}} @enderror</span>
                        </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label"> Categoria do post </label>
                        <select class="form-select" wire:model="post_category">
                            <option value="">--- Não Selecionado --</option>
                            @foreach (\App\Models\SubCategory::all() as $category)
                                <option value="{{$category->id}}">{{$category->subcategory_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('post_category'){{$message}} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagem destacada</label>
                        <input type="file" name="image" id="image" class="form-control" wire:model="featured_image" onchange="previewImage()">
                        <span class="text-danger">@error('featured_image'){{$message}} @enderror</span>
                    </div> 
                    <div class="mb-3">

                        <div wire:loading wire:target="featured_image">
                            <div class="spinner-border spinner-border-sm text-muted" role="status"></div>
                            Carregando...
                        </div>

                       @if ($featured_image)
                       <img id="preview" src="{{$featured_image->temporaryUrl()}}" wire:ignore.self style="border-radius:3px; max-width:100%;max-height:165px;height: 165px;cursor:pointer;">
                       @endif
                     
                    </div>
                    
                    <div style="text-align: right">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>   
                            
                          
                        
                    
                </div>
            </form>
        </div>
    </div>
</div>

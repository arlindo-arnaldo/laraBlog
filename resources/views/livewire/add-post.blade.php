<div>
    <div class="card">
        <div class="card-body">
            <form action="" wire:submit.prevent="addPost()">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Título do post</label>
                            <input type="text" class="form-control" wire:model="post_title">
                            <span class="text-dander">@error('post_title'){{$message}} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Conteúdo do post</label>
                            <textarea class="form-control" rows="10" wire:model="post_content"></textarea>
                            <span class="text-dander">@error('post_content'){{$message}} @enderror</span>
                        </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label"> Categoria do post </label>
                        <select class="form-select" wire:model="post_category">
                            <option value="">--- Não Selecionado --</option>
                            @foreach (\App\Models\Category::all() as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-dander">@error('post_category'){{$message}} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagem destacada</label>
                        <input type="file" name="image" id="image" class="form-control" onchange="previewImage()" >
                        <span class="text-dander">@error('post_image'){{$message}} @enderror</span>
                    </div> 
                    <div class="mb-3">
                        <img id="preview"  style="height: 165px;cursor:pointer;">
                    </div>
                    <div style="text-align: right">
                        <button class="btn btn-primary">Salvar post</button>
                    </div>
                </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>

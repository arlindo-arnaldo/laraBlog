<div>
    <div class="row row-cards">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Categorias</h3>
              <div class="card-actions">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#category-modal">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                  Nova categoria
                </a>
              </div>
            </div>
            <div class="card-body p-0">
                <div class="col-12">
                    
                      <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                          <thead>
                            <tr>
                              <th>Nome</th>
                              <th>Nº de subcategorias</th>
                              
                              <th class="w-1"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($categories as $category)
                                
                           
                            <tr>
                              <td data-label="Nome">
                                <div class="d-flex py-1 align-items-center">
                                  <div class="flex-fill">
                                    <div class="font-weight-medium">{{$category->category_name}}</div>
                                  </div>
                                </div>
                              </td>
                              <td data-label="Nº de Subcategorias">
                                
                                <div class="text-muted">{{$category->subcategories->count()}}</div>
                              </td>         
                              <td>
                                  <div >
                                    <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path></svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                      <a class="dropdown-item" href="#" wire:click.prevent="editCategory({{$category}})">Editar</a>
                                      <a class="dropdown-item text-danger" href="#">Deletar</a>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            @empty
                               <div class="ml-4">
                                <span class="text-danger mt-4">Nenhuma categoria salva!</span> 
                               </div>
                            @endforelse

                          </tbody>
                        </table>
                        <!--Add or Update Category Modal-->
                        <div wire:ignore.self class="modal modal-blur fade" id="category-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <div class="modal-title">{{$updateCategoryMode ? 'Actualizar categoria' :'Adicionar categoria'}}</div>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form wire:submit.prevent="{{$updateCategoryMode ? 'updateCategory()' : 'addCategory()'}}">
                                <div class="modal-body">
                                  @if ($updateCategoryMode)
                                      <input type="hidden" wire:modal="selected_category_id">
                                  @endif
                                  <div class="mb-3">
                                    <label for="category_name" class="form-label">Nome da categoria</label>
                                    <input type="text" class="form-control" placeholder="Introduza o nome da sua categoria" wire:model="category_name" id="category_name">
                                    <span class="text-danger">@error('category_name'){{{$message}}}@enderror</span>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <a class="btn  link-secondary me-auto" data-bs-dismiss="modal">Cancelar</a>
                                  <button type="submit" class="btn btn-primary">{{$updateCategoryMode ? 'Actualizar' : 'Salvar'}}</button>
                                
                                </form>
                                </div>
                               
                              </div>
                            </div>
                          </div>
                        <!--end add or update modal-->
                      </div>
                    
                </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Subcategorias</h3>
              <div class="card-actions">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subcategory-modal">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                  Nova sub-categoria
                </a>
              </div>
            </div>
            <div class="card-body p-0">
                <div class="col-12">
                    <div class="table-responsive">
                      <table class="table table-vcenter table-mobile-md card-table">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Categoria mãe</th>
                            <th>Nº de Posts</th>
                            
                            <th class="w-1"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($subcategories as $subcategory)
                          <tr>
                            <td data-label="Nome">
                              <div class="d-flex py-1 align-items-center">
                                <div class="flex-fill">
                                  <div class="font-weight-medium">{{$subcategory->subcategory_name}}</div>
                                </div>
                              </div>
                            </td>
                            <td data-label="Categoria mãe">
                              
                              <div class="text-muted">{{$subcategory->ParentCategory->category_name}}</div>
                            </td>
                            <td data-label="Nº de posts">
                                <div class="text-muted">4</div>
                              </td>
                              <td>
                                <div >
                                  <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path></svg>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a class="dropdown-item" href="#" wire:click.prevent="editSubCategory({{$subcategory}})">Editar</a>
                                    <a class="dropdown-item text-danger" href="#">Deletar</a>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          @empty
                              <span class="text-danger">Nenhuma Subcategoria</span>
                          @endforelse 
                        </tbody>
                      </table>
                    </div>
              </div>

              <!--Add or Update Category Modal-->
              <div wire:ignore.self class="modal modal-blur fade" id="subcategory-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                  <div class="modal-content">

                    <form wire:submit.prevent="{{$updateSubCategoryMode ? 'updateSubCategory()' : 'addSubCategory()'}}">
                      <div class="modal-header">
                        <div class="modal-title">{{$updateSubCategoryMode ? 'Actualizar sub-categoria' : 'Adicionar sub-categoria'}}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                        <div class="modal-body">
                          @if ($updateSubCategoryMode)
                              <input type="hidden" wire:model="selected_subcategory_id">
                          @endif
                            <div class="mb-3">
                                <label for="parent_category" class="form-label"> Categoria Mãe </label>
                                <select class="form-select" id="parent_category" wire:model="parent_category">
                                  @if (!$updateSubCategoryMode)
                                      <option value=""> -- Não Selecionado--</option>
                                  @endif
                                  @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                 @endforeach
                                </select>
                                <span class="text-danger">@error('parent_category'){{$message}} @enderror</span>
                            </div>
                            <div class="mb-3">
                                <label for="subcategory_name" class="form-label">Nome da sub-categoria</label>
                                <input type="text" class="form-control" placeholder="Introduza o nome da sua sub-categoria" wire:model="subcategory_name" id="subcategory_name">
                                <span class="text-danger">@error('subcategory_name'){{{$message}}}@enderror</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn  link-secondary me-auto" data-bs-dismiss="modal">Cancelar</a>
                            <button type="submit" class="btn btn-primary">{{$updateSubCategoryMode ? 'Actualizar' : 'Salvar'}}</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            <!--end add or update modal-->
            </div>
          </div>
        </div>

      </div>
</div>

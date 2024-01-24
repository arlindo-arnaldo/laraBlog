<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;
use Illuminate\Support\Str;

class Categories extends Component
{
    public $category_name, $selected_category_id;
    public $updateCategoryMode = false;


    public $subcategory_name, $selected_subcategory_id, $parent_category;
    public $updateSubCategoryMode = false;

    protected $listeners = [
        'DisbleUpdateMode'
    ];
    public function DisbleUpdateMode(){
        $this->updateCategoryMode = false;
        $this->updateSubCategoryMode = false;
        $this->category_name = null;
        $this->subcategory_name = null;
        $this->parent_category = null;
        $this->resetErrorBag();
    }
    public function addCategory(){  
        $this->validate([
            'category_name' => 'required|unique:categories,category_name',
        ]);
        $category = new Category();
        $category->category_name = $this->category_name;
        $saved = $category->save();
        if ($saved) {
            $this->dispatchBrowserEvent('hide_category_modal');
        }   
    }
    public function editCategory($category){
        $this->category_name = $category['category_name'];
        $this->selected_category_id = $category['id'];
        $this->updateCategoryMode = true;
        
        $this->dispatchBrowserEvent('show_category_modal');
    }
    public function updateCategory(){
        $this->validate([
            'category_name' => 'required|unique:categories,category_name,'.$this->selected_category_id,
        ],[
            'category_name.required' => 'Insira o nome da categoria',
            'category_name.unique' => 'Já existe uma categoria com este nome',
        ]);
        $category = Category::find($this->selected_category_id);
        $updated = $category->update([
            'category_name' => $this->category_name
        ]);
        if ($updated) {
            $this->dispatchBrowserEvent('hide_category_modal');
            $this->updateCategoryMode = false;
        }
    }
    public function addSubCategory(){
       $this->validate([
        'subcategory_name' => 'required|unique:sub_categories,subcategory_name',
        'parent_category' => 'required|exists:categories,id',
       ],[
        'subcategory_name.required' => 'Insira o nome da subcategoria',
        'subcategory_name.unique' => 'Já existe uma subcategoria com este nome',
        'parent_category.required' => 'Escolha uma categoria mãe para a sua subcategoria',
       ]);

       $subcategory = new SubCategory();
       $subcategory->subcategory_name = $this->subcategory_name;
       $subcategory->slug  = Str::slug($this->subcategory_name);
       $subcategory->parent_category = $this->parent_category;
       $saved = $subcategory->save();
       if($saved){
            $this->subcategory_name = null;
            $this->parent_category = null;
            $this->dispatchBrowserEvent('hide_subcategory_modal');
       }
    }
    public function editSubCategory($subcategory){
        $this->selected_subcategory_id = $subcategory['id'];
        $subcategory = SubCategory::findOrFail($this->selected_subcategory_id);
        $this->subcategory_name = $subcategory->subcategory_name;
        $this->parent_category = $subcategory->parent_category;
        $this->updateSubCategoryMode = true;
        $this->dispatchBrowserEvent('show_subcategory_modal');
        
    } 
    public function updateSubCategory(){
        $subcategory = SubCategory::findOrFail($this->selected_subcategory_id);
        $subcategory->subcategory_name = $this->subcategory_name;
        $subcategory->parent_category = $this->parent_category;
        $updated = $subcategory->save();
        if ($updated) {
            $this->dispatchBrowserEvent('hide_subcategory_modal');
        }

        
    }
    public function render()
    {
        return view('livewire.categories', ['categories' => Category::orderby('ordering', 'asc')->get(), 'subcategories' => SubCategory::orderby('ordering', 'asc')->get()]);
    }
}

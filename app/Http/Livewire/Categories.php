<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public $category_name, $selected_category_id;
    public $updateCategoryMode = false;
    protected $listeners =[
        'DisbleUpdateCategoryMode'
    ];
    public function DisbleUpdateCategoryMode(){
        $this->updateCategoryMode = false;
        $this->category_name = null;
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
        $this->resetErrorBag();
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
            $this->emit('DisbleUpdateCategoryMode');
            $this->updateCategoryMode = false;
        }
    } 
    public function render()
    {
        return view('livewire.categories', ['categories' => Category::orderby('ordering', 'asc')->get()]);
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Author extends Component
{
    use WithPagination;
    public $author_id,$name, $email, $username, $author_type, $direct_publisher, $blocked;
    public $author, $per_page = 4;
    public $search;

    protected $listeners = [
        'resetForms',
        'deleteAuthorAction'
    ];
    public function mount(){
        $this->resetPage();
    }
    public function updatingSearch(){
        $this->resetPage();
    }
    public function resetForms(){
        $this->name = $this->email = $this->username = $author_type  = $direct_publisher = null;
        $this->resetErrorBag();
    }
    public function addAuthor(){
        
        $this->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:6|max:20',
            'author_type' => 'required',
            'direct_publisher' => 'required'
        ],[
            'author_type.required' => 'Choose author type',
            'direct_publisher.required' => 'Specify author publication access',
        ]);
        $default_password = Random::generate(8);  
        $this->author = new User();
        $this->author->name = $this->name;
        $this->author->email = $this->email;
        $this->author->username = $this->username;
        $this->author->password = Hash::make($default_password);
        $this->author->type = $this->author_type;
        $this->author->direct_publish = $this->direct_publisher;
        if($this->author->save()){

            info('Salvo com sucesso!');
            info('Email: '.$this->email);
            info('Password: '.$default_password);
            info('-----------------------');

            $this->dispatchBrowserEvent('hide_add_author_modal');
            $this->dispatchBrowserEvent('show_success_modal');
        }
    }
    public function editAuthor($author){
        $this->author_id = $author['id'];
        $this->name = $author['name'];
        $this->email = $author['email'];
        $this->username = $author['username'];
        $this->author_type = $author['type'];
        $this->direct_publisher = $author['direct_publish'];
        $this->blocked = $author['blocked'];
        $this->dispatchBrowserEvent('show_edit_author_modal');
    }
    public function updateAuthor(){
        $this->validate([
            'name' =>'required',
            'email' => 'required|email|unique:users,email,'.$this->author_id,
            'username' => 'required|min:6|max:20|unique:users,username,'.$this->author_id,
        ]);
        if($this->author_id){
            $author = User::find($this->author_id);
            $author->update([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'type' => $this->author_type,
                'direct_publish' => $this->direct_publisher,
                'blocked' => $this->blocked
            ]);
            $this->dispatchBrowserEvent('hide_edit_author_modal');
        }
    }
    public function showDeleteModal($author){
        $this->author = $author['id'];
        $this->dispatchBrowserEvent('show_delete_confirm_modal');
        
    }
    public function deleteAuthorAction(){
        //$this->author = $this->showDeleteModal($author);
        $author = User::find($this->author);    
       $path = 'back/dist/img/authors/';
       $picture = $author->picture;
       $file_path = $path.explode('/', $picture)[7];
       
       $email = $author->email;
       if ($file_path != null && File::exists(public_path($file_path))) {
            if($file_path != $path.'default-img.png'){
                File::delete(public_path($file_path));
                info('Deletando Foto de '.$author->email);
            }
        }
        $author->delete();
        info('Autor '.$email.' deletato...');
        info('---------------------------');
        $this->dispatchBrowserEvent('hide_delete_confirm_modal');
    }
    
    public function render()
    {
        return view('livewire.author', ['authors' => User::search(trim($this->search))->where('id', '!=', auth()->user()->id)->paginate($this->per_page)]);
    }
}

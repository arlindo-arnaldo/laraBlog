<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Author extends Component
{
    use WithPagination;
    public $name, $email, $username, $author_type, $direct_publisher;
    public $author, $per_page = 4;
    public $search;
    protected $listeners = [
        'resetForms',
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
    public function render()
    {
        return view('livewire.author', ['authors' => User::search(trim($this->search))->where('id', '!=', auth()->user()->id)->paginate($this->per_page)]);
    }
}

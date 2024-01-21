<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Setting;

class AuthorGeneralSettings extends Component
{
    public $blog_name, $blog_email, $blog_description;
    public $settings;

    public function mount(){
    
        $this->settings = Setting::find(1);
        $this->blog_name = $this->settings->blog_name;
        $this->blog_email = $this->settings->blog_email;
        $this->blog_description = $this->settings->blog_description;
    }
    public function UpdateGeneralSettings(){
        $this->validate([
          'blog_name' => 'required',
          'blog_email' => 'required|email'
        ]);
        
        $update = $this->settings->update([
            'blog_name' => $this->blog_name,
            'blog_email' => $this->blog_email,
            'blog_description' => $this->blog_description
        ]);
        if($update){
            $this->emit('UpdateAuthorFooter');
        }else{
            info("Erro ");
        }
        
    }
    public function render()
    {
        return view('livewire.author-general-settings');
    }
}

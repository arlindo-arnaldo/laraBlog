<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthorChangePassword extends Component
{
    public $current_password, $new_password, $confirm_password;

    public function changePassword()
    {
        $this->validate([
            'current_password' => [
                'required', function($attribute, $value, $fail){
                if (!Hash::check($value, User::find(auth('web')->id())->password)) {
                    return $fail(__('The current password is incorrect'));
                }
            },
        ],
        'new_password' => 'required|min:5|max:25',
        'confirm_password' => 'required|same:new_password'
        ],
    [
        'current_password.required' => 'Insira a sua senha actual',
        'new_password.required' => 'Introduza a senha nova',
        'confirm_password.required' => 'Confirme a nova senha',
        'confirm_password.same' => 'Esta senha deve ser igual a nova senha'
    ]);

    if(User::find(auth('web')->id())->update(['password' => Hash::make($this->new_password)])){
        $this->current_password = $this->new_password = $this->confirm_password = null;
        $this->dispatchBrowserEvent('show_modal_updated_profile');
    }

    }
    public function render()
    {
        return view('livewire.author-change-password');
    }
    
    
}

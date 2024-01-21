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
        'current_password.required' => 'Enter your Current Password',
        'new_password.required' => 'Enter your new password',
        'confirm_password.same' => 'The confirm password must be equal to the new password'
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

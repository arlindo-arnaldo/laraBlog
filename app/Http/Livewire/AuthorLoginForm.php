<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorLoginForm extends Component
{
    public $email, $password;
    public $returnUrl;
    
    public function mount(){
        $this->returnUrl = request()->returnUrl;
    }

    public function LoginHendler(){
        $this->validate([
           'email' => 'required|email|exists:users,email',
           'password' => 'required|min:3'
        ],[
            'email.required' => 'Enter your email address',
            'email.email' => 'This email is not valid',
            'email.exists' => 'This email does not exist in the database',
            'password.required' => 'Enter your password'
        ]);
            
        $creds = array('email' => $this->email, 'password' => $this->password);

        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where('email', $this->email)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your  account had been blocked');
            }else{
                if ($this->returnUrl !=null) {
                    info(auth()->user()->name.' Fez o login');
                    return redirect()->to($this->returnUrl);
                }else {
                    return redirect()->route('author.home');
                }
                
            }
        }else{
            session()->flash('fail', 'Incorrect email or password');
        }
    }
    public function render()
    {
        return view('livewire.author-login-form');
    }
}

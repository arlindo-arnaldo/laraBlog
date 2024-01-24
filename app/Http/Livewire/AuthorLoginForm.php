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
            'email.required' => 'Insira seu email',
            'email.email' => 'Este email é invalido',
            'email.exists' => 'O email não existe na base de dados',
            'password.required' => 'Insira uma senha'
        ]);
            
        $creds = array('email' => $this->email, 'password' => $this->password);

        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where('email', $this->email)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Sua conta encontra-se bloqueada');
            }else{
                if ($this->returnUrl !=null) {
                    
                    info($checkUser->name.' Fez o login');
                    return redirect()->to($this->returnUrl);
                    
                }else {
                    info($checkUser->name.' Fez o login');
                    return redirect()->route('author.home');
                    
                }
                
            }
        }else{
            session()->flash('fail', 'Email ou senha Incorrecto');
        }
    }
    public function render()
    {
        return view('livewire.author-login-form');
    }
}

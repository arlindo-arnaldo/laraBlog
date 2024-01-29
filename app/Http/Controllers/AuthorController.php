<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;

class AuthorController extends Controller
{
    public $handler = null;
    //
    public function index()
    {
        $users = User::all();
        return view('back.pages.home');
    }
    public function logout()
    {
        $name = auth()->user()->name;
        Auth::guard('web')->logout();
        info($name . ' deslogou do sistema');
        return redirect()->route('author.login');
    }
    public function changeProfilePicture(Request $request)
    {
        $user = User::find(auth('web')->id());
        $path = 'back/dist/img/authors/';
        $file = $request->file('file');
        //Recuperando dados da foto antiga
        $file_path = $path . explode('/', $user->picture)[7];
        //Criando a nova foto
        $new_picture_name = 'AIMG' . $user->id . time() . rand(0, 1000) . '.jpg';

        //Deletando a foto antiga
        if ($file_path != null && File::exists(public_path($file_path))) {
            if ($file_path != $path . 'default-img.png') {
                File::delete(public_path($file_path));
                info('Foto antiga de ' . $user->email . ' deletada com sucesso');
            }
        }
        //movendo a foto
        $upload = $file->move(public_path($path), $new_picture_name);
        //Actualizando a foto no banco de dados
        if ($upload) {
            info('Foto nova Carregada!');
            $user->update([
                'picture' => $new_picture_name,
            ]);
            return response()->json(['status' => 1, 'msg' => 'A sua imagem foi recortada e actualizada com sucesso.', 'name' => $new_picture_name]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Aconteceu um erro, tente novamente mais tarde']);
        }
    }
    public function createPost(Request $request){
        $request->validate([
            'post_title' => 'required|string',
        ]);
    }
}
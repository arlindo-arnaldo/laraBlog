<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AddPost extends Component
{
    use WithFileUploads;
    public $post_title;
    public $post_content;
    public $post_category;
    public $post_slug;
    public $featured_image;

    public function addPost(){
        //dd(request()->serverMemo['data']);
        $this->validate([
            'post_title' => 'required',
            'post_content' => 'required',
            'post_category' => 'required|exists:sub_categories,id',
            'featured_image' => 'required|image|max:4096',
        ]);
        
        if ($this->featured_image) {
            $path = 'images/post_images/';
            $file = $this->featured_image;
            $filename = $file->getClientOriginalName();
            $new_filename = time().$filename;
            
            $uploaded = $file->storeAs($path, $new_filename, 'public');
            $post_thumbnails_path = $path.'thumbnails';
            
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path);
            }

            //Gera uma imagem quadrada
            Image::make( storage_path('app/public/'.$path.$new_filename))
                    ->fit(200, 200)
                    ->save( storage_path('app/public/'.$path.'thumbnails/thumb_'.$new_filename));
            Image::make( storage_path('app/public/'.$path.$new_filename))
                    ->fit(500, 350)
                    ->save( storage_path('app/public/'.$path.'thumbnails/resized_'.$new_filename));
            if ($uploaded) {
                $post = new Post();
                $post->post_title = $this->post_title;
                $post->category_id = $this->post_category;
                $post->post_content = $this->post_content;
                $post->post_slug = Str::slug($this->post_title);
                $post->featured_image = $new_filename;
                $post->author_id = auth()->user()->id;
                $saved = $post->save();
                if($saved){
                    $this->post_title = null;
                    $this->post_category = null;
                    $this->post_content = null;
                    $this->featured_image = null;
                    $this->dispatchBrowserEvent('show_post_success_modal');
                }else{
                    $this->dispatchBrowserEvent('show_post_error_modal');
                }
            }else {
                dd('sdfffffff');
            }
            
        }
        
    }
    public function render()
    {
        return view('livewire.add-post');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\BlogSocialMedia;
use Livewire\Component;

class UpdateBlogSocialMedia extends Component
{
    public $facebook_url, $instagram_url, $youtube_url, $social;

    public function mount(){
        $this->social = BlogSocialMedia::find(1);
        $this->facebook_url = $this->social->bsm_facebook;
        $this->instagram_url = $this->social->bsm_instagram;
        $this->youtube_url = $this->social->bsm_youtube;
    }
    public function UpdateBlogSocialMedia(){
        $this->validate([
            'facebook_url'  => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url'   => 'nullable|url'
        ]);
        $social = $this->social->update([
            'bsm_facebook' => $this->facebook_url,
            'bsm_instagram' => $this->instagram_url,
            'bsm_youtube' => $this->youtube_url
        ]);
    }
    public function render()
    {
        return view('livewire.update-blog-social-media');
    }
}

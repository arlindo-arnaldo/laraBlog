<div>
    <form class="card" method="POST" wire:submit.prevent="UpdateBlogSocialMedia()">
        <div class="card-body">
          <h3 class="card-title"></h3>
          <div class="row row-cards">
            <div class="col-md-5">
              <div class="mb-3">
                <label class="form-label">Facebook</label>
                <input type="text" class="form-control" wire:model="facebook_url">
                <span class="text-danger">@error('facebook_url') {{$message}}@enderror</span>
              </div>
            </div>

            <div class="col-sm-6 col-md-3">
              <div class="mb-3">
                <label class="form-label">Instagram</label>
                <input type="text" class="form-control" placeholder="" wire:model="instagram_url">
                <span class="text-danger">@error('instagram_url') {{$message}}@enderror</span>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="mb-3">
                <label class="form-label">Youtube</label>
                <input type="text" class="form-control" placeholder="" wire:model="youtube_url">
                <span class="text-danger">@error('youtube_url') {{$message}}@enderror</span>
              </div>
            </div>
            
          </div>
        </div>
        <div class="card-footer text-end">
          <button type="submit" class="btn btn-primary">Update Profile</button>
        </div>
      </form>
</div>

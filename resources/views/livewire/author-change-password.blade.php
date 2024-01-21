<div>
  <form class="card" method="POST" wire:submit.prevent="changePassword()">
    <div class="card-body">
      <h3 class="card-title"></h3>
      <div class="row row-cards">
        <div class="col-md-5">
          <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-control" wire:model="current_password">
            <span class="text-danger">@error('current_password') {{$message}}@enderror</span>
          </div>
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" placeholder="" wire:model="new_password">
            <span class="text-danger">@error('new_password') {{$message}}@enderror</span>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" placeholder="" wire:model="confirm_password">
            <span class="text-danger">@error('confirm_password') {{$message}}@enderror</span>
          </div>
        </div>
        
      </div>
    </div>
    <div class="card-footer text-end">
      <button type="submit" class="btn btn-primary">Update Profile</button>
    </div>
  </form>
</div>

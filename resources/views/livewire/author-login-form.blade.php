<div>
    @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{Session::get('fail')}}
        </div>
    @endif
    <form wire:submit.prevent="LoginHendler()" method="post" autocomplete="off" novalidate>
        <div class="mb-3">
          <label class="form-label">Endereço de email</label>
          <input type="email" class="form-control" placeholder="seu@email.com" autocomplete="off" wire:model="email">
            @error('email')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
        <div class="mb-2">
          <label class="form-label">
            Password
            <span class="form-label-description">
              <a href="{{route('author.forgot-password')}}">Não lembro minha senha</a>
            </span>
          </label>
          <div class="input-group input-group-flat">
            <input type="password" class="form-control"  placeholder="Your password"  autocomplete="off" wire:model="password">
            
            
          </div>
          @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-2">
          <label class="form-check">
            <input type="checkbox" class="form-check-input"/>
            <span class="form-check-label">Guardar dados de acesso</span>
          </label>
        </div>
        <div class="form-footer">
          <button type="submit" class="btn btn-primary w-100">Log in</button>
        </div>
      </form>
</div>

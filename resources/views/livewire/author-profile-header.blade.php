<div>
    
    <div class="row align-items-center">
        <div class="col-auto">
          <span class="avatar avatar-lg rounded" style="background-image: url({{$author->picture}})"></span>
        </div>
        <div class="col">
          <h1 class="fw-bold">{{$author->name}}</h1>

          <div class="list-inline list-inline-dots text-muted">
           @ {{$author->username}} | {{$author->authorType->name}}
          </div>
          <div class="my-2">
            {{$author->biography}}
          </div>
          
        </div>
        <div class="col-auto ms-auto">
          <div class="btn-list">
            <input type="file" name="file" id="changeAuhorPictureFile" class="d-none" onchange="this.dispatchEvent( new InputEvent('input'))">
            <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.querySelector('#changeAuhorPictureFile').click()">
              <!-- Download SVG icon from http://tabler-icons.io/i/check -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
              Alterar Foto
            </a>
          </div>
        </div>
      </div>

</div>

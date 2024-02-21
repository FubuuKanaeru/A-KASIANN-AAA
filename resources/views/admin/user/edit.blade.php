@if ($edit)
          <div class="card">
            <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input wire:model="nama" type="text" class="form-control" id="nama" name="nama">
                    @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input wire:model="email" type="email" class="form-control" id="email" name="email">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>
                 
            </div>
        </div>
@endif 
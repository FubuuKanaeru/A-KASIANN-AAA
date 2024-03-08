@if($create)
<div class="modal fade show" id="modal-default" role="dialog" style="padding-right: 17px; display: block;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ulasan</h4>
        <span  wire:click="format"  type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="ulasan">Ulasan</label>
            <input wire:model="ulasan" type="textarea" class="form-control" id="ulasan" min="1">
            @error('ulasan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
      <div class="modal-footer justify-content-between">
        <span wire:click="format" type="button" class="btn btn-default" data-dismiss="modal">Batal</span>
        <span wire:click="store({{ $buku_id }})"  type="button" class="btn btn-success">Ulas Buku</span>
      </div>
    </div>
  </div>
</div>
@endif
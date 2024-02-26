@if($delete)
<div class="modal fade show" id="modal-default" role="dialog" style="padding-right: 17px; display: block;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ulasan</h4>
        <span wire:click="format"  type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus data ini?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <span wire:click="format" type="button" class="btn btn-default" data-dismiss="modal">Batal</span>
        <span wire:click="destory({{ $ulasan_id }})"  type="button" class="btn btn-danger">Hapus</span>
      </div>
    </div>
  </div>
</div>
@endif
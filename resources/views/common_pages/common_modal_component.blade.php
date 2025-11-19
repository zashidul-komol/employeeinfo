<div class="modal fade" id="{{ $id ?? 'common-modal' }}" tabindex="-1" role="dialog" aria-labelledby="modal-nofooter-label">
    <div class="modal-dialog {{ $modalSize ?? '' }}" role="document">
        <div class="modal-content">
            <div class="modal-header state">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="modal-title">
                    {{ $modalTitle ?? 'Detail Information' }}
                </h4>
            </div>
            <div class="modal-body" id="{{ $bodyid ?? 'modal-body' }}">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
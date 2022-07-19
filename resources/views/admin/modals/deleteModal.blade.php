<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-center mt-4 mb-3">Confirm Action</h3>
                        <p class="text-center">Are you sure you want to delete this record?</p>
                    </div>
                </div>
                <div class=" mt-3 mb-5 mm-delete-flex">
                    <div class="">
                        <button class="btn edit_save" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <div class="">
                        <form method="post" id="deleteForm">
                            <input type="hidden" name="id" id="identity">
                            @csrf
                            @method('DELETE')
                            <button class="btn edit_save" type="submit" >Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

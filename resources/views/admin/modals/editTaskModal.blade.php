<div class="modal fade" id="edit_task" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('update_task') }}" id="update_task_form">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 error-placeholder">
                            <label class="form-label">Task Name</label>
                            <input type="text" class="form-control edit_name" name="update_name">
                            <span class="invalid-feedback">
                                <p></p>
                            </span>
                        </div>
                        <div class="mb-3 error-placeholder">
                            <label class="form-label">Task Date</label>
                            <input type="Date" class="form-control edit_date" name="update_date">
                            <input type="hidden" class="form-control updated_id" name="updated_id">
                            <span class="invalid-feedback">
                                <p></p>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn edit_save" id="update_task_btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

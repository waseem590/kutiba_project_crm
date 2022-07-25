<div class="modal fade" id="add_task" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('save_task') }}" id="add_task_form">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 error-placeholder">
                            <label class="form-label">Task Name</label>
                            <input type="text" class="form-control" name="name">
                            <span class="invalid-feedback">
                                <p></p>
                            </span>
                        </div>
                        <div class="mb-3 error-placeholder">
                            <label class="form-label">Task Date</label>
                            <input type="Date" class="form-control" name="date">
                            <span class="invalid-feedback">
                                <p></p>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn edit_save" id="add_task_btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

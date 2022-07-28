<div class="modal fade" id="comment_modal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Comment</h5>
                    <button type="button" class="btn-close comment_close_btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Add Comment</label>
                            <!-- <input type="text" value="{{ $student->info->name ?? '' }}" class="form-control course_name" disabled> -->
                            <textarea rows="4" class="form-control comment_textarea"></textarea>
                            <p class="comment_textarea_p"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn edit_save save_comment" value="{{ $student_id ?? '' }}">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

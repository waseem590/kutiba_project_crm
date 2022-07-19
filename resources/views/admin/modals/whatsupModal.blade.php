<!-- whatsapp model -->
<div class="modal social-custom-modals fade" id="whatsapp-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title " id="exampleModalLabel">WhatsApp Student</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <img class="pt-2" src="{{ asset('admin/images/modal-close.png') }}" alt="">
          </button>
        </div>
        <div class="modal-body">
            <div>
                <div class="modal-info">
                    <span class="custom-id-and-name">ID and Name:</span>
                    <span>123 Ronny Chieng</span>
                </div>

                <div class="form-group mt-4">
                    <label for="usr">WhatsApp</label>
                    <input type="text" class="form-control" id="usr" placeholder="+966 551468888 ">
                  </div>
                  <div class="form-group">
                    <label for="usr">Subject</label>
                    <input type="text" class="form-control" id="usr">
                  </div>
                  <div class="form-group">
                    <label for="comment">Message</label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                  </div>
                  <div class="social-custom-modals-btnn text-center ">
                      <button class="btn btn-primary">Send</button>
                  </div>
            </div>
        </div>

      </div>
    </div>
  </div>

<div class="modal fade" id="mod_post_payroll_form">
  <div class="modal-dialog modal-md">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title"><i class="fa-solid fa-circle-info"></i> POST PAYROLL</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body" id="mb-salary-employee">
              
          </div>
          <div class="modal-footer justify-content-between">
              {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
              <button type="button" id="save" class="btn btn-primary ml-auto rounded-0" onclick="$('#frm-post-payroll').trigger('submit');"><i class="fa-solid fa-file-import"></i> Post</button>
          </div>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
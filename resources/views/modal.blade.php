<div id="companionsModal" class="modal modal-fixed-footer">
  <div class='template' style="display:none">
    <div class="row">
      <div class="input-field col s5">
        <input id="companion_first_name_{id}" name="companion_first_name[]" type="text" class="validate" required>
        <label for="companion_first_name_{id}">Last Name</label>
      </div>
      <div class="input-field col s5">
        <input id="companion_last_name_{id}" name="companion_last_name[]" type="text" class="validate" required>
        <label for="companion_last_name_{id}">First Name</label>
      </div>
      <div class="input-field col s2">
        <input id="companion_middle_initial_{id}" name="companion_middle_initial[]" type="text" class="validate" required>
        <label for="companion_middle_initial_{id}">Middle Initial</label>
      </div>
      <div class="input-field col s6">
        <input id="companion_nickname_{id}" name="companion_nickname[]" type="text" class="validate" required>
        <label for="companion_nickname_{id}">Nickname</label>
      </div>
      <div class="input-field col s6">
        <input id="companion_email_address_{id}" name="companion_email_address[]" type="email" class="validate" required>
        <label for="companion_email_address_{id}">Email Address <i>(Ticket will be sent here)</i></label>
      </div>
      <p class="caption">If alumnus, </p>
      <div class="input-field col s6">
        <input id="companion_company_{id}" name="companion_company[]" type="text" class="validate">
        <label for="companion_company_{id}">Company</label>
      </div>
      <div class="input-field col s6">
        <input id="companion_job_title_{id}" name="companion_job_title[]" type="text" class="validate">
        <label for="companion_job_title_{id}">Job Title</label>
      </div>
      <div class="input-field col s6">
        <input id="companion_batch_{id}" name="companion_batch[]" type="number" class="validate" required>
        <label for="companion_batch_{id}">Batch (Year)</label>
      </div>
    </div>
  </div>
  <form name="frmRegister" data-type="with-companions">
    <div class="modal-content">
      <h4>Companions Details</h4>
      <div class="fields-content"></div>
    </div>
    <div class="modal-footer">
      <button type="button" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
      <button type="submit" class=" waves-effect waves-green btn-flat">Proceed</button>
    </div>
  </form>
</div>

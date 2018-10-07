@include('header')
<div class="container">
  <div class="row">
    <div class="col s12 m10 offset-m1" style="margin-top:30px">
      <div class="card">
        <form name="frmRegister">
          <div class="card-content">
            <span class="card-title black-text">Register</span>
            <div class="row">
              <div class="input-field col s5">
                <input id="first_name" name="first_name" type="text" class="validate" required>
                <label for="first_name">Last Name</label>
              </div>
              <div class="input-field col s5">
                <input id="last_name" name="last_name" type="text" class="validate" required>
                <label for="last_name">First Name</label>
              </div>
              <div class="input-field col s2">
                <input id="middle_initial" name="middle_initial" type="text" class="validate" required>
                <label for="middle_initial">Middle Initial</label>
              </div>
              <div class="input-field col s8">
                <input id="nickname" name="nickname" type="text" class="validate" required>
                <label for="nickname">Nickname</label>
              </div>
              <div class="input-field col s4">
                <input id="number_of_companions" name="number_of_companions" type="number" class="validate" required>
                <label for="number_of_companions">Number of Companions</label>
              </div>
              <div class="input-field col s6">
                <input id="email_address" name="email_address" type="email" class="validate" required>
                <label for="email_address">Email Address</label>
              </div>
              <div class="input-field col s6">
                <input id="contact_number" name="contact_number" type="text" class="validate" required>
                <label for="contact_number">Contact #</label>
              </div>
              <div class="input-field col s6">
                <input id="company" name="company" type="text" class="validate" required>
                <label for="company">Company</label>
              </div>
              <div class="input-field col s6">
                <input id="job_title" name="job_title" type="text" class="validate" required>
                <label for="job_title">Job Title</label>
              </div>
            </div>
          </div>
          <div class="card-action" style="overflow:hidden">
            <h5 align='center'>Disclaimer</h5>
            <p style='text-align:justify;color:#545454'>
              &quot;The event organizers are collecting information from you as participants for the purposes of registration and overall event management.   By providing your information, you are giving your consent to us to use your information for the aforementioned purposes.
            </p>
            <p style='text-align: justify;color:#545454'>
              After conclusion of the event and completion of all necessary reports, your personal data will be saved in secure files for future reference and networking activities. If you do not wish to be contacted further after this event, kindly inform the organizers.&quot;
            </p>
            <label>
              <input type="checkbox" name="terms">
              <span>I understand and agree to these terms.</span>
            </label>
          </div>
          <div class="card-action" style="overflow:hidden">
            <button type="submit" class="btn waves-light waves-effect right">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="companionsModal" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4>Companions Details</h4>
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
          <label for="companion_email_address_{id}">Email Address</label>
        </div>
        <div class="input-field col s6">
          <input id="companion_company_{id}" name="companion_company[]" type="text" class="validate" required>
          <label for="companion_company_{id}">Company</label>
        </div>
        <div class="input-field col s6">
          <input id="companion_job_title_{id}" name="companion_job_title[]" type="text" class="validate" required>
          <label for="companion_job_title_{id}">Job Title</label>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Proceed</a>
  </div>
</div>
@include('footer')

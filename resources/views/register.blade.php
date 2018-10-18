@include('header')
@include('modal')
<div class="container">
  <div class="row">
    <div class="col s12 m10 offset-m1" style="margin-top:30px">
      <div class="card">
        <form name="frmRegister">
          <div class="center-align" style="background:lightgreen;overflow:auto">
            <div class="col s3">
              <img src="{{ asset('public/img/ccss_thumb.png') }}" alt="" height="100px">
            </div>
            <div class="col s6" style="margin-top:15px">
              <span class="white-text card-title" style="font-weight:bold">
                <span style="font-family:LemonMilk;color:green;font-size:22px">UE-CCSS Alumni Homecoming</span><br>
                <span style="font-family:HighStories">Registration Form</span>
              </span>
            </div>
            <div class="col s3">
              <img src="{{ asset('public/img/ue_thumb.png') }}" alt="" height="100px">
            </div>
          </div>
          <div class="card-content">
            <div class="row">
              <div class="input-field col s5">
                <input id="first_name" name="first_name" type="text" class="validate" required>
                <label for="first_name">First Name</label>
              </div>
              <div class="input-field col s2">
                <input id="middle_initial" name="middle_initial" type="text" class="validate" required>
                <label for="middle_initial">Middle Initial</label>
              </div>
              <div class="input-field col s5">
                <input id="last_name" name="last_name" type="text" class="validate" required>
                <label for="last_name">Last Name</label>
              </div>
              <div class="input-field col s4">
                <input id="nickname" name="nickname" type="text" class="validate" required>
                <label for="nickname">Nickname</label>
              </div>
              <div class="input-field col s4">
                <input id="number_of_companions" name="number_of_companions" type="number" class="validate" required>
                <label for="number_of_companions">Number of Companions</label>
              </div>
              <div class="input-field col s4">
                <input id="batch" name="batch" type="number" class="validate" required>
                <label for="batch">Batch (Year)</label>
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
            <h6 align='center' style="font-weight:bold">Disclaimer</h6>
            <p style='text-align:justify;color:#545454;font-size:14px'>
              &quot;The event organizers are collecting information from you as participants for the purposes of registration and overall event management.   By providing your information, you are giving your consent to us to use your information for the aforementioned purposes.
            </p>
            <p style='text-align: justify;color:#545454;font-size:14px'>
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
@include('footer')

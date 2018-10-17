<h4 style="color:purple">PAYMENT INSTRUCTIONS</h4>
<div style="text-align:center;padding:0 20px;background-color:orange;color:white">
  Total Due<br>
  <span style="font-size:20px;font-weight:bold">PHP 280.00</span><br>
  Status: PENDING
</div>
<br>
<table width="50%">
  <tr>
    <td width="50%">Bank:</td>
    <td style="font-weight:bold" width="50%">PNB</td>
  </tr>
  <tr>
    <td width="50%">Ref No.</td>
    <td style="font-weight:bold" width="50%">{{ $data->user->reference_number }}</td>
  </tr>
  <tr>
    <td width="50%">Acct No:</td>
    <td style="font-weight:bold" width="50%">166010044084</td>
  </tr>
  <tr>
    <td width="50%">Acct Name:</td>
    <td style="font-weight:bold" width="50%">Rodany Merida and Ma. Teresa Borebor</td>
  </tr>
  <tr>
    <td width="50%">Acct Type:</td>
    <td style="font-weight:bold" width="50%">Peso Checking</td>
  </tr>
  <tr>
    <td width="50%">Amount:</td>
    <td style="font-weight:bold" width="50%">PHP 280.00</td>
  </tr>
  <tr>
    <td width="50%">Description:</td>
    <td style="font-weight:bold" width="50%">somewhere</td>
  </tr>
  <tr>
    <td width="50%">Deadline:</td>
    <td style="font-weight:bold;color:red" width="50%">Saturday, October 6, 2018</td>
  </tr>
</table>
<br>
<h2 style="color:purple">Step 1: Pay</h2>
<ol>
  <li>Fill-up a regular deposit slip and pay exact amount in <b>CASH</b> or <b>ON-US Check</b> (check issued by this same bank) only.</li>
  <li>Note that some banks may charge a <i>handling fee</i> for deposits in their provincial branches.</li>
</ol>
<h2 style="color:purple">Step 2: Validate <span style="font-size:22px;color:red">[>> IMPORTANT <<]</span></h2>
<ol>
  <li>When deposit is completed, click on this link ({{ url("/upload?code=" . $data->code) }}) and fill up the details within the same day to validate.</li>
</ol>
<h2 style="color:purple">Step 3: Confirmation</h2>
<ol>
  <li>Payments are processed at end of the day.</li>
  <li>We will send a confirmation email to you once processed. If you do not receive one by noon time of the next day, you may call us at (02)655-6820, email help@blabla.ph</li>
</ol>

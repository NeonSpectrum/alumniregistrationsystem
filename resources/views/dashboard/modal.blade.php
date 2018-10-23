<div id="verifyPasswordModal" class="modal">
  <form name="frmVerifyPassword" data-type="with-companions">
    <input type="hidden" name="type">
    <input type="hidden" name="code">
    <div class="modal-content">
      <h4>Verify Password</h4>
      <div class="input-field">
        <input id="verify_password" name="password" type="password" class="validate">
        <label for="verify_password">Password</label>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
      <button type="submit" class=" waves-effect waves-green btn-flat">Send</button>
    </div>
  </form>
</div>
<div id="viewPictureModal" class="modal modal-fixed-footer">
  <form name="frmViewPicture">
    <input type="hidden" name="code">
    <div class="modal-content">
      <h4>View Deposit Slip</h4>
      <img src="" alt="" width="100%">
    </div>
    <div class="modal-footer">
      <button type="button" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
      <button type="submit" class=" waves-effect waves-green btn-flat">Mark as Paid</button>
    </div>
  </form>
</div>

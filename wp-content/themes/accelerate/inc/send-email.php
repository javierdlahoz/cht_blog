<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="modal fade" id="emailModalForm" role="dialog" displayed="false" data-backdrop="static" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-email-content">
      <div class="modal-email-header">
        <button type="button" class="modal-email-close" data-dismiss="modal" aria-label="Close" id="dismiss-email-modal">
          <i class="fa fa-close"></i>
        </button>
        <h3 class="modal-email-title text-center">Let's Keep in Touch!</h3>
        <h6 class="modal-email-title text-center">Get valuable information from the leading Nonprofit Topic Experts straight to your inbox.<br/> Subscribe to the CharityHowTo Blog.</h6>
      </div>
      <div class="modal-body">
      <h6 class="modal-email-text text-center">Thank you for subscribing! :)</h6>
      <h6 class="modal-email-text text-center">The subscription was not successful :(</h6>
      <form id="subscribe-email-form">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="johndoe@mail.com" aria-label="johndoe@mail.com" aria-describedby="basic-addon2" id="subscriber-email">
          </div>
      </form>
      </div>
      <div class="modal-email-footer">
      <button class="g-recaptcha" data-sitekey="6LfDCmgUAAAAAIN-vsdjtXEV2dyibM_5nYIDQX7H"
                      data-callback='submitEmail' id="buttonemail" class="btn btn-success" type="button">I WANT TO SUBSCRIBE!</button>
      </div>
    </div>
  </div>
</div>
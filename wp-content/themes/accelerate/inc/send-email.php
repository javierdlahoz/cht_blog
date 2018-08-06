<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="modal fade" id="emailModalForm" role="dialog" displayed="false" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-email-content" id="modal-body">
            <div class="modal-email-header">
                <button type="button" class="modal-email-close" data-dismiss="modal" aria-label="Close"
                        id="dismiss-email-modal">
                    <i class="fa fa-close"></i>
                </button>
                <div id="modal-captions" style="display: block">
                    <h3 class="modal-email-title text-center">Let's Keep in Touch!</h3>
                    <h5 class="modal-email-title text-center"><i>Get valuable information</i> from the leading Nonprofit Topic
                        Experts straight to your inbox</h5>
                </div>
                <div id="modal-messages" class="text-center" style="display: none; margin-top: 40px">
                    <h2 class="modal-email-text" id="thank-you-modal" style="display: none">
                        Thank you for subscribing!
                    </h2>
                    <h6 class="modal-email-text" id="error-modal" style="display: none">
                        The subscription was not successful
                    </h6>
                    <h6 id="modal-processing">Processing...</h6>
                </div>
            </div>
            <div class="modal-body text-center">
                <form id="subscribe-email-form">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="johndoe@mail.com"
                               aria-label="johndoe@mail.com" aria-describedby="basic-addon2" id="subscriber-email">
                    </div>
                    <button class="g-recaptcha btn-transparent" data-sitekey="6Lf9nmYUAAAAALqJTSH41n_jvQP9PS_EXKTsMQn8"
                            data-callback='submitEmail' id="buttonemail" type="button">I WANT TO
                        SUBSCRIBE!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
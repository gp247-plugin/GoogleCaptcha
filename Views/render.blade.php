{{--
    Front-end reCAPTCHA widget injected into storefront forms by the core
    helper gp247_captcha_processview(): it renders this view inside the target
    <form> (register / forgot / login / checkout ...).

    GP247 2.0 (TailAdmin/GP247Front) rebuilt every storefront form and no
    longer exposes the legacy `gp247-form-process` / `gp247-button-process`
    element ids the 1.x invisible-button implementation hooked onto, so that
    approach silently breaks on 2.0. Instead we render the standard reCAPTCHA
    v2 checkbox widget: it auto-injects the hidden `g-recaptcha-response` field
    (see AppConfig::getField()) into the enclosing <form>, needing no fixed
    ids, no JS callback and no extra submit button — fully template-agnostic.
--}}
<div>
    <div class="g-recaptcha" data-sitekey="{{ gp247_config('GoogleCaptcha_site_key') }}"></div>
    @if ($errors->has('captcha_field'))
        <p class="text-xs text-red-600 mt-1">{{ $errors->first('captcha_field') }}</p>
    @endif
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

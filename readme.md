> 🌐 **Language:** [🇻🇳 Tiếng Việt](./readme_vi.md) · 🇬🇧 English (current)

# Google reCAPTCHA Plugin for GP247

## Introduction

This plugin protects your GP247 website from spam (fake registrations, automated form submissions) using the **Google reCAPTCHA v2 — "I'm not a robot"** checkbox (the familiar tick box). This document is written for **shop owners / administrators who are not technical**: after reading it you can register your own Google keys, install the plugin, and enable captcha on pages such as registration, forgot password, and checkout — without needing a developer. The last section is for developers who want to add captcha to a custom form.

> ⚠️ **Important:** Since version 2.0 the plugin uses **reCAPTCHA v2 (the "I'm not a robot" checkbox)**, **not** reCAPTCHA v3. When registering your keys at Google you must pick the v2 type (see Step 1); if you pick v3 by mistake, the checkbox will not appear and the form will always report a captcha error.

## Operating conditions (read before installing)

The captcha box **only appears** when **all** of the conditions below are met. If any single line is missing, the captcha will not show up:

**Group A — Things you enable in Admin (required):**
1. The **GoogleCaptcha** plugin is **Installed** and **Enabled**.
2. Both the **Site Key** and **Secret Key** are entered, and they are genuinely **reCAPTCHA v2 checkbox** keys.
3. Under **Shop Config → Captcha tab**: the status is switched **ON**, the method **Google reCaptcha** is selected, and the target **pages are checked**.

**Group B — The page must have a "slot" for the captcha:**
4. Only pages that GP247 supports out of the box have a place to show the captcha. There are 4: **Register**, **Forgot password**, **Contact**, **Checkout**. Any page not in this list (or not checked in step 3) will have no captcha.
5. If you use a **customized template**, that page's form must keep the captcha output line provided by GP247. The default GP247 template already includes it — just keep this in mind when you edit a template yourself (see "For developers").

> 💡 Simple way to think about it: **Group A** is "have you turned it on correctly", **Group B** is "does this page support captcha". Both must be true for the checkbox to appear.

## System requirements

- GP247 version **2.0 or higher**.
- Any **Google account** (Gmail) to register the reCAPTCHA keys (free).

## Step 1 — Register Google reCAPTCHA v2 (get the Site Key & Secret Key)

1. Open your browser and go to the key-creation page: [https://www.google.com/recaptcha/admin/create](https://www.google.com/recaptcha/admin/create)
2. **Sign in** with your Google account (if you are not already signed in).
3. In the **Label** field, type a memorable name, e.g. your website name: `my-shop`.
4. In the **reCAPTCHA type** section, choose **Challenge (reCAPTCHA v2)**, then choose **"I'm not a robot" Checkbox**.

   > ⚠️ This is the easiest step to get wrong. You **must** pick v2 → checkbox, **not** v3.
5. In the **Domains** section, add your website domain(s), one per line, **without** `https://`. For example:

   ```
   my-shop.com
   www.my-shop.com
   ```

   If you are testing on your own machine, also add `localhost`.
6. Tick the box to accept the terms (**Accept the reCAPTCHA Terms of Service**), then click **Submit**.
7. On success, Google shows **2 keys**:
   - **Site Key** (the public key) — a string starting with `6L...`
   - **Secret Key** — also starting with `6L...`

   Keep this page open to copy them shortly, or paste both keys somewhere temporary (Notepad).

## Step 2 — Install and enable the plugin in GP247

1. Log in to the GP247 **Admin Panel**.
2. Go to **Extension → Plugins**.
3. Find the **GoogleCaptcha** card and click **Install**.
4. After it installs, click **Enable** on the same card. On success the plugin switches to the enabled state.

### Install from the command line (CLI, gp247 3.x)

This is an alternative to the 4 admin actions above. Since gp247 3.x you can download **GoogleCaptcha** from the GP247 library and install it straight from the command line, without opening the admin. The plugin requires the `gp247/front` package on the website. Open a terminal in the website's root folder and run:

```bash
# 1) Once per website: register the (free) API License that connects the site to the GP247 library
php artisan gp247:ext-register-license

# 2) Download the plugin from the library and install it
php artisan gp247:ext-install --type=plugin --key=GoogleCaptcha
```

- Before step 1, make sure `APP_URL` in `.env` is the website's **real domain** (not `http://localhost`) — the license is bound to that domain.
- Once installed, the plugin is **enabled** and caches are refreshed automatically; you no longer need to click Install/Enable in the admin.
- The command checks the requirements declared in `gp247.json` (core version, composer packages, required plugins) and stops with a clear message if something is missing (e.g. `gp247/front` is not installed).
- If the folder `app/GP247/Plugins/GoogleCaptcha` is already on the server (copied manually or shipped with the installer), the command **installs it in place** instead of downloading it again.
- The command refuses a plugin that is already installed. To move to a newer version, run `php artisan gp247:ext-update --type=plugin --key=GoogleCaptcha`.
- Append `--json` to get machine-readable output (for scripts/CI).
- The post-install configuration steps below still apply: you still need **Step 3** (enter the Site Key & Secret Key) and **Step 4** (enable captcha, choose pages) before the captcha box appears.
- More: [Installing Plugins & Templates](https://github.com/gp247net/gp247-docs/blob/main/extension/install-extension.md) · [Command reference](https://github.com/gp247net/gp247-docs/blob/main/system/command-line-reference.md).

## Step 3 — Enter the Site Key & Secret Key

1. Still under **Extension → Plugins**, click **GoogleCaptcha** to open its config screen.
2. Paste the two keys from Step 1 into the correct fields:
   - **Site key** ← paste Google's **Site Key**.
   - **Secret key** ← paste Google's **Secret Key**.
3. Click **Save**. On success you will see a save-successful message.

## Step 4 — Enable captcha and choose the target pages

1. Go to **Shop Setting → Shop Config**.
2. Select the **Captcha** tab.
3. Switch the captcha status to **ON**.
4. For the method, select **Google reCaptcha**.
5. **Check the pages** where you want the captcha to appear: **Register**, **Forgot password**, **Contact**, **Checkout** (pick as many as you like).
6. Click **Save**.

## Verify it works

1. Open your website as a guest (or in an incognito window) and go to the **Register** page.
2. If configured correctly, the **"I'm not a robot"** checkbox appears inside the form.
3. Tick it, fill in the details, then click the register button. If you submit without ticking, the form reports a captcha error and blocks you.

## For developers — add captcha to a custom form

Since version 2.0 the old `idForm` / `idButtonForm` mechanism has been **removed** (it relied on fixed IDs that the new template no longer provides). The new approach needs **no IDs**: just place the widget **inside** the `<form>` tag, and Google will inject the verification data into that form automatically.

The standard way (same as GP247's default forms): in the page controller, build the captcha piece and pass it to the view:

```php
// In the controller: 'register' is the page name — it must match a page checked in Step 4
$viewCaptcha = gp247_captcha_processview('register', 'Register');
// ... pass $viewCaptcha to the view
```

In the view, print it **inside** the `<form>` tag, above the submit button:

```blade
<form method="POST" action="...">
    @csrf
    {{-- ...input fields... --}}

    {!! $viewCaptcha ?? '' !!}

    <button type="submit">Submit</button>
</form>
```

Valid page names (matching the checkboxes in Step 4): `register`, `forgot`, `contact`, `checkout`.

## Common troubleshooting

- **No captcha box anywhere** → check in order: is the plugin Enabled; have you entered the Site Key; in Shop Config → Captcha is the status ON and is the **page you are viewing actually checked** (review "Operating conditions").
- **The captcha shows but every submit reports an error** → usually a **wrong Secret Key**, or you accidentally registered **v3 keys** instead of v2. Register the correct v2 keys again (Step 1).
- **Google says "Invalid domain" / the captcha complains about the domain** → your website domain has not been added to the **Domains** section in the Google reCAPTCHA admin (Step 1, item 5).
- **Nothing shows on your test machine** → add `localhost` to the key's Domains section.

## Uninstallation

1. Go to **Extension → Plugins** and find **GoogleCaptcha**.
2. Click **Disable** to turn it off temporarily.
3. Click **Uninstall** to remove it completely (this deletes the saved key configuration).

## Upgrade notes (version 2.0)

- Switched from **reCAPTCHA v3** to **reCAPTCHA v2 checkbox** so it works reliably with the new template (TailAdmin/Livewire), with no dependency on fixed form/button IDs.
- The admin config screen was rebuilt on TailAdmin/Livewire; the Site Key and Secret Key are still stored in the same `admin_config` rows as before, so already-configured values are **preserved** on upgrade.

## Q&A

**Q1: Does the plugin use reCAPTCHA v2 or v3?**
Version 2.0 uses **v2 checkbox** (the "I'm not a robot" tick box). You must pick this exact type when registering the keys at Google.

**Q2: I already have reCAPTCHA v3 keys — can I reuse them?**
No. v3 and v2 keys are different. You need to register a new **v2 checkbox** key pair following Step 1.

**Q3: Everything is enabled but the captcha still doesn't show on the register page?**
Re-check the **Operating conditions**: the most common cause is not having **checked the "Register" page** in Shop Config → Captcha, or not entering the Site Key.

**Q4: The captcha only appears on some pages, not others?**
That is by design — the captcha only appears on the pages you **checked** in Step 4, and only within the pages GP247 supports (register, forgot password, contact, checkout).

**Q5: Does reCAPTCHA cost money?**
No. Google reCAPTCHA v2 is free for normal usage.

**Q6: What do I do if I change my website domain?**
In the Google reCAPTCHA admin, add the new domain to the **Domains** section of the key you are using (no need to create a new key).

**Q7: How do I add captcha to a form I built myself?**
See "For developers": put `{!! $viewCaptcha !!}` inside the `<form>` tag and call `gp247_captcha_processview(...)` in the controller. You do not need to declare form/button IDs like the old version.

**Q8: If I enter a wrong Secret Key, is there any warning?**
The captcha box still shows normally, but submitting the form always reports a verification error. Go back to the plugin config screen and re-enter the correct Secret Key.

**Q9: Does uninstalling the plugin lose the Site Key / Secret Key I entered?**
**Disable** only turns it off and keeps the keys. **Uninstall** deletes the key configuration entirely; to use it again you must re-enter them.

**Q10: When upgrading from 1.x to 2.0, do I have to re-enter the keys?**
No. The keys are preserved because they are stored in the same location as before. You only need to make sure the keys in use are the **v2 checkbox** type; if they were v3, you must register new ones following Step 1.

---

<sub>📅 **Last updated:** 2026-09-25 · ✍️ **Author:** GP247</sub>

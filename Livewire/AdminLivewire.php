<?php
#App\GP247\Plugins\GoogleCaptcha\Livewire\AdminLivewire.php

namespace App\GP247\Plugins\GoogleCaptcha\Livewire;

use GP247\Core\AdminShell\Infrastructure\ConfigForm;

/**
 * Admin settings screen for the GoogleCaptcha plugin (reCAPTCHA site/secret
 * key), backed by the admin_config key/value table.
 */
class AdminLivewire extends ConfigForm
{
    protected ?string $permission = null;

    /**
     * Kept as "Plugins" (not the configKey) on purpose: these rows have been
     * seeded under this group by AppConfig::install() since plugin version
     * 1.0, so already-installed sites keep their configured values across
     * the upgrade instead of losing them to a new empty group.
     */
    protected function group(): string
    {
        return 'Plugins';
    }

    protected function heading(): string
    {
        return gp247_language_render('Plugins/GoogleCaptcha::lang.title');
    }

    protected function keys(): array
    {
        return [
            'GoogleCaptcha_site_key',
            'GoogleCaptcha_secrect_key',
        ];
    }
}

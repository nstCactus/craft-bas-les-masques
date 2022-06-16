<?php

namespace nstcactus\baslesmasques\models;

use craft\base\Model;

class Settings extends Model
{
    /**
     * Enable the /actions/bas-les-masques/stop-impersonation route.
     * ⚠️ Use with caution: if you hand someone an impersonation URL, they will be able to log as the user who created the impersonation URL!
     * @var bool
     */
    public bool $enableStopImpersonationRoute = false;

    public function rules(): array
    {
        return [
            ['enableStopImpersonationRoute', 'boolean'],
        ];
    }
}

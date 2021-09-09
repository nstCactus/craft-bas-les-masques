<?php
/**
 * Bas les masques ! plugin for Craft CMS 3.x
 *
 * Helps you detect if a user is being impersonated and get the originally signed in user
 *
 * @link      https://github.com/nstCactus
 * @copyright Copyright (c) 2021 nstCactus
 */

namespace nstcactus\baslesmasques\variables;

use craft\elements\User;
use nstcactus\baslesmasques\Plugin;
use nstcactus\baslesmasques\services\BasLesMasquesService;

/**
 * @author    nstCactus
 * @package   BasLesMasques
 * @since     1.0.0
 */
class BasLesMasquesVariable
{
    /**
     * @see BasLesMasquesService::isImpersonating()
     */
    public function isImpersonating(): bool
    {
        return Plugin::getInstance()->service->isImpersonating();
    }

    /**
     * @see BasLesMasquesService::getOriginalUser()
     */
    public function getOriginalUser(): ?User
    {
        return Plugin::getInstance()->service->getOriginalUser();
    }
}

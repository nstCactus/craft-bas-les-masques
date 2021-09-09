<?php
/**
 * Bas les masques ! plugin for Craft CMS 3.x
 *
 * Helps you detect if a user is being impersonated and get the originally signed in user
 *
 * @link      https://github.com/nstCactus
 * @copyright Copyright (c) 2021 nstCactus
 */

namespace nstcactus\baslesmasques\services;

use craft\elements\User;

use Craft;
use craft\base\Component;

/**
 * @author    nstCactus
 * @package   BasLesMasques
 * @since     1.0.0
 */
class BasLesMasquesService extends Component
{
    /**
     * Return `true` if there is an ongoing impersonation, `false` otherwise.
     * @return bool
     */
    public function isImpersonating(): bool
    {
        return Craft::$app->session->has(User::IMPERSONATE_KEY);
    }

    /**
     * Return the original user (the one impersonating the other), or null if there is no ongoing impersonation.
     * @return User|null
     */
    public function getOriginalUser(): ?User
    {
        if (!$this->isImpersonating()) {
            return null;
        }

        return Craft::$app->getUsers()->getUserById(Craft::$app->session->get(User::IMPERSONATE_KEY));
    }
}

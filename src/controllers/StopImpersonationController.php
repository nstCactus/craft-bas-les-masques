<?php
/**
 * Bas les masques ! plugin for Craft CMS 3.x
 *
 * Helps you detect if a user is being impersonated and get the originally signed in user
 *
 * @link      https://github.com/nstCactus
 * @copyright Copyright (c) 2021 nstCactus
 */

namespace nstcactus\baslesmasques\controllers;

use craft\elements\User;
use craft\errors\MissingComponentException;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use nstcactus\baslesmasques\Plugin;

use Craft;
use craft\web\Controller;

/**
 * @author    nstCactus
 * @package   BasLesMasques
 * @since     1.0.0
 */
class StopImpersonationController extends Controller
{
    /**
     * Stop impersonating and log back as the original user.
     * Redirects to posted URL, if any, or to the homepage afterwards.
     * ⚠️ Use with caution: if you hand someone an impersonation URL, they will be able to log as the user who created the impersonation URL!
     * @return Response
     * @throws MissingComponentException
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     */
    public function actionIndex(): Response
    {
        $plugin = Plugin::getInstance();
        if (!$plugin->getSettings()->enableStopImpersonationRoute) {
            throw new ForbiddenHttpException();
        }

        if ($plugin->service->isImpersonating()) {
            $originalUser = $plugin->service->getOriginalUser();
            $sessionService = Craft::$app->getSession();

            if (!$originalUser) {
                $sessionService->setError("Could not stop impersonating: the original user can't be found.");

                return $this->redirectToPostedUrl(null, '/');
            }

            $sessionService->remove(User::IMPERSONATE_KEY);

            Craft::$app->getUser()->loginByUserId($originalUser->id);
        }

        return $this->redirectToPostedUrl(null, '/');
    }
}

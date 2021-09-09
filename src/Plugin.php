<?php
/**
 * Bas les masques ! plugin for Craft CMS 3.x
 *
 * Helps you detect if a user is being impersonated and get the originally signed in user
 *
 * @link      https://github.com/nstCactus
 * @copyright Copyright (c) 2021 nstCactus
 */

namespace nstcactus\baslesmasques;

use nstcactus\baslesmasques\models\Settings;
use nstcactus\baslesmasques\services\BasLesMasquesService;
use nstcactus\baslesmasques\variables\BasLesMasquesVariable;

use Craft;
use craft\base\Plugin as BasePlugin;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class BasLesMasques
 *
 * @author    nstCactus
 * @package   BasLesMasques
 * @since     1.0.0
 *
 * @property  BasLesMasquesService $service
 * @property-read Settings $settings
 * @method Settings getSettings()
 */
class Plugin extends BasePlugin
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->set('service', BasLesMasquesService::class);

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['siteActionTrigger1'] = 'bas-les-masques-!/site';
            }
        );

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('basLesMasques', BasLesMasquesVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'bas-les-masques',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    /**
     * @return Settings
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }
}

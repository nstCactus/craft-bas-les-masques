# *Bas les masques !* plugin for Craft CMS 3.x & 4.x

Helps you detect if a user is being impersonated and get the originally 
signed-in user.

## Requirements

This plugin requires Craft CMS 3.6.0 or later (might work with earlier 3.x
versions, but I didn't test it, and you'll need to tweak the composer.json).

Starting with version 2.0.0, this plugin requires Craft 4.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require nstcactus/craft-bas-les-masques

3. In the Control Panel, go to Settings → Plugins and click the “Install” button
   for *Bas les masques !*.


## Usage

### From the twig templates

#### `craft.basLesMasques.isImpersonating()`

Return a boolean indicating if there is an ongoing impersonation.

#### `craft.basLesMasques.getOriginalUser()`

Return the `User` element corresponding
to the original user (the one impersonating the other), or `null` if there is no
ongoing impersonation.

#### Example
```twig
    {% if craft.basLesMasques.isImpersonating() %}
        {{ craft.basLesMasques.getOriginalUser() }}
    {% endif %}
```

### From PHP code

#### `\nstcactus\baslesmasques\Plugin::getInstance()->service->isImpersonating()`

Return a boolean indicating if there is an ongoing impersonation.

#### `\nstcactus\baslesmasques\Plugin::getInstance()->service->getOriginalUser()`

Return the `User` element corresponding
to the original user (the one impersonating the other), or `null` if there is no
ongoing impersonation.

## What's with the strange name?

*Bas les masques!* is french for "Drop the act!" or "Stop pretending to be 
someone else". 

Brought to you by [nstCactus](https://github.com/nstCactus)

**Note: This has been forked from https://github.com/jakebathman/laravel-slack-api to add Laravel 8.x support.**

## Laravel 5 and Lumen - Slack API

[![Latest Stable Version](https://poser.pugx.org/RouxtAccess/laravel-slack-api/version)](https://packagist.org/packages/RouxtAccess/laravel-slack-api)
[![Total Downloads](https://poser.pugx.org/RouxtAccess/laravel-slack-api/downloads)](https://packagist.org/packages/RouxtAccess/laravel-slack-api)
[![Latest Unstable Version](https://poser.pugx.org/RouxtAccess/laravel-slack-api/v/unstable)](//packagist.org/packages/RouxtAccess/laravel-slack-api)
[![License](https://poser.pugx.org/RouxtAccess/laravel-slack-api/license)](https://packagist.org/packages/RouxtAccess/laravel-slack-api)

[![StyleCI](https://styleci.io/repos/102903970/shield?branch=master)](https://styleci.io/repos/102903970)

This package provides a simple way to use the [Slack API](https://api.slack.com).

The package is a fork from https://github.com/Vluzrmos/laravel-slack-api The original package is not maintained and I made several changes that possibly make this version incompatible to the original.

### Changes made:

* removed functionality to lookup user by nickname: this package provides basic functionality 
* removed cache as it was not needed anymore
* added basic tests
* updated slack api options on a couple of methods
* fixed minor bugs

## Installation 

`composer require RouxtAccess/laravel-slack-api`

## Installation on Laravel 5

The package has autodiscovery enabled. (A laravel 5.5 feature)

```php
[
    'providers' => [
        RouxtAccess\SlackApi\SlackApiServiceProvider::class,
    ]
]

```

## Configuration

This package uses slacks legacy tokens. Get you token here:

https://api.slack.com/custom-integrations/legacy-tokens

Configure your slack team token in <code>config/services.php</code> 

```php 

[
    //...,
    'slack' => [
        'token' => 'your token here'
    ]
]

```


## Installation on Lumen

I have not tested the lumen installation! Documentation from the original package:

Add the following line on `bootstrap/app.php`:

```php
// $app->register('App\Providers\AppServiceProvider'); (by default that comes commented)
$app->register('RouxtAccess\SlackApi\SlackApiServiceProvider');

```

If you want to use facades, add this lines on <code>bootstrap/app.php</code>

```php
class_alias('RouxtAccess\SlackApi\Facades\SlackApi', 'SlackApi');
//... and others
```

Otherwise, just use the singleton shortcuts:

```php
/** @var \RouxtAccess\SlackApi\Contracts\SlackApi $slackapi */
$slackapi     = app('slack.api');

/** @var \RouxtAccess\SlackApi\Contracts\SlackChannel $slackchannel */
$slackchannel = app('slack.channel');

etc
```

## Example Usage

```php
//Lists all users on your team
SlackUser::lists(); 

//Lists all channels on your team
SlackChannel::lists(); 

//List all groups
SlackGroup::lists();

//Invite a new member to your team
SlackUserAdmin::invite("example@example.com", [
    'first_name' => 'John', 
    'last_name' => 'Doe'
]);

// or just use the helper

//Autoload the api
slack()->post('chat.postMessage', [...]);

//Autoload a Slack Method
slack('Chat')->message([...]);
slack('Team')->info();
```

## All Injectable Contracts:

### Generic API
`RouxtAccess\SlackApi\Contracts\SlackApi`

Allows you to do generic requests to the api with the following http verbs:
`get`, `post`, `put`, `patch`, `delete` ... all allowed api methods you could see here: [Slack Web API Methods](https://api.slack.com/methods).

<!--
And is also possible load a SlackMethod contract:

```php
/** @var SlackChannel $channel **/
$channel = $slack->load('Channel');
$channel->lists();

/** @var SlackChat $chat **/
$chat = $slack->load('Chat');
$chat->message('D98979F78', 'Hello my friend!');

/** @var SlackUserAdmin $chat **/
$admin = $slack('UserAdmin'); //Minimal syntax (invokable)
$admin->invite('jhon.doe@example.com'); 

```
-->

### Channels API
`RouxtAccess\SlackApi\Contracts\SlackChannel`

Allows you to operate channels:
`invite`, `archive`, `rename`, `join`, `kick`, `setPurpose` ...


### Chat API
`RouxtAccess\SlackApi\Contracts\SlackChat`

Allows you to send, update and delete messages with methods:
`delete`, `message`, `update`.

### Files API
`RouxtAccess\SlackApi\Contracts\SlackFile`

Allows you to send, get info, delete,  or just list files:
`info`, `lists`, `upload`, `delete`.

### Groups API
`RouxtAccess\SlackApi\Contracts\SlackGroup`

Same methods of the SlackChannel, but that operates with groups and have adicional methods:
`open`, `close`, `createChild`

### Instant Messages API (Direct Messages)
`RouxtAccess\SlackApi\Contracts\SlackInstantMessage`

Allows you to manage direct messages to your team members.

### Real Time Messages API
`RouxtAccess\SlackApi\Contracts\SlackRealTimeMessage`

Allows you list all channels and user presence at the moment.


### Search API
`RouxtAccess\SlackApi\Contracts\SlackSearch`

Find messages or files.

### Stars API
`RouxtAccess\SlackApi\Contracts\SlackStar`

List all of starred itens.

### Team API
`RouxtAccess\SlackApi\Contracts\SlackTeam`

Get information about your team.

### Users API
`RouxtAccess\SlackApi\Contracts\SlackUser`

Get information about an user on your team or just check your presence ou status.

### Users Admin API
`RouxtAccess\SlackApi\Contracts\SlackUserAdmin`

Invite new members to your team.

## License

[DBAD License](https://dbad-license.org).

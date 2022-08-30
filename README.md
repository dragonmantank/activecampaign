# ActiveCampaign Client SDK

## Installation

This package requires the use of Composer to install.

`$ composer require dragonmantank/activecampaign`

## Usage

```php
$accountUrl = 'https://<company>.api-us1.com';
$accountKey = 'abcd';

$client = new Dragonmantank\ActiveCampaign\Client($accountUrl, $accountKey);

// Example to get contacts
$response = $client->get('contacts');
```
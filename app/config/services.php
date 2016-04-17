<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => array(
		'domain' => 'sandbox6cd9ce523c6f4c40bb4212b64d6cfb46.mailgun.org',
		'secret' => 'key-25c64a63178ac6b38dfd76883811779f',
	),

	'mandrill' => array(
		'secret' => '',
	),

	'stripe' => array(
		'model'  => 'User',
		'secret' => '',
	),

    /*
       |--------------------------------------------------------------------------
       | AWS
       |--------------------------------------------------------------------------
       |
       */

    'aws' => array(
        'access_key' => 'AKIAIMOIYKPEND2XUO7Q',
        'secret_key' => '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',
        'region' => 'Tokyo',
    ),

    /*
    |--------------------------------------------------------------------------
    | Google Cloud
    |--------------------------------------------------------------------------
    |
    */

    'google_cloud' => array(
        'service_account' => '[[your service account]',
        'key_file' => '[[path to the p12 key file]]',
        'secret' => '[[your secret]]',
        'developer_key' => '[[your developer key]]',
    ),

    /*
    |--------------------------------------------------------------------------
    | Rackspace
    |--------------------------------------------------------------------------
    |
    */

    'rackspace' => array(
        'username' => '[[your username]]',
        'tenant_name' => '[[your tenant name]]',
        'api_key' => '[[your api key]]',
        'api_endpoint' => \OpenCloud\Rackspace::UK_IDENTITY_ENDPOINT,
    ),
);

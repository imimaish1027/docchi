<?php

use Aws\Laravel\AwsServiceProvider;

return [

  /*
    |--------------------------------------------------------------------------
    | AWS SDK Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration options set in this file will be passed directly to the
    | `Aws\Sdk` object, from which all client objects are created. This file
    | sets the default minimum configuration used by the service provider even
    | if no configuration is set by the user. The full set of possible options
    | are documented at:
    | http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html
    |
    */
  'region' => env('AWS_REGION', 'us-east-1'),
  'version' => 'latest',
  'ua_append' => [
    'L5MOD/' . AwsServiceProvider::VERSION,
  ],
  'bucket_url' => env('AWS_BUCKET_URL', ''),
  'cloudfront_url' => env('AWS_CLOUDFRONT_URL', ''),
  'cloudfront_private_key' => env('AWS_CLOUDFRONT_PRIVATE_KEY', ''),
  'cloudfront_key_pair_id' => env('AWS_CLOUDFRONT_KEY_PAIR_ID', ''),
];

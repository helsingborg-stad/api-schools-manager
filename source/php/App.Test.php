<?php

namespace SchoolsManager\Test;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use WP_Mock;

class AppTest extends \PHPUnit\Framework\TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @testdox useGoogleApiKeyIfDefined calls acf_update_setting if defined.
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function testUseGoogleApiKeyIfDefinedCallsACFIfDefined()
    {
        // Arrange
        $apiKey     = '1234567890';
        $optionName = 'google_api_key';
        define('GOOGLE_API_KEY', $apiKey);
        $app = new \SchoolsManager\App();

        // Assert
        WP_Mock::userFunction('acf_update_setting', [
            'times' => 1,
            'args'  => [$optionName, $apiKey]
        ]);

        // Act
        $app->useGoogleApiKeyIfDefined();
    }
}

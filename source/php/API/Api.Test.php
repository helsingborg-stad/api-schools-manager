<?php

namespace SchoolsManager\API\Test;

use Mockery;
use SchoolsManager\API\Api;
use SchoolsManager\API\Fields\FieldsRegistrar;
use SchoolsManager\Helper\ExitCaller;
use SchoolsManager\Helper\Url;
use tad\FunctionMocker\FunctionMocker;
use WP_Mock;

class ApiTest extends \WP_Mock\Tools\TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function testApiConstructorCallsRegisterFieldsOnFieldsRegistrar()
    {
        $fieldsRegistrarMock = Mockery::mock(FieldsRegistrar::class);
        $fieldsRegistrarMock->shouldReceive('registerFields')->once();
        new Api($fieldsRegistrarMock);
    }

    public function testApiConstructorCallsExpectedHooks()
    {
        $fieldsRegistrarMock = Mockery::spy(FieldsRegistrar::class);
        $api                 = new Api($fieldsRegistrarMock);
        WP_Mock::expectActionAdded('template_redirect', [$api, 'redirectToApi']);
        $api->addHooks();
    }

    public function testRedirectToApiReturnsVoidIfInitiatedFromCli()
    {
        $fieldsRegistrarMock = Mockery::spy(FieldsRegistrar::class);
        $api                 = new Api($fieldsRegistrarMock);
        FunctionMocker::replace('php_sapi_name', 'cli');

        $this->assertNull($api->redirectToApi());
    }

    public function testRedirectToApiReturnsVoidIfIsAdmin()
    {
        $fieldsRegistrarMock = Mockery::spy(FieldsRegistrar::class);
        $api                 = new Api($fieldsRegistrarMock);
        FunctionMocker::replace('php_sapi_name', 'foo');
        WP_Mock::userFunction('is_admin', ['return' => true]);

        $this->assertNull($api->redirectToApi());
    }

    public function testRedirectToApiCallsWpRedirect()
    {
        $fieldsRegistrarMock = Mockery::spy(FieldsRegistrar::class);
        $api                 = new Api($fieldsRegistrarMock);

        FunctionMocker::replace('php_sapi_name', 'foo');
        WP_Mock::userFunction('is_admin', ['return' => false]);
        WP_Mock::userFunction('rest_url', ['return' => 'bar']);
        $urlSpy = Mockery::spy('alias:' . Url::class);
        $urlSpy->shouldReceive('isRest')->andReturn(false);
        $urlSpy->shouldReceive('isAnyPageButRest')->andReturn(true);

        Mockery::mock('alias:' . ExitCaller::class)->shouldReceive('exit')->once();
        WP_Mock::userFunction('wp_redirect')->once()->with('bar');

        $this->assertNull($api->redirectToApi());
    }
}

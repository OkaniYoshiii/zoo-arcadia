<?php

use App\Controllers\HomeController;
use App\Controllers\ServicesController;
use App\Exceptions\RouterException;
use App\Objects\Request;
use App\Router;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        require_once './config/config.global.php';
    }

    public static function routeConfigPathsProvider() : array
    {
        return [
            [''],
            ['dazdazdad'],
            [__DIR__ . '/../config/config.global.php'],
        ];
    }
    
    #[DataProvider('routeConfigPathsProvider')]
    public function testSetCurrentRoute(string $configPath) : void
    {
        $request = [
            'uri' => '/',
            'method' => 'GET',
            'parameters' => null
        ];

        $this->expectException(Exception::class);

        $router = new Router($configPath, $request);
    }

    public static function testGetCurrentRouteDataProvider() : array
    {
        return [
            [
                [
                    'uri' => '/',
                    'method' => 'GET',
                    'parameters' => null
                ],
                [
                    'method' => 'GET',
                    'uri' => '/',
                    'template' => 'home.html.twig',
                    'controller' => HomeController::class,
                    'roles' => ['NONE'],
                    'hasAccess' => true,
                ]
            ],
            [
                [
                    'uri' => '/services',
                    'method' => 'GET',
                    'parameters' => null
                ],
                [
                    'method' => 'GET',
                    'uri' => '/services',
                    'template' => 'services.html.twig',
                    'controller' => ServicesController::class,
                    'roles' => ['NONE'],
                    'hasAccess' => true,
                ]
            ],
        ];
    }

    #[DataProvider('testGetCurrentRouteDataProvider')]
    public function testGetCurrentRoute(array $request, array $expected) : void
    {
        $configPath = __DIR__ . '/../config/routes.json';
        $router = new Router($configPath, $request);
        $router->getCurrentRoute();

        $this->assertSame($expected, $router->getCurrentRoute());
    }

    public static function testGetCurrentRouteThrowExceptionDataProvider() : array
    {
        return [
            [
                'request' => [
                    'uri' => '/',
                    'method' => 'GET',
                    'parameters' => null
                ],
                'throwsException' => false,
            ],
            [
                'request' => [
                    'uri' => '',
                    'method' => 'GET',
                    'parameters' => null
                ],
                'throwsException' => true,
            ],
            [
                'request' => [
                    'uri' => '/patate',
                    'method' => 'GET',
                    'parameters' => null
                ],
                'throwsException' => true,
            ],
            [
                'request' => [
                    'uri' => '/services',
                    'method' => 'GET',
                    'parameters' => null
                ],
                'throwsException' => false,
            ],
        ];
    }

    #[DataProvider('testGetCurrentRouteThrowExceptionDataProvider')]
    public function testGetCurrentRouteThrowRouterException(array $request, bool $throwsException) : void
    {
        if($throwsException) {
            $this->expectException(RouterException::class);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $configPath = __DIR__ . '/../config/routes.json';
        $router = new Router($configPath, $request);
        $router->getCurrentRoute();
    }
}
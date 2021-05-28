<?php namespace Finnito\SissccModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Finnito\SissccModule\Event\Contract\EventRepositoryInterface;
use Finnito\SissccModule\Event\EventRepository;
use Anomaly\Streams\Platform\Model\Sisscc\SissccEventEntryModel;
use Finnito\SissccModule\Event\EventModel;
use Illuminate\Routing\Router;

class SissccModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Additional addon plugins.
     *
     * @type array|null
     */
    protected $plugins = [];

    /**
     * The addon Artisan commands.
     *
     * @type array|null
     */
    protected $commands = [];

    /**
     * The addon's scheduled commands.
     *
     * @type array|null
     */
    protected $schedules = [];

    /**
     * The addon API routes.
     *
     * @type array|null
     */
    protected $api = [];

    /**
     * The addon routes.
     *
     * @type array|null
     */
    protected $routes = [
        'admin/sisscc'           => 'Finnito\SissccModule\Http\Controller\Admin\EventController@index',
        'admin/sisscc/create'    => 'Finnito\SissccModule\Http\Controller\Admin\EventController@create',
        'admin/sisscc/edit/{id}' => 'Finnito\SissccModule\Http\Controller\Admin\EventController@edit',
        "/"                    => "Finnito\SissccModule\Http\Controller\EventController@home",
        "{slug}"                    => "Finnito\SissccModule\Http\Controller\EventController@publicFrontend",
        "{slug}/input"           => "Finnito\SissccModule\Http\Controller\EventController@adminFrontend",
        "/api/event-data/{slug}" => [
            "verb" => "GET",
            "uses" => "Finnito\SissccModule\Http\Controller\APIController@getEventData",
        ],
        "/api/event-data/post/{slug}" => [
            "verb" => "POST",
            "uses" => "Finnito\SissccModule\Http\Controller\APIController@saveEventData",
        ],
        "/api/results/{slug}" => [
            "verb" => "GET",
            "uses" => "Finnito\SissccModule\Http\Controller\APIController@getEventResults",
        ],
        "/register" => "Finnito\SissccModule\Http\Controller\DisableController@disable",
        "/login" => "Finnito\SissccModule\Http\Controller\AuthController@login",
        "/users/password/forgot" => "Finnito\SissccModule\Http\Controller\AuthController@forgot",
    ];

    /**
     * The addon middleware.
     *
     * @type array|null
     */
    protected $middleware = [
        //Finnito\SissccModule\Http\Middleware\ExampleMiddleware::class
    ];

    /**
     * Addon group middleware.
     *
     * @var array
     */
    protected $groupMiddleware = [
        //'web' => [
        //    Finnito\SissccModule\Http\Middleware\ExampleMiddleware::class,
        //],
    ];

    /**
     * Addon route middleware.
     *
     * @type array|null
     */
    protected $routeMiddleware = [];

    /**
     * The addon event listeners.
     *
     * @type array|null
     */
    protected $listeners = [
        //Finnito\SissccModule\Event\ExampleEvent::class => [
        //    Finnito\SissccModule\Listener\ExampleListener::class,
        //],
    ];

    /**
     * The addon alias bindings.
     *
     * @type array|null
     */
    protected $aliases = [
        //'Example' => Finnito\SissccModule\Example::class
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        SissccEventEntryModel::class => EventModel::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        EventRepositoryInterface::class => EventRepository::class,
    ];

    /**
     * Additional service providers.
     *
     * @type array|null
     */
    protected $providers = [
        //\ExamplePackage\Provider\ExampleProvider::class
    ];

    /**
     * The addon view overrides.
     *
     * @type array|null
     */
    protected $overrides = [
        //'streams::errors/404' => 'module::errors/404',
        //'streams::errors/500' => 'module::errors/500',
    ];

    /**
     * The addon mobile-only view overrides.
     *
     * @type array|null
     */
    protected $mobile = [
        //'streams::errors/404' => 'module::mobile/errors/404',
        //'streams::errors/500' => 'module::mobile/errors/500',
    ];

    /**
     * Register the addon.
     */
    public function register()
    {
        // Run extra pre-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Boot the addon.
     */
    public function boot()
    {
        // Run extra post-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Map additional addon routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Register dynamic routes here for example.
        // Use method injection or commands to bring in services.
    }

}

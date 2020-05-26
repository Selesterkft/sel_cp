<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapUsersRoutes();
        $this->mapInvoicesRoutes();
        $this->mapStocksRoutes();
        $this->mapTransportsRoutes();
        //$this->mapCompaniesRoutes();
        $this->mapVersionsRoutes();
        $this->mapRolesRoutes();
        $this->mapPermissions();
        $this->mapSettingsRoutes();
        $this->mapCompanySubdomain();
        $this->mapTranslationsRoutes();
        $this->mapLanguagesRoutes();

        $this->mapCompanySettings();
        $this->mapPageSettings();
        $this->mapCompanyDesign();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        \Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapUsersRoutes()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/users.php'));
    }

    protected function mapInvoicesRoutes()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/invoices.php'));
    }

    protected function mapStocksRoutes()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/stocks.php'));
    }

    protected function mapTransportsRoutes()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/transports.php'));
    }

    protected function mapCompaniesRoutes()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/Companies.php'));
    }

    protected function mapVersionsRoutes()
    {
        \Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/versions.php'));
    }

    protected function mapRolesRoutes()
    {
        \Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/roles.php'));
    }

    protected function mapSettingsRoutes()
    {
        \Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/settings.php'));
    }

    protected function mapCompanySubdomain()
    {
        \Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/companysubdomain.php'));
    }

    protected function mapTranslationsRoutes()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/translations.php'));
    }

    protected function mapLanguagesRoutes()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/languages.php'));
    }

    protected function mapPageSettings()
    {

        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/page_settings.php'));

    }

    protected function mapCompanySettings()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/company_settings.php'));
    }

    protected function mapPermissions()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/permissions.php'));
    }

    protected function mapCompanyDesign()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/company_design.php'));
    }
}

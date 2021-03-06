<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }

  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind(
      \App\Repositories\User\UserRepositoryContract::class,
      \App\Repositories\User\UserRepository::class
    );
    $this->app->bind(
      \App\Repositories\Role\RoleRepositoryContract::class,
      \App\Repositories\Role\RoleRepository::class
    );
    $this->app->bind(
      \App\Repositories\Department\DepartmentRepositoryContract::class,
      \App\Repositories\Department\DepartmentRepository::class
    );
    $this->app->bind(
      \App\Repositories\Setting\SettingRepositoryContract::class,
      \App\Repositories\Setting\SettingRepository::class
    );
    $this->app->bind(
      \App\Repositories\Ticket\TicketRepositoryContract::class,
      \App\Repositories\Ticket\TicketRepository::class
    );
    $this->app->bind(
      \App\Repositories\Relation\RelationRepositoryContract::class,
      \App\Repositories\Relation\RelationRepository::class
    );
    $this->app->bind(
      \App\Repositories\Lead\LeadRepositoryContract::class,
      \App\Repositories\Lead\LeadRepository::class
    );
    $this->app->bind(
      \App\Repositories\Invoice\InvoiceRepositoryContract::class,
      \App\Repositories\Invoice\InvoiceRepository::class
    );
  }
}

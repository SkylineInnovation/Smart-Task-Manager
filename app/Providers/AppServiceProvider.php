<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Events\MigrationsStarted;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // code in ⁠ register ⁠ method 
        Event::listen(MigrationsStarted::class, function () {
            if (env('ALLOW_DISABLED_PK')) {
                DB::statement('SET SESSION sql_require_primary_key=0');
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ///...

        // $the_expense_types = ExpenseType::where('slug', 'lifting-weights')->get();
        // View::share('the_expense_types', $the_expense_types);


        // 3
        Builder::macro('whereNullOrEmpty', function ($field) {
            return $this->where(function ($query) use ($field) {
                return $query->where($field, '=', null)->orWhere($field, '=', '');
            });
        });

        Builder::macro('orWhereNullOrEmpty', function ($field) {
            return $this->where(function ($query) use ($field) {
                return $query->orWhere($field, '=', null)->orWhere($field, '=', '');
            });
        });

        Builder::macro('whereNullOrEmptyOrZero', function ($field) {
            return $this->where(function ($query) use ($field) {
                return $query->where($field, '=', null)->orWhere($field, '=', '')
                    ->orWhere($field, '=', 0)->orWhere($field, '=', '0');
            });
        });

        Builder::macro('whereNotNullOrEmpty', function ($field) {
            return $this->where(function ($query) use ($field) {
                return $query->where($field, '<>', null)->where($field, '<>', '');
            });
        });

        Builder::macro('whereSearch', function ($field, $text) {
            return $this->where(function ($query) use ($field, $text) {
                return $query->whereRaw("lower(`$field`) like '%" . strtolower($text) . "%'");
            });
        });

        Builder::macro('orWhereSearch', function ($field, $text) {
            return $this->orWhere(function ($query) use ($field, $text) {
                return $query->whereRaw("lower(`$field`) like '%" . strtolower($text) . "%'");
            });
        });
    }
}

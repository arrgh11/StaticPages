<?php

namespace Statamic\Addons\StaticPages;

use Statamic\Extend\ServiceProvider;


class StaticPagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->api('StaticPages')->assetContainer();
        // $hi = AssetContainer::all();
        // dd($hi);
        //
        // if (!AssetContainer::find('staticpages')) {
        //     $new = AssetContainer::create();
        //     // $new->id('staticpages');
        //     // $new->save();
        // }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // $hi = AssetContainer::all();
    }
}

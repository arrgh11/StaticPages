<?php

namespace Statamic\Addons\StaticPages;

use Statamic\API\Nav;
use Statamic\Extend\Listener;

class StaticPagesListener extends Listener
{
    /**
     * The events to be listened for, and the methods to call.
     *
     * @var array
     */
    public $events = [
        'cp.nav.created' => 'addNavItems'
    ];

    public function addNavItems($nav)
    {
        // Create the first level navigation item
        // Note: by using route('store'), it assumes you've set up a route named 'store'.
        $store = Nav::item('Static Pages')->url('/cp/addons/static-pages')->icon('flow-tree');

        // Add second level navigation items to it
        // $store->add(function ($item) {
        //     $item->add(Nav::item('Products')->route('store.products'));
        //     $item->add(Nav::item('Orders')->route('store.orders'));
        // });

        // Finally, add our first level navigation item
        // to the navigation under the 'tools' section.
        $nav->addTo('content', $store);
    }
}

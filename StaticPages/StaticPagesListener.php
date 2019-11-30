<?php

namespace Statamic\Addons\StaticPages;

use Statamic\API\Nav;
use Statamic\Extend\Listener;
use Statamic\API\AssetContainer;

class StaticPagesListener extends Listener
{
    /**
     * The events to be listened for, and the methods to call.
     *
     * @var array
     */
    public $events = [
        'cp.nav.created' => 'addNavItems',
    ];

    public function addNavItems($nav)
    {
        $this->api('StaticPages')->assetContainer('remove');
        $pages = Nav::item('Static Pages')->url('/cp/addons/static-pages')->icon('flow-tree');
        $nav->addTo('content', $pages);
        // $nav->remove('content.assets.browse.staticpages');
    }

}

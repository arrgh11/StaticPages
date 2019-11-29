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
        'AssetUploaded' => 'assetUploaded'
    ];

    public function addNavItems($nav)
    {
        $this->api('StaticPages')->assetContainer();
        $pages = Nav::item('Static Pages')->url('/cp/addons/static-pages')->icon('flow-tree');
        $nav->addTo('content', $pages);
    }

    public function assetUploaded($event) 
    {
    	$hi = AssetContainer::all();
        dd($hi);
    	$event->affectedPaths();
	    // An array of file paths that have been affected by the action.
	    // For example:
	    // [
	    //     /path/to/content/pages/oldpageslug/index.md, 
	    //     /path/to/content/pages/newpageslug/index.md
	    // ]

	    $event->contextualData();
	    // An array representation of the item that was saved.
	    // For example, the data in a page, or an array of configuration settings.
    }
}

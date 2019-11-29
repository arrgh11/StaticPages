<?php

namespace Statamic\Addons\StaticPages;

use Statamic\API\AssetContainer;
use Statamic\Extend\API;

class StaticPagesAPI extends API
{
    /**
     * Accessed by $this->api('StaticPages')->example() from other addons
     */
    public function assetContainer()
    {
        if (AssetContainer::find('staticpages') == null) {
        	$new = AssetContainer::create();
        	$new->id('staticpages');
        	$new->title('StaticPages');
        	$new->path('staticpages');
        	$new->url('/staticpages');
        	$new->save();
        }
        // dd('hi');
    }
}

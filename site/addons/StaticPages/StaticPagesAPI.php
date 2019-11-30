<?php

namespace Statamic\Addons\StaticPages;

use Statamic\API\AssetContainer;
use Statamic\Extend\API;
use Statamic\API\File;
use ZipArchive as ZipArchive;

class StaticPagesAPI extends API
{
    /**
     * Accessed by $this->api('StaticPages')->example() from other addons
     */
    public function assetContainer()
    {
        if (AssetContainer::find('staticpages') == null) {

            File::copy('site/addons/StaticPages/staticpages.yaml', 'site/content/assets/staticpages.yaml', true);
            // 
        } else {
           // dd('hi'); 
        }
        // 
    }

    public function expandArchive($data)
    {
        $zip = new ZipArchive;
        if ($zip->open($data['archive'], ZIPARCHIVE::OVERWRITE)) {
            // dd($zip->count());
            $path = pathinfo(realpath($data['archive']), PATHINFO_DIRNAME);
            if ($zip->extractTo($path)) {
                $zip->close();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        
    }
}

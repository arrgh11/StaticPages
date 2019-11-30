<?php

namespace Statamic\Addons\StaticPages;

use Statamic\API\AssetContainer;
use Statamic\Extend\API;
use Statamic\API\File;
use Statamic\API\YAML;
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
        // dd($data['archive']);
        $zip = new ZipArchive;
        $ZIP_ERROR = [
          ZipArchive::ER_EXISTS => 'File already exists.',
          ZipArchive::ER_INCONS => 'Zip archive inconsistent.',
          ZipArchive::ER_INVAL => 'Invalid argument.',
          ZipArchive::ER_MEMORY => 'Malloc failure.',
          ZipArchive::ER_NOENT => 'No such file.',
          ZipArchive::ER_NOZIP => 'Not a zip archive.',
          ZipArchive::ER_OPEN => "Can't open file.",
          ZipArchive::ER_READ => 'Read error.',
          ZipArchive::ER_SEEK => 'Seek error.',
        ];

        $result_code = $zip->open(ltrim($data['archive'], '/'));
        if( $result_code !== true ){
           $msg = isset($ZIP_ERROR[$result_code])? $ZIP_ERROR[$result_code] : 'Unknown error.';
           dd($msg);
        }
        $path = 'staticpages/'.$data['route'];
        // dd($path);
        if ($zip->extractTo($path)) {
            $zip->close();
            // return true;
        } else {
            // dd('fuck1');
            return false;
        }
        return true;
    }

    public function modifyRoutes($new, $old=null)
    {
        $routes = YAML::parse(File::get('site/settings/routes.yaml'));
        // dd($routes);
        $vanity_routes = array();
        if (isset($routes['vanity']) && !empty($routes['vanity'])) {
            $vanity_routes = $routes['vanity'];
        }
        
        if ($old !== null) {

        } else {
            $vanity_routes["/staticpages/{$new['route']}"] = "/staticpages/{$new['route']}/index.html";
        }
        
        $routes['vanity'] = $vanity_routes;
        File::put('site/settings/routes.yaml', YAML::dump($routes));
    }

}

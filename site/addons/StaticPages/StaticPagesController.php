<?php

namespace Statamic\Addons\StaticPages;

use Statamic\API\File;
use Statamic\API\YAML;
use Statamic\API\Fieldset;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Statamic\API\Asset;
use Statamic\Assets\Asset as asset_asset;
use Statamic\Extend\Controller;
use Statamic\API\AssetContainer;
use Statamic\CP\Publish\ProcessesFields;

class StaticPagesController extends Controller
{
    /**
     * Maps to your route definition in routes.yaml
     *
     * @return mixed
     */

    use ProcessesFields;

    public function index()
    {


		$all = Asset::all();
		// dd(AssetContainer::all());
		// $this->storage->putJSON('pages', array(array('name'=>'boy', 'id'=>1)));
		$pages = $this->storage->getJSON('pages');

        return $this->view('index', [
        	'assets'=>$pages,
        	'newUrl' => route('staticpages.new')
        ]);
    }

    public function getNew()
    {

    	$fieldset = $this->fieldset();

    	return $this->view('new', [
    		'id' => null,
    		'page' => [],
    		'fieldset' => $fieldset->toPublishArray(),
    		'submitUrl' => route('staticpages.store')
    	]);
    }

    public function getEdit($request)
    {

    	$fieldset = $this->fieldset();

    	$pages = $this->storage->getJSON('pages');
    	$the_page = "";
    	foreach ($pages as $page) {
    		if ($page['id'] == $request) {
    			$the_page = $page;
    		}
    	}
    	return $this->view('edit', [
    		'page'=>$the_page,
    		'fieldset' => $fieldset->toPublishArray(),
    		'submitUrl' => route('staticpages.store')
    	]);
    }

    public function addNew(Request $request)
    {
    	// dd(request->all());
    	$data = $this->processFields($this->fieldset(), $request->fields);
    	// $asset_asset->upload(UploadedFile $file);
    }

    protected function fieldset()
    {
        $contents = File::get($this->getDirectory().'/resources/fieldsets/content.yaml');
        $fieldset = Fieldset::create('defaults', YAML::parse($contents));
        return $fieldset;
    }

}

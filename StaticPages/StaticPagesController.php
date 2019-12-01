<?php

namespace Statamic\Addons\StaticPages;

use Statamic\API\Helper;
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
        $pages = $this->storage->getJSON('pages');

        return $this->view('index', [
        	'pages'=>$pages,
        	'newUrl' => route('staticpages.new')
        ]);
    }

    public function getNew()
    {

    	$fieldset = $this->fieldset();
        $this->api('StaticPages')->assetContainer('add');

    	return $this->view('edit', [
    		'id' => null,
    		'page' => $this->prepareData([]),
    		'fieldset' => $fieldset->toPublishArray(),
    		'submitUrl' => route('staticpages.store')
    	]);
    }

    public function getEdit($request)
    {

    	$fieldset = $this->fieldset();
        $this->api('StaticPages')->assetContainer('add');

    	$pages = $this->storage->getJSON('pages');
    	$the_page = "";
    	foreach ($pages as $page) {
    		if ($page['id'] == $request) {
    			$the_page = $page;
    		}
    	}
    	return $this->view('edit', [
    		'id' => $request,
    		'page'=>$this->prepareData($the_page),
    		'fieldset' => $fieldset->toPublishArray(),
    		'submitUrl' => route('staticpages.update')
    	]);
    }

    public function deletePage($id)
    {

    	$pages = $this->storage->getJSON('pages');
    	$the_page = "";
    	foreach ($pages as $key=>$page) {
    		if ($page['id'] == $id) {
    			$the_page = $page;
    			if (is_dir('staticpages/'.$page['route'])) {
    				$this->delTree('staticpages/'.$page['route']);	
    			}
    			
    			unset($pages[$key]);
    		}
    	}
    	$this->storage->putJSON('pages', $pages);
    	return redirect(route('staticpages.home'));
    }

    public function update(Request $request) {
    	$data = $this->processFields($this->fieldset(), $request->fields);
    	$id = $request->uuid;
    	$old_pages = $this->storage->getJSON('pages');
    	$pages = $old_pages;
    	foreach ($pages as $page) {
    		if ($page['id'] == $id) {
    			$page['title'] = $data['title'];
    			$page['route'] = $data['route'];
    			$page['archive'] = $data['archive'];
    		}
    	}
    	$this->storage->putJSON('pages', $pages);
    	return [
            'success'  => true,
            'redirect' => route('staticpages.home'),
            'message' => "Successfully updated ".$data['title']
        ];
    }

    public function addNew(Request $request)
    {
    	$data = $this->processFields($this->fieldset(), $request->fields);
    	$id = Helper::makeUuid();
    	$pages = $this->storage->getJSON('pages');
    	array_push($pages, array(
    		'title'=>$data['title'], 
    		'route'=>$data['route'], 
    		'archive'=>$data['archive'],
    		'edit' => route('staticpages.edit', ['id'=> $id]),
    		'delete' => route('staticpages.delete', ['id'=>$id]),
    		'id'=>$id)
    	);
    	$this->storage->putJSON('pages', $pages);
    	$result = $this->api('StaticPages')->expandArchive($data);
    	if (!$result) {
    		return [
	            'success'  => false,
	            'redirect' => route('staticpages.home'),
	            'message' => "There was an error"
	        ];
    	}
    	$this->api('StaticPages')->modifyRoutes($data);
		return [
            'success'  => true,
            'redirect' => route('staticpages.home'),
            'message' => "Successfully added Page"
        ];
   		
    }

    protected function fieldset()
    {
        $contents = File::get($this->getDirectory().'/resources/fieldsets/content.yaml');
        $fieldset = Fieldset::create('defaults', YAML::parse($contents));
        return $fieldset;
    }
	
    private function prepareData($data)
    {
        return $this->preProcessWithBlankFields($this->fieldset(), $data);
    }

    function delTree($dir)
    { 
        $files = array_diff(scandir($dir), array('.', '..')); 

        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file"); 
        }

        return rmdir($dir); 
    } 

}

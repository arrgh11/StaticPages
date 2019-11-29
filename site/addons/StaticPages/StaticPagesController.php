<?php

namespace Statamic\Addons\StaticPages;

use Statamic\API\Asset;
use Statamic\Extend\Controller;

class StaticPagesController extends Controller
{
    /**
     * Maps to your route definition in routes.yaml
     *
     * @return mixed
     */
    public function index()
    {


		$all = Asset::all();
		$this->storage->putJSON('pages', array(array('name'=>'boy', 'id'=>1)));
		$pages = $this->storage->getJSON('pages');

        return $this->view('index', ['assets'=>$pages]);
    }

    public function getEdit($request)
    {
    	return $this->view('edit', ['page'=>$request]);
    }

    public function addNew()
    {
    	
    }

}

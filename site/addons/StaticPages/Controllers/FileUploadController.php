<?php

namespace Statamic\Addons\StaticPages;

use Statamic\API\Helper;
use Statamic\API\Fieldset;
use Illuminate\Http\Request;
use Statamic\Extend\Controller;
use Statamic\CP\Publish\ProcessesFields;

class FileUploadController extends Controller
{
    use ProcessesFields;

    private $store;

    public function __construct(ContentStore $store)
    {
        $this->store = $store;
    }

    public function create()
    {
        return $this->view('index', [
            'id' => null,
            'data' => $this->prepareData([]),
            'submitUrl' => route('contentstore.store')
        ]);
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $data = $this->prepareData($this->store->get($id));

        return $this->view('index', [
            'id' => $id,
            'data' => $data,
            'submitUrl' => route('contentstore.update')
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->uuid;

        $this->save($id, $request);

        return $this->successResponse($id);
    }

    public function store(Request $request)
    {
        $id = Helper::makeUuid();

        $this->save($id, $request);

        return $this->successResponse($id);
    }

    /**
     * Prepare the data for the view.
     *
     * Vue needs to have at least null values available from the start in order
     * to properly set up the reactivity. The data in the contentstore is not
     * guaranteed to have every single field. This method will add the
     * appropriate null values based on the provided fieldset.
     *
     * @return array
     */
    private function prepareData($data)
    {
        return $this->preProcessWithBlankFields(Fieldset::get('post'), $data);
    }

    private function save($id, $request)
    {
        // Vue submits data slightly differently to how it should be saved.
        // Each field's fieldtype will process the data appropriately.
        $data = $this->processFields(Fieldset::get($request->fieldset), $request->fields);

        $this->store->save($id, $data);
    }

    private function successResponse($id)
    {
        $message = 'Entry saved';

        if (! request()->continue || request()->new) {
            $this->success($message);
        }

        return [
            'success'  => true,
            'redirect' => route('contentstore.edit') . '?id=' . $id,
            'message' => $message
        ];
    }
}
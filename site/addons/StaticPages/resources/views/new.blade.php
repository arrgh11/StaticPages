@extends('layout')

@section('content')

    <script>
        Statamic.Publish = {
            contentData: {!! json_encode($data) !!},
        };
    </script>

    <publish title="{{ $id ? $data['title'] : 'New entry' }}"
             :is-new="{{ bool_str($id === null) }}"
             fieldset-name="post" <!-- use either fieldset-name or fieldset props. not both -->
             fieldset="{{ $fieldset->toPublishArray() }}"
             content-type="entry"
             submit-url="{{ $submitUrl }}"
             id="{{ $id }}"
             extra='{"collection": "blog"}'
             :remove-title="true"
    ></publish>

@endsection
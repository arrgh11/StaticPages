@extends('layout')

@section('content')
<script>
    Statamic.Publish = {
        contentData: {!! json_encode($page) !!},
        fieldset: {!! json_encode($fieldset) !!},
    };
</script>
<div class="flex flex-wrap items-center w-full sticky -mx-3"> 
	<h1 class="w-full my-1 text-center lg:text-left lg:flex-1"> 
		<span>Static Pages</span> 
	</h1> 
	<div class="controls flex flex-wrap items-center w-full lg:w-auto justify-center">  
		<div class="mr-2 my-1">   
		</div>   
	</div>
</div>

<div class="w-full -mx-3">
	<div class="page-tree mx-3">
	    <publish title="{{ $id ? $page['title'] : 'New Static Page' }}"
             :is-new="{{ bool_str($id === null) }}"
             content-type="addon"
             submit-url="{{ $submitUrl }}"
             id="{{ $id }}"
    ></publish>
	</div>
</div>

@endsection

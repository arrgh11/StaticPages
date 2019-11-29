@extends('layout')

@section('content')
<div class="flex flex-wrap items-center w-full sticky -mx-3"> 
	<h1 class="w-full my-1 text-center lg:text-left lg:flex-1"> 
		<span>Static Pages</span> 
	</h1> 
	<div class="controls flex flex-wrap items-center w-full lg:w-auto justify-center">  
		<div class="mr-2 my-1">   
		</div>   
		<div class="btn-group btn-group-primary my-1"> 
			<button type="button" class="btn btn-primary">Upload Archive</button>
		</div>
	</div>
</div>

<div class="w-full -mx-3">
	{{$page}}
</div>

@endsection

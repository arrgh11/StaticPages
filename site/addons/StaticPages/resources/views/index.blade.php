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
@if($assets !== null)
<div class="w-full -mx-3">
	<div class="page-tree mx-3">
		<ul class="tree-home list-unstyled">
			@foreach($assets as $asset)
				<li class="branch"> 
					<div class="branch-row w-full flex items-center">
						<div class="flex items-center flex-1 p-1"> 
							<div class="page-text"> 
								<a class="page-title" href="/cp/addons/static-pages/edit/{{$asset['id']}}">
									{{$asset['name']}}
								</a> 
							</div>   
						</div>
					</div>
				</li>
			@endforeach
		</ul>
	</div>
</div>
@endif
@endsection

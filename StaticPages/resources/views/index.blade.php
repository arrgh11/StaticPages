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
			<a role="button" href="{{$newUrl}}" class="btn btn-primary">Upload Archive</a>
		</div>
	</div>
</div>
@if(!empty($pages))
<div class="w-full -mx-3">
	<div class="page-tree mx-3">
		<ul class="tree-home list-unstyled">
			@foreach($pages as $page)
				<li class="branch"> 
					<div class="branch-row w-full items-center">
						<div class="flex justify-between items-center p-1"> 
							<div class="page-text "> 
								<a class="page-title" href="{{$page['edit']}}">
									{{$page['title']}}
								</a> 
							</div>  
							<div class="btn-group action-more">
	                            <button type="button" class="btn-more dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon icon-dots-three-vertical"></i> </button>
	                            <ul class="dropdown-menu">
	                            	<li>
	                            		<a href="/staticpages/{{$page['route']}}" target="_blank">Visit Page</a>
	                            	</li>
	                                <li class="warning">
	                                    <a href="{{$page['delete']}}" title="Delete this menu">Delete</a>
	                                </li>
	                            </ul>
	                        </div> 
						</div>
					</div>
				</li>
			@endforeach
		</ul>
	</div>
</div>
@else
<div class="w-full -mx-3 bg-white rounded shadow">
	<div class="text-center py-5 text-lg">
		You don't have any Pages yet!
	</div>
</div>
@endif

@endsection

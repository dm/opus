<div class="test">	    		
	<div class="row" style="margin-bottom: 10px;">
    	<div class="wiki-nav-con">
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    			<h3 style="margin-bottom: 0;"><a href="#">{{ $page->name }}</a></h3>
    			<p style="margin-bottom: 0;" class="text-muted">Created by {{ ViewHelper::getUsername($page->user_id) }} on {{ $page->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }} at {{ $page->created_at->timezone(Session::get('user_timezone'))->format('h:i A') }} </p>
			</div>
    		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
    			<ul class="list-inline list-unstyled" style="position: relative; top: 5px;">
    				@if($page->page_watching) 
	    				<li>
	    					<button data-page-id="{{ $page->id }}" id="watch-page-btn" class="btn btn-default btn-sm pull-left" style="border-radius: 3px 0px 0px 3px;">
						        Unwatch
						    </button>
						    <div class="count-with-arrow pull-left">
								<span class="count page-watch-count" style="line-height: 9px;"> {{ ViewHelper::getPageWatch($page->id) }} </span>
							</div>
							<div class="clearfix"></div>
	    				</li>
	    			@else
						<li>
	    					<button data-page-id="{{ $page->id }}" id="watch-page-btn" class="btn btn-default btn-sm pull-left" style="border-radius: 3px 0px 0px 3px;">
						        Watch
						    </button>
						    <div class="count-with-arrow pull-left">
								<span class="count page-watch-count" style="line-height: 9px;"> {{ ViewHelper::getPageWatch($page->id) }} </span>
							</div>
							<div class="clearfix"></div>
	    				</li>
	    			@endif
    				@if($page->page_like) 
	    				<li>
	    					<button data-page-id="{{ $page->id }}" id="like-page-btn" class="btn btn-default btn-sm pull-left" style="border-radius: 3px 0px 0px 3px;">
						        Unstar
						    </button>
						    <div class="count-with-arrow pull-left">
								<span class="count page-star-count" style="line-height: 9px;"> {{ ViewHelper::getPageStar($page->id) }} </span>
							</div>
							<div class="clearfix"></div>
	    				</li>
    				@else 
						<li>
	    					<button data-page-id="{{ $page->id }}" id="like-page-btn" class="btn btn-default btn-sm pull-left" style="border-radius: 3px 0px 0px 3px;">
						        Star
						    </button>
						    <div class="count-with-arrow pull-left">
								<span class="count page-star-count" style="line-height: 9px;"> {{ ViewHelper::getPageStar($page->id) }} </span>
							</div>
							<div class="clearfix"></div>
	    				</li>
    				@endif
    			</ul>
    		</div>
    	</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        <ul class="nav nav-pills center-block" id="organization-nav" style="border-top: 1px solid #e5e5e5;">
	            <li @if(ViewHelper::getCurrentRoute() == 'wikis/{wiki_slug}') class="active" @endif>
	            	<a href="{{ route('wikis.show', $wiki->slug) }}"><i class="fa fa-home"></i> Home</a>
	            </li>
	            @if(ViewHelper::getCurrentRoute() != 'wikis/{wiki_slug}/pages/reorder')
		            <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text-o"></i> Select Page <i class="fa fa-caret-down"></i></a>
	                    <ul class="dropdown-menu page-tree-con" style="left: -95px; top: 35px; width: 200px;">
	                        @if($wikiPages->count() == 0)
								<ul class="list-unstyled">
				                	<li style="text-align: center; font-size: 12px; font-weight: 600;" class="text-muted"><i class="fa fa-search"></i> Nothing found</li>
								</ul>
			               	@else
	                            <div id="page-tree" style="padding-left: 5px;">
									<ul>
										{{ ViewHelper::makeWikiPageTree($wikiPages, null) }}
									</ul>
								</div>
							@endif
	                    </ul>
	                </li>
	            @endif
	            <li @if(ViewHelper::getCurrentRoute() == 'wikis/{wiki_slug}/pages/create') class="active" @endif>
	            	<a href="{{ route('wikis.pages.create', $wiki->slug) }}"><i class="fa fa-plus-square"></i> New Page</a>
	            </li>
                <li @if(ViewHelper::getCurrentRoute() == 'wikis/{wiki_slug}/pages/reorder') class="active" @endif>
                	<a href="{{ route('wikis.pages.reorder', $wiki->slug) }}"><i class="fa fa-sort fa-lg"></i> Reorder Pages</a>
                </li>
                <ul class="nav nav-pills pull-right" id="organization-nav" style="border-bottom: 0px !important;">
		            <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-download fa-lg"></i> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu" style="left: -115px; top: 35px;">
							<li><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
                            <li><a href="#"><i class="fa fa-file-word-o"></i> Word Document</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear fa-lg"></i> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu" style="left: -110px; top: 35px;">
                            <li><a href="{{ route('pages.edit', [$wiki->slug, $page->slug]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
		                    <li>
		                    	<a href="#" onclick="if(confirm('Are you sure you want to delete this page?')) {event.preventDefault(); document.getElementById('delete-page').submit();}"><i class="fa fa-trash-o"></i> Delete</a>
								<form id="delete-page" action="{{ route('pages.destroy', [$wiki->slug, $page->slug]) }}" method="POST" style="display: none;">
	                                {!! method_field('delete') !!}
	                                {!! csrf_field() !!}
	                            </form>
		                    </li>
                        </ul>
                    </li>
                </ul>
	        </ul>
	    </div>
	</div>
</div>
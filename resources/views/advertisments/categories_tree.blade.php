@foreach ($cCategories as $oCategory)
	<li class="node @if(!$oCategory->isRoot()) is-root @endif @if (in_array($oCategory->id, $openedCategories)) font-weight-bold expand-open @else font-weight-normal expand-closed @endif">
		<div class="{{$oCategory->hasChildren() ? 'expand' : 'expand-leaf'}}"></div>
		<div class="content">
			<a href="{{app()->router->generateCurrentRouteWithFilters(['f_category' => $oCategory->code])}}">{{$oCategory->title}}</a>
		</div>
		@if($oCategory->hasChildren())
			<ul class="category-container">
				@include('advertisments.categories_tree', ['cCategories' => $oCategory->childCategories])
			</ul>
		@endif
	</li>
@endforeach

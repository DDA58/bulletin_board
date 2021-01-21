@foreach ($cCategories as $oCategory)
	<li class="node @if(!$oCategory->isRoot()) is-root @endif expand-closed">
		<div class="{{$oCategory->hasChilders() ? 'expand' : 'expand-leaf'}}"></div>
		<div class="content">{{$oCategory->title}}</div>
		@if($oCategory->hasChilders())
			<ul class="category-container">
				@include('advertisments.categories_tree', ['cCategories' => $oCategory->childCategories])
			</ul>
		@endif
	</li>
@endforeach
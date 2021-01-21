<div id="sidebar" class="col-3">
	<section>
		<header>
			<h2>Все категории</h2>
		</header>
		<ul class="style1 category-container">
			@include('advertisments.categories_tree', ['cCategories' => $cCategories])
		</ul>
	</section>
</div>
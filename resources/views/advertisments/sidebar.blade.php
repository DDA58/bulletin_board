<div id="sidebar" class="col-3">
	<section>
		<header>
			<h2><a href="{{app()->router->generateCurrentRouteWithFilters([], ['f_category'])}}">Все категории</a></h2>
		</header>
		<ul class="style1 category-container">
			@include('advertisments.categories_tree', ['cCategories' => $cCategories])
		</ul>
        <form name="prices_filter_form">
            <div class="form-group row col-12">@lang('Цена')</div>
            <div class="form-group row" style="
border: solid 1px;
border-radius: 10px;
border-color: rgba(0, 0, 0, 0.1);">
                <div class="col-6" style="border-right: solid 1px;
    border-color: rgba(0, 0, 0, 0.1)">
                    <input name="f_price_min" type="number" class="form-control-plaintext" placeholder="@lang('Цена от')" style="outline:none;" autocomplete="off">
                </div>
                <div class="col-6">
                    <input name="f_price_max" type="number" class="form-control-plaintext" placeholder="@lang('до')" style="outline:none;" autocomplete="off">
                </div>
            </div>
            <div class="form-group row col-12 justify-content-center">
                <button type="submit" class="btn btn-dark">Найти</button>
            </div>
        </form>
	</section>
</div>

<div class="container" style="padding: 10px 0;">
	<div class="row">
		<div class="col-12 ml-auto mr-auto d-flex justify-content-center">
			<form name="fulltext_form" method="get" class="col-12 d-flex justify-content-center">
				<div class="form-row col-12 justify-content-center" style="padding: 10px;
border: solid 1px;
border-radius: 10px;
border-color: rgba(0, 0, 0, 0.1);">
					<div class="col-4 my-auto">
						<input name="fts" type="text" class="form-control" id="mainSearch" placeholder="Поиск по объявлениям" autocomplete="off">
					</div>
                    <div class="col-1 text-center my-auto">
                        <button type="submit" class="btn btn-dark">Найти</button>
                    </div>
					<div class="col-4 my-auto">
						<div class="dropdown show">
							<a class="btn btn-light dropdown-toggle w-100" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="white-space: normal;">
								{{$sCheckedRegionName}}
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="height: auto; max-height: 25vh; overflow-y: auto;">
								<a class="dropdown-item" href="{{app()->router->generateCurrentRouteWithFilters([], ['f_region', 'f_city'])}}">Все регионы</a>
								@foreach ($cRegions as $oRegion)
									<a class="dropdown-item" href="{{app()->router->generateCurrentRouteWithFilters(['f_region' => $oRegion->id], ['f_city'])}}">{{$oRegion->name}}</a>
								@endforeach
							</div>
						</div>
					</div>
					<div class="col-3 my-auto">
						<div class="dropdown show">
							<a class="btn btn-light dropdown-toggle w-100" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="white-space: normal;">
								{{$sCheckedCityName}}
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="height: auto; max-height: 25vh; overflow-y: auto;">
								<a class="dropdown-item" href="{{app()->router->generateCurrentRouteWithFilters([], ['f_city'])}}">Все города</a>
								@foreach ($cCities as $oCity)
									<a class="dropdown-item" href="{{app()->router->generateCurrentRouteWithFilters(['f_city' => $oCity->slug])}}">{{$oCity->name}}</a>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

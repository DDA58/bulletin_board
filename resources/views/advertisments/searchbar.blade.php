<div class="container" style="padding: 10px 0;">
	<div class="row">
		<div class="col-12 ml-auto mr-auto d-flex justify-content-center">
			<form name="searchbar" action="{{route('ads')}}" method="get" class="col-12 d-flex justify-content-center">
				<div class="form-row col-12 justify-content-center" style="padding: 10px;
border: solid 1px;
border-radius: 10px;
border-color: rgba(0, 0, 0, 0.1);">
					<div class="col-4">
						<input name="mainSearch" type="text" class="form-control" id="mainSearch" placeholder="Поиск по объявлениям" disabled>
					</div>
					<div class="col-3">                                       
						<select name="regions" class="form-control" id="regions" onchange="console.log(event)">
							<option value="0">Все регионы</option>
							@foreach ($cRegions as $oRegion)
								<option value="{{$oRegion->id}}">{{$oRegion->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-3">                                      
						<select name="cities" class="form-control" id="cities">
							<option value="0">Все города</option>
							@foreach ($cCities as $oCity)
								<option value="{{$oCity->id}}">{{$oCity->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-2 text-center">
						<button type="submit" class="btn btn-dark">Найти</button>
					</div>
				</div>
			</form>
		</div>                        
	</div>      
</div>
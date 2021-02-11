@extends('layouts.app')

@section('content')
<!-- Main -->
<div id="main">
	@include ('advertisments.searchbar')
	<div class="container">
		<div class="row">
			@include('advertisments.sidebar')
			<div id="content" class="col-9 skel-cell-important">
				<section>
					<header>
						<h2>Объявления</h2>
					</header>
					<div class="container" style="width: 100%;">
						<div class="row">
							<div class="col-12">
								<div class="row">
									@forelse ($cAvderts as $oAdvert)
										<div class="col-6">
											<div class="row">
												<div class="row">
													<img class="col-6" src="{{asset('images/img_template.png')}}" width="78" height="78" alt="" style="width: 150px; height: 150px;">
													<div class="row col-6" style="align-content: flex-start;">
                                                        <span class="posted col-12" style="padding-left: 0px; align-self: center;">{{$oAdvert->city->name}}, {{$oAdvert->region->name}}</span>
                                                        <span class="posted col-12" style="padding-left: 0px; align-self: center;">Стоимость: {{$oAdvert->cost}}</span>
                                                        <span class="posted col-12" style="padding-left: 0px; align-self: center;">Дата публикации: {{$oAdvert->publish_date}}</span>
                                                    </div>
												</div>
												<div class="row col-12" style="width: 100%;">
													<p style="width: 100%; border-bottom: 1px solid; border-color: rgba(0,0,0,.1);">{{$oAdvert->title}}</p>
												</div>
											</div>
										</div>
                                    @empty
                                        <h4 class="w-100 text-center">Записи отсутствуют</h4>
									@endforelse
								</div>
								<div class="row col-12 justify-content-center">
									{{ $cAvderts->links() }}
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

		</div>
	</div>
</div>
<!-- /Main -->
@endsection

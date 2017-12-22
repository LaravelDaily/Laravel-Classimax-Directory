@extends('layouts.mainTable')

@section('content')

<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
                    {!! Form::open([ 'action' => 'HomePageController@table', 'method' => 'get']) !!}

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                {!! Form::text('search', old('search'), ['class' => 'form-control', 'placeholder' => 'Search company']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('name'))
                                    <p class="help-block">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                {!! Form::select('categories', $search_categories, null , ['placeholder' => 'Category', 'class' => 'form-control form-control-lg']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('categories'))
                                    <p class="help-block">
                                        {{ $errors->first('categories') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                {!! Form::select('city_id', $search_cities, null, ['placeholder' => 'City', 'class' => 'form-control form-control-lg']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('city_id'))
                                    <p class="help-block">
                                        {{ $errors->first('city_id') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit"
                                        class="btn btn-primary">
                                        Search Now
                                </button>
                            </div>
                        </div>

                    {!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</section>
<!--===================================
=            Store Section            =
====================================-->
<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<h1 class="product-title">{{ $company->name }}</h1>
					<div class="product-meta">
						<ul class="list-inline">
                            @foreach ($company->categories as $singleCategories)
                                <li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Category<a href="{{ route('category', [$singleCategories->id]) }}">
                                        <span class="label label-info label-many">{{ $singleCategories->name }}</span>
                                </a></li>
                            @endforeach
							<li class="list-inline-item"><i class="fa fa-location-arrow"></i> Location<a href="{{ route('search', ['city_id' => $company->city->id]) }}">{{ $company->city->name }}</a></li>
						</ul>
					</div>
                    <br>
                    <div class="col-md-4">
                        @if($company->logo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $company->logo) }}" target="_blank"><img class="card-img-top img-fluid" src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $company->logo) }}"/></a>@endif
                    </div>
					<div class="content">
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">About company</h3>
								<p>{{ $company->description}}</p>
							</div>
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">Where to find</h3>
								<p>{{ $company->address}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<!-- User Profile widget -->
					<div class="widget user">
						<h4>Other companies in this category</h4>
                        @foreach ($company->categories as $singleCategories)
                            @foreach ($singleCategories->companies->shuffle()->take(10) as $singleCompany)
                            <li><a href="{{ route('company', [$singleCompany->id]) }}">{{ $singleCompany->name }}</a></li>
                            @endforeach
                        @endforeach
					</div>
					<!-- Map Widget -->
				</div>
			</div>
			
		</div>
	</div>
	<!-- Container End -->
</section>

@stop

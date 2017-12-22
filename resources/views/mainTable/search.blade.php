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

<section class="section-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-result bg-gray">
					<h2>Results</h2>
					<p>{{ $companies->count() }} Results</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="category-sidebar">
					<div class="widget category-list">
                        <h4 class="widget-header">All Category</h4>
                        <ul class="category-list">
                            @foreach ( $categories_all as $category_all)
                                <li><a href="{{ route('category', [$category_all->id]) }} ">{{ $category_all->name}} <span>{{$category_all->companies->count()}}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
				</div>
			</div>
            <div class="col-md-9">
				<div class="product-grid-list">
					<div class="row mt-30">
                        @if (count($companies) > 0)
                            @foreach ($companies as $company)
                                <div class="col-sm-12 col-lg-4 col-md-6">
                                
                                    <!-- product card -->
                            
                                    <div class="product-item bg-light">
                                        <div class="card">
                                            <div class="thumb-content">
                                                @if($company->logo)<a href="{{ route('company', [$company->id]) }}"><img class="card-img-top img-fluid" src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $company->logo) }}"/></a>@endif
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title"><a href="{{ route('company', [$company->id]) }}">{{$company->name}}</a></h4>
                                                @foreach ($company->categories as $singleCategories)
                                                    <ul class="list-inline product-meta">
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('category', [$singleCategories->id]) }}"><i class="fa fa-folder-open-o"></i>{{ $singleCategories->name }}</a>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                                <p class="card-text">{{ substr($company->description, 0, 100) }}...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
				</div>
            {{ $companies->appends(Request::all())->links() }}
			</div>
		</div>
	</div>
</section>


@stop
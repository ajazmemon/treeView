@extends('layouts.main')
@section('content')
		<div class="panel panel-primary">
			<div class="panel-heading">Category</div>
	  		<div class="panel-body">
	  			<div class="row">
	  				<div class="col-md-6">
	  					<h3>Category List</h3>
				        <ul id="tree1">
				            @foreach($categories as $category)
				                <li>
				                    {{ $category->title }}
				                    @if(count($category->childs))
				                        @include('manageChild',['childs' => $category->childs])
				                    @endif
				                </li>
				            @endforeach
				        </ul>
	  				</div>
	  				<div class="col-md-6">
                      <h5 class="success alert alert-success hidden animated"></h5>
                            @if(isset($categoryId))
                                <h3>Update  Category</h3>
                            @else
                                <h3>Add  Category</h3>
                            @endif

                            @if(isset($categoryId))
                              {!! Form::open(['url'=>'update_category/' . $categoryId->id,'class'=>'formSubmit']) !!}
                            @else    
                              {!! Form::open(['route'=>'add.category','class'=>'formSubmit']) !!}
                            @endif
				  				@if ($message = Session::get('success'))
									<div class="alert alert-success alert-block">
										<button type="button" class="close" data-dismiss="alert">×</button>	
									        <strong>{{ $message }}</strong>
									</div>
								@endif
				  				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('Title:') !!}
									{!! Form::text('title',  @$categoryId->title ,['class'=>'form-control', 'placeholder'=>'Enter Title','required']) !!}
									<span class="text-danger">{{ $errors->first('title') }}</span>
								</div>
								<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
									{!! Form::label('Category:') !!}
									{!! Form::select('parent_id',$allCategories, @$categoryId->parent_id, ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
									<span class="text-danger">{{ $errors->first('parent_id') }}</span>
								</div>
								<div class="form-group">
									<button class="btn btn-success">Save Changes</button>
								</div>
				  			{!! Form::close() !!}
	  				</div>
	  			</div>

	  			
	  		</div>
        </div>
        @endsection
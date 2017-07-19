@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    update review
@stop

{{-- page specific css --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset( 'assets/frontend/css/star-rating.css' ) }}" media="all" type="text/css"/>
@endpush

{{-- main page content --}}
@section('contents')
<div class="content-wrapper container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <div class="row">
                    <h4 class="pull-left">Update Review Contents</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>product reviews</li>
                        <li>update</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-card margin-b-30">
                <!-- Start .panel -->
                <div class="panel-heading">
                    Edit Review Contents
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-rounded btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Go To <span class="caret"></span></button>
                            <ul class="dropdown-menu panel-dropdown" role="menu">
                                <li><a href="{{ url('/admin/product/reviews/published') }}">Published Reviews</a></li>
                                <li><a href="{{ url('/admin/product/reviews/unpublished') }}">Pending Reviews</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/admin/request/product/review/update/'.$review->id) }}" method="post" class="form-horizontal">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Review Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" value="{{ $review->title }}">

                                @if ($errors->has('title'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Review Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control">{{ $review->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('rating') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="text" name="rating" value="{{ $review->rating }}" class="rating rating-loading" data-size="xs" title="">

                                @if ($errors->has('rating'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ url('/admin/product/reviews/published') }}" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div> 
@stop
{{-- page specific js --}}
@push('scripts')
    
    <script type="text/javascript" src="{{ asset('assets/frontend/js/star-rating.js') }}"></script>

@endpush
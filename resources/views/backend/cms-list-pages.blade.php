@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    list of added cms pages
@stop

{{-- page specific css --}}
@push('styles')
    
    {{-- css switch --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/switch.css') }}">

@endpush

{{-- main page content --}}
@section('contents')
<div class="content-wrapper container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <div class="row">
                    <h4 class="pull-left">Manage CMS Pages</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>added pages</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- end .page title-->
    
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-card recent-activites">
                <!-- Start .panel -->
                <div class="panel-heading">
                    All Pages
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ url('/admin/cms/add-page') }}" class="btn btn-info btn-rounded btn-xs">Add Page</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Page Name</th>
                                    <th>URL</th>
                                    <th>Last Modified</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <form id="delete-page" action="" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    
                                </form>

                                @foreach($pages as $page)

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $page->page_name }}</td>
                                        <td><a href="{{ url('/'.$page->page_slug) }}" target="_blank">{{url('/'.$page->page_slug)}}</a></td>
                                        <td>{{ $page->updated_at }}</td>
                                        <td><a href="{{ url('/admin/cms/edit-page/'.$page->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                                        <td>
                                            <button type="button" onclick="deletePage({{ $page->id }});" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End .panel --> 


        </div>
    </div>

</div> 
@stop
{{-- page specific js --}}
@push('scripts')
    
    <script>
        function deletePage(page)
        {
            let conf = confirm('sure to delete this page!');
            if(conf)
            {
                $("form#delete-page").attr('action', `{{ url('/admin/cms/manage-page/delete/') }}/${page}`).submit();
            }
        }
    </script>

@endpush

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
        /*function changeCatSort(id, order) {
            //ajax
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{ url('/admin/category/set-order') }}",
                type: "PUT",
                data: {id:id, sort:order},
                success: function(result){
                    Command: toastr["success"]("order updated successfully", "Successfully Done. .");
                },
                error: function(xhr,status,error){
                    Command: toastr["error"](error, "some error occurred");
                }
            });

            $.ajax();
            //ajax
        }

        function remCategory(catId, elem)
        {
            let conf = confirm('sure to remove the category completely!\nall related products will be deleted too');

            if(conf)
            {
                var xhttp = new XMLHttpRequest();
                
                xhttp.open("DELETE", "{{ url('/admin/category/delete') }}", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                let data = '_token={{ csrf_token() }}';
                data += '&category='+catId;

                xhttp.send(data);

                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if(this.status == 200)
                        {
                            Command: toastr["success"]("category removed successfully", "Successfully Done. .");
                            $(elem).closest('tr').fadeOut();
                        }
                        else
                        {
                            Command: toastr["error"]("Upss! some error occurred", "Error. .");
                        }
                    }
                };
            }
        }*/
    </script>

@endpush

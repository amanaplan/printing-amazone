@extends('layouts.backend.main')

{{-- title of the page --}}
@section('pagetitle')
    list of added admins
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
                    <h4 class="pull-left">Manage List Admins</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li>accounts</li>
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
                    Striped Rows
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-rounded btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu panel-dropdown" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Full Name</th>
                                    <th>Email-ID</th>
                                    <th>Active / Inactive</th>
                                    <th>Remove Account</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset( 'assets/images' ) }}/{{ ($admin->profile_pic)? 'profile/'.$admin->profile_pic : 'user.png' }}" width="130" class="img-thumbnail" /></td>
                                    <td><i class="fa fa-id-badge"></i> {{$admin->name}}</td>
                                    <td><i class="fa fa-envelope"></i> {{$admin->email}}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" onchange="toggleUser({{$admin->id}}, this)" {{ ($admin->active)? 'checked' : '' }}>
                                            <div class="slider round"></div>
                                        </label>
                                    </td>
                                    <td><a href="{{ route('admin.remove', ['id' => $admin->id]) }}" class="btn btn-danger btn-lg" onclick="return confirm('this account will be removed forever. proceed!');"><i class="fa fa-trash"></i></a></td>
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
        function toggleUser(id, elem) {
          
            $(elem).prop('disabled',true);
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{ route('admin.user.toggle') }}",
                type: "PUT",
                data: {u_id:id},
                success: function(result){
                    $(elem).prop('disabled',false);
                    Command: toastr["success"]("Action Performed Successfully", "Successfully Done. .");
                },
                error: function(xhr,status,error){
                    Command: toastr["error"](error, "Error Occurred. .");
                }
            });

            $.ajax();
          
        }
    </script>

@endpush
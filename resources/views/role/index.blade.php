@extends('layouts.default')

@section('title', 'Role')

@section('styles') 
    <!-- Datatables -->
    <link href="{{ asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" rel="stylesheet">
    <style type="text/css">
      .actionicon{font-size: 18px;}
    </style>
@endsection

@section('content')

	<div class="">
	    <div class="page-title">
	        <div class="title_left">
	            <h3></h3>
	        </div>

	        <div class="title_right">
	            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
	                <div class="input-group pull-right">
	                    <a class="btn btn-default btn-success" href="{{ route('role.create') }}"><big><b>Add Role</b></big></a>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="clearfix"></div>
	    <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">
	            <div class="x_panel">
	                <div class="x_title">
	                    <h2>Roles List</h2>
	                    <div class="clearfix"></div>
	                </div>
	                <div class="x_content">

	                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
	                        <thead>
	                            <tr>
	                                <th>#</th>
	                                <th>Name</th>
	                                <th>Label</th>
	                                <th>Permissions</th>
	                                <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>  
	                        @foreach($roles as $key => $role) 
	                            <tr>
	                                <td><label>{{ $key+1 }}</label></td>
	                                <td>{{ $role->name }}</td>
	                                <td>{{ $role->label }}</td>
	                                <td><span class="label label-success">{!! $role->permissions->pluck('name')->implode('</span> <span class="label label-success">') !!}</span></td>
	                                <td>
	                                	@if(Auth::user()->hasRole('super_admin') || Auth::user()->id==$role->user_id)
	                                	 @if(!Auth::user()->hasRole($role->name))
	                                    <a href="{{ route('role.edit',$role->id) }}" class="actionicon" data-toggle="tooltip" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>	                                   
	                                    <a href="JavaScript:void(0);" class="actionicon" onClick="removecollection('{{ route('role.destroy',$role->id) }}','{{ $role->id }}')" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
	                                    @endif
	                                    @endif
	                                </td>
	                            </tr>  
	                        @endforeach                  
	                        </tbody>                      
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

@endsection
@section('js')
<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('js/responsive.bootstrap.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>

<script type="text/javascript">
    $("#datatable-responsive").DataTable({
        "pageLength": 20
    });
</script>
<script type="text/javascript">
        function removecollection(url,id){
           swal({
                  title: "Role Data",
                  text: "Are you sure that you want to delete this role?",
                  type: "warning",
	              showCancelButton: true,
	              confirmButtonText: "Yes, delete it!",
	              confirmButtonColor: "#ec6c62"
                }, function () {                
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                });
                
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: {"id": id},
                    cache: false,
                    success: function (data) {                          
                        location.reload();
                    }
                });
			});
    }
    </script>

@endsection
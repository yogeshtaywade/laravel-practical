@extends('layouts.default')

@section('title', 'User')

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
	    </div>

	    <div class="clearfix"></div>
	    <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">
	            <div class="x_panel">
	                <div class="x_title">
	                    <h2>Users List</h2>
	                    <div class="clearfix"></div>
	                </div>
	                <div class="x_content">

	                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
	                        <thead>
	                            <tr>
	                                <th>#</th>
	                                <th>Name</th>
	                                <th>Email</th>
	                                <th>Phone Number</th>
	                                <th>Image</th>
	                            </tr>
	                        </thead>
	                        <tbody>   
	                        	@if(count($users) > 0)
	                        	@foreach($users as $key => $user) 
                                        <tr>
                                            <td><label>{{ $key+1 }}</label></td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td align="center"><img src="{{ url('storage/image/'.$user->image)}}" class="figure" id="blah" onerror="this.onerror=null;this.src='{{asset('images/useravatar.png') }}';" width="50" height="50" /></td>
                                        </tr>
	                            @endforeach
		                        @else
		                             <tr><th colspan="5" ><h2><center>No Record Found</center></h2></th></tr>
		                        @endif                      
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
                  title: "User Data",
                  text: "Are you sure that you want to delete this User?",
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
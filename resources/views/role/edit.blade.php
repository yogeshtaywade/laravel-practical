@extends('layouts.default')

@section('title', 'Edit Role')

@section('styles') 
<!-- Datatables -->
<link href="{{ asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<!-- iCheck -->
<link href="{{ asset('css/green.css')}}" rel="stylesheet">
<style type="text/css">
    .margins{margin-bottom:2em;border-bottom:1px solid #efeaea;}
    label.error{color:red;}
</style>
@endsection

@section('content')

<div class="">
    <div class="row" style="margin-bottom:2em;border-bottom:1px solid #efeaea;">
        <div class="page-title" >
            <div class="title_left">
                <h3>Edit Role</h3>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
    <div class="main">
        <form class="form-horizontal form-label-left input_mask" id="customerforms" method="post" action="{{ route('role.update',$role->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT')}}
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                    <div class="x_content">
                        <br>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <label>Role Name </label>
                            <input type="text" class="form-control" id="inputSuccess2" value="{{ $role->name }}" disabled="" placeholder="Role Name">
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback {{ $errors->has('label') ? ' has-error' : '' }}">
                            <label>Role Label</label>
                            <input type="text" class="form-control" id="inputSuccess4" value="{{ $role->label }}" name="label"  placeholder="Role Label">
                            @if ($errors->has('label'))
                            <span class="help-block">
                                <strong>{{ $errors->first('label') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <label class="{{ $errors->has('permission') ? ' has-error' : '' }}">Role Permissions</label>    
                            <ul class="permissions-list">
                                @foreach($permissions as $key => $value)
                                <label style="cursor: pointer;" for="check_{{$key}}">{{ (empty($key) ? '*' : ucfirst($key))  }}</label>
                                <ul class="checkbox-group-child-ul row">
                                    @foreach($value as $permission)
                                    <li class="col-xs-12 col-md-4" style="list-style: none">
                                        <input class="checkbox-group-child" id="check_id_{{$permission->id}}" type="checkbox" value="{{ $permission->id }}" name="permission[]" {{ (isset($role) ? (in_array($permission->id,$role->permissions->pluck('id')->toArray()) ? 'checked=checked' : '') : '')}}> &nbsp;&nbsp;&nbsp;<label style="cursor: pointer; background-color:transparent;width: auto;height: auto;border: none;border-radius: unset;" for="check_id_{{$permission->id}}">{{ ucfirst(str_replace('-',' ',$permission->name)) }}</label>
                                    </li>
                                    @endforeach
                                </ul>

                                @endforeach
                                @if ($errors->has('permission'))
                              <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('permission') }}</strong>
                                    </span>
                                @endif
                            </ul>                        
                        </div>

                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="button" class="btn btn-primary" value="Cancel">
                        <input type="submit" name="addcustomerdata" value="Submit" class="btn btn-success">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@section('js') 
<!-- Datatables -->
<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('js/responsive.bootstrap.js')}}"></script>
<!-- iCheck -->
<script src="{{ asset('js/icheck.min.js')}}"></script>
<!-- jquery validate -->
<script src="{{ asset('js/jquery.validate.min.js')}}"></script>   


@endsection
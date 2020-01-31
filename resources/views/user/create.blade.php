@extends('layouts.default')

@section('title', 'Create User')

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
                  <h3>Add User</h3>
              </div>
          </div>
          <div class="clearfix"></div>

      </div>
      <div class="main">
              
              <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="x_panel">
                      <div class="x_content">
                          <br>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <label>Name</label>
                              {{ $user->first_name.' '.$user->last_name }}
                              <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                          </div>

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <label>Email</label>
                              <input type="text" class="form-control" id="inputSuccess4" name="email" placeholder="Enter Email">
                              <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                          </div>

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <label>Phone Number <span style="color:red;">(US Only)</span></label>
                              <input type="text" class="form-control" id="inputSuccess5" placeholder="Phone Number" name="phone" >
                              <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <input type="button" class="btn btn-primary" value="Cancel">
                          <input type="submit" name="addcustomerdata" value="Submit" class="btn btn-success">
                      </div>
                  </div>
              </div>
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
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Add Validation Rules -->
    <script type="text/javascript">
          $(document).ready(function () {
            //Phone Us
            $.validator.addMethod("phoneUS", function (phone_number, element) {
                  phone_number = phone_number.replace(/\s+/g, "");
                  return this.optional(element) || phone_number.length > 9 &&
                        phone_number.match(/\(?[\d\s]{3}\)[\d\s]{3}-[\d\s]{4}$/);
                  }, "Invalid phone number");

              $('#customerforms').validate({ // initialize the plugin
                    rules :{
                        "name" : {
                            required : true
                        },                        
                        "email" : {
                            required : true,
                            email:true
                        },
                       /* "phone" : {
                            /*required : true,
                            minlength: 10,
                            maxlength: 10
                            phoneUS: true
                        }*/
                        
                    },
                    messages :{
                        "name" : {
                            required : 'Please Enter Name'
                        },                        
                        "email" : {
                            required : 'Please Enter Email Address',
                            email: 'Please Enter a valid email address',
                        },
                       /* "phone" : {
                            /*required : 'Please Enter Phone Number',
                            minlength: 'Phone Number Should be 10 Digits',
                            maxlength: 'Phone Number Should be 10 Digits',
                            phoneUS: "Enter Right US Phone Number"
                        }*/
                    }
              });

          });
    </script>
@endsection
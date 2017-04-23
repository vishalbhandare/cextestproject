@extends('layouts.main')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Profile</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('profiles.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   <form method="POST" action="/profiles/{{$item->id}}" id="createform"  enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {!! method_field('patch') !!}
        <input type="hidden" name="_method" value="PATCH">
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
         
             
             
                  <div class="form-group ">
              
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name"  name="name" placeholder="Enter Name" value="{{$item->name}}">   
                    <span class="help-block"></span>
                  </div>            
            </div>
          
        </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email"  value="{{$item->email}}">

          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
            <label for="exampleInputFile">Profile  Image</label>
            <input type="file" class="form-control-file" id="profilepics" name="profilepics" aria-describedby="fileHelp" onchange="loadFile(event)" value="{{$item->email}}">
            <img id="output"  width="100px" height="100px" src="/{{$item->profilepic}}" />
            <a href="#" style="display:none" id="removeimg">Remove</a>
            <small id="fileHelp" class="form-text text-muted">Upload File Only Jpeg/Png supported.</small>
          </div>
        </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Phone Number</label>
            <input type="text" class="form-control" id="phonenumber" name="phonenumber" aria-describedby="phoneHelp" placeholder="Enter Phone Number"  value="{{$item->phonenumber}}">

          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
        </form>


@endsection
@section('scripts')
<script>
var loadFile = function(event) {
    var output = document.getElementById('output');
    var remove = document.getElementById('removeimg');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.style = "display:block";
    remove.style= "display:block";
 };
 
 
 
$(document).ready(function() {
    
    $("#removeimg").click(function(){
          $('#file').val("");
            $('#output').hide();
             $("#removeimg").hide()
            return false;
     });
     
     
    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
);
// validate signup form on keyup and submit
		var validatereturn = $("#createform").validate({
			rules: {
				name: "required",
                                email: {
					required: true,
					email: true
				},
                                phonenumber: {
                                    required: true,
                                    regex   : "[789][0-9]{9}"
                                },
                                profilepics:{
                                    required: false   
                                }
			},
			messages: {
				name: "Please enter your firstname",
                                email: "Please enter a valid email address",
                                phonenumber: "Please enter a valid Phone Number",
                                profilepics:{
                                    required: 'Please select the image!'  
                                 }
			},
                         submitHandler:function (form) {
                            var form_data = new FormData(form);
                              //var formData = new FormData($(form)[0]);                              
                          
                              //return false;
                              $.ajax({
                                    dataType: "json",
                                    type: 'post',
                                    url: "/profiles/{{$item->id}}",
                                    data: form_data,
                                     contentType: false,
                                     cache: false,
                                    processData:false,
                                    success: function (responseData) {
                                        if(responseData.status==1){
                                            alert(responseData.message);
                                            window.location.href = "/profiles";
                                        }
                                        console.log(responseData)
                                    },
                                    error: function (responseData) {
                                        console.log(responseData.responseJSON);
                                        validatereturn.showErrors(responseData.responseJSON);
                                    }
                             });
                             return false;
                         }
		});

  
});
</script>
@endsection

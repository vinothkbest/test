@extends('layout')
@section('contents')
    <div class="card w-50">
        <div class="card-header text-center bg-info text-light">Employee Registration</div>
        <div class="card-body text-center">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#userModal">
              Sign Up
            </button>
        </div>
    </div>
    {{-- User Modal --}}
    <div class="modal fade" id="userModal"
         tabindex="-1" role="dialog"
         aria-labelledby="userModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                        <div class="modal-title"
                             id="userModalLabel">Fill the following information
                        </div>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control h-fix" id="name"
                                   placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="dob">DOB</label>
                            <input type="date" class="form-control h-fix" id="dob"
                                   placeholder="Pick DOB">
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control h-fix" id="mobile"
                                   placeholder="Enter Mobile"
                                   minlength=10
                                   maxlength=10>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control h-fix" id="email"
                                   placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="number" class="form-control h-fix" id="salary"
                                   placeholder="Enter salary in rupee">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control h-fix" id="address" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="admin">Is Admin?</label>
                            <input type="checkbox" class="ml-4" id="admin">
                        </div>
                        <div class="form-group" id="password-div"
                             style="display:none">
                            <label for="password">Password</label>
                            <input type="password" class="form-control h-fix" id="password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success w-50" onClick="employeeSave()">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_after')
<script>
    $("#admin").click(function() {
        $("#password-div").toggle();
    });
    async function employeeSave(){
        var formdata = ''
        if($("#admin").is(":checked")){

            formdata = {
                name:$("#name").val(),
                dob:$("#dob").val(),
                email:$("#email").val(),
                mobile:$("#mobile").val(),
                salary:$("#salary").val(),
                address:$("#address").val(),
                is_admin:1,
                password:$("#password").val()
            }   
        }
        else{
            formdata = {
                name:$("#name").val(),
                dob:$("#dob").val(),
                email:$("#email").val(),
                mobile:$("#mobile").val(),
                salary:$("#salary").val(),
                address:$("#address").val(),
                is_admin: 0
            } 
        }
        const request = `{{ url('register') }}`;
        $.ajax({type:'POST',
                url:request,
                headers: {
                           'X-CSRF-Token': $('input[name="_token"]').val(),
                        },
                data: formdata,
                success: function(response){
                    $("#name").val('')
                    $("#dob").val('')
                    $("#email").val('')
                    $("#mobile").val('')
                    $("#salary").val('')
                    $("#address").val('')
                    $("#password").val('')
                    $("#userModal").modal('hide');
                    swal({
                        title: "Employee Registration",
                        text: response.message,
                        icon: "success",
                    });
                },
                error: function(error){
                    swal({
                        title: "Employee Registration",
                        text: error.responseJSON.message,
                        icon: "error",
                    });
                }
        })
    }
</script>
@endsection
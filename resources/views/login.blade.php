<!DOCTYPE HTML>
<html>
<head>
    <title>Login page</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
</head>
<body>

<!-- container -->
<div class="container">
<!-- <div class="page-header">
        <h4>Create Role</h4>
    </div>
    <div class="row">
        <form class="form-group" id="createRoleForm">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="roleName" class="form-control" placeholder="Enter roleName" id="roleName">
                </div>
            </div>
            

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="moduleID" class="form-control" placeholder="Enter moduleID" id="moduleID">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="canView" class="form-control" placeholder="Enter canView" id="canView">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="canAdd" class="form-control" placeholder="Enter canAdd" id="canAdd">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="canDelete" class="form-control" placeholder="Enter canDelete" id="canDelete">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="canEdit" class="form-control" placeholder="Enter canEdit" id="canEdit">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <input type="button" name="addRole" id="addRole" onclick="addRoleRecord();"
                           class="btn btn-primary btn-sm"
                           value="addRole ">
                </div>
            </div>
        </form>
    </div> -->

<div class="page-header">
    <h4>Create user</h4>
</div>
    <div class="row">
        <form class="form-group" id="-form">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Enter username" id="username">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Enter email" id="email">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="fname" class="form-control" placeholder="Enter first name" id="fname">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="lname" class="form-control" placeholder="Enter last name" id="lname">
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <input type="password" name="Password" class="form-control" placeholder="Enter Password" id="Password">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="password" name="Password2" class="form-control" placeholder="Re-enter Password" id="Password2">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="createdBy" class="form-control" placeholder="Enter created by" id="createdBy">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="modifiedBy" class="form-control" placeholder="Enter modified by" id="modifiedBy">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select name="role" class="form-control" id="role">
                        <option value="0">Select Role</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="processor">Processor</option>
                        <option value="member">Member</option>
                        <option value="encoder">Encoder</option>
                        <option value="helpdesk">Helpdesk</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="button" name="register" id="register" onclick="registerRecord();"
                           class="btn btn-primary btn-sm"
                           value="Register ">
                </div>
            </div>
            
        </form>
    </div>
    <div class="page-header">
        <h4>LOGIN</h4>
    </div>
    <div class="row">
        <form class="form-group" id="-form">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="email" name="loginEmail" class="form-control" placeholder="Enter Name" id="loginEmail">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="password" name="loginPassword" class="form-control" placeholder="Enter Password" id="loginPassword">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <input type="button" name="login" id="login" onclick="loginRecord();"
                           class="btn btn-primary btn-sm"
                           value="Login ">
                </div>
            </div>
        </form>
    </div>

    <!-- Trigger the modal with a button -->
    <button class="btn btn-info btn-lg" data-target="#myModal" data-toggle="modal" id="modalButtonOpen"
            style="visibility:hidden" type="button">
        Open Modal
    </button>
    <!-- Modal (Pop up when detail button clicked) -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="myModal" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-label="Close" class="close" data-dismiss="modal" id="modalButtonClose" type="button">
                        Close
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                         Editor
                    </h4>
                    <form id="-update-form">
                        <div class="form-group">
                            <div class="col-sm-12" id="update_field">

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary btn-sm" onclick="submitUpdate();" name="submit_update" type="button"
                           value="Save Changes"/>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end .container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <!--  ALL AJAX SCRIPT WILL COME HERE -->
  
 <script>
function loginRecord() {
    const loginEmail = $('#loginEmail').val();
    const loginPassword = $('#loginPassword').val();
    $.ajaxSetup({
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    });
    // save token
    $.ajax({
        type: "POST",
        url: "/api/login",
        data: {
            loginEmail,
            loginPassword,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            
            if (response.status) {
                localStorage.setItem('token', response.token);
                alert('Login successful');

                const roleRedirectMap = {
                    'superadmin': '/superadmin/',
                    'admin': '/admin/',
                    'processor': '/processor/',
                    'member': '/member/',
                    'encoder': '/encoder/',
                    'helpdesk': '/helpdesk/'
                };

                const redirectPath = roleRedirectMap[response.fldRoleName] || '/';
                window.location.href = redirectPath;
            } else {
                alert('Login failed');
            }
        },
        error: function () {
            alert('An error occurred. Please try again.');
        }
    });
}

    function registerRecord() {
        var username = $('#username').val();
        var email = $('#email').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var password = $('#Password').val();
        var password2 = $('#Password2').val();
        var createdBy = $('#createdBy').val();
        var modifiedBy = $('#modifiedBy').val();
        var role = $('#role').val();
        if (role == 0) {
            alert('Please select a role');
            return;
        }

        if (password !== password2) {
            alert('Passwords do not match');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/api/register",
            data: {
                username: username,
                email: email,
                fname: fname,
                lname: lname,
                password: password,
                createdBy: createdBy,
                modifiedBy: modifiedBy,
                role: role,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status == 'success') {
                    alert('Registration successful');
                  
                } else {
                    console.log(response);
                    alert('Registration failed');
                }
            },
            error: function (xhr) {
                alert('An error occurred. Please try again.');
            }
        });
    }
    function addRoleRecord() {
        var roleName = $('#roleName').val();
        var moduleID = $('#moduleID').val();
        var canView = $('#canView').val();
        var canAdd = $('#canAdd').val();
        var canDelete = $('#canDelete').val();
        var canEdit = $('#canEdit').val();

        $.ajax({
            type: "POST",
            url: "/api/addRole",
            data: {
                roleName: roleName,
                moduleID: moduleID,
                canView: canView,
                canAdd: canAdd,
                canDelete: canDelete,
                canEdit: canEdit,
            },
            success: function (response) {
                if (response.permission) {
                    alert('Role added successfully');
                } else {
                    alert('Failed to add role, reason:',response.error);
                }
            },
            error: function (xhr) {
                alert('An error occurred. Please try again.');
            }
        });
    }
 </script>
</body>
</html>

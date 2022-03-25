@extends('layouts.layout')

@section('title','Teachers')

@section('content')
@if($schoolinfo == null)
    <h3 class="text-center text-success">Hello {{ $adminInfo->name }} Click the Link below to update to register your institution</h3>
    <h5 class="text-center"><a href="/schoolreg" class="link-info">Register School</a></h5>
    @else 
<div class="container-fluid">
@include('adminFiles.motto')
<div class="main">
<div id="sidenavigation" class="sidenav">
@include('adminFiles.sidebar')
</div>
<div id="main" class="maincontent">
@include('adminFiles.topnav')
<h4>Teacher(s)</h4>
<div class="mb-2">
<button class="btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#teacheraddModal" type="button"><i class="fas fa-plus-circle"></i>&nbsp;ADD TEACHER</button>
<a href="/downloadteachers" type="button" class="btn-sm btn-info"><i class="fas fa-file-csv"></i>&nbsp;EXPORT TO EXCEL</a>
<a href="/teachersexcelimport" type="button" class="btn-sm btn-primary" type="button"><i class="fas fa-file-csv"></i>&nbsp;IMPORT FROM EXCEL</a>
<div id="regresponse"></div>
</div>
<!---Teacher edit modal start--->
<div class="modal w3-animate-zoom" id="teachereditModal" tabindex="-1" aria-labelledby="teachereditModal">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-success text-center" id="teacheraddModalLabel">Teacher Edit Modal<h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="#" id="teachereditform" class="p-2" method="POST" enctype="multipart/form-data">
         <div class="row">
            <div class="col-lg-6">
            <input type="number" name="editid" id="editid" hidden>
             <div class="form-group mb-2">
                <label for="">Salutation</label>
                <select name="editsalutation" id="editsalutation" class="form-control">
                    <option id="editsalval"></option>
                    <option value="Ms">Miss</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Madam">Madam</option>
                </select>
                <div class="invalid-feedback"></div>
             </div>
             <div class="form-group mb-2">
                <label for="">First Name</label>
                <input class="form-control" type="text" name="editfname" id="editfname">
                <div class="invalid-feedback"></div>
             </div>
             <div class="form-group mb-2">
                <label for="">Second Name</label>
                <input class="form-control" type="text" name="editsname" id="editsname">
                <div class="invalid-feedback"></div>
             </div>
             <div class="form-group mb-2">
                <label for="">Last Name</label>
                <input class="form-control" type="text" name="editlname" id="editlname">
                <div class="invalid-feedback"></div>
             </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group mb-2">
                <label for="">Phone Number</label>
                <input class="form-control" type="text" name="editpno" id="editpno">
                <div class="invalid-feedback"></div>
             </div>
             <div class="form-group mb-2">
                <label for="">Email</label>
                <input class="form-control" type="text" name="editemail" id="editemail">
                <div class="invalid-feedback"></div>
             </div>
             <div class="form-group mb-2">
                <label for="">Position</label>
                <select class="form-control" name="editposition" id="editposition">
                    <option id="editpositionval"></option>
                    <option value="Principal">Principal</option>
                    <option value="Deputy Principal">Deputy Principal</option>
                    <option value="Senior Teacher">Senoir Teacher</option>
                    <option value="Games Captain">Games Captain</option>
                    <option value="HOD">Head of Department</option>
                    <option value="Club Patron">Club Patron</option>
                    <option value="Madam">Teacher</option>
                </select>
                <div class="invalid-feedback"></div>
             </div>
             <div class="form-group mb-2">
                <label for="">Gender</label>
                <div id="editgenderdiv">

                </div>
             </div>
             <div class="form-group mb-2">
              <label for="">Profile Photo</label>
              <input onchange="preview2()" class="form-control" type="file" name="editprofile" id="editprofile">
              <div class="invalid-feedback"></div>
             </div>
            </div>
            <div class="text-center mb-2" id="teachereditprofile">

            </div>
            <div class="form-group mb-2 d-grid">
             <input type="submit" id="editteachersubmitbtn" class="btn btn-warning btn-sm rounded-0" value="EDIT TEACHER">
            </div>
         </div>
        </form>
        </div>
    </div>
    </div>
</div>
<!---Teacher edit modal start--->

<!---Teacher view modal start--->
<div class="modal w3-animate-zoom" id="teacherviewModal" tabindex="-1" aria-labelledby="teacherviewModal">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-success text-center" id="teacheraddModalLabel"><span id="titleteacher" class="text-danger"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="row">
         <div class="text-center" id="teacherimg"></div>
            <div id="teacherdetails" class="text-center">
                
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<!---Teacher view modal start--->

<!---Teacher add modal start--->
<div class="modal fade" id="teacheraddModal" tabindex="-1" aria-labelledby="teacheraddModalLabel">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-success text-center" id="teacheraddModalLabel">Register Teacher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="#" id="teacherregform" class="p-2" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="">Salutation<sup><b class="text-danger">*</b></sup></label>
                        <select name="salutation" id="salutation" class="form-control">
                            <option value="">--select salutation--</option>
                            <option value="Ms">Miss</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Madam">Madam</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">FirstName</label>
                        <input placeholder="First Name" type="text" name="firstname" id="firstname" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">SecondName</label>
                        <input placeholder="Second Name" type="text" name="secondname" id="secondname" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">LastName</label>
                        <input placeholder="Last Name" type="text" name="lastname" id="lastname" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-lg-6">
                <div class="form-group mb-3">
                        <label for="">Phone Number</label>
                        <input placeholder="Phone Number" type="tel" name="phone" id="phone" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input placeholder="Email address" type="email" name="email" id="email" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Position<sup><b class="text-danger">*</b></sup></label>
                        <select name="position" id="position" class="form-control">
                            <option value="">--select position--</option>
                            <option value="Principal">Principal</option>
                            <option value="Deputy Principal">Deputy Principal</option>
                            <option value="Senior Teacher">Senoir Teacher</option>
                            <option value="Games Captain">Games Captain</option>
                            <option value="HOD">Head of Department</option>
                            <option value="Club Patron">Club Patron</option>
                            <option value="Madam">Teacher</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Gender</label><br>
                        <input type="radio" name="gender" id="gender" value="male">&nbsp;Male
                        <input type="radio" name="gender" id="gender" value="female">&nbsp;Female
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Profile Photo</label><br>
                        <input onchange="preview()" type="file" name="file" id="file" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                    <div class="text-center mb-3">
                    <img width="150" id="frame" height="150" class="img-fluid" src="{{ asset('images/avatar.png') }}" alt="">
                    </div>

                <div class="form-group mb-3 d-grid">
                    <button type="submit" id="teacheregbtn" class="btn btn-info">REGISTER TEACHER</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    </div>
</div>

<div class="row border border-3 border-info p-3">
    
<div class="table-responsive">
<div id="actionbtns" class="d-none">
<!---
<button class="btn btn-sm btn-info float-end"><i class="fas fa-envelope"></i>&nbsp;Send Email</button>
<button class="btn btn-sm btn-success float-end"><i class="fas fa-sms"></i>&nbsp;Send SMS</button>
--->
<button id="deactivatebtn" class="btn btn-sm btn-primary float-end m-1">Deactivate</button>
<button id="activatebtn" class="btn btn-sm btn-success float-end m-1">Activate</button>
<button id="viewbtn" class="btn btn-sm btn-info float-end m-1"><i class="fas fa-eye"></i>&nbsp;View</button>
<button id="teachereditbtn" class="btn btn-sm btn-warning float-end m-1"><i class="fas fa-edit"></i>&nbsp;Edit</button> 
<button id="teacherdelbtn" class="btn btn-sm btn-danger float-end m-1"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button> 
</div> 
<table class="table">
            <thead>
            <tr>
                <th scope="col">Select</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Gender</th>
                <th scope="col">Position</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>  
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        </table>

</div>
 </div>
    
</div>
</div>
</div>
@endsection 
@endif


@section('script')
<script>
function preview(){
frame.src=URL.createObjectURL(event.target.files[0]);
}

function preview2(){
frame2.src=URL.createObjectURL(event.target.files[0]);
}
</script>
<script>
    $(document).ready(function(){
        fetchteachers();
        //set csrf
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        function fetchteachers() {
            $.ajax({
                method: 'GET',
                url: '/fetchteachers',
                //dataType: 'jsons',
                success: function(res) {
                    if (res.teachers.length == 0) {
                        $('tbody').html('<h5 class="text-center text-danger">No any teachers registered as at now</h5>');
                    } else {
                        $('tbody').html('');
                         $.each(res.teachers, function(key,item){
                        $('tbody').append('<tr>\
                        <td><input value="'+item.id+'" type="checkbox" class="checkboxid" name="teachercheckboxid" id="teachercheckboxid"></td>\
                        <td><img  width="50" height="50" class="img-fluid" src="images/'+item.Profile+'" alt=""></td>\
                        <td>'+item.salutation+' '+item.Fname+' '+item.Lname+'</td>\
                        <td><button class="btn btn-success btn-sm">'+item.Active+'</button></td>\
                        <td>'+item.Gender+'</td>\
                        <td>'+item.Position+'</td>\
                        <td>'+item.Email+'</td>\
                        <td>'+item.Phone+'</td>\
                    </tr>');
                    });  
                    }
                   
                }

            })
        }

        $(document).on('change', '.checkboxid',function(e){
            e.preventDefault();
            var id = $(this).val();
            $('#actionbtns').removeClass('d-none');
        })

        $("#teacherregform").submit(function(e){
            e.preventDefault();
            $('#regresponse').addClass('d-none');
            $('#teacheregbtn').val('PLEASE WAIT...');
            var formData = new FormData($('#teacherregform')[0]);

            $.ajax({
                method: 'POST',
                url: '{{ route('teacher.register') }}',
                contentType: false,
               processData: false,
               data: formData,
               //dataType: 'json',
               success: function(res){
                   if (res.status == 400) {
                    $('#teacheregbtn').val('REGISTER TEACHER');
                    showError('salutation', res.messages.salutation);
                    showError('firstname', res.messages.firstname);
                    showError('secondname', res.messages.secondname);
                    showError('lastname', res.messages.lastname);
                    showError('active', res.messages.active);
                    showError('phone', res.messages.phone);
                    showError('email', res.messages.email);
                    showError('position', res.messages.position);
                    showError('gender', res.messages.gender);
                    showError('file', res.messages.file);
                   } else if(res.status == 200){
                    fetchteachers();
                    $('#teacherregform')[0].reset();
                    $('#teacheregbtn').val('REGISTER TEACHER');
                    $('#regresponse').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>'+res.messages+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>')
                    $('#regresponse').removeClass('d-none');
                    $('#teacherregform').find('input').val('');
                   $('#frame').src = 'images/avatar.png';
                   $("#teacheraddModal").modal('hide'); 
                   }
                   
               }
            });
        })
    //Update Teacher ajax Request
    $("#teachereditform").submit(function(e){
            e.preventDefault();
            $('#regresponse').addClass('d-none');
            $('#editteachersubmitbtn').val('PLEASE WAIT...');
            var formData = new FormData($('#teachereditform')[0]);

            $.ajax({
                method: 'POST',
                url: '{{ route('teacher.edit') }}',
                contentType: false,
               processData: false,
               data: formData,
               //dataType: 'json',
               success: function(res){
                   if (res.status == 400) {
                    $('#editteachersubmitbtn').val('EDIT TEACHER');
                    showError('editsalutation', res.messages.editsalutation);
                    showError('editfname', res.messages.editfname);
                    showError('editlname', res.messages.editlname);
                    showError('editposition', res.messages.editposition);
                    showError('editgender', res.messages.editgender);
                    showError('editprofile', res.messages.editprofile);
                   } else if(res.status == 200){
                    fetchteachers();
                    $('#teachereditform')[0].reset();
                    $('#editteachersubmitbtn').val('EDIT TEACHER');
                    $('#regresponse').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>'+res.messages+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>')
                    $('#regresponse').removeClass('d-none');
                   $('#frame').src = 'images/avatar.png';
                   $("#teachereditModal").modal('hide'); 
                   }
                   
               }
            });
        })


    //Function to fetch teacher for viewing
    function fetchteacher(id){
        $.ajax({
                method: 'GET',
                url: `/getteacher/${id}`,
                //dataType: 'jsons',
                success: function(res) {
                    var data = res.teacher;
                    $('#titleteacher').text(data.salutation+' '+data.Fname+' '+data.Sname+' '+data.Lname);
                    $('#teacherimg').html('');
                    $('#teacherimg').append('<img src="images/'+data.Profile+'" class="img-fluid"/>');
                    $('#teacherdetails').html('');
                    $('#teacherdetails').append('<h6>Gender : <span class="text-danger">'+data.Gender+'</span></h6>\
                    <h6>Position : <span class="text-danger">'+data.Position+'</span></h6>\
                    <h6>Email : <span class="text-danger">'+data.Email+'</span></h6>\
                    <h6>Phone : <span class="text-danger">'+data.Phone+'</span></h6>\
                    ');
                }                   
                })
        }
    //Function to fetch teacher for editing
    function fetchteacher2(id){
        $.ajax({
                method: 'GET',
                url: `/getteacher/${id}`,
                //dataType: 'jsons',
                success: function(res) {
                    var data = res.teacher;
                    $('#teachereditprofile').html('<img width="150" id="frame2" height="150" class="img-fluid" src="images/'+data.Profile+'" alt="">');
                    $('#editid').val(data.id);
                    $('#editsalval').val(data.salutation);
                    $('#editsalval').text(data.salutation);
                    $('#editfname').val(data.Fname);
                    $('#editsname').val(data.Sname);
                    $('#editlname').val(data.Lname);
                    $('#editpno').val(data.Phone);
                    $('#editemail').val(data.Email);
                    $('#editpositionval').val(data.Position);
                    $('#editpositionval').text(data.Position);

                    if (data.Gender == 'male') {
                        $('#editgenderdiv').html('');
                        $('#editgenderdiv').append('<input checked type="radio" name="editgender" id="editgender" value="male">&nbsp;Male\
                        <input type="radio" name="editgender" id="editgender" value="female">&nbsp;Female');
                    } else {
                        $('#editgenderdiv').html('');
                        $('#editgenderdiv').html('<input type="radio" name="editgender" id="editgender" value="male">&nbsp;Male\
                        <input checked type="radio" name="editgender" id="editgender" value="female">&nbsp;Female'); 
                    }
                }                   
                })
        }

    //Teacher Viewing
     $(document).on('click', '#viewbtn',function(e){
         e.preventDefault();
         var ids = []
         $('#teachercheckboxid:checked').each(function(i){
            ids[i] = $(this).val()
        })
        if (ids.length < 1) {
            alert('Please select a Teacher to view details');
        } else if(ids.length > 1){
            alert('You can only view one Teacher at a Time.Select only one Teacher');
        } else {
            fetchteacher(ids)
           $('#teacherviewModal').modal('show'); 
        }
     })
    //Teacher edit modal
    $(document).on('click', '#teachereditbtn',function(e){
         e.preventDefault();
         var ids = []
         $('#teachercheckboxid:checked').each(function(i){
            ids[i] = $(this).val()
        })
        if (ids.length < 1) {
            alert('Please select a Teacher to edit');
        } else if(ids.length > 1){
            alert('You can only edit one Teacehr at a time. Select only one Teacher');
        } else {
            fetchteacher2(ids)
           $('#teachereditModal').modal('show'); 
        }
     })
         //Teacher deleting ajax
         $(document).on('click', '#teacherdelbtn',function(e){
         e.preventDefault();
         var ids = []
         $('#teachercheckboxid:checked').each(function(i){
            ids[i] = $(this).val()
        })
        
        if (ids.length < 1) {
            alert('You must select a Teacher(s) to delete')
        } else {
            var confirm = window.confirm(`Are you sure you want to delete this Teacher? You will not be able to revert this action one executed`);
        if (confirm) {
            $.ajax({
                method: 'GET',
                url: `/deleteteacher/${ids}`,
                contentType: false,
                processData: false,
                //dataType: 'json',
                success: function(res){
                    console.log(res)
                   if (res.status == 200) {
                    fetchteachers();
                    $('#regresponse').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>'+res.messages+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                   } else {
                    $('#regresponse').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>Sorry! Something went wrong.Please try again later</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');  
                   }
                    }
                }) 
            }  
        }
     })
     //Student deactivating account ajax
    $(document).on('click', '#deactivatebtn',function(e){
         e.preventDefault();
         var ids = []
         $('#teachercheckboxid:checked').each(function(i){
            ids[i] = $(this).val()
        })
        
        if (ids.length < 1) {
            alert('You must select a Teacher(s) whose account(s) is/are to be deactivated')
        } else {
            var confirm = window.confirm(`Are you sure you want to Deactivate this Teacher Account? Once you deactivate they will not be able to login`);
        if (confirm) {
            $.ajax({
                method: 'GET',
                url: `/deactivateteacher/${ids}`,
                contentType: false,
                processData: false,
                //dataType: 'json',
                success: function(res){
                    console.log(res)
                   if (res.status == 200) {
                    fetchteachers();
                    $('#regresponse').removeClass('d-none');
                    $('#regresponse').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>'+res.messages+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                   } else {
                    $('#regresponse').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>Sorry! Something went wrong.Please try again later</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');  
                   }
                    }
                }) 
            }  
        }
     })
//Teacher account activating ajax request
$(document).on('click', '#activatebtn',function(e){
         e.preventDefault();
         var ids = []
         $('#teachercheckboxid:checked').each(function(i){
            ids[i] = $(this).val()
        })
        
        if (ids.length < 1) {
            alert('You must select a Teacher(s) whose account(s) is/are to be activated')
        } else {
            var confirm = window.confirm(`Are you sure you want to activate this Teacher Account? Once you activate they will not be able to login to the System`);
        if (confirm) {
            $.ajax({
                method: 'GET',
                url: `/activateteacher/${ids}`,
                contentType: false,
                processData: false,
                //dataType: 'json',
                success: function(res){
                    console.log(res)
                   if (res.status == 200) {
                    fetchteachers();
                    $('#regresponse').removeClass('d-none');
                    $('#regresponse').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>'+res.messages+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                   } else {
                    $('#regresponse').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>Sorry! Something went wrong.Please try again later</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');  
                   }
                    }
                }) 
            }  
        }
     })

    })
</script>
@endsection
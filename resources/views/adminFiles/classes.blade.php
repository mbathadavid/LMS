@extends('layouts.layout')

@section('title','Classes')

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
<h4>Class(es)</h4>
<!----Class edit Modal start--->
<div id="classeditModal" class="modal w3-animate-left" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success">ADD EXAM MODAL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" id="classeditform">
            <input hidden type="number" name="editclassid" id="editclassid">
                <div class="form-group mb-3">
                <label for=""><h4>Class<sup class="text-danger"><b></b></sup></h4></label>
                <select name="editclass" id="editclass" class="form-control">
                    <option id="classeditval"></option>
                    <option value="FORM ONE">FORM ONE</option>
                    <option value="FORM TWO">FORM TWO</option>
                    <option value="FORM THREE">FORM THREE</option>
                    <option value="FORM FOUR">FORM FOUR</option>
                </select>
                <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label for=""><h4>Stream</h4></label>
                <input class="form-control" type="text" name="editstream" id="editstream" placeholder="Enter the stream eg. EAST or A">
                <div class="invalid-feedback"></div>
            </div>

                <div class="form-group mb-3">
                    <label for=""><h4>Number of Students</h4></label>
                <input class="form-control" type="number" name="editnostudents" id="editnostudents" placeholder="Enter the number of students">
                <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                <label for=""><h4>Class Teacher<sup class="text-danger"><b>*</b></sup></h4></label>
                <select name="editteacher" id="editteacher" class="form-control">
                <option id="editteacherval"></option>  
                </select>
                <div class="invalid-feedback"></div>
            </div>

                <div class="form-group mb-3 d-grid">
                    <input type="submit" class="btn btn-info" id="submiteditclass" value="EDIT CLASS">
                </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!----Class edit Modal start--->

<div class="row border border-3 border-info mt-2 p-3">
    <div class="col-lg-5 col-md-4 border border-success p-3">
        <button class="btn btn-sm btn-info" type="button">EXPORT TO EXCEL</button>
        <button class="btn btn-sm btn-primary" type="button">IMPORT FROM EXCEL</button>
        <h6 class="border-bottom border-success text-center border-2">Register A New Class Here</h6>
        <form action="#" method="POST" id="registerclass">
            <h6 id="classregres" class="text-success p-2 bg-info d-none"></h6>
            
        <div class="form-group mb-3">
        <label for=""><h4>Class<sup class="text-danger"><b>*</b></sup></h4></label>
        <select name="class" id="class" class="form-control">
            <option value="">--select Class--</option>
            <option value="FORM ONE">FORM ONE</option>
            <option value="FORM TWO">FORM TWO</option>
            <option value="FORM THREE">FORM THREE</option>
            <option value="FORM FOUR">FORM FOUR</option>
        </select>
        <div class="invalid-feedback"></div>
        </div>

        <div class="form-group mb-3">
            <label for=""><h4>Stream(if any)</h4></label>
        <input class="form-control" type="text" name="stream" id="stream" placeholder="Enter the stream eg. EAST or A">
        <div class="invalid-feedback"></div>
    </div>

        <div class="form-group mb-3">
            <label for=""><h4>Number of Students</h4></label>
        <input class="form-control" type="number" name="nostudents" id="nostudents" placeholder="Enter the number of students">
        <div class="invalid-feedback"></div>
        </div>

        <div class="form-group mb-3">
        <label for=""><h4>Class Teacher<sup class="text-danger"><b>*</b></sup></h4></label>
        <select name="teacher" id="teachers" class="form-control">
          <option value="">--Select Class Teacher--</option>  
        </select>
        <div class="invalid-feedback"></div>
    </div>

        <div class="form-group mb-3 d-grid">
            <input type="submit" class="btn btn-info" id="submitclass" value="ADD CLASS">
        </div>
        </form>
    </div>

    <div class="col-lg-7 col-md-8 border border-dark p-3">
        <div id="actionbtns" class="d-none">
            <a href="/students" class="btn-sm btn-warning text-decoration-none" type="button"><i class="fas fa-users"></i>&nbsp;View Students</a>
            <button id="classdeletebtn" class="btn-sm btn-danger float-end" type="button"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button>
            <button id="classeditbtn" class="btn-sm btn-info float-end" type="button"><i class="fas fa-edit"></i>&nbsp;Edit</button>
            <button id="compresultsbtn" class="btn-sm btn-primary" type="button">Add Marks</button>
        </div>

        <div class="row d-none resultscomputation">
            <form action="#" id="computeresults">
                <input type="number" name="examresid" id="examresid" hidden>
                <div class="form-group mb-1">
                    <label for="">Select Exam For Results Computation</label>
                    <select name="class" id="classtocompre" class="form-control">
                     <option value="">--Select Exam--</option>
                    </select>
                </div>
                <div class="form-group mb-1 d-grid">
                    <input value="PROCEED TO COMPUTE RESULTS" type="submit" class="btn btn-sm btn-primary"> 
                </div>
                <button id="hideresultscompbtn" class="btn btn-sm btn-danger float-end">CANCEL</button>
            </form>
            <hr>
        </div>


        <h6 class="border-bottom border-danger text-center border-2">Registered Classes</h6>
        <div class="table-responsive">
            <div id="response"></div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Select</th>
                <th scope="col">Class</th>
                <th scope="col">Students</th>
                <th scope="col">Class teacher</th>
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
</div>
@endsection 
@endif


@section('script')
<script>
    $(document).ready(function(){
        $('#classregres').addClass('d-none')
        fecthclasses()
        fetchteachers() 

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

        $("#registerclass").submit(function(e){
            e.preventDefault();
            $('#classregres').addClass('d-none')
            $("#submitclass").val('PLEASE WAIT...');
            $.ajax({
                url: '{{ route('class.register') }}',
               method: 'post',
               data: $(this).serialize(),
               dataType: 'json',
               success: function(res){
                if (res.status == 400) {
                    $("#submitclass").val('ADD CLASS');
                    showError('class', res.messages.class);
                    showError('teachers', res.messages.teacher);
                } else {
                    fecthclasses()
                    $('#registerclass')[0].reset();
                    $("#submitclass").val('ADD CLASS');
                    $('#classregres').removeClass('d-none')
                    $('#classregres').text(res.messages)
                }
               }
            })
        })
        //Edit class ajax
        $("#classeditform").submit(function(e){
            e.preventDefault();
            $('#submiteditclass').val('PLEASE WAIT...');
            var formData = new FormData($('#classeditform')[0]);
            $.ajax({
                method: 'POST',
                url: '{{ route('class.edit') }}',
                contentType: false,
               processData: false,
               data: formData,
               //dataType: 'json',
               success: function(res){
                   console.log(res)
                   if (res.status == 400) {
                    $('#submiteditclass').val('EDIT CLASS');
                    showError('editclass', res.messages.editclass);
                    showError('editstream', res.messages.editstream);
                    showError('editnostudents', res.messages.editnostudents);
                    showError('editteacher', res.messages.editteacher);
                   } else if(res.status == 200){
                    fecthclasses()
                    $('#response').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>'+res.messages+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    $('#classeditform')[0].reset();
                    $('#submiteditclass').val('EDIT CLASS');
                    $('#regresponse').text(res.messages)
                    $("#classeditModal").modal('hide');
                    $('#editteacher').html(''); 
                   }   
               }
            });
        })

        //function to fetchclasses
        function fecthclasses(){
            $.ajax({
                method: 'GET',
                url: '/fetchclasses',
                success: function(res){
                    console.log(res)
                    if (res.classes.length == 0) {
                        $('tbody').html('<h5 class="text-danger">There are no classes registered yet</h5>')
                    } else {
                        $('tbody').html('')
                        $.each(res.classes, function(key,item){
                            $('tbody').append('<tr>\
                            <td><input value="'+item.id+'" type="checkbox" name="" id="classselectbox"></td>\
                            <td>'+item.class+' '+item.stream+'</td>\
                            <td>'+item.snumber+'</td>\
                            <td>'+item.classteacher+'</td>\
                        </tr>')
                        })
                    }
                }
            });
        }
        //function to fetch Teacher
        function fetchteachers() {
            $.ajax({
                method: 'GET',
                url: '/fetchteachers',
                //dataType: 'jsons',
                success: function(res) {
                    if (res.teachers == 0) {
                        $("#teachers").html('')
                        $('#teachers').html('No Teachers registred yet')
                    } else {
                        $.each(res.teachers, function(key,item){
                            $('#teachers').append('<option value="'+item.salutation+' '+item.Fname+' '+item.Lname+'">'+item.salutation+' '+item.Fname+' '+item.Lname+'</option>')
                        })
                    }
                }

            })
        }
        //fetchteachers2
        function fetchteachers2() {
            $.ajax({
                method: 'GET',
                url: '/fetchteachers',
                //dataType: 'jsons',
                success: function(res) {
                        $.each(res.teachers, function(key,item){
                            $('#editteacher').append('<option value="'+item.salutation+' '+item.Fname+' '+item.Lname+'">'+item.salutation+' '+item.Fname+' '+item.Lname+'</option>')
                        })
                }

            })
        }

        $(document).on('change', '#classselectbox', function(e){
            e.preventDefault();
            $("#actionbtns").removeClass('d-none')
        })
            //function to fetchexams
            function exams(){
            $.ajax({
                method: 'GET',
                url: '/fetchexams',
                success: function(res){
                    console.log(res)
                    if (res.exams.length == 0) {
                        $('#classtocompre').text('Sorry!There are no classes added recently')
                    } else {
                        $('#classtocompre').html('');
                        $.each(res.exams, function(key,item){
                            $('#classtocompre').append('<option value="'+item.id+'">'+item.Examination+'</option>')
                        })
                    }
                }
            });
        }
//Navigate to compute exam results
    $("#computeresults").submit(function(e){
            e.preventDefault();
            //var classid = $('#classtocompre').val()
            var classid = $('#examresid').val()
            var examid = $('#classtocompre').val();
            window.location = `/classresults/${examid}/${classid}`;
        })

//function to fetch details of a class for update
    function fetchclass(id){
        $.ajax({
                method: 'GET',
                url: `/getclass/${id}`,
                //dataType: 'jsons',
                success: function(res) {
                    var data = res.class;
                    $("#editclassid").val(data.id)
                    $('#classeditval').val(data.class)
                    $('#classeditval').text(data.class)
                    $('#editteacherval').val(data.classteacher)
                    $('#editteacherval').text(data.classteacher)
                    $('#editstream').val(data.stream)
                    $('#editnostudents').val(data.snumber)
                }
            })
        }

    //Handle class editing
    $(document).on('click', '#classeditbtn',function(e){
         e.preventDefault();
         var ids = []
         $('#classselectbox:checked').each(function(i){
            ids[i] = $(this).val()
        })
        if (ids.length < 1) {
            alert('Please select a class to edit');
        } else if(ids.length > 1){
            alert('You can only edit one class at a time. Select only one class');
        } else {
            fetchclass(ids)
            fetchteachers2()
           $('#classeditModal').modal('show'); 
        }
     })
     //Navigate to results management page
     $(document).on('click', '#compresultsbtn',function(e){
         e.preventDefault();
         var ids = []
         $('#classselectbox:checked').each(function(i){
            ids[i] = $(this).val()
        })
        if (ids.length < 1) {
            alert('Please select a class for which results is to be computed');
        } else if(ids.length > 1){
            alert('You can only compute results of one class at a time.');
        } else {
           $('#examresid').val(ids)
           $('.resultscomputation').removeClass('d-none'); 
           exams()
        }
     })

      //Handle hiding
      $(document).on('click', '#hideresultscompbtn',function(e){
         e.preventDefault();
         $('.resultscomputation').addClass('d-none');
     })

        //Book deleting ajax
     $(document).on('click', '#classdeletebtn',function(e){
         e.preventDefault();
         var ids = []
         $('#classselectbox:checked').each(function(i){
            ids[i] = $(this).val()
        })
        
        if (ids.length < 1) {
            alert('You must select class(s) to delete')
        } else {
            var confirm = window.confirm(`Are you sure you want to delete this class? You will not be able to revert this action one executed`);
        if (confirm) {
            $.ajax({
                method: 'GET',
                url: `/deleteclass/${ids}`,
                contentType: false,
                processData: false,
                //dataType: 'json',
                success: function(res){
                    console.log(res)
                   if (res.status == 200) {
                    fecthclasses()
                    $('#response').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>'+res.messages+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                   } else {
                    $('#response').text('Sorry!Something went wrong while deleting.Please try again later');  
                   }
                    }
                }) 
            }  
        }
     })
    });
</script>
@endsection
@extends('layouts.layout')

@section('title','Subjects')

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
<div class="row p-2 border border-success border-2 mt-2 mr-3">
    <div class="col-lg-5 col-md-4 border border-info p-3">
        <form action="#" class="border border-danger p-2" id="subjectregform" method="POST">
        <div id="response"></div>
            <div class="form-group mb-3">
                <label for="">Subject</label>
                <input placeholder="Enter the subject Name" type="text" name="subject" id="subject" class="form-control">
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group mb-3">
                <label for="">Subject Category</label>
                <select name="category" id="category" class="form-control">
                    <option value="">--Select Category--</option>
                    <option value="Humanities">Humanities</option>
                    <option value="Sciences">Sciences</option>
                    <option value="Languages">Languages</option>
                    <option value="Technical">Technical</option>
                </select>
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group mb-3">
                <input id="subregbtn" type="submit" class="btn btn-success form-control" value="ADD SUBJECT">
            </div>
        </form>
    </div>

    <div class="col-lg-7 col-md-8 border border-success p-3">
    <!-- <h6 class="text-center text-success">Subjects Management</h6>
    <form action="#" method="POST">
        <div class="form-group">
            <select class="form-control" name="subjecttomanage" id="subjecttomanage">
            <option value="">--Select Subject To Manage--</option>
            </select>
        </div>
    </form> -->

    <div class="table-responsive">
        <table class="table">
            <div id="response2"></div>
        <h6 class="text-center">SUBJECTS</h6>
            <thead>
                <tr>
                    <th scope="col">SUBJECT</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody id="subjectstable">

            </tbody>
        </table>
    </div>
    <!-- <div id="actionbtns" class="pt-2 d-none">
    <button type="button" class="btn btn-sm btn-info">View Grading System</button>
    <button type="button" id="gradingsystembtn" class="btn btn-sm btn-warning float-end">Update Grading System</button>
    </div> -->
    <div>
</div>

</div>
</div>

<!-- Update Subject Modal Start -->
<div class="modal w3-animate-zoom" id="subjecteditmodal" tabindex="-1" aria-labelledby="booksaddModalLabel">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-success text-center" id="booksaddModalLabel">EDIT <span id="subtoedit"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="#" method="POST" id="subjectupdateform">
        <div class="row">
            <div class="form-group d-none">
                <input type="number" name="subid" id="subid" class="form-control">
            </div>

            <div class="form-group mb-2">
                <label>Subject</label>
                <input type="text" name="subject" id="subname" class="form-control">
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group mb-2">
                <label>Subject Category</label>
                <select class="form-control" name="category" id="subeditcat">
                 <option id="editcat"></option>
                 <option value="Humanities">Humanities</option>
                 <option value="Sciences">Sciences</option>
                 <option value="Languages">Languages</option>
                 <option value="Technical">Technical</option>
                </select>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group d-grid">
                <button type="submit" class="btn btn-sm rounded-0 w3-teal">EDIT SUBJECT <span id="subinbtn"></span></button>
            </div>

        </div>
        </form>
        </div>
        </div>
        </div>
<!-- Update Subject Modal End -->

<!-- <div id="gradesdiv" class="p-2 mt-2 border border-2 border-info d-none">
<form action="#" class="p-2" method="POST" id="GradeForm">
<h6 class="text-center text-danger p-1 bg-info d-none" id="graderegdiv"></h6>  
<div class="row">
<h6 class="text-center text-success">Grading System</h6>
    <div class="col-lg-4 col-md-3 p-2 border border-success">
    <div class="form-group mb-2 d-none">
        <label for="">SUBJECT</label>
        <input readonly value="" class="form-control" type="text" name="subject" id="subject1">
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group mb-2">
        <label for="">Class</label>
    <select name="class" id="class" class="form-control">
        <option value="">--Select Class--</option>
        <option value="FORM ONE">FORM ONE</option>
        <option value="FORM TWO">FORM TWO</option>
        <option value="FORM THREE">FORM THREE</option>
        <option value="FOUR FOUR">FOUR FOUR</option>
    </select>
    <div class="invalid-feedback"></div>
    </div>
    </div>

    <div class="col-lg-8 col-md-9 border border-danger p-2">
    <div id="gradestable" class="table-responsive">
    <table class="table">
            <thead>
            <tr>
                <th scope="col">MIN MARKS</th>
                <th scope="col">MAX MARKS</th>
                <th scope="col">POINTS</th>
                <th scope="col">GRADE</th>
                <th scope="col">REMARKS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input class="form-control" type="number" name="minA" id="minA">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="99" class="form-control" type="number" name="maxA" id="maxA">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="12" class="form-control" type="number" name="pointsA" id="pointsA">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="A" class="form-control" type="text" name="gradeA" id="gradeA">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="Excellent" class="form-control" type="text" name="RemarksA" id="RemarksA">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minA_minus" id="minA_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxA_minus" id="maxA_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="11" class="form-control" type="number" name="pointsA_minus" id="pointsA_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="A-" class="form-control" type="text" name="gradeA_minus" id="gradeA_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="Very Good" class="form-control" type="text" name="RemarksA_minus" id="RemarksA_minus">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minB_plus" id="minB_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxB_plus" id="maxB_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="10" class="form-control" type="number" name="pointsB_plus" id="pointsB_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="B+" class="form-control" type="text" name="gradeB_plus" id="gradeB_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="Good" class="form-control" type="text" name="RemarksB_plus" id="RemarksB_plus">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minB" id="minB">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxB" id="maxB">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="9" class="form-control" type="number" name="pointsB" id="pointsB">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="B" class="form-control" type="text" name="gradeB" id="gradeB">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="Fairly Good" class="form-control" type="text" name="RemarksB" id="RemarksB">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minB_minus" id="minB_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxB_minus" id="maxB_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="8" class="form-control" type="number" name="pointsB_minus" id="pointsB_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="B-" class="form-control" type="text" name="gradeB_minus" id="gradeB_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="text" name="RemarksB_minus" id="RemarksB_minus">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minC_plus" id="minC_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxC_plus" id="maxC_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="7" class="form-control" type="number" name="pointsC_plus" id="pointsC_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="C+" class="form-control" type="text" name="gradeC_plus" id="gradeC_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="text" name="RemarksC_plus" id="RemarksC_plus">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minC" id="minC">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxC" id="maxC">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="6" class="form-control" type="number" name="pointsC" id="pointsC">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="C" class="form-control" type="text" name="gradeC" id="gradeC">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="text" name="RemarksC" id="RemarksC">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minC_minus" id="minC_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxC_minus" id="maxC_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="5" class="form-control" type="number" name="pointsC_minus" id="pointsC_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="C-" class="form-control" type="text" name="gradeC_minus" id="gradeC_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="text" name="RemarksC_minus" id="RemarksC_minus">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minD_plus" id="minD_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxD_plus" id="maxD_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="4" class="form-control" type="number" name="pointsD_plus" id="pointsD_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="D+" class="form-control" type="text" name="gradeD_plus" id="gradeD_plus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="text" name="RemarksD_plus" id="RemarksD_plus">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minD" id="minD">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxD" id="maxD">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="3" class="form-control" type="number" name="pointsD" id="pointsD">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="D" class="form-control" type="text" name="gradeD" id="gradeD">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="text" name="RemarksD" id="RemarksD">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minD_minus" id="minD_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxD_minus" id="maxD_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="2" class="form-control" type="number" name="pointsD_minus" id="pointsD_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="D-" class="form-control" type="text" name="gradeD_minus" id="gradeD_minus">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="text" name="RemarksD_minus" id="RemarksD_minus">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input class="form-control" type="number" name="minE" id="minE">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input class="form-control" type="number" name="maxE" id="maxE">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="1" class="form-control" type="number" name="pointsE" id="pointsE">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="E" class="form-control" type="text" name="gradeE" id="gradeE">
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input value="Very Poor" class="form-control" type="text" name="RemarksE" id="RemarksE">
                    <div class="invalid-feedback"></div>
                </td>
            </tr>
        </tbody>
    </div>
    </div>
    </div>

    <div class="form-group d-grid">
        <input class="btn btn-info btn-sm rounded-0" type="submit" value="UPDATE GRADING SYSTEM">
    </div>
</form>
</div> -->

</div>
@endsection 
@endif


@section('script')
<script>
    $(document).ready(function(){
        //setting csrf token
        $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });


        $("#subresdiv").addClass('d-none');
        fetchSubjects()

        //select subject for managing
        $('#subjecttomanage').change(function(e){
            e.preventDefault();
            var subject = $('#subjecttomanage').val();
            $('#subject1').val(subject);
            $('#actionbtns').removeClass('d-none')
        })
        //select grading system form
        $('#gradingsystembtn').click(function(e){
            e.preventDefault();
            $('#gradesdiv').removeClass("d-none");
        })

        function fetchSubjects(){
            $.ajax({
                method: 'GET',
                url: '/fetchsubjects',
                success: function(response){
                    if (response.subjects.length == 0) {
                        $('#subjecttomanage').append('<option>No subjects Registered yet</option>')
                    } else {
                        $('#subjectstable').html('')
                        $.each(response.subjects, function(key,item){
                            $('#subjecttomanage').append('<option value="'+item.id+','+item.subject+'">'+item.subject+'</option>');
                        }) 

                        $.each(response.subjects, function(key,item){
                            //$('#subjectstable').append('<option value="'+item.id+','+item.subject+'">'+item.subject+'</option>');
                            var appenddata = '';

                            appenddata += '<tr>';
                            appenddata += '<td>'+item.subject+'</td>';
                            appenddata += '<td>'+item.category+'</td>';
                            appenddata += '<td><button id="editbtn" sid="'+item.id+'" class="btn btn-sm w3-green rounded-0"><i class="fas fa-edit"></i></button> <button id="delbtn" sid="'+item.id+'" class="btn btn-sm w3-red rounded-0"><i class="fas fa-trash"></i></button></td>';
                            appenddata += '<tr>';

                            $('#subjectstable').append(appenddata)
                        })
                    }

                    if (response.classes.length == 0) {
                        $('#class').append('<option>No any Class Registered yet</option>')
                    } else {
                        $('#class').html('')
                        $.each(response.classes, function(key,item){
                            $('#class').append('<option value="'+item.id+'">'+item.class+' '+item.stream+'</option>');
                        }) 
                        
                    }
                }
            })
        }

      $('#subjectregform').submit(function(e){
          e.preventDefault();
          $('#subregbtn').val('PLEASE WAIT...')
          var formdata = new FormData($('#subjectregform')[0]);
          $.ajax({
                method: 'POST',
                url: '{{ route('subject.register') }}',
                contentType: false,
               processData: false,
               data: formdata,
               //dataType: 'json',
               success: function(res){
                   if (res.status == 200) {
                        fetchSubjects();
                       $("#subresdiv").removeClass('d-none');
                       $('#subjectregform')[0].reset();
                       //$('#subjectregform').find('input').val('');
                       $('#response').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>'+res.messages+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div')  
                       //$('#subresdiv').text(res.messages)
                       $('#subregbtn').val('ADD SUBJECT');
                   } else if(res.status == 400){
                    showError('subject', res.messages.subject);
                    showError('category', res.messages.category);
                    $('#subregbtn').val('ADD SUBJECT');
                   }
                    else {
                       $('#subregbtn').val('ADD SUBJECT')
                       //$("#subresdiv").removeClass('d-none');
                       $('#response').html('Sorry!some error occured while registering subject.Try again Later')  
                       //$('#subresdiv').text('Sorry!some error occured while registering subject.Try again Later');
                   }  
               } 
            });
      }) 
      /*Subjects grading start*/
        $('#minA').change(function(e){
           e.preventDefault()
           var value = $(this).val();
            $('#maxA-').val(value-1)
        })
      /*Subjects grading end*/

       //Perform Deletion Operation
       $(document).on('click','#editbtn',function(e){
           e.preventDefault();
           var subval = $(this).attr('sid')
           
           $.ajax({
                method: 'GET',
                url: `/subdetails/${subval}`,
                contentType: false,
                processData: false,
               //dataType: 'json',
               success: function(res){
                console.log(res)
                $('#subid').val(res.subjectdetails.id)
                $('#subname').val(res.subjectdetails.subject)
                $('#subtoedit').text(res.subjectdetails.subject.toUpperCase())
                $('#editcat').text(res.subjectdetails.category)
                $('#editcat').text(res.subjectdetails.category)
                $('#subinbtn').text(res.subjectdetails.subject.toUpperCase())
                $('#subjecteditmodal').modal('show');
               }
           })
       })

       //Perform Subject Deleting
       $(document).on('click','#delbtn',function(e){
           e.preventDefault();
           var subval = $(this).attr('sid')
           
           var confirm = window.confirm('Are you sure you want to delete this Subject? This may alter other system outputs')
           
            if (confirm) {
                $.ajax({
                method: 'GET',
                url: `/deletesubject/${subval}`,
                contentType: false,
                processData: false,
               //dataType: 'json',
               success: function(res){
                $('#response2').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>'+res.messages+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div')  
                fetchSubjects()
               }
            })
            } else {
                
            }
       })

       //Submit Subject Update Form
       $('#subjectupdateform').submit(function(e){
          e.preventDefault();
          $('#subregbtn').val('PLEASE WAIT...')
          var formdata = new FormData($('#subjectupdateform')[0]);
          $.ajax({
                method: 'POST',
                url: '{{ route('subject.update') }}',
                contentType: false,
               processData: false,
               data: formdata,
               success: function(res){
                   if (res.status == 200) {
                        fetchSubjects();
                       //$("#subresdiv").removeClass('d-none');
                       $('#subjectupdateform')[0].reset();
                       $('#response2').html('<div class="alert alert-success alert-dismissible w3-animate-zoom show" role="alert"><strong>'+res.messages+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div')  
                       $('#subregbtn').val('ADD SUBJECT');
                       $('#subjecteditmodal').modal('hide');
                   } else if(res.status == 400){
                    showError('subname', res.messages.subject);
                    showError('subeditcat', res.messages.category);
                    $('#subregbtn').val('ADD SUBJECT');
                   }
                    else {
                       $('#subregbtn').val('ADD SUBJECT')
                       $('#response2').html('Sorry!some error occured while editing the subject.Try again Later')  
                       
                   }  
               } 
            });
      }) 

    })
</script>
@endsection
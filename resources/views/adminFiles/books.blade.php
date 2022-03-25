@extends('layouts.layout')

@section('title','Library')

@section('content')
@if($schoolinfo == null)
    <h3 class="text-center text-success">Hello {{ $adminInfo->name }} Click the Link below to update to register your institution</h3>
    <h5 class="text-center"><a href="/schoolreg" class="link-info">Register School</a></h5>
    
    @else 
<div class="container-fluid">
@include('adminFiles.motto')
<div class="main">
<div id="sidenavigation" class="sidenav w3-animate-right">
@include('adminFiles.sidebar')
</div>
<div id="main" class="maincontent">
@include('adminFiles.topnav')
<h4>Library Resource(s)</h4>
<!--Issue book modal start--->
<div id="issueBookModal" class="modal w3-animate-left" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success">Issue Book Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" id="issuebookform">
        <div class="row">
            <div class="col-lg-6 border border-2 border-success bg-warning p-2 mb-3">
               <h5 class="text-center">BOOK NUMBER: <span id="booknumber1" class="text-danger"></span></h5>
               <h5 class="text-center">SUBJECT: <span id="booksubject" class="text-danger"></span></h5>
               <h5 class="text-center">CATEGORY: <span id="bookcategory" class="text-danger"></span></h5>
               <h5 class="text-center">PUBLISHER: <span id="bookpublisher" class="text-danger"></span></h5> 
            </div>

            <div class="col-lg-6">
                <input type="text" name="bookid" id="bookid" hidden>
             <div class="form-group mb-2">
             <label for="">Date Borrowed(TODAY)</label>
             <input type="date" id="dateborrowed" name="dateborrowed" class="form-control">
             <div class="invalid-feedback"></div>
             </div>
             <div class="form-group mb-2">
             <label for="">Anticipated Return Date</label>
             <input type="date" id="returndate" name="returndate" class="form-control">
             <div class="invalid-feedback"></div>
             </div>
             <div class="form-group mb-2">
             <label for="">Delayed Return Fine Per Day</label>
             <input placeholder="Fine" id="fine" type="number" name="fine" class="form-control">
             <div class="invalid-feedback"></div>
             </div>
             <div class="form-group mb-2">
                <label for="">Issued To</label>
                <input placeholder="Admission No." class="form-control" list="admnos" name="admnos">
                <datalist id="admnos">
                    
                </datalist>
                <div class="invalid-feedback"></div>
             </div>
            </div>
            <div class="form-group d-grid">
                <input id="bookissuebtn" class="btn btn-sm btn-primary rounded-0" type="submit" value="ISSUE BOOK">
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--Issue book modal end--->

<!---Books modal--->
<div class="modal w3-animate-zoom" id="booksmodal" tabindex="-1" aria-labelledby="booksaddModalLabel">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-success text-center" id="booksaddModalLabel">ADD BOOKS</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="#" method="POST" id="bookform">
        <div class="row">
        <div class="col-lg-6">
            <div class="form-group mb-2">
             <label for="">Book Number</label>
             <input class="form-control" type="text" name="booknumber" id="booknumber">
             <div class="invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
             <label for="">Category</label>
             <select class="form-control" name="category" id="category">
                <option value="">--Select Category--</option>
                <option value="Course Book">Course Book</option>
                <option value="Revision Book">Revision Book</option>
                <option value="Set Book">Set Book</option>
                <option value="Story Book">Story Book</option>
                <option value="Dictionary">Dictionary</option>
                <option value="Kamusi">Kamusi</option>
             </select>
             <div class="invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
            <label for="">Class</label>
            <select class="form-control" name="class" id="class">
             <option value="">--Select Class--</option>
             <option value="FORM ONE">FORM ONE</option>
             <option value="FORM TWO">FORM TWO</option>
             <option value="FORM THREE">FORM THREE</option>
             <option value="FORM FOUR">FORM FOUR</option>
            </select>
            <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group mb-2">
            <label for="">Subject</label>
            <input class="form-control" type="text" name="subject" id="subject">
            <div class="invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
                <label for="">Publisher</label>
             <input class="form-control" type="text" name="publisher" id="publisher">
             <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="form-group d-grid">
         <input id="bookregbtn" class="form-control btn btn-info" type="submit" value="ADD BOOK">
        </div>
        </div>
        </div>
        </form>
        </div>
        </div>
        </div>
<!---Books modal--->

<!--Update Book Modal start-->
<div class="modal w3-animate-top" id="bookseditmodal" tabindex="-1" aria-labelledby="booksaddModalLabel">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-success text-center" id="booksaddModalLabel">EDIT BOOK</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="#" method="POST" id="bookupdateform">
        <div class="row">
        <div class="col-lg-6">
            <input type="number" name="bookid" id="bookid1" hidden>
            <div class="form-group mb-2">
             <label for="">Book Number</label>
             <input class="form-control" type="text" name="booknumber2" id="booknumber2">
             <div class="invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
             <label for="">Category</label>
             <select class="form-control" name="bookcategory1">
                <option id="bookcategory1"></option>
                <option value="Course Book">Course Book</option>
                <option value="Revision Book">Revision Book</option>
                <option value="Set Book">Set Book</option>
                <option value="Story Book">Story Book</option>
                <option value="Dictionary">Dictionary</option>
                <option value="Kamusi">Kamusi</option>
             </select>
             <div class="invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
            <label for="">Class</label>
            <select class="form-control" name="bookclass1" id="class">
             <option id="bookclass1"></option>
             <option value="FORM ONE">FORM ONE</option>
             <option value="FORM TWO">FORM TWO</option>
             <option value="FORM THREE">FORM THREE</option>
             <option value="FORM FOUR">FORM FOUR</option>
            </select>
            <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group mb-2">
            <label for="">Subject</label>
            <input class="form-control" type="text" name="booksubject1" id="booksubject1">
            <div class="invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
                <label for="">Publisher</label>
             <input class="form-control" type="text" name="bookpublisher1" id="bookpublisher1">
             <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="form-group d-grid">
         <input id="bookupdatebtn" class="form-control btn btn-info" type="submit" value="EDIT BOOK">
        </div>
        </div>
        </div>
        </form>
        </div>
        </div>
        </div>
<!--Update Book Modal start-->

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 border border-danger border-2 p-3">
        <h6 class="text-center text-danger">Library Resources Management</h6>
        <button data-bs-toggle="modal" data-bs-target="#booksmodal" type="button" class="btn btn-sm btn-danger"><i class="fas fa-plus-circle"></i>&nbsp;ADD A BOOK</button>
        <a href="/downloadbooks" type="button" class="btn-sm btn-info"><i class="fas fa-file-csv"></i>&nbsp;EXPORT TO EXCEL</a>
        <a href="/importbooks" type="button" class="btn-sm btn-primary" type="button"><i class="fas fa-file-csv"></i>&nbsp;IMPORT FROM EXCEL</a>
        <h6 id="booksregres" class="text-center mt-2 d-none p-2 bg-success"></h6>
        <div class="table-responsive">
        <div id="actionbtns" class="d-none mb-2">
        <button id="bookcollectbtn" class="btn btn-sm btn-info float-end">Collect Book</button>
        <button id="issuebooksbtn" class="btn btn-sm btn-success float-end">Issue Book</button>
        <button id="bookseditbtn" type="button" class="btn btn-sm btn-warning float-end"><i class="fas fa-edit"></i>&nbsp;Edit</button> 
        <button id="bookdeletebtn" class="btn btn-sm btn-danger float-end"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button>
         
        </div>
        <table class="table" id="table">
            <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="CheckAll"></th>
                <th scope="col">Book No.</th>
                <th scope="col">Category</th>
                <th scope="col">Class</th>
                <th scope="col">Subject</th>
                <th scope="col">Publisher</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody id="bookstable">
            @if(count($books) == 0)
            <tr>
                <td><h6 class="text-danger">There are currently no books in the database</h6></td>
            </tr>
            @else
            @foreach($books as $book)
            <tr>
                <td><input id="bookcheckbox" type="checkbox" value="{{ $book->id }}" name="id[]"></td>
                <td>{{ $book->BookNumber }}</td>
                <td>{{ $book->Category }}</td>
                <td>{{ $book->Class }}</td>
                <td>{{ $book->Subject }}</td>
                <td>{{ $book->Publisher }}</td>
                @if($book->Status === 'In Store')
                <td><button class="btn btn-sm btn-rounded btn-info">{{ $book->Status }}</button></td>
                @else
                <td><button class="btn btn-sm btn-rounded btn-success">{{ $book->Status }}</button></td>
                @endif
            </tr>
            @endforeach
            @endif
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
function preview(){
        frame.src=URL.createObjectURL(event.target.files[0]);
        }
</script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

     //function to fetch books
     function fetchbooks(){
            $.ajax({
                method: 'GET',
                url: '/fetchbooks',
                //dataType: 'jsons',
                success: function(res) {
                $('#bookstable').html('');
                  $.each(res.books,function(key,item){
                    if (item.Status == 'In Store') {
                    $('#bookstable').append('<tr>\
                    <td><input id="bookcheckbox" type="checkbox" value="'+item.id+'" name="id[]"></td>\
                    <td>'+item.BookNumber+'</td>\
                    <td>'+item.Category+'</td>\
                    <td>'+item.Class+'</td>\
                    <td>'+item.Subject+'</button></td>\
                    <td>'+item.Publisher+'</td>\
                    <td>'+item.Status+'</td>\
                    </tr>') 
                    } else {
                    $('#bookstable').append('<tr>\
                    <td><input id="bookcheckbox" type="checkbox" value="'+item.id+'" name="id[]"></td>\
                    <td>'+item.BookNumber+'</td>\
                    <td>'+item.Category+'</td>\
                    <td>'+item.Class+'</td>\
                    <td>'+item.Subject+'</button></td>\
                    <td>'+item.Publisher+'</td>\
                    <td><button class="btn btn-sm btn-success">'+item.Status+'</button></td>\
                    </tr>')   
                    }  
                  })
                }
            })
        }
     //Register Books
     $('#bookform').submit(function(e){
         $('#bookregbtn').val('PLEASE WAIT...');
         e.preventDefault();
         var formdata = new FormData($(this)[0]);
         $.ajax({
             method: 'POST',
             url: '/registerbook',
             contentType: false,
            processData: false,
            dataType: 'json',
            data: formdata,
            success: function(res) {
                if (res.status == 400) {
                $('#bookregbtn').val('ADD BOOK');
                showError('booknumber', res.messages.booknumber);
                showError('category', res.messages.category);
                showError('class', res.messages.class);
                showError('subject', res.messages.subject);
                showError('publisher', res.messages.publisher);
                } else if(res.status == 200){
                $('#bookform')[0].reset();
                $('#bookregbtn').val('ADD BOOK');
                $('#booksregres').removeClass('d-none');
                $('#booksregres').text(res.messages);
                $('#booksmodal').modal('hide');
                fetchbooks();   
                }
            }
         })
     })
     //Update book ajax request
     $('#bookupdateform').submit(function(e){
         $('#bookupdatebtn').val('PLEASE WAIT...');
         e.preventDefault();
         var formdata = new FormData($(this)[0]);
         $.ajax({
             method: 'POST',
             url: '/updatebook',
             contentType: false,
            processData: false,
            dataType: 'json',
            data: formdata,
            success: function(res) {
                if (res.status == 400) {
                $('#bookupdatebtn').val('EDIT BOOK');
                showError('booknumber2', res.messages.booknumber2);
                showError('bookcategory1', res.messages.bookcategory1);
                showError('bookclass1', res.messages.bookclass1);
                showError('booksubject1', res.messages.booksubject1);
                showError('bookpublisher1', res.messages.bookpublisher1);
                } else if(res.status == 200){
                $('#bookupdateform')[0].reset();
                $('#bookupdatebtn').val('EDIT BOOK');
                $('#booksregres').removeClass('d-none');
                $('#booksregres').text(res.messages);
                $('#bookseditmodal').modal('hide');
                fetchbooks();   
                }
            }
         })
     })

     //handle selection of books
     $(document).on('change', '#bookcheckbox',function(e){
        e.preventDefault();
        $('#actionbtns').removeClass('d-none');
     })
     //CheckAll
     $('#CheckAll').click(function(){
         if ($(this).is(':checked')) {
             $('#bookcheckbox').prop('checked',true);
         } else {
            $('#bookcheckbox').prop('checked',false);
         }
         $('#actionbtns').removeClass('d-none');
     })

    //function to fetch details on one book
    function fetchBook(id){
        $.ajax({
                method: 'GET',
                url: `/getBook/${id}`,
                //dataType: 'jsons',
                success: function(res) {
                    var data = res.bookdetails;
                    $('#bookid').val(data.id)
                    $('#booknumber1').text(data.BookNumber);
                    $('#bookcategory').text(data.Category);
                    $('#bookpublisher').text(data.Publisher);
                    $('#booksubject').text(data.Subject);
                }
            })
    }
    //function to fetch details of a book for update
    function fetchBook2(id){
        $.ajax({
                method: 'GET',
                url: `/getBook/${id}`,
                //dataType: 'jsons',
                success: function(res) {
                    var data = res.bookdetails;
                    $('#bookid1').val(data.id)
                    $('#booknumber2').val(data.BookNumber);
                    $('#bookcategory1').text(data.Category);
                    $('#bookcategory1').val(data.Category);
                    $('#bookclass1').text(data.Class);
                    $('#bookclass1').val(data.Class);
                    $('#bookpublisher1').val(data.Publisher);
                    $('#booksubject1').val(data.Subject);
                }
            })
    }

    //check book status
    function fetchBookStatus(id){
        $.ajax({
                method: 'GET',
                url: `/getBook/${id}`,
                //dataType: 'jsons',
                success: function(res) {
                    var data = res.bookdetails;
                    var status = res.bookdetails.Status;
                    if (status === "Borrowed") {
                        alert('This Book has already been issued to someone')
                    } else if(status === "In Store"){
                        $('#issueBookModal').modal('show');
                    } 
                }
            })
    }
    
    //Function to filter to fetch students
        function fetchStudents(){
            var filter = {
                'filtervalue' : 'ALL'
            }
                $.ajax({
                    method: 'POST',
                    url: '{{ route('filter.students') }}',
                    data: filter,
                    success: function(res){
                        $('#admnos').html('');
                        $.each(res.students, function(key,item){
                            $('#admnos').append('<option value="'+item.AdmissionNo+'">');
                        })
                    }
                    })
                }

     //show issue book modal
     $(document).on('click', '#issuebooksbtn',function(e){
         e.preventDefault();
         var ids = []
         $('#bookcheckbox:checked').each(function(i){
            ids[i] = $(this).val()
        })
        if (ids.length > 1) {
            alert('You can only issue one book at a time');
        } else {
       fetchBookStatus(ids);
            fetchBook(ids)
            fetchStudents()
           //$('#issueBookModal').modal('show'); 
        }
     })
     //Handle book editing
     $(document).on('click', '#bookseditbtn',function(e){
         e.preventDefault();
         var ids = []
         $('#bookcheckbox:checked').each(function(i){
            ids[i] = $(this).val()
        })
        if (ids.length < 1) {
            alert('Please select a book to edit');
        } else if(ids.length > 1){
            alert('You can only edit one book at a time. Select only one Book');
        } else {
            fetchBook2(ids)
           $('#bookseditmodal').modal('show'); 
        }
     })

     //Book collect ajax request
     $(document).on('click', '#bookcollectbtn',function(e){
         e.preventDefault();
         var ids = []
         $('#bookcheckbox:checked').each(function(i){
            ids[i] = $(this).val()
        })
        
        var confirm = window.confirm(`Are you sure the book has been returned? Make sure it is handed over to you for collection`);
        if (confirm) {
            $.ajax({
                method: 'GET',
                url: `/collectbook/${ids}`,
                contentType: false,
                processData: false,
                //dataType: 'json',
                success: function(res){
                   if (res.status == 200) {
                    fetchbooks();
                    $('#booksregres').removeClass('d-none');
                    $('#booksregres').text(res.messages);
                   } else {
                    $('#booksregres').removeClass('d-none');
                    $('#booksregres').text('Unknown Error occured while trying to return books');  
                   }
                    }
                }) 
        } else {
            
        } 
     })
     //Book deleting ajax
     $(document).on('click', '#bookdeletebtn',function(e){
         e.preventDefault();
         var ids = []
         $('#bookcheckbox:checked').each(function(i){
            ids[i] = $(this).val()
        })
        
        if (ids.length < 1) {
            alert('You must select book(s) to delete')
        } else {
            var confirm = window.confirm(`Are you sure you want to delete this book? You will not be able to revert this action one executed`);
        if (confirm) {
            $.ajax({
                method: 'GET',
                url: `/deletebook/${ids}`,
                contentType: false,
                processData: false,
                //dataType: 'json',
                success: function(res){
                    console.log(res)
                   if (res.status == 200) {
                    fetchbooks();
                    $('#booksregres').removeClass('d-none');
                    $('#booksregres').text(res.messages);
                   } else {
                    $('#booksregres').removeClass('d-none');
                    $('#booksregres').text('Sorry!Something went wrong while deleting.Please try again later');  
                   }
                    }
                }) 
            }  
        }
     })

     //Book issuing ajax request
        $('#issuebookform').submit(function(e){
         $('#bookissuebtn').val('PLEASE WAIT...');
         e.preventDefault();
         var formdata = new FormData($(this)[0]);
         $.ajax({
             method: 'POST',
             url: '/issuebook',
             contentType: false,
            processData: false,
           // dataType: 'json',
            data: formdata,
            success: function(res) {
                if (res.status == 400) {
                $('#bookissuebtn').val('ISSUE BOOK');
                showError('dateborrowed', res.messages.dateborrowed);
                showError('returndate', res.messages.returndate);
                showError('fine', res.messages.fine);
                showError('admnos', res.messages.admnos);
                } else if(res.status == 200){
                $('#bookissuebtn').val('ISSUE BOOK');
                $('#booksregres').removeClass('d-none');
                $('#booksregres').text(res.messages);
                $('#booksmodal').modal('hide');
                $('#issueBookModal').modal('hide');
                $('#issuebookform')[0].reset();
                fetchbooks();   
                }
            }
         })
     })
    
    })
</script>

@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
</head>
<body>
  <h3 id="h11"></h3>
    <div class="container">
        <div class="row">
            <div class="col md-10">
                <div class="card">
                    <div class="card-header">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="add-btn">
                        Add Comment
                    </button>

                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr id="tr_{{$data->id}}">                           
                            <th scope="row">1</th>
                            <td>{{$data->title}}</td>
                            <td>{{$data->desc}}</td>
                            <td>
                                <button class="btn btn-warning open-AddBookDialog" data-bs-toggle="modal" data-bs-target="#editModal" id="edit-btn" data-id="{{$data->id}}">Edit</button>
                                <button class="btn btn-danger"><a href="javascript:void(0)" onclick="deletePost({{$data->id}})">Delete</a></button>
                            </td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

   <script>
    function deletePost(id)
    {
      if(confirm("Are You Sure Delete This"))
      {
        console.log(id);
        $.ajaxSetup({
        header:
        {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    
        });
        $.ajax({
          url:'/delete_post/'+id,
          type:'GET',
          success:function(result){
            $("#"+result['tr']).slideUp("slow");
          }
        });
      
      }
    }
   </script>



<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
    <form  method="POST" id="form-data">
       
      <!-- Modal body -->
      <div class="modal-body">
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title">
      </div>
      <div class="modal-body">
        <label for="title">Description</label><br>
        <input type="text" name="desc" id="desc">
      </div>
      @csrf
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
   
   $(document).ready(function(){
    $('#form-data').on('submit',function(e){
        e.preventDefault();
        var data = $('#form-data').serialize();
        
        $.ajax({
            
            url:"{{url('store')}}",
            type:"Post",
            data:data, 
            dataType: "json",   
            success:function(result)
            {
              
                $("#h2").html(result);
            }
        })
        

    });
   });
    
    
</script> 

<!-- Edit Modal -->
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Modal</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
    <form  method="POST" id="update-data">
       <input type="hidden" id="id" name="id">
      <!-- Modal body -->
      <div class="modal-body">
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title1">
      </div>
      <div class="modal-body">
        <label for="title">Description</label><br>
        <input type="text" name="desc" id="desc1">
      </div>
      @csrf
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Edit Script-->
    <script>
        $(document).on("click", ".open-AddBookDialog", function () {
            var myBookId = $(this).data('id');
            // alert(myBookId);

            $.ajax({
                type: "GET",
                url: "/edit/" + myBookId,
                success: function (response) {
                   
                    $('#title1').val(response.comment.title);
                    $('#desc1').val(response.comment.desc);
                    $('#id').val(response.comment.id);       

                }
            })
        });


    </script>
<!-- Update script-->
<script>
   
   $(document).ready(function(){
    $('#update-data').on('submit',function(e){
        e.preventDefault();
        var data = $('#update-data').serialize();
        // console.log(data);
        $.ajax({
            
            url:"{{url('update')}}",
            type:"Post",
            data:data, 
            dataType: "json",   
            success:function(status)
            {
              // $("#"+status['tr']).load();
 
                $("#h11").html(status);
            }
        })
        

    });
   });
    
    
</script> 

</body>
</html>
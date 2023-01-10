<!-- 
    Aditi Chakravarthi 
    AXC200021
    CS 6314 Project
 -->
<!Doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Search Courses</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
    ul{
    margin-top: 0px;
    background: #fff;
    color: #000;
    }
    li{
    padding: 12px;
    cursor: pointer;
    color: black;
    }
    li:hover{
    background: #f0f0f0;
    }
</style>
    <body style="background-color: #ebebeb">
        <div class="container" style="margin-top: 50px;">
            <h2 class="text-center">Search for course listings</h2>
            <div class="row">
                <div class="col-md-3"></div>  
                <div class="col-md-6" style="margin-top:20px; margin-bottom:20px;">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search Courses"> 
                            <div id="search-result"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<!-- Script to make ajax request whenever any text is entererd into search box -->
<!-- Results appear in the search-result div -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#search").on("keyup", function(){
        var search = $(this).val();
        if (search !=="") {
            $.ajax({
                url:"db-course-task5.php",
                type:"POST",
                cache:false,
                data:{
                    term:search
                },
                success:function(data){
                    // console.log(data);
                    $("#search-result").html(data);
                    $("#search-result").fadeIn();
                }  
            });
        } else {
            $("#search-result").html("");  
            $("#search-result").fadeOut();
        }
    });

    $(document).on("click","li", function(){
        $('#search').val($(this).text());
        $('#search-result').fadeOut("fast");
    });
});
</script>         
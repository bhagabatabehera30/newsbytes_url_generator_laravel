<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<div class="container">
    <br/>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <form class="card card-sm" method="post">
                <br>
                <div class="col-12 text-center">
                    <div id="generateUrlMsg">
                    </div>
                    <div id="generatedUrl">
                    </div>
                </div>
                <div class="card-body row no-gutters align-items-center">

                    <!--end of col-->
                    <div class="col">
                        <input class="form-control form-control-lg form-control-borderless" name="url" id="getUrl" type="text" placeholder="Write your url" required>
                    </div>
                    <!--end of col-->
                    <div class="col-auto">
                        <button class="btn btn-lg btn-success" type="button" id="generateUrl">Generate new url</button>
                    </div>
                    <!--end of col-->
                </div>
            </form>
        </div>
        <!--end of col-->
    </div>
</div>

<script>
   $(document).ready(function() {
    $(document).on('click', '#generateUrl', function () {
        const getUrl=$('#getUrl').val();
        $.ajax({
           type:'POST',
           url:'{{ url("api/generate-hashed-url") }}',
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           dataType:'json',
           data:{url:getUrl},
           success:function(data){
            if(data.status==true){
                $('#generateUrlMsg').html('<div class="alert alert-success" role="alert">Url has been created successfully.</div>');
                $('#generatedUrl').html('<a href="' + data.generated_url +'" target="_blank" class="alert alert-info">'+ data.generated_url + ' click to open</a>');
            }else{
             if(data.error!=""){
                $('#generateUrlMsg').html('<div class="alert alert-danger" role="alert">'+ data.error +'</div>');
            }else{
               $('#generateUrlMsg').html('<div class="alert alert-warning" role="alert">'+ data.message +'</div>');
           }
       }
       console.log(data);
   }
});
    });
});
</script>
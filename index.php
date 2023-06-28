<?php
    include './controller/CardController.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Playing Card Distributor</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active reset" href="#">Reset</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div style="padding-top: 5rem">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 mt-3">
                                <label for="peopleno" class="form-label">Number Of People:</label>
                                <input type="text" class="form-control" id="peopleno" placeholder="Please Fill" id="people-no">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4 mt-5">
                <div class="card">
                        <div class="card-body">
                            <div class="mb-3 mt-3">
                                <label for="peopleno" class="form-label">Card Distribution:</label>
                                <div id="result">No Result</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            $(document).on('click', '#submit', function(){
                let peopleno = $('#peopleno').val();

                if((peopleno == '' || typeof peopleno == 'undefined') || !RegExp('^[0-9]').test(peopleno)){
                    $('.invalid-feedback').html('Input value does not exist of value is invalid').attr('style', 'color:red;display:block');
                    return false;
                }
                $('.invalid-feedback').html('').attr('style', ';display:none');

                let data = new FormData();
                data.append('people_no', peopleno);

                $.ajax({
                    type:'POST',
                    url: window.location.origin + '/controller/CardController.php' ,
                    data:data,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    context: this,
                    success: function(data) {
                        $('#result').html('').append(data);
                    },
                    error: function (e){

                    }
                });
            });

            $(document).on('click', '.reset', function(){
                $('#result').html('No Result');
                $('#peopleno').val('');
            });
        </script>
    </body>
</html>

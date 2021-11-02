<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form using Larvel 8 and AJAX</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-8 offset-md-2">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="card-title">Contact Form</h3>
                    </div>
                    <div class="card-body">
                        <form id="contact-frm" action="{{ route('contact-form.store') }}">
                            <input type="hidden" id="token" value="{{ @csrf_token() }}">
                            <div id="res" ></div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter your full name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Message</label>
                                <textarea name="msg" id="msg" class="form-control" placeholder="How can we help you?"></textarea>
                              </div>
                            
                            <button type="submit" id="btn" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg==" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $("#contact-frm").submit(function(e){
                e.preventDefault();
                let url = $(this).attr('action');
                $("#btn").attr('disabled', true);
                $.post(url, 
                {
                    '_token': $("#token").val(),
                    email: $("#email").val(),
                    name: $("#name").val(),
                    message: $("#msg").val()
                }, 
                function (response) {
                    if(response.code == 400){
                        $("#btn").attr('disabled', false);
                        let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                        $("#res").html(error);
                    }else if(response.code == 200){
                        $("#btn").attr('disabled', false);
                        let success = '<span class="alert alert-success">'+response.msg+'</span>';
                        $("#res").html(success);
                        document.getElementById("contact-frm").reset(); /*It's a good option for the UX when the contact form have success*/
                    }
                });
                
                
            })
        })
    </script>
</body>
</html>

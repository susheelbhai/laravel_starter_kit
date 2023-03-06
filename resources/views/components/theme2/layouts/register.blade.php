<div class="login-and-register-form modal">
    <div class="main-overlay"></div>
    <div class="main-register-holder">
        <div class="main-register fl-wrap">
            <div class="close-reg"><i class="fa fa-times"></i></div>
            <h3>Welcome to <span> {{ Config::get('settings')->app_name }} </span></h3>

            <div id="tabs-container">
                <ul class="tabs-menu">
                    <li class="current"><a href="#tab-1">Login</a></li>
                    <li><a href="#tab-2">Register</a></li>
                </ul>
                <div class="error_div"></div>
                <div class="tab">
                    <div id="tab-1" class="tab-contents">
                        <div class="custom-form">
                            <form method="post" id="user_login">
                                <label>Username or Email Address * </label>
                                <input name="login" type="text" onClick="this.select()" value="">
                                <label>Password * </label>
                                <input name="login_password" type="password" onClick="this.select()" value="">
                                <button type="submit" class="log-submit-btn"><span>Log In</span></button>
                                <div class="clearfix"></div>
                                <div class="filter-tags">
                                    <input id="check-a" type="checkbox" name="check">
                                    <label for="check-a">Remember me</label>
                                </div>
                            </form>
                            <div class="lost_password">
                                <a href="{{ route('partner.password.request') }}">Lost Your Password?</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab">
                        <div id="tab-2" class="tab-contents">
                            <div class="custom-form">
                                <form method="post" id="user_register" class="main-register-form"
                                    id="main-register-form2">
                                    <label>First Name * </label>
                                    <input name="name" type="text" onClick="this.select()" value="">

                                    <label>Email Address *</label>
                                    <input name="register_email" type="text" onClick="this.select()" value="">

                                    <label>Phone Number *</label>
                                    <input name="register_phone" type="text" onClick="this.select()" value="">
                                    <label>Password *</label>
                                    <input name="register_password" type="password" onClick="this.select()" value="">
                                    <button type="submit" class="log-submit-btn"><span>Register</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#user_register").submit(function(e) {
        e.preventDefault();
        var name = $("input:text[name=name]").val();
        var email = $("input:text[name=register_email]").val();
        var phone = $("input:text[name=register_phone]").val();
        var password = $("input:password[name=register_password]").val();
        $.ajax({
            type: "POST",
            url: "{{ route('partner.register') }}",
            data: {
                _token:"{{ csrf_token() }}",
                name:name,
                email:email,
                phone:phone,
                password:password,
                password_confirmation:password,
            },
            success: function (result) {
                $(".error_div").html("Registered Successfully");
                window.location.href = "{{ route('partner.dashboard') }}";
                console.log(result);
            },
            error: function (error) {
                var msg = `<span class="text-danger">`+error.responseJSON.message+`</span>`; 
                $(".error_div").html(msg);
                console.log(error.responseJSON.message);
            }
        });
        console.log(password);
    })

    $("#user_login").submit(function(e) {
        e.preventDefault();
        var email = $("input:text[name=login]").val();
        var password = $("input:password[name=login_password]").val();
        $.ajax({
            type: "POST",
            url: "{{ route('partner.login') }}",
            data: {
                _token:"{{ csrf_token() }}",
                login:email,
                password:password,
            },
            success: function (result) {
                $(".error_div").html("Login Successfully");
                window.location.href = "{{ route('partner.dashboard') }}";
                console.log(result);
            },
            error: function (error) {
                var msg = `<span class="text-danger">`+error.responseJSON.message+`</span>`; 
                $(".error_div").html(msg);
                console.log(error.responseJSON.message);
            }
        });
        console.log(password);
    })
</script>

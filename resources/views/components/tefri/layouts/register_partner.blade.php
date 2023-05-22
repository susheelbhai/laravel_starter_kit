<div class="login-and-register-form modal">
    <div class="main-overlay"></div>
    <div class="main-register-holder">
        <div class="main-register fl-wrap">
            <div class="close-reg"><i class="fa fa-times"></i></div>
            <h3>Welcome to <span>Listi<strong>Find</strong></span></h3>
            
            <div id="tabs-container">
                <ul class="tabs-menu">
                    <li class="current"><a href="storage/theme/theme2/#tab-1">Login or Register</a></li>
                </ul>
                <div class="tab">
                    <div id="tab-1" class="tab-contents">
                        <div class="custom-form">
                            <form method="post" id="partner_register" action="{{ route('partner.login') }}">
                                <label>Phone Number * </label>
                                <input name="email" type="text" onClick="this.select()" value="">
                                <label>Password * </label>
                                <input name="password" type="password" onClick="this.select()" value="">
                                <button type="submit" class="log-submit-btn"><span>Log In</span></button>
                                <div class="clearfix"></div>
                                <div class="filter-tags">
                                    <input id="check-a" type="checkbox" name="check">
                                    <label for="check-a">Remember me</label>
                                </div>
                            </form>
                            <div class="lost_password">
                                <a href="storage/theme/theme2/#">Lost Your Password?</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $("#partner_register").submit(function(e){
        e.preventDefault();
        var name = $("input:text[name=name]").val();
        var email = $("input:text[name=email]").val();
        var phone = $("input:text[name=phone]").val();
        var password = $("input:text[name=password]").val();
        $.ajax({
            type: "POST",
            url: "{{ route('partner.register') }}",
            data: {
                _token:"{{ csrf_token() }}"
                name:name,
                email:email,
                phone:phone,
                password:password,
                password_confirmation:password,
            },
            success: success,
        });
        console.log(name);
    })
</script>
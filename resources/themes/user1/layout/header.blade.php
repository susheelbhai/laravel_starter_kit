<header class="header-area">

    <div class="custom-container">
        <div class="custom-row align-items-center justify-content-between">
            <div class="header-left d-flex align-items-center">
                
                {{ $header_logo }}

                <div class="header-left-right">
                    <a href="#" class="theme-btn">Contact Us</a>
                    <span class="menu-bar">
                        <i class="las la-bars"></i>
                    </span>
                </div>
                <nav class="navbar-wrapper">
                    <span class="close-menu-bar">
                        <i class="las la-times"></i>
                    </span>
                    <ul>
                        {{ $header }}
                    </ul>
                </nav>
            </div>
            

            <div class="header-right">
                <div class="header-contact-info d-flex align-items-center">
                    <div class="phone-number">
                        <a href="tel:+917979851485">
                            Call Us 
                            <i class="iconoir-arrow-up-right"></i>
                        </a>
                        +91 7979851485
                    </div>
                    <a href="{{ route('login') }}" class="theme-btn"> Login </a>
                </div>
            </div>
        </div>
    </div>

</header>
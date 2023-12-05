<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
  <!-- Stylesheets -->
 <link rel="stylesheet" href="{{ asset('home/css/styles.css') }}" >
    <link rel="stylesheet" href="{{ asset('home/css/animation.css') }}" >
  <!-- <link rel="stylesheet" href="{{ asset('home/css/docs.theme.min.css') }}"> -->

  <!-- Owl Stylesheets -->
  <link rel="stylesheet" href="{{ asset('home/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('home/css/owl.theme.default.min.css') }}">

  <!-- Yeah i know js should not be in header. Its required for demos.-->

  <!-- javascript -->
  <script src="{{ asset('home/js/jquery.min.js') }}"></script>
  <script src="{{ asset('home/js/owl.carousel.js') }}"></script>
  <style type="text/css">

  h1{
    font-family: 'Campton Book' !important;
    text-align: center;
    color: #f64c1e;
    font-size: 18px;
    margin-bottom: 15px;
    font-weight: normal;
  }
  h1 strong{
    font-family: "Campton-Bold";
  }
  #demos p{
    font-size: 13px;
    text-align: center;
    font-weight: normal;
    color: #939393;
    margin-top: 10px;
    margin-left: auto;
    margin-right: auto;
    max-width: 242px;
    margin-bottom: 1px;
  }
  button.user-login{
    padding: 12px 36px;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    -webkit-transition: all .5s;
    -o-transition: all .5s;
    transition: all .5s;
    font-size: 12px;
    margin-left: auto;
    display: block;
    margin-right: auto;
    margin-top: 1px;
    background: #f64c1e;
    font-family: 'Campton Book' !important;
    color: white;
    width: 60%;
  }

  @media(max-width: 1024px) {
    button.user-login {
        
        width: 92%;
    }
  }

  a.login{
   padding: 9px 36px;
   -webkit-box-sizing: border-box;
   box-sizing: border-box;
   -webkit-border-radius: 10px;
   border-radius: 10px;
   -webkit-transition: all .5s;
   -o-transition: all .5s;
   transition: all .5s;
   font-size: 12px;
   margin-left: auto;
   display: block;
   margin-right: auto;
   margin-top: 0px;
   background: transparent;
   font-family: 'Campton Book' !important;
   color: #f64c1e;
   font-weight: bold;
   text-align: center;
   margin-bottom: 36px;
 }
</style>
</head>
<body class="product-column-blocks">

 <span class="qodef-grid-line-right">
      <span class="qodef-grid-line-inner" data-parallax="{&quot;y&quot;:-450, &quot;smoothness&quot;:25}" style="transform:translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scaleX(1) scaleY(1) scaleZ(1); -webkit-transform:translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scaleX(1) scaleY(1) scaleZ(1); ">

      </span>
  </span>
  <header class="global-header">
      <div class="header-inner-mobile">
         <a href="" class="logo header-logo link-image">
           <img src="home/images/LOGO-EPIC-RESULT.png">
       </a>
   </div>
   <nav class="main-navigation">
          <!-- <ul class="navigation-list">
        <li class="navigation-item">
                    <a class="navigation-link" href="#">
                        <span class="dot">Products</span>
                    </a>
                </li>
                <li class="navigation-item">
                    <a class="navigation-link" href="#">
                        <span class="dot">For Business</span>
                    </a>
                </li>
                <li class="navigation-item">
                    <a class="navigation-link" href="#">
                        <span class="dot">About Us</span>
                    </a>
                </li>
            </ul> -->

            <ul class="navigation-right">
              <li class="navigation-item">
                <a class="navigation-link link--help" href="#">
                    <span class="dot"><strong>FAQ?</strong></span>
                </a>
            </li>
            <li class="navigation-item">
                <a class="navigation-link link-image log-in login-d" @if(Auth::check()) href="{{ route('dashboard') }}" @else href="{{route('result.loginMob')}}" @endif>                  
                    @if(Auth::check())
                      <span><strong>Dashboard</span>
                    @else
                      <span><strong>LOG</strong> IN</span>
                    @endif 
                </a>
                
                <a class="navigation-link link-image log-in login-m" @if(Auth::check()) href="{{ route('dashboard') }}" @else href="{{route('result.loginMob')}}" @endif>
                    @if(Auth::check())
                      <span><strong>Dashboard</span>
                    @else
                      <span><strong>LOG</strong> IN</span>
                    @endif 
                </a>
            </li>
            <li class="navigation-item menu">
               <button class="side-menu button-circle side-menu-open">
                   <span class="line"></span>
                   <span class="line"></span>
                   <span class="line"></span>
               </button>
           </li>
       </ul>
   </nav>
</header>
  <!--  Demos -->
  <section id="demos">
    <div class="row">
      <div class="large-12 columns">
        <div class="owl-carousel owl-theme">
         <div class="item">
          
           <img src="home/images/login-slider-4.jpg">
           <h1><strong>Welcome to EPIC </strong> - RESULT!</h1>
           <p>
             Your Lifestyle Design partner, helping you create happy, healthy living, with a holistic approach.<br><br>By addressing all aspects of Health & Wellness we ensure that you are able to live a happier and healthier life, <br><br>Anytime and anywhere
           </p>
         </div>
         
         <div class="item">
           <img src="home/images/login-slider-2.jpg">
           <h1><strong>EPIC </strong> RESULT - FUEL!</h1>
           <p>
             A healthy balanced nutritional plan is very important for creating a healthy Lifestyle Design Journey.<br><br>Our simple guidance and support will make healthy eating choices easy with thousands of recipes and tips to help you along the way.
           </p>
         </div>
         <div class="item">
          <img src="home/images/login-slider-3.jpg">
          <h1><strong>EPIC </strong> RESULT - ACTIVE!</h1>
          <p>
            This is introducing simple yet effective physical activity into your daily and weekly routines.<br><br>We support you in implementing and monitoring your activity in a progressive manner.
          </p>
        </div>

        <div class="item">
          <img src="home/images/login-slider-1.jpg">
          <h1><strong>EPIC </strong> RESULT - LIFE!</h1>
          <p>
            Stress management and time management are critical to the perfect Lifestyle Design Journey and its important to address all aspects of your life related to stress.<br><br>This may include how diet, hydration, sleep and time managements may benefit you daily.
          </p>
        </div>
      </div>

<button class="user-login">NEW USER SIGN UP</button>
<br>
<a class="login" href="{{route('login')}}">LOG IN</a>


      <script>
        $(document).ready(function() {
          var owl = $('.owl-carousel');
          owl.owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true
          });
          $('.play').on('click', function() {
            owl.trigger('play.owl.autoplay', [1000])
          })
          $('.stop').on('click', function() {
            owl.trigger('stop.owl.autoplay')
          })
        })
      </script>
    </div>
  </div>
</section>

</body>
</html>
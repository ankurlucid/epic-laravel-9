<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>EPIC FIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="{{ asset('home/css/styles.css') }}" >
    <link rel="stylesheet" href="{{ asset('home/css/animation.css') }}" >
    {{-- <link rel="stylesheet" type="text/css" href="home/css/styles.css">
    <link rel="stylesheet" type="text/css" href="home/css/animation.css"> --}}
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
    rel="stylesheet" type="text/css" />



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
<main class="main">
    <div class="container content-wrapper">
        <section class="section-with-apps">
            <h3 class="title subhead-1 _fade-in _anim">Join an <span class="theme_color">EPIC</span> Brand</h3>
            <h1 class="title h2">
               <span class="_escape_up-wrapper">
                <span class="_escape_up">Your Holistic</span>
            </span>
            <span class="_escape_up-wrapper">
                <span class="_escape_up">Health & Wellness</span>
            </span>
            <span class="_escape_up-wrapper">
                <span class="_escape_up">Partner</span>
            </span>
        </h1>
    </section>
</div>
<div class="content-wrapper">

    <div class="phones">
        <div class="phones-wrapper _slide-bottom-to-top-small" data-intersection="true">
            <img src="home/images/home-main.png" width="599" height="899" class="two-phones" alt="phone">
        </div>
    </div>
    <div class="desktop-view-data ">
        <!-- Section one start -->
        <div class="desktop-overlayy epic-dashboard-desk current-feature">
            <div class="has-one-list features has-overlay desktop-overlay _anim ">

                <div class="features-inner cta">
                    <div class="wrapper">
                        <div class="section_heading">
                            <div class="index_heading">
                                <strong>EPIC</strong> FEATURES
                            </div>
                            <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                        </div>

                        <h3 class="app-feature__title title h4">
                            <strong>The <span class="theme_color">EPIC</span> dashboard is a simple navigation hub which allows you to easily access  </strong>
                            <span class="secondary-color">the most common sections within your RESULT profile.</span>
                        </h3>
                        <a href="#" class="btn link f-button">Try us today</a>
                    </div>
                </div>
                <div class="app-feature-phone p-relative">
                    <ul class="circle-container">
                      <li>10</li>
                      <li>9</li>
                      <li>8</li>
                      <li>7</li>
                      <li>6</li>
                      <li>5</li>
                      <li>4</li>
                      <li>3</li>
                      <li>2</li>                           
                      <li class="current-h">1</li>
                  </ul>
                  <figure class="inner p-relative top-31">
                    <div class="phone-frame _anim appfeature">
                        <img src="home/images/phone-app-1.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                    </div>
                </figure>
            </div>
            <div class="features-inner list p-relative">

               <div class="feature_heading">
                <div class="index_heading">
                    <strong>EPIC</strong> <br>DASHBOARD
                </div>

            </div>
            <hr width="1" size="480">
            <ul class="list-wrapper symmetric-indent _anim" data-intersection="true">
                <li class="app-feature">
                    <span class="theme_color">Easy</span> to navigate your Lifestyle Design Journey
                </li>
                <li class="app-feature">
                    <span class="theme_color">Simplistic</span> measurable information that is always at hand
                </li>
                <li class="app-feature">
                    <span class="theme_color">Safe</span> and secure access to your Lifestyle Design Profile
                </li>
                <li class="app-feature">
                    <span class="theme_color">Adjustable</span> dashboard to show as much or as little data as you want
                </li>
                <li class="app-feature">
                    <span class="theme_color">Customisable</span> user profile with personalised preferences
                </li>
            </ul>
            <a href="#" class="btn link f-button">Try us today</a>
        </div>
    </div>
</div>
<!-- Section one end -->
<!-- Section two start -->
<div class="desktop-overlayy epic-social-desk">
    <div class="has-one-list features has-overlay desktop-overlay _anim ">

        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> FEATURES
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                </div>

                <h3 class="app-feature__title title h4">
                    <strong><span class="theme_color">EPIC</span> Social is the perfect support platform where your friends and family hold </strong>
                    <span class="secondary-color">you accountable with your Lifestyle Design Journey.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone p-relative">
            <ul class="circle-container">
              <li>10</li>
              <li>9</li>
              <li>8</li>
              <li>7</li>
              <li>6</li>
              <li>5</li>
              <li>4</li>
              <li>3</li>
              <li>2</li>                           
              <li class="current-h">1</li>
          </ul>
          <figure class="inner p-relative top-31">
            <div class="phone-frame _anim appfeature">
                <img src="home/images/phone-app-social.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
            </div>
        </figure>
    </div>
    <div class="features-inner list p-relative">

       <div class="feature_heading">
        <div class="index_heading">
            <strong>EPIC</strong><br> SOCIAL
        </div>

    </div>
    <hr width="1" size="480">
    <ul class="list-wrapper symmetric-indent _anim" data-intersection="true">
     <li class="app-feature">
        <span class="theme_color">Create</span> strength in numbers and share your journey
    </li>
    <li class="app-feature">
        <span class="theme_color">Get</span> support from, and support family and friends
    </li>
    <li class="app-feature">
        <span class="theme_color">Achieve</span> better results when you have help
    </li>
    <li class="app-feature">
        <span class="theme_color">Easily</span> monitor and track your desired RESULT
    </li>
    <li class="app-feature">
        <span class="theme_color">Chat,</span> communicate and interact with likeminded individuals
    </li>
</ul>
<a href="#" class="btn link f-button">Try us today</a>
</div>
</div>
</div>
<!-- Section two end -->
<!-- Section three start -->
<div class="desktop-overlayy epic-fuel-desk">
    <div class="has-one-list features has-overlay desktop-overlay _anim ">

        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> FEATURES
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                </div>

                <h3 class="app-feature__title title h4">
                    <strong>Understanding nutrition as a fuel source and implementing simple Trace & Replace protocols </strong>
                    <span class="secondary-color">into your daily life, ensuring you are happier, and healthier.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone p-relative">
            <ul class="circle-container">
              <li>10</li>
              <li>9</li>
              <li>8</li>
              <li>7</li>
              <li>6</li>
              <li>5</li>
              <li>4</li>
              <li>3</li>
              <li>2</li>                           
              <li class="current-h">1</li>
          </ul>
          <figure class="inner p-relative top-31">
            <div class="phone-frame _anim appfeature">
                <img src="home/images/phone-app-4.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
            </div>
        </figure>
    </div>
    <div class="features-inner list p-relative">

       <div class="feature_heading">
        <div class="index_heading">
            <strong>EPIC</strong><br> FUEL
        </div>

    </div>
    <hr width="1" size="480">
    <ul class="list-wrapper symmetric-indent _anim" data-intersection="true">
      <li class="app-feature">
        <span class="theme_color">Trace</span> and replace unhealthy habits
    </li>
    <li class="app-feature">
        <span class="theme_color">Introduce</span> meal preparation into your routine
    </li>
    <li class="app-feature">
        <span class="theme_color">Understand</span> calories and portion distortion
    </li>
    <li class="app-feature">
        <span class="theme_color">Implement</span> a simple meal plan into your life 
    </li>
    <li class="app-feature">
        <span class="theme_color">Track</span> and monitor your daily, weekly, and monthly calorie intake
    </li>
</ul>
<a href="#" class="btn link f-button">Try us today</a>
</div>
</div>
</div>
<!-- Section three end -->

<!-- Section fourstart -->
<div class="desktop-overlayy epic-posture-desk">
    <div class="has-one-list features has-overlay desktop-overlay _anim ">

        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> FEATURES
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                </div>

                <h3 class="app-feature__title title h4">
                    <strong>This is a useful tool to ensure we limit injuries and discomfort due to incorrect posture</strong>
                    <span class="secondary-color">caused by muscle imbalance or structural misalignments?</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone p-relative">
            <ul class="circle-container">
              <li>10</li>
              <li>9</li>
              <li>8</li>
              <li>7</li>
              <li>6</li>
              <li>5</li>
              <li>4</li>
              <li>3</li>
              <li>2</li>                           
              <li class="current-h">1</li>
          </ul>
          <figure class="inner p-relative top-31">
            <div class="phone-frame _anim appfeature">
                <img src="home/images/phone-app-posture.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
            </div>
        </figure>
    </div>
    <div class="features-inner list p-relative">

       <div class="feature_heading">
        <div class="index_heading">
            <strong>EPIC</strong><br> POSTURE PLUS
        </div>

    </div>
    <hr width="1" size="480">
    <ul class="list-wrapper symmetric-indent _anim" data-intersection="true">
       <li class="app-feature">
        <span class="theme_color">Record</span> imbalances and have a record of your current posture
    </li>
    <li class="app-feature">
        <span class="theme_color">Address</span> the root cause and create a program
    </li>
    <li class="app-feature">
        <span class="theme_color">Set</span> reasonable goal and commence with your program
    </li>
    <li class="app-feature">
        <span class="theme_color">Follow</span> the plan and monitor your progress over time
    </li>
    <li class="app-feature">
        <span class="theme_color">Monitor</span> and re-adjust your plan where required
    </li>
</ul>
<a href="#" class="btn link f-button">Try us today</a>
</div>
</div>
</div>
<!-- Section four end -->
<!-- Section five start -->
<div class="desktop-overlayy epic-active-desk">
    <div class="has-one-list features has-overlay desktop-overlay _anim ">

        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> FEATURES
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                </div>

                <h3 class="app-feature__title title h4">
                    <strong>Movement matters, first we get you to move right, then we get you to move often. We incorporate full body</strong>
                    <span class="secondary-color">training and cater for both resistance and cardiovascular endurance.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone p-relative">
            <ul class="circle-container">
              <li>10</li>
              <li>9</li>
              <li>8</li>
              <li>7</li>
              <li>6</li>
              <li>5</li>
              <li>4</li>
              <li>3</li>
              <li>2</li>                           
              <li class="current-h">1</li>
          </ul>
          <figure class="inner p-relative top-31">
            <div class="phone-frame _anim appfeature">
                <img src="home/images/phone-app-active.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
            </div>
        </figure>
    </div>
    <div class="features-inner list p-relative">

       <div class="feature_heading">
        <div class="index_heading">
            <strong>EPIC</strong><br> ACTIVE
        </div>

    </div>
    <hr width="1" size="480">
    <ul class="list-wrapper symmetric-indent _anim" data-intersection="true">
        <li class="app-feature">
            <span class="theme_color">Strength</span> in number encouraging you to get a support network
        </li>
        <li class="app-feature">
            <span class="theme_color">Structuring</span> resistance training plan with exercise library
        </li>
        <li class="app-feature">
            <span class="theme_color">Fitness</span> mapper addressing cardiovascular requirements
        </li>
        <li class="app-feature">
            <span class="theme_color">Monitoring</span> progression sessions related to your journey
        </li>
        <li class="app-feature">
            <span class="theme_color">Implementing</span> stretching and mobility into your program
        </li>
    </ul>
    <a href="#" class="btn link f-button">Try us today</a>
</div>
</div>
</div>
<!-- Section five end -->
<!-- Section six start -->
<div class="desktop-overlayy epic-analysys-desk">
    <div class="has-one-list features has-overlay desktop-overlay _anim ">

        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> FEATURES
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                </div>

                <h3 class="app-feature__title title h4">
                    <strong>Knowing yourself is important; it is critical that you have a base level to work from and with </strong>
                    <span class="secondary-color">EPIC Body Analysis you get the perfect benchmark information.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone p-relative">
            <ul class="circle-container">
              <li>10</li>
              <li>9</li>
              <li>8</li>
              <li>7</li>
              <li>6</li>
              <li>5</li>
              <li>4</li>
              <li>3</li>
              <li>2</li>                           
              <li class="current-h">1</li>
          </ul>
          <figure class="inner p-relative top-31">
            <div class="phone-frame _anim appfeature">
                <img src="home/images/phone-app-body-analysis.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
            </div>
        </figure>
    </div>
    <div class="features-inner list p-relative">

       <div class="feature_heading">
        <div class="index_heading">
            <strong>EPIC</strong><br> BODY ANALYSIS
        </div>

    </div>
    <hr width="1" size="480">
    <ul class="list-wrapper symmetric-indent _anim" data-intersection="true">
        <li class="app-feature">
            <span class="theme_color">Have</span> an accurate base to start from
        </li>
        <li class="app-feature">
            <span class="theme_color">Monitor</span> and track real statistics not just weight
        </li>
        <li class="app-feature">
            <span class="theme_color">Limit </span> injuries and imbalances
        </li>
        <li class="app-feature">
            <span class="theme_color">Ensure</span> you stay healthy and within your health parameters
        </li>
        <li class="app-feature">
            <span class="theme_color">Assess</span> lean muscle and fat loss
        </li>
    </ul>
    <a href="#" class="btn link f-button">Try us today</a>
</div>
</div>
</div>
<!-- Section six end -->
<!-- Section seven start -->
<div class="desktop-overlayy epic-smarter-desk">
    <div class="has-one-list features has-overlay desktop-overlay _anim ">

        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> FEATURES
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                </div>

                <h3 class="app-feature__title title h4">
                    <strong>Goal setting is critical to ensure that you achieve your desired RESULT. <span class="theme_color">EPIC</span> BE SMARTER</strong>

                    <span class="secondary-color">is a systematic process that allows for perfect goal setting.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone p-relative">
            <ul class="circle-container">
              <li>10</li>
              <li>9</li>
              <li>8</li>
              <li>7</li>
              <li>6</li>
              <li>5</li>
              <li>4</li>
              <li>3</li>
              <li>2</li>                           
              <li class="current-h">1</li>
          </ul>
          <figure class="inner p-relative top-31">
            <div class="phone-frame _anim appfeature">
                <img src="home/images/phone-app-be-smarter.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
            </div>
        </figure>
    </div>
    <div class="features-inner list p-relative">

       <div class="feature_heading">
        <div class="index_heading">
            <strong>EPIC</strong><br> BE SMARTER
        </div>

    </div>
    <hr width="1" size="480">
    <ul class="list-wrapper symmetric-indent _anim" data-intersection="true">
        <li class="app-feature">
            <span class="theme_color">Gain</span> relevant information related to all aspects of your life
        </li>
        <li class="app-feature">
            <span class="theme_color">Take</span> all aspects of your existing lifestyle into account
        </li>
        <li class="app-feature">
            <span class="theme_color">Find</span> barriers and address them
        </li>
        <li class="app-feature">
            <span class="theme_color">Set</span> achievable milestones creating a clear path
        </li>
        <li class="app-feature">
            <span class="theme_color">Ensure</span> you share your Goal and follow through
        </li>
    </ul>
    <a href="#" class="btn link f-button">Try us today</a>
</div>
</div>
</div>
<!-- Section seven end -->
<!-- Section eight start -->
<div class="desktop-overlayy epic-daily-desk">
    <div class="has-one-list features has-overlay desktop-overlay _anim ">

        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> FEATURES
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                </div>

                <h3 class="app-feature__title title h4">
                    <strong>Diarise and prioritise your life and monitor all aspects of your Health </strong>
                    <span class="secondary-color">& Wellness daily in a simple to use wellness hub.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone p-relative">
            <ul class="circle-container">
              <li>10</li>
              <li>9</li>
              <li>8</li>
              <li>7</li>
              <li>6</li>
              <li>5</li>
              <li>4</li>
              <li>3</li>
              <li>2</li>                           
              <li class="current-h">1</li>
          </ul>
          <figure class="inner p-relative top-31">
            <div class="phone-frame _anim appfeature">
                <img src="home/images/phone-app-daily-diary.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
            </div>
        </figure>
    </div>
    <div class="features-inner list p-relative">

       <div class="feature_heading">
        <div class="index_heading">
            <strong>EPIC</strong><br> DAILY DIARY
        </div>

    </div>
    <hr width="1" size="480">
    <ul class="list-wrapper symmetric-indent _anim" data-intersection="true">
     <li class="app-feature">
        <span class="theme_color">Stay</span> accountable by recording your information daily
    </li>
    <li class="app-feature">
        <span class="theme_color">Know </span> your path and achieve your milestones
    </li>
    <li class="app-feature">
        <span class="theme_color">Implement</span> simple habits into your daily life
    </li>
    <li class="app-feature">
        <span class="theme_color">Apply</span> and track your daily tasks to ensure that you achieve your desired RESULT
    </li>
    <li class="app-feature">
        <span class="theme_color">Share</span> your achievements online and celebrate your success and motivate others
    </li>
</ul>
<a href="#" class="btn link f-button">Try us today</a>
</div>
</div>
</div>
<!-- Section eight end -->
<!-- Section nine start -->
<div class="desktop-overlayy epic-explore-desk">
    <div class="has-one-list features has-overlay desktop-overlay _anim ">

        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> FEATURES
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                </div>

                <h3 class="app-feature__title title h4">
                    <strong>Get out and try new routes, challenge your friends or yourself on the same route.</strong>
                    <span class="secondary-color">Map your run, walk, bike, swim, kayak, or paddle board. Explore the world.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone p-relative">
            <ul class="circle-container">
              <li>10</li>
              <li>9</li>
              <li>8</li>
              <li>7</li>
              <li>6</li>
              <li>5</li>
              <li>4</li>
              <li>3</li>
              <li>2</li>                           
              <li class="current-h">1</li>
          </ul>
          <figure class="inner p-relative top-31">
            <div class="phone-frame _anim appfeature">
                <img src="home/images/phone-app-4.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
            </div>
        </figure>
    </div>
    <div class="features-inner list p-relative">

       <div class="feature_heading">
        <div class="index_heading">
            <strong>EPIC</strong><br> EXPLORE
        </div>

    </div>
    <hr width="1" size="480">
    <ul class="list-wrapper symmetric-indent _anim" data-intersection="true">
        <li class="app-feature">
            <span class="theme_color">Map</span>and motivate yourself and friends to get outdoors
        </li>
        <li class="app-feature">
            <span class="theme_color">Challenge</span> friends or get challenged on local routes
        </li>
        <li class="app-feature">
            <span class="theme_color">Track</span> and record most outdoor activities on one platform
        </li>
        <li class="app-feature">
            <span class="theme_color">Save</span> and continue monitoring progress over the same routes
        </li>
        <li class="app-feature">
            <span class="theme_color">Share</span> routes with friends and family
        </li>
    </ul>
    <a href="#" class="btn link f-button">Try us today</a>
</div>
</div>
</div>

<!-- Section nine end -->
<!-- Section ten start -->
<div class="desktop-overlayy epic-lifestyle-desk">
    <div class="has-one-list features has-overlay desktop-overlay _anim ">

        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> FEATURES
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                </div>

                <h3 class="app-feature__title title h4">
                    <strong>A holistic approach to Health &amp; wellness where we address all aspects </strong>
                    <span class="secondary-color">in a progressive way making small changes often.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone p-relative">
            <ul class="circle-container">
              <li>10</li>
              <li>9</li>
              <li>8</li>
              <li>7</li>
              <li>6</li>
              <li>5</li>
              <li>4</li>
              <li>3</li>
              <li>2</li>                           
              <li class="current-h">1</li>
          </ul>
          <figure class="inner p-relative top-31">
            <div class="phone-frame _anim appfeature">
                <img src="home/images/phone-app-4.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
            </div>
        </figure>
    </div>
    <div class="features-inner list p-relative">

       <div class="feature_heading">
        <div class="index_heading">
            <strong>EPIC</strong><br> LIFESTYLE DESIGN
        </div>

    </div>
    <hr width="1" size="480">
    <ul class="list-wrapper symmetric-indent _anim" data-intersection="true">
        <li class="app-feature">
            <span class="theme_color">Holistic</span> approach to your Lifestyle
        </li>
        <li class="app-feature">
            <span class="theme_color">Addressing</span> critical path items and focus points
        </li>
        <li class="app-feature">
            <span class="theme_color">Managing</span> stress and implementing time management
        </li>
        <li class="app-feature">
            <span class="theme_color">Implementing</span> healthy sleep habits and Recovery Routines
        </li>
        <li class="app-feature">
            <span class="theme_color">Making</span> the change to become a happier and healthier person
        </li>
    </ul>
    <a href="#" class="btn link f-button">Try us today</a>
</div>
</div>
</div>
<!-- Section ten end -->
</div>

<div class="sticky-content-wrapper mobile-view-data">

<!--     <div class="features sticky-wrap">
        <div class="app-feature-phone _slide-bottom-to-top-small _anim sticky">
            <figure class="inner">
                <div class="phone-frame">
                    <img src="home/images/phone-app-1.png" width="400" height="800" class="phone-screen has-frame fade-in current imgDashboard" alt="phone">
                    <img src="home/images/phone-app-social.png" width="315" height="682" class="phone-screen has-frame imgSocial" alt="phone">

                    <img src="home/images/phone-app-4.png" width="315" height="682" class="phone-screen has-frame imgFuel" alt="phone">
                    <img src="home/images/phone-app-posture.png" width="315" height="682" class="phone-screen has-frame imgPosture" alt="phone">
                    <img src="home/images/phone-app-active.png" width="400" height="800" class="phone-screen has-frame imgactive" alt="phone">
                    <img src="home/images/phone-app-body-analysis.png" width="400" height="800" class="phone-screen has-frame imgBody" alt="phone">
                    <img src="home/images/phone-app-be-smarter.png" width="315" height="682" class="phone-screen has-frame imgbesmarter" alt="phone">
                    <img src="home/images/phone-app-daily-diary.png" width="315" height="682" class="phone-screen has-frame imgdailydiary" alt="phone">
              

                </div>
            </figure>
        </div>
    </div> -->
    <!-- plan-sticky-container start -->
    <div class="plan-sticky-container">
        <!-- Section one start -->
        <div class="features has-two-list app-features-bg has-overlay _anim" style="padding-bottom: 52px;padding-top: 144px;">
            <div class="features-inner list">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> FEATURES
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> FEATURES</span>
                </div>
                <div class="feature_heading feature_change_heading">
                <div class="index_heading current-feature-mob"  id="EPICDashboard">
                    <strong>EPIC</strong> <br>DASHBOARD
                </div>
                <div class="index_heading"  id="EPICSocial">
                    <strong>EPIC</strong> <br>Social
                </div>
                <div class="index_heading"  id="EPICFuel">
                    <strong>EPIC</strong> <br>FUEL
                </div>
                <div class="index_heading"  id="EPICPosture">
                    <strong>EPIC</strong> <br>Posture Plus
                </div>
                <div class="index_heading"  id="EPICActive">
                    <strong>EPIC</strong> <br>Active
                </div>
                <div class="index_heading"  id="EPICBody">
                    <strong>EPIC</strong> <br>Body Analysis
                </div>
                <div class="index_heading"  id="EPICSmarter">
                    <strong>EPIC</strong> <br>Be Smarter
                </div>
                <div class="index_heading"  id="EPICDaily">
                    <strong>EPIC</strong> <br>Daily Diary
                </div>
                <div class="index_heading"  id="EPICExplore">
                    <strong>EPIC</strong> <br>Explore
                </div>
                <div class="index_heading"  id="EPICLifestyle">
                    <strong>EPIC</strong> <br>Lifestyle Design
                </div>

            </div>
                <ul class="list-wrapper _anim list-wrapper-mob" style="margin-top: 32px;">
                  <!--   <li class="app-feature">
                        <div class="app-feature__content" id="EPICSocial">
                            <div class="title subhead-2"><span class="theme_color">EPIC</span> Social</div>
                            <div class="f-caption-2">Fitness Mapper</div>
                        </div>
                    </li>
                    <li class="app-feature">
                        <div class="app-feature__content" id="EPICPosture">
                            <div class="title subhead-2"><span class="theme_color">EPIC</span> Posture Plus</div>
                            <div class="f-caption-1">Fitness Mapper</div>
                        </div>
                    </li>
                    <li class="app-feature">
                        <div class="app-feature__content" id="EPICBody">
                            <div class="title subhead-2"><span class="theme_color">EPIC</span> Body Analysis</div>
                            <div class="f-caption-2">Fitness Mapper</div>
                        </div>
                    </li>
                    <li class="app-feature">
                        <div class="app-feature__content" id="EPICDaily">
                            <div class="title subhead-2"><span class="theme_color">EPIC</span> Daily Diary</div>
                            <div class="f-caption-1">Fitness Mapper</div>
                        </div>
                    </li>
                    <li class="app-feature">
                        <div class="app-feature__content" id="EPICLifestyle">
                            <div class="title subhead-2"><span class="theme_color">EPIC</span> Lifestyle Design</div>
                            <div class="f-caption-2">Fitness Mapper</div>
                        </div>
                    </li>
                    <li class="app-feature current-feature-mob">
                        <div class="app-feature__content current" id="EPICDashboard">
                            <div class="title subhead-2"><span class="theme_color">EPIC</span> Dashboard</div>
                            <div class="f-caption-2">Fitness Mapper</div>
                        </div>
                    </li>
                    <li class="app-feature">
                        <div class="app-feature__content" id="EPICFuel">
                            <div class="title subhead-2"><span class="theme_color">EPIC</span> Fuel</div>
                            <div class="f-caption-1">Fitness Mapper</div>
                        </div>
                    </li>
                    <li class="app-feature">
                        <div class="app-feature__content" id="EPICActive">
                            <div class="title subhead-2"><span class="theme_color">EPIC</span> Active</div>
                            <div class="f-caption-2">Fitness Mapper</div>
                        </div>
                    </li>
                    <li class="app-feature">
                        <div class="app-feature__content" id="EPICSmarter">
                            <div class="title subhead-2"><span class="theme_color">EPIC</span> Be Smarter</div>
                            <div class="f-caption-1">Fitness Mapper</div>
                        </div>
                    </li>
                    <li class="app-feature ">
                        <div class="app-feature__content" id="EPICExplore">
                            <div class="title subhead-2"><span class="theme_color">EPIC</span> Explore</div>
                            <div class="f-caption-2">Fitness Mapper</div>
                        </div>
                    </li> -->
                </ul>
            </div>
            <div class="app-feature-phone" >
                <ul class="mobile-circle crcl-container circle-container">
                  <li>10</li>
                  <li>9</li>
                  <li>8</li>
                  <li>7</li>
                  <li>6</li>
                  <li>5</li>
                  <li>4</li>
                  <li>3</li>
                  <li>2</li>                           
                  <li class="current-h">1</li>
              </ul>
              <figure class="inner">
                <div class="phone-frame _anim appfeature">
                    <img src="home/images/phone-app-1.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                </div>
            </figure>
        </div>
        <div class="features-inner list">
            <ul class="list-wrapper _anim">

            </ul>
        </div>
    </div>
    <!-- Section one end -->
    <!-- Dashboard Section start -->
    <div class="has-one-list personal-plan sticky-container">
        <div class="features">
            <div class="features-inner cta">
                <div class="wrapper">
                    <div class="section_heading">
                        <div class="index_heading">
                            <strong>EPIC</strong> Dashboard
                        </div>
                        <span class="title subhead-1"><strong>EPIC</strong> Dashboard</span>
                    </div>
                    <h3 class="app-feature__title title h4">
                        <strong>The <span class="theme_color">EPIC</span> dashboard is a simple navigation hub which allows you to easily access  </strong>
                        <span class="secondary-color">the most common sections within your RESULT profile.</span>
                    </h3>
                    <a href="#" class="btn link f-button">
                        Try us today
                    </a>
                </div>
            </div>
            <div class="app-feature-phone">
                <figure class="inner">
                    <div class="phone-frame">
                        <img src="home/images/phone-app-1.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                    </div>
                </figure>
            </div>
            <div class="features-inner list">
                <ul class="list-wrapper symmetric-indent ">
                    <li class="app-feature">
                        <span class="theme_color">Easy</span> to navigate your Lifestyle Design Journey
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Simplistic</span> measurable information that is always at hand
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Safe</span> and secure access to your Lifestyle Design Profile
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Adjustable</span> dashboard to show as much or as little data as you want
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Customisable</span> user profile with personalised preferences
                    </li>
                </ul>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
    </div>
    <!-- Dashboard Section end -->

</div>
<!-- plan-sticky-container end -->
<!-- Social Section start -->
<div class="has-one-list workouts sticky-container app-features-bg">
    <div class="features reverse_section">
        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> Social
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> Social</span>
                </div>
                <h3 class="app-feature__title title h4">
                    <strong><span class="theme_color">EPIC</span> Social is the perfect support platform where your friends and family hold </strong>
                    <span class="secondary-color">you accountable with your Lifestyle Design Journey.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>                        
        <div class="app-feature-phone">
            <figure class="inner">
                <div class="phone-frame">
                    <img src="home/images/phone-app-social.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                </div>
            </figure>
        </div>
        <div class="features-inner list">
            <ul class="list-wrapper symmetric-indent ">
                <li class="app-feature">
                    <span class="theme_color">Create</span> strength in numbers and share your journey
                </li>
                <li class="app-feature">
                    <span class="theme_color">Get</span> support from, and support family and friends
                </li>
                <li class="app-feature">
                    <span class="theme_color">Achieve</span> better results when you have help
                </li>
                <li class="app-feature">
                    <span class="theme_color">Easily</span> monitor and track your desired RESULT
                </li>
                <li class="app-feature">
                    <span class="theme_color">Chat,</span> communicate and interact with likeminded individuals
                </li>
            </ul>
            <a href="#" class="btn link f-button">Try us today</a>
        </div>
    </div>                
</div>
<!-- Social Section end -->
<!-- Fuel Section start -->
<div class="has-one-list nutrition sticky-container">
    <div class="features">
        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> Fuel
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> Fuel</span>
                </div>
                <h3 class="app-feature__title title h4">
                    <strong>Understanding nutrition as a fuel source and implementing simple Trace & Replace protocols </strong>
                    <span class="secondary-color">into your daily life, ensuring you are happier, and healthier.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone">
            <figure class="inner">
                <div class="phone-frame">
                    <img src="home/images/phone-app-4.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                </div>
            </figure>
        </div>
        <div class="features-inner list">
            <ul class="list-wrapper symmetric-indent ">
                <li class="app-feature">
                    <span class="theme_color">Trace</span> and replace unhealthy habits
                </li>
                <li class="app-feature">
                    <span class="theme_color">Introduce</span> meal preparation into your routine
                </li>
                <li class="app-feature">
                    <span class="theme_color">Understand</span> calories and portion distortion
                </li>
                <li class="app-feature">
                    <span class="theme_color">Implement</span> a simple meal plan into your life 
                </li>
                <li class="app-feature">
                    <span class="theme_color">Track</span> and monitor your daily, weekly, and monthly calorie intake
                </li>
            </ul>
            <a href="#" class="btn link f-button">Try us today</a>
        </div>
    </div>               
</div>
<!-- Fuel Section end -->
<!-- Posture Plus Section start -->
<div class="has-one-list challenges sticky-container app-features-bg">
    <div class="features reverse_section">
        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> Posture Plus
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> Posture Plus</span>
                </div>
                <h3 class="app-feature__title title h4">
                    <strong>This is a useful tool to ensure we limit injuries and discomfort due to incorrect posture</strong>
                    <span class="secondary-color">caused by muscle imbalance or structural misalignments?</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>                        
        <div class="app-feature-phone">
            <figure class="inner">
                <div class="phone-frame">
                    <img src="home/images/phone-app-posture.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                </div>
            </figure>
        </div>
        <div class="features-inner list">
            <ul class="list-wrapper symmetric-indent ">
                <li class="app-feature">
                    <span class="theme_color">Record</span> imbalances and have a record of your current posture
                </li>
                <li class="app-feature">
                    <span class="theme_color">Address</span> the root cause and create a program
                </li>
                <li class="app-feature">
                    <span class="theme_color">Set</span> reasonable goal and commence with your program
                </li>
                <li class="app-feature">
                    <span class="theme_color">Follow</span> the plan and monitor your progress over time
                </li>
                <li class="app-feature">
                    <span class="theme_color">Monitor</span> and re-adjust your plan where required
                </li>
            </ul>
            <a href="#" class="btn link f-button">Try us today</a>
        </div>
    </div>               
</div>
<!-- Posture Plus Section end -->
<!-- EPIC ACTIVE Section start -->
<div class="has-one-list personal-statistics sticky-container">
    <div class="features">
        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> Active
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> Active</span>
                </div>
                <h3 class="app-feature__title title h4">
                    <strong>Movement matters, first we get you to move right, then we get you to move often. We incorporate full body</strong>
                    <span class="secondary-color">training and cater for both resistance and cardiovascular endurance.</span>
                </h3>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>
        <div class="app-feature-phone">
            <figure class="inner">
                <div class="phone-frame">
                    <img src="home/images/phone-app-active.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                </div>
            </figure>
        </div>
        <div class="features-inner list">
            <ul class="list-wrapper symmetric-indent ">
             <li class="app-feature">
                <span class="theme_color">Strength</span> in number encouraging you to get a support network
            </li>
            <li class="app-feature">
                <span class="theme_color">Structuring</span> resistance training plan with exercise library
            </li>
            <li class="app-feature">
                <span class="theme_color">Fitness</span> mapper addressing cardiovascular requirements
            </li>
            <li class="app-feature">
                <span class="theme_color">Monitoring</span> progression sessions related to your journey
            </li>
            <li class="app-feature">
                <span class="theme_color">Implementing</span> stretching and mobility into your program
            </li>
        </ul>
        <a href="#" class="btn link f-button">Try us today</a>
    </div>
</div>                 
</div>
<!-- EPIC ACTIVE Section end -->
<!-- Epic BODY ANALYSYS Section start -->
<div class="has-one-list body-analysyss sticky-container app-features-bg">
    <div class="features reverse_section">
        <div class="features-inner cta">
            <div class="wrapper">
                <div class="section_heading">
                    <div class="index_heading">
                        <strong>EPIC</strong> BODY ANALYSIS
                    </div>
                    <span class="title subhead-1"><strong>EPIC</strong> Body Analysis                    </div>
                        <h3 class="app-feature__title title h4">
                            <strong>Knowing yourself is important; it is critical that you have a base level to work from and with </strong>
                            <span class="secondary-color">EPIC Body Analysis you get the perfect benchmark information.</span>
                        </h3>
                        <a href="#" class="btn link f-button">Try us today</a>
                    </div>
                </div>                        
                <div class="app-feature-phone">
                    <figure class="inner">
                        <div class="phone-frame">
                            <img src="home/images/phone-app-body-analysis.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                        </div>
                    </figure>
                </div>
                <div class="features-inner list">

                    <ul class="list-wrapper symmetric-indent ">
                        <li class="app-feature">
                            <span class="theme_color">Have</span> an accurate base to start from
                        </li>
                        <li class="app-feature">
                            <span class="theme_color">Monitor</span> and track real statistics not just weight
                        </li>
                        <li class="app-feature">
                            <span class="theme_color">Limit </span> injuries and imbalances
                        </li>
                        <li class="app-feature">
                            <span class="theme_color">Ensure</span> you stay healthy and within your health parameters
                        </li>
                        <li class="app-feature">
                            <span class="theme_color">Assess</span> lean muscle and fat loss
                        </li>
                    </ul>
                    <a href="#" class="btn link f-button">Try us today</a>
                </div>
            </div>                
        </div>
        <!-- Epic BODY ANALYSYS Section end -->
        <!-- Epic BE SMARTER Section start -->
        <div class="has-one-list smarterr sticky-container">
            <div class="features">
                <div class="features-inner cta">
                    <div class="wrapper">
                        <div class="section_heading">
                            <div class="index_heading">
                                <strong>EPIC</strong> BE SMARTER
                            </div>
                            <span class="title subhead-1"><strong>EPIC</strong> Be Smarter</span>
                        </div>
                        <h3 class="app-feature__title title h4">
                            <strong>Goal setting is critical to ensure that you achieve your desired RESULT. <span class="theme_color">EPIC</span> BE SMARTER</strong>

                            <span class="secondary-color">is a systematic process that allows for perfect goal setting.</span>
                        </h3>
                        <a href="#" class="btn link f-button">Try us today</a>
                    </div>
                </div>
                <div class="app-feature-phone">
                    <figure class="inner">
                        <div class="phone-frame">
                            <img src="home/images/phone-app-be-smarter.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                        </div>
                    </figure>
                </div>
                <div class="features-inner list">

                    <ul class="list-wrapper symmetric-indent ">
                     <li class="app-feature">
                        <span class="theme_color">Gain</span> relevant information related to all aspects of your life
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Take</span> all aspects of your existing lifestyle into account
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Find</span> barriers and address them
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Set</span> achievable milestones creating a clear path
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Ensure</span> you share your Goal and follow through
                    </li>
                </ul>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>               
    </div>
    <!-- Epic BE SMARTER Section end -->
    <!-- EPIC DAILY DIARY Section start -->
    <div class="has-one-list daly-diaryy sticky-container app-features-bg">
        <div class="features reverse_section">
            <div class="features-inner cta">
                <div class="wrapper">
                    <div class="section_heading">
                        <div class="index_heading">
                            <strong>EPIC</strong> DAILY DIARY
                        </div>
                        <span class="title subhead-1"><strong>EPIC</strong> Daily Diary</span>
                    </div>
                    <h3 class="app-feature__title title h4">
                        <strong>Diarise and prioritise your life and monitor all aspects of your Health </strong>
                        <span class="secondary-color">& Wellness daily in a simple to use wellness hub.</span>
                    </h3>
                    <a href="#" class="btn link f-button">Try us today</a>
                </div>
            </div>                        
            <div class="app-feature-phone">
                <figure class="inner">
                    <div class="phone-frame">
                        <img src="home/images/phone-app-daily-diary.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                    </div>
                </figure>
            </div>
            <div class="features-inner list">
                <ul class="list-wrapper symmetric-indent ">
                    <li class="app-feature">
                        <span class="theme_color">Stay</span> accountable by recording your information daily
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Know </span> your path and achieve your milestones
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Implement</span> simple habits into your daily life
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Apply</span> and track your daily tasks to ensure that you achieve your desired RESULT
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Share</span> your achievements online and celebrate your success and motivate others
                    </li>
                </ul>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>               
    </div>
    <!-- EPIC DAILY DIARY Section end -->
    <!-- EPIC EXPLORE DESIGN Section start -->
    <div class="has-one-list exploree sticky-container">
        <div class="features">
            <div class="features-inner cta">
                <div class="wrapper">
                    <div class="section_heading">
                        <div class="index_heading">
                            <strong>EPIC</strong> EXPLORE 
                        </div>
                        <span class="title subhead-1"><strong>EPIC</strong> Explore</span>
                    </div>
                    <h3 class="app-feature__title title h4">
                        <strong>Get out and try new routes, challenge your friends or yourself on the same route.</strong>
                        <span class="secondary-color">Map your run, walk, bike, swim, kayak, or paddle board. Explore the world.</span>
                    </h3>
                    <a href="#" class="btn link f-button">Try us today</a>
                </div>
            </div>
            <div class="app-feature-phone">
                <figure class="inner">
                    <div class="phone-frame">
                        <img src="home/images/phone-app-4.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                    </div>
                </figure>
            </div>
            <div class="features-inner list">
                <ul class="list-wrapper symmetric-indent ">
                    <li class="app-feature">
                        <span class="theme_color">Map</span> and motivate yourself and friends to get outdoors
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Challenge</span> friends or get challenged on local routes
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Track</span> and record most outdoor activities on one platform
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Save</span> and continue monitoring progress over the same routes
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Share</span> routes with friends and family
                    </li>
                </ul>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>                 
    </div>
    <!-- EPIC EXPLORE DESIGN -->
    <!-- EPIC LIFESTYLE Section start -->
    <div class="has-one-list lifestylee sticky-container app-features-bg">
        <div class="features reverse_section">
            <div class="features-inner cta">
                <div class="wrapper">
                    <div class="section_heading">
                        <div class="index_heading">
                            <strong>EPIC</strong> LIFESTYLE Design
                        </div>
                        <span class="title subhead-1"><strong>EPIC</strong> Lifestyle Design</span>
                    </div>
                    <h3 class="app-feature__title title h4">
                        <strong>A holistic approach to Health & wellness where we address all aspects </strong>
                        <span class="secondary-color">in a progressive way making small changes often.</span>
                    </h3>
                    <a href="#" class="btn link f-button">Try us today</a>
                </div>
            </div>                        
            <div class="app-feature-phone">
                <figure class="inner">
                    <div class="phone-frame">
                        <img src="home/images/phone-app-4.png" width="315" height="682" class="phone-screen has-frame" alt="phone">
                    </div>
                </figure>
            </div>
            <div class="features-inner list">
                <ul class="list-wrapper symmetric-indent ">
                    <li class="app-feature">
                        <span class="theme_color">Holistic</span> approach to your Lifestyle
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Addressing</span> critical path items and focus points
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Managing</span> stress and implementing time management
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Implementing</span> healthy sleep habits and Recovery Routines
                    </li>
                    <li class="app-feature">
                        <span class="theme_color">Making</span> the change to become a happier and healthier person
                    </li>

                </ul>
                <a href="#" class="btn link f-button">Try us today</a>
            </div>
        </div>               
    </div>
    <!-- EPIC LIFESTYLE Section end -->
</div>
</div>
</main>
<footer class="footer-block">
    <div class="container">
        <div class="footer-menu title body-1">
            <ul class="nav inline footer-social title body-1">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">Instagram</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot"> TikTok</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">Facebook</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">Twitter</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">LinkedIn</span>
                    </a>
                </li>
            </ul>
            <ul class="nav inline footer-main title body-1">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">About Us</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">Careers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">Blog</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">Contacts</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer-legal">
            <div class="footer-copyright">
                <div class="copyright-text year title body-2">
                    <span class="copyright-symbol">©</span> 2021. EPIC FIT.
                </div>
                <div class="copyright-desc title body-3">
                    Our website services, content and products are for informational purposes only. EPIC FIT does not provide medical advice, diagnosis, or treatment
                </div>
            </div>
            <ul class="nav inline footer-legal-links title body-2">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">Editorial Standards</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">Editorial Team</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="dot">Privacy Policy</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
{{-- <script src="{{ asset('home/js/homepage.js') }}"></script> --}}
<script src="{{ asset('home/js/jquery.js') }}"></script>
<script type="text/javascript">

    $('#EPICDashboard').click(function() {
        $('.appfeature img').prop("src", "home/images/phone-app-1.png");            
        $('.phone-screen').removeClass('fade-in current');
        $('.imgPosture').removeClass('fade-in current');
        $('.imgFuel').removeClass('fade-in current');
        $('.imgBody').removeClass('fade-in current');
        $('.imgDashboard').addClass('fade-in current');
        $('.app-feature__content').removeClass('current');
        $('#EPICDashboard').addClass('current');

    });
    $('#EPICSocial').click(function() {
        $('.appfeature img').prop("src", "home/images/phone-app-2.jpg");
        $('.phone-screen').removeClass('fade-in current');
        $('.imgPosture').removeClass('fade-in current');
        $('.imgFuel').removeClass('fade-in current');
        $('.imgBody').removeClass('fade-in current');
        $('.imgSocial').addClass('fade-in current');
        $('.app-feature__content').removeClass('current');
        $('#EPICSocial').addClass('current');
    });
    $('#EPICPosture').click(function() {
        $('.appfeature img').prop("src", "home/images/phone-app-posture.png");
        $('.phone-screen').removeClass('fade-in current');
        $('.imgSocial').removeClass('fade-in current');
        $('.imgFuel').removeClass('fade-in current');
        $('.imgBody').removeClass('fade-in current');
        $('.imgPosture').addClass('fade-in current');
        $('.app-feature__content').removeClass('current');
        $('#EPICPosture').addClass('current');
    });
    $('#EPICFuel').click(function() {
        $('.appfeature img').prop("src", "home/images/phone-app-4.png");
        $('.phone-screen').removeClass('fade-in current');
        $('.imgSocial').removeClass('fade-in current');
        $('.imgPosture').removeClass('fade-in current');
        $('.imgBody').removeClass('fade-in current');
        $('.imgFuel').addClass('fade-in current');
        $('.app-feature__content').removeClass('current');
        $('#EPICFuel').addClass('current');
    });
    $('#EPICBody').click(function() {
        $('.appfeature img').prop("src", "home/images/phone-app-5.jpg");
        $('.appfeature img').prop("src", "home/images/phone-app-4.jpg");
        $('.phone-screen').removeClass('fade-in current');
        $('.imgSocial').removeClass('fade-in current');
        $('.imgPosture').removeClass('fade-in current');
        $('.imgFuel').removeClass('fade-in current');
        $('.imgBody').addClass('fade-in current');
        $('.app-feature__content').removeClass('current');
        $('#EPICBody').addClass('current');
    });
    $('#EPICActive').click(function() {
        $('.appfeature img').prop("src", "home/images/phone-app-active.png");
        $('.phone-screen').removeClass('fade-in current');
        $('.imgactive').addClass('fade-in current');
        $('.app-feature__content').removeClass('current');
        $('#EPICActive').addClass('current');
    });
    $('#EPICDaily').click(function() {
        $('.appfeature img').prop("src", "home/images/phone-app-6.png");
        $('.phone-screen').removeClass('fade-in current');
        $('.imgactive').addClass('fade-in current');
        $('.app-feature__content').removeClass('current');
        $('#EPICDaily').addClass('current');
    });
    $('#EPICLifestyle').click(function() {
        $('.appfeature img').prop("src", "home/images/phone-app-6.png");
        $('.phone-screen').removeClass('fade-in current');
        $('.imgactive').addClass('fade-in current');
        $('.app-feature__content').removeClass('current');
        $('#EPICLifestyle').addClass('current');
    });
    $('#EPICSmarter').click(function() {
        $('.appfeature img').prop("src", "home/images/phone-app-6.png");
        $('.phone-screen').removeClass('fade-in current');
        $('.imgactive').addClass('fade-in current');
        $('.app-feature__content').removeClass('current');
        $('#EPICSmarter').addClass('current');
    });
    $('#EPICExplore').click(function() {
        $('.appfeature img').prop("src", "home/images/phone-app-6.png");
        $('.phone-screen').removeClass('fade-in current');
        $('.imgactive').addClass('fade-in current');
        $('.app-feature__content').removeClass('current');
        $('#EPICExplore').addClass('current');
    });
    /***desktop**/
    // $('.circle-container > *').click(function() {
    //     $('.circle-container > *').removeClass('current-h');
    //     $(this).addClass('current-h');
    // });
    $('.circle-container > *:nth-of-type(10)').click(function() {
       $('.mobile-view-data .appfeature img').prop("src", "home/images/phone-app-1.png");
       $('.circle-container > *').removeClass('current-h');
       $('.circle-container > *:nth-of-type(10)').addClass('current-h');
       $('.desktop-overlayy').removeClass('current-feature');
       $('.epic-dashboard-desk').addClass('current-feature');
       $('.index_heading').removeClass('current-feature-mob');
       $('#EPICDashboard').addClass('current-feature-mob');
   });
    $('.circle-container > *:nth-of-type(9)').click(function() {
       $('.mobile-view-data .appfeature img').prop("src", "home/images/phone-app-social.png");
       $('.circle-container > *').removeClass('current-h');
       $('.circle-container > *:nth-of-type(9)').addClass('current-h');
       $('.desktop-overlayy').removeClass('current-feature');
       $('.epic-social-desk').addClass('current-feature');
       $('.index_heading').removeClass('current-feature-mob');
       $('#EPICSocial').addClass('current-feature-mob');
   });
    
    $('.circle-container > *:nth-of-type(8)').click(function() {
       $('.mobile-view-data .appfeature img').prop("src", "home/images/phone-app-4.png");
       $('.circle-container > *').removeClass('current-h');
       $('.circle-container > *:nth-of-type(8)').addClass('current-h');
       $('.desktop-overlayy').removeClass('current-feature');
       $('.epic-fuel-desk').addClass('current-feature');
       $('.index_heading').removeClass('current-feature-mob');
       $('#EPICFuel').addClass('current-feature-mob');
   });
    $('.circle-container > *:nth-of-type(7)').click(function() {
       $('.mobile-view-data .appfeature img').prop("src", "home/images/phone-app-posture.png");
       $('.circle-container > *').removeClass('current-h');
       $('.circle-container > *:nth-of-type(7)').addClass('current-h');
       $('.desktop-overlayy').removeClass('current-feature');
       $('.epic-posture-desk').addClass('current-feature');
       $('.index_heading').removeClass('current-feature-mob');
       $('#EPICPosture').addClass('current-feature-mob');
   });
    $('.circle-container > *:nth-of-type(6)').click(function() {
       $('.mobile-view-data .appfeature img').prop("src", "home/images/phone-app-active.png");
       $('.circle-container > *').removeClass('current-h');
       $('.circle-container > *:nth-of-type(6)').addClass('current-h');
       $('.desktop-overlayy').removeClass('current-feature');
       $('.epic-active-desk').addClass('current-feature');
       $('.index_heading').removeClass('current-feature-mob');
       $('#EPICActive').addClass('current-feature-mob');
   });
    $('.circle-container > *:nth-of-type(5)').click(function() {
       $('.mobile-view-data .appfeature img').prop("src", "home/images/phone-app-body-analysis.png");
       $('.circle-container > *').removeClass('current-h');
       $('.circle-container > *:nth-of-type(5)').addClass('current-h');
       $('.desktop-overlayy').removeClass('current-feature');
       $('.epic-analysys-desk').addClass('current-feature');
       $('.index_heading').removeClass('current-feature-mob');
       $('#EPICBody').addClass('current-feature-mob');
   });
    $('.circle-container > *:nth-of-type(4)').click(function() {
       $('.mobile-view-data .appfeature img').prop("src", "home/images/phone-app-be-smarter.png");
       $('.circle-container > *').removeClass('current-h');
       $('.circle-container > *:nth-of-type(4)').addClass('current-h');
       $('.desktop-overlayy').removeClass('current-feature');
       $('.epic-smarter-desk').addClass('current-feature');
       $('.index_heading').removeClass('current-feature-mob');
       $('#EPICSmarter').addClass('current-feature-mob');
   });
    $('.circle-container > *:nth-of-type(3)').click(function() {
       $('.mobile-view-data .appfeature img').prop("src", "home/images/phone-app-daily-diary.png");
       $('.circle-container > *').removeClass('current-h');
       $('.circle-container > *:nth-of-type(3)').addClass('current-h');
       $('.desktop-overlayy').removeClass('current-feature');
       $('.epic-daily-desk').addClass('current-feature');
       $('.index_heading').removeClass('current-feature-mob');
       $('#EPICDaily').addClass('current-feature-mob');
   });
    $('.circle-container > *:nth-of-type(2)').click(function() {
       $('.circle-container > *').removeClass('current-h');
       $('.circle-container > *:nth-of-type(2)').addClass('current-h');
       $('.desktop-overlayy').removeClass('current-feature');
       $('.epic-explore-desk').addClass('current-feature');
       $('.index_heading').removeClass('current-feature-mob');
       $('#EPICExplore').addClass('current-feature-mob');
   });
    $('.circle-container > *:nth-of-type(1)').click(function() {
       $('.circle-container > *').removeClass('current-h');
       $('.circle-container > *:nth-of-type(1)').addClass('current-h');
       $('.desktop-overlayy').removeClass('current-feature');
       $('.epic-lifestyle-desk').addClass('current-feature');
       $('.index_heading').removeClass('current-feature-mob');
       $('#EPICLifestyle').addClass('current-feature-mob');
   });

</script>
</body>
</html>
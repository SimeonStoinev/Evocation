<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Favicons -->
        <link href="{{ asset('img/favicon.png') }}" rel="icon">  <!-- add favicon in the folder later -->

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

        <!-- Bootstrap CSS File -->
        <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Libraries CSS Files -->
        <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/landing/style.css') }}" rel="stylesheet">



    </head>
    <body>


    <header id="header">
        <div class="container-fluid">

            <div id="logo" class="pull-left">
                <h1><a href="#intro" class="scrollto">Evocation</a></h1>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="#facts">Регистрация</a></li>
                    <li><a href="#prices">Вход</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="intro">
        <div class="intro-container">
            <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

                <ol class="carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">

                    <div class="carousel-item active">
                        <div class="carousel-background"><img src="{{asset('img/intro/1.jpg')}}" alt=""></div>
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2>Ние сме професионалисти</h2>
                                <p>Оцени своите умения. Създай автобиография си по Европейските стандарти. Избери най-добрата работа.</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-background"><img src="{{asset('img/intro/2.jpg')}}" alt=""></div>
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2>Ние сме оригинални</h2>
                                <p>Изпъкни със своята автобиография. Покажи желанието си да бъдеш различен. Спечели със стил.</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-background"><img src="{{asset('img/intro/3.jpg')}}" alt=""></div>
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2>Ние сме ефективни</h2>
                                <p>Следвай стъпките ни. Напиши какво можеш. Избери работата, която винаги си търсил.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Предишно</span>
                </a>

                <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Следващо</span>
                </a>

            </div>
        </div>
    </section>

    <main id="main">

        <section id="featured-services">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 box">
                        <i class="ion-ios-bookmarks-outline"></i>
                        <h4 class="title"><a href="">Професионализъм</a></h4>
                        <p class="description">Създай автобиография си, съобразена по последните Европейски стандарти, без да се налага да ги знаеш.</p>
                    </div>

                    <div class="col-lg-4 box box-bg">
                        <i class="ion-ios-stopwatch-outline"></i>
                        <h4 class="title"><a href="">Бързина</a></h4>
                        <p class="description">Спести време, усилия и пари, като просто следваш няколко прости стъпки.</p>
                    </div>

                    <div class="col-lg-4 box">
                        <i class="ion-ios-heart-outline"></i>
                        <h4 class="title"><a href="">Креативност</a></h4>
                        <p class="description">Отличи се от останалите с красив дизайн на автобиографията си, съобразен с позицията, за която кандидатстваш.</p>
                    </div>

                </div>
            </div>
        </section>

        <section id="facts"  class="wow fadeIn">
            <div class="container">

                <header class="section-header">
                    <h3>Всичко в няколко числа</h3>
                </header>

                <div class="row counters">

                    <div class="col-lg-3 col-6 text-center">
                        <span data-toggle="counter-up">30271</span>
                        <p>Ученици</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-toggle="counter-up">1071</span>
                        <p>Класа</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-toggle="counter-up">31</span>
                        <p>Училища</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-toggle="counter-up">7</span>
                        <p>Града</p>
                    </div>

                </div>

                <div class="facts-img">
                    <img src="{{asset('img/facts-img.png')}}" alt="" class="img-fluid">
                </div>

            </div>
        </section>

        <section id="services">
            <div class="container">

                <div class="row">

                    <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
                        <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
                        <h4 class="title"><a href="">Готов дизайн</a></h4>
                        <p class="description">Можеш да избереш сам своя дизайн или да получиш такъв, съобразен с позицията, за която кандидатстваш</p>
                    </div>
                    <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
                        <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
                        <h4 class="title"><a href="">Система за самооценка</a></h4>
                        <p class="description">Спести време на себе си и на работодателя си с разработените ни по Европейската скала тестове, които удостоверяват знанията ти, без да ти е необходим сертификат за тях</p>
                    </div>
                    <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
                        <div class="icon"><i class="ion-ios-paper-outline"></i></div>
                        <h4 class="title"><a href="">Търсачка за работа</a></h4>
                        <p class="description">След като направиш бързо своята автобиография, сиснемата изкарва топ 10 най-подходящи места за работа в населеното ти място от най-големите фирми</p>
                    </div>

                </div>

            </div>
        </section>
        {{--<section id="portfolio"  class="section-bg" >--}}
            {{--<div class="container">--}}

                {{--<header class="section-header">--}}
                    {{--<h3 class="section-title">Дизайни</h3>--}}
                {{--</header>--}}

                {{--<div class="row">--}}
                    {{--<div class="col-lg-12">--}}
                        {{--<ul id="portfolio-flters">--}}
                            {{--<li data-filter="*" class="filter-active">Всички</li>--}}
                            {{--<li data-filter=".filter-app">Строги</li>--}}
                            {{--<li data-filter=".filter-card">Забавни</li>--}}
                            {{--<li data-filter=".filter-web">Тематични</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="row portfolio-container">--}}

                    {{--<div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp">--}}
                        {{--<div class="portfolio-wrap">--}}
                            {{--<figure>--}}
                                {{--<img src="img/portfolio/app1.jpg" class="img-fluid" alt="">--}}
                                {{--<!-- <a href="img/portfolio/app1.jpg" data-lightbox="portfolio" data-title="App 1" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a> -->--}}
                                {{--<a href="#" class="link-details">Избери</a>--}}
                            {{--</figure>--}}

                            {{--<div class="portfolio-info">--}}
                                {{--<h4><a href="#">Строго</a></h4>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">--}}
                        {{--<div class="portfolio-wrap">--}}
                            {{--<figure>--}}
                                {{--<img src="img/portfolio/web3.jpg" class="img-fluid" alt="">--}}
                                {{--<!-- <a href="img/portfolio/web3.jpg" class="link-preview" data-lightbox="portfolio" data-title="Web 3" title="Preview"><i class="ion ion-eye"></i></a> -->--}}
                                {{--<a href="#" class="link-details">Избери</a>--}}
                            {{--</figure>--}}

                            {{--<div class="portfolio-info">--}}
                                {{--<h4><a href="#">Тематично</a></h4>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">--}}
                        {{--<div class="portfolio-wrap">--}}
                            {{--<figure>--}}
                                {{--<img src="img/portfolio/app2.jpg" class="img-fluid" alt="">--}}
                                {{--<!-- <a href="img/portfolio/app2.jpg" class="link-preview" data-lightbox="portfolio" data-title="App 2" title="Preview"><i class="ion ion-eye"></i></a> -->--}}
                                {{--<a href="#" class="link-details">Избери</a>--}}
                            {{--</figure>--}}

                            {{--<div class="portfolio-info">--}}
                                {{--<h4><a href="#">По-строго</a></h4>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">--}}
                        {{--<div class="portfolio-wrap">--}}
                            {{--<figure>--}}
                                {{--<img src="img/portfolio/card2.jpg" class="img-fluid" alt="">--}}
                                {{--<!--  <a href="img/portfolio/card2.jpg" class="link-preview" data-lightbox="portfolio" data-title="Card 2" title="Preview"><i class="ion ion-eye"></i></a> -->--}}
                                {{--<a href="#" class="link-details">Избери</a>--}}
                            {{--</figure>--}}

                            {{--<div class="portfolio-info">--}}
                                {{--<h4><a href="#">Забавно</a></h4>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">--}}
                        {{--<div class="portfolio-wrap">--}}
                            {{--<figure>--}}
                                {{--<img src="img/portfolio/web2.jpg" class="img-fluid" alt="">--}}
                                {{--<!--  <a href="img/portfolio/web2.jpg" class="link-preview" data-lightbox="portfolio" data-title="Web 2" title="Preview"><i class="ion ion-eye"></i></a> -->--}}
                                {{--<a href="#" class="link-details">Избери</a>--}}
                            {{--</figure>--}}

                            {{--<div class="portfolio-info">--}}
                                {{--<h4><a href="#">По-тематично</a></h4>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">--}}
                        {{--<div class="portfolio-wrap">--}}
                            {{--<figure>--}}
                                {{--<img src="img/portfolio/app3.jpg" class="img-fluid" alt="">--}}
                                {{--<!--  <a href="img/portfolio/app3.jpg" class="link-preview" data-lightbox="portfolio" data-title="App 3" title="Preview"><i class="ion ion-eye"></i></a> -->--}}
                                {{--<a href="#" class="link-details">Избери</a>--}}
                            {{--</figure>--}}

                            {{--<div class="portfolio-info">--}}
                                {{--<h4><a href="#">Най-строго</a></h4>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">--}}
                        {{--<div class="portfolio-wrap">--}}
                            {{--<figure>--}}
                                {{--<img src="img/portfolio/card1.jpg" class="img-fluid" alt="">--}}
                                {{--<!-- <a href="img/portfolio/card1.jpg" class="link-preview" data-lightbox="portfolio" data-title="Card 1" title="Preview"><i class="ion ion-eye"></i></a> -->--}}
                                {{--<a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>--}}
                            {{--</figure>--}}

                            {{--<div class="portfolio-info">--}}
                                {{--<h4><a href="#">По-забавно</a></h4>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp" data-wow-delay="0.1s">--}}
                        {{--<div class="portfolio-wrap">--}}
                            {{--<figure>--}}
                                {{--<img src="img/portfolio/card3.jpg" class="img-fluid" alt="">--}}
                                {{--<!-- <a href="img/portfolio/card3.jpg" class="link-preview" data-lightbox="portfolio" data-title="Card 3" title="Preview"><i class="ion ion-eye"></i></a> -->--}}
                                {{--<a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>--}}
                            {{--</figure>--}}

                            {{--<div class="portfolio-info">--}}
                                {{--<h4><a href="#">Най-забавно</a></h4>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.2s">--}}
                        {{--<div class="portfolio-wrap">--}}
                            {{--<figure>--}}
                                {{--<img src="img/portfolio/web1.jpg" class="img-fluid" alt="">--}}
                                {{--<!-- <a href="img/portfolio/web1.jpg" class="link-preview" data-lightbox="portfolio" data-title="Web 1" title="Preview"><i class="ion ion-eye"></i></a> -->--}}
                                {{--<a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>--}}
                            {{--</figure>--}}

                            {{--<div class="portfolio-info">--}}
                                {{--<h4><a href="#">Най-тематично</a></h4>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}

            {{--</div>--}}
        {{--</section>--}}


        <section id="contact" class="section-bg wow fadeInUp">
            <div class="container">

                <div class="section-header">
                    <h3>Контакт</h3>
                    <p>Свържи се с нас за съвет, консултация или неизправност. Ще отговорим по най-бързия начин.</p>
                </div>

                <div class="row contact-info">

                    <div class="col-md-4">
                        <div class="contact-address">
                            <i class="ion-ios-location-outline"></i>
                            <h3>Адрес</h3>
                            <address>гр. Търговище, България</address>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="ion-ios-people-outline"></i>
                            <h3>Администратори</h3>
                            <p>Симеон Стойнев</p>
                            <p>Денислав Колев</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="ion-ios-email-outline"></i>
                            <h3>E-Майл</h3>
                            <p>seternals8@gmail.com</p>
                            <p>denislav_kolev00@abv.bg</p>
                        </div>
                    </div>

                </div>

                <div class="form">
                    <div id="sendmessage">Съобщението беше изпратено! Благодарим! </div>
                    <div id="errormessage"></div>
                    <form action="" method="post" role="form" class="contactForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Име" data-rule="minlen:4" data-msg="Моля, въведи повече от 4 символа" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Е-Майл" data-rule="email" data-msg="Моля, въведи правилен е-майл" />
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Тема" data-rule="minlen:4" data-msg="Моля, въведи повече от 8 символа" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Моля, напиши ни нещо" placeholder="Съобщение"></textarea>
                            <div class="validation"></div>
                        </div>
                        <div class="text-center"><button type="submit">Изпрати</button></div>
                    </form>
                </div>

            </div>
        </section>

    </main>

    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6 footer-info">
                        <h3>Evocation</h3>
                        <p>Генератор за професионални, креативни и ефективни автобиографии, придружени с адекватни квалификационни тестове и най-подходящите обяви за работа от най-големите български сайтове.</p>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Бърз достъп</h4>
                        <ul>
                            <li><i class="ion-ios-arrow-right"></i> <a href="#intro">Регистрация</a></li>
                            <li><i class="ion-ios-arrow-right"></i> <a href="featured-services">Вход</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Контакт</h4>
                        <p>
                            бул. "Трайко Китанчев 31" <br>
                            Търговище, 7700<br>
                            България<br>
                        <div><strong>Е-Майл:</strong></div> seternals8@gmail.com denislav_kolev00@abv.bg

                        </p>

                        <div class="social-links">
                            <a href="https://twitter.com" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="https://facebook.com" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="https://instagram.com" class="instagram"><i class="fa fa-instagram"></i></a>
                            <a href="https://google.com" class="google-plus"><i class="fa fa-google-plus"></i></a>
                            <a href="https://linkedin.com" class="linkedin"><i class="fa fa-linkedin"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    {{--Javascript files--}}
    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/superfish/hoverIntent.js') }}"></script>
    <script src="{{ asset('lib/superfish/superfish.min.js') }}"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('lib/touchSwipe/jquery.touchSwipe.min.js') }}"></script>
    <script src="{{ asset('js/landing/contactform.js') }}"></script>
    <script src="{{ asset('js/landing/main.js') }}"></script>

    </body>
</html>

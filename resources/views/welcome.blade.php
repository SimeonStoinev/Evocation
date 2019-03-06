<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Evocation</title>

        <!-- Favicons -->
        <link href="{{ 'favicon.png' }}" rel="icon">

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
                <h1><a href="#intro" class="scrollto"><img src="{{ asset('img/white_logo.png') }}" alt="logo"></a></h1>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="/login">Вход</a></li>
                    <li class="menu-active"><a href="/register">Регистрация</a></li>
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
                                <h2>Иновация</h2>
                                <p>Ние обединяваме училището и технологиите, за да вървим заедно към бъдещето.</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-background"><img src="{{asset('img/intro/2.jpg')}}" alt=""></div>
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2>Сигурност</h2>
                                <p>Evocation е изграден чрез най-новите технологии, за да гарантира висока сигурност на системата.</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-background"><img src="{{asset('img/intro/3.jpg')}}" alt=""></div>
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2>Улесение</h2>
                                <p>Целта на приложението е да улесни максимално учители, родители и ученици.</p>
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
                        <i class="ion-information-circled"></i>
                        <h4 class="title"><a href="javascript:;">Какво е Evocation?</a></h4>
                        <p class="description">Evocation e Интернет приложение, което идентифицира посещението на учениците в училище чрез магнитна карта.</p>
                    </div>

                    <div class="col-lg-4 box box-bg">
                        <i class="ion-android-settings"></i>
                        <h4 class="title"><a href="javascript:;">Автоматизация</a></h4>
                        <p class="description">Данните от идентификацията в реално време се нанасят в електронен дневник, което улеснява работата на учителите и уведомява родителите.</p>
                    </div>

                    <div class="col-lg-4 box">
                        <i class="ion-ios-bookmarks-outline"></i>
                        <h4 class="title"><a href="javascript:;">Електронен дневник</a></h4>
                        <p class="description">Електронният дневник предоставя детайлна информация за отсъствията на учениците, за седмичното разписание на училището и др.</p>
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

                    <div class="col-lg-4 col-6 text-center">
                        <span data-toggle="counter-up">{{ $numbers['students'] }}</span>
                        <p>Ученици</p>
                    </div>

                    <div class="col-lg-4 col-6 text-center">
                        <span data-toggle="counter-up">{{ $numbers['grades'] }}</span>
                        <p>Класа</p>
                    </div>

                    <div class="col-lg-4 col-6 text-center">
                        <span data-toggle="counter-up">{{ $numbers['schools'] }}</span>
                        @if ($numbers['schools'] == 1)
                            <p>Училище</p>
                        @else
                            <p>Училища</p>
                        @endif
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
                        <div class="icon"><i class="ion-android-lock"></i></div>
                        <h4 class="title"><a href="javascript:;">Сигурност</a></h4>
                        <p class="description">Ние използваме най-новите технологии, за да постигнем максимална ефективност и сигурност.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
                        <div class="icon"><i class="ion-ios-bolt-outline"></i></div>
                        <h4 class="title"><a href="javascript:;">Бързина</a></h4>
                        <p class="description">Главната цел на Evocation е да автоматизира процеса на въвеждане на отсъствия.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
                        <div class="icon"><i class="ion-ios-lightbulb-outline"></i></div>
                        <h4 class="title"><a href="javascript:;">Креативност</a></h4>
                        <p class="description">Дизайнът на Evocation е responsive, за да отоговори на изискванията на всеки потребител.</p>
                    </div>

                </div>

            </div>
        </section>
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
                            <h3>Разработчици</h3>
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
                                <input type="text" name="name" class="form-control" id="name" placeholder="Име" data-rule="minlen:4" data-msg="Моля, въведете повече от 4 символа" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Е-Майл" data-rule="email" data-msg="Моля, въведете правилен е-майл" />
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Тема" data-rule="minlen:4" data-msg="Моля, въведете повече от 8 символа" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Моля, напишете ни нещо" placeholder="Съобщение"></textarea>
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
                        <p>Evocation представлява Интернет приложение, което идентифицира посещението на учениците в училище чрез магнитна карта. Данните от идентификацията в реално време се нанасят в електронен дневник, което улеснява работата на учителите и уведомява родителите.</p>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Бърз достъп</h4>
                        <ul>
                            <li><i class="ion-ios-arrow-right"></i> <a href="/login">Вход</a></li>
                            <li><i class="ion-ios-arrow-right"></i> <a href="/register">Регистрация</a></li>
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

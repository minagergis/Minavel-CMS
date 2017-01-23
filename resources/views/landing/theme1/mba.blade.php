@include('landing.theme1.haeder')

        <!-- Fixed Header -->
<header class="container fixed-brand">
    <!--
            <div class="row">
                <div class="page-brand col-sm-8 col-sm-offset-2 text-right">
                    <h1>حمل كتب مجانا وابدأ تعليم المحادثة الانجليزية </h1>
                </div>

                <div class="company-brand col-sm-1 col-xs-1 text-left">
                        <a href='#' class='logo'><img class='img-responsive' src='img/Logo-1-150x150.png' alt=''></a>
                </div>
                -->
    <!-- Sidebar -->
    <div class="fixed-side hidden-xs col-sm-3">

        <?php if (!count($errors) > 0){ ?>
        <div class="price-panal panel panel-info">
            <div class="panel-body text-center">
                <img src="{{ asset('public/assets/landing/theme1/img/logo.png') }}" class='img-responsive price'>
            </div>
        </div>
        <?php } ?>

        <div class="form-panal panel panel-danger hidden-xs text-center">
            <div class="panel-heading text-center"> حمل الآن 12 كتاب <br> تعلم الانجليزي مجانا</div>
            <div class="text-center" style="color : #FFF !important;"> ادخل اسمك وايميلك وتليفونك <br>وحمل الكتب
                وابدأ بالتعليم فورا
            </div>
            <div class="panel-body">
                <?php if (count($errors) > 0){ ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <?php

                    foreach ($errors as $error) {
                        echo $error . '</br>';
                    }

                    ?>
                </div>
                <?php } ?>

                <form class="form" action="{{ route('landing.post', $slug) }}" accept-charset="utf-8" method="post" name="mainform" role="form">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <!--                            	<label for="name">Your Name :</label>
                        --> <input type="text" class="form-control" id='name' name="name" placeholder="إسمك" required>
                    </div>
                    <div class="form-group">
                        <!--                            	<label for="name">Your E-Mail :</label>
                        --> <input type="email" class="form-control" id='email' name="email" placeholder="بريدك الألكتروني"
                               required>
                    </div>
                    <div class="form-group">
                        <!--                            	<label for="name">Your Mobile :</label>
                        --> <input type="text" class="form-control" id='mobile' name="mobile" placeholder="موبايلك" required>
                    </div>
                    <button type="submit" class="btn btn1">اضغط هنا للتحميل</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->
    </div>
</header>
<!-- /Header -->

<div>
    <?php if($agent->isMobile()){?>
    <section class="container ccccc visible-xs videomobile_container">
        <div class="row">


            <div class="video">
                <iframe
                        src="http://www.youtube.com/embed/7MnlWVc_lu0?rel=0" allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <?php } ?>
</div>

<img class="img-responsive hidden-xs" src={{ asset('public/assets/landing/theme1/img/1.jpg') }} alt=""
     style="opacity:0.9">
</div>
<!-- Slider -->
<!--<div id="mainslider" class="carousel slide" data-ride="carousel">-->
<!-- Indicators -->
<!--        <ol class="carousel-indicators">
        	<li data-target="#mainslider" data-slide-to="0" class="active"></li>
        </ol>
-->
<!-- Wrapper for slides -->
<!--
<div class="carousel-inner" role="listbox">
    <div class="item active">
        <img src='img/1.jpg' alt="">
        <div class="carousel-caption">
        </div>
    </div>
    <div class="item">
        <img src='img/2.jpg' alt="">
        <div class="carousel-caption">
        </div>
    </div>
    <div class="item">
        <img src='img/3.jpg' alt="">
        <div class="carousel-caption">
        </div>
    </div>
</div>
<div class="col-xs-5 visible-xs-block mobile-price">
    <img src='img/price-1.png' class='img-responsive'>
</div>

</div>-->
<!-- /Slider -->
<section class="visible-xs-block container">
    <div class="row">
        <div class="col-xs-12 panel panel-danger mobile-panel">
            <div class="panel-heading text-center headsh">سجل الآن مجانا <br>وانتظر الهدايا والمفاجأت عبر الايميل</div>
            <div class="panel-body">

                <?php if (count($errors) > 0){ ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <?php

                    foreach ($errors as $error) {
                        echo $error . '</br>';
                    }

                    ?>
                </div>
                <?php } ?>

                <form class="form" accept-charset="utf-8" method="post" name="mobileform" role="form">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="إسمك" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="بريدك الألكتروني" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="موبايلك" required>
                    </div>
                    <button type="submit" class="btn btn1">إرسال</button>
                </form>
            </div>
        </div>
    </div>
</section>

<div id="site-content">


    <?php if(!$agent->isMobile()){?>
    <section class="container ccccc hidden-xs">

        <div class="row">
            <div class="col-sm-8 col-sm-offset-4 text-center about">
                <div class="top_hedaer">ابدأ الان فى تعليم الانجليزية مجانا .. وشاهد الفيديو</div>

                <div class="video">
                    <iframe

                            src="http://www.youtube.com/embed/42ffWHly3qg" allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
            <!--
        <section class="container promo-panels" >
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-4 text-center about">
                        <div class="col-xs-4">
                            <div class="panel panel-info text-center">
                                <img src="img/22.png">
                                <br>
                                كورس تعليم المحادثة الانجليزية فى 90 يوم
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="panel panel-info  text-center">
                                <img src="img/5.png">
                                <br>
                                 حاصل على شهادة الايزو العالمية
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="panel panel-info text-center">
                                <img src="img/11.png">
                                <br>
                                اختبارات تحديد المستوي لتعرف من اين تبدأ
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>         
 -->

    <section class="container ccccc">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-4 text-center about">
                <!--<div class="video">
                    <iframe
                    src="http://www.youtube.com/embed/M8TuDH12THA">
                    </iframe>
                </div>-->

                <h2></h2>
                <ul class="nav nav-tabs alt">
                    <li class="active"><a>المحتوى التعليمى </a></li>
                </ul>
                <div class="tab-content alt">
                    <div class="tab-pane active" id="about-course">
                        <div class="section-content row">
                            <div class="col-xs-12">
                                <div class="content">
                                    <ul>

                                        <li>احدث طرق تعليم محادثة بالانجليزية.</li>
                                        <li>الكورس من اعداد خبراء اجانب محترفين فى تعليم الانجليزية.</li>
                                        <li>اسلوب مبسط وسهل لتعليم المحادثة وأتقان اللغة.</li>
                                        <li>محادثات بالصوت والصورة لجميع المواقف الحياتية.</li>
                                        <li>اختبار لتحديد المستوي لتعرف من اين تبدأ.</li>
                                        <li>خاصية التسجيل الصوتي لتتمكن من ممارسة التحدث بالانجليزية.</li>
                                        <li>خاصية للاسئلة والاجوبة لكل درس.</li>
                                        <li>الكورس بمراحل ومستويات لتعيمك كيفية الفهم والنطق.</li>
                                        <li>البرنامج سهل الاستخدام لك ولاسرتك</li>
                                        <li>يساعدك فى تعليم نفسك بنفسك وفي اي وقت.</li>
                                        <li>البرنامج معد بطريقة احترافية سلسة من متخصصين اللغة.</li>
                                        <li>البرنامج مكون من 12 مستوي حتي الاحتراف.</li>
                                        <li>البرنامج حاصل على شهادة الايزو العالمية.</li>
                                        <li>البرنامج يصلك الي تعليم الانجليزية فى 90 يوم.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <br><br>
                <ul class="nav nav-tabs alt">
                    <li class="active"><a>اذا اعجبتك الكتب المجانية وتريد ان تحصل علي الكورس بالكامل ستتميز بـ </a></li>
                </ul>
                <div class="tab-content alt">
                    <div class="tab-pane active" id="about-course">
                        <div class="section-content row">
                            <div class="col-xs-12">
                                <div class="content">
                                    <ul>

                                        <li>خصومات تصل الى 70%.</li>
                                        <li>تحميل برامج للغات مجانا.</li>
                                        <li>احصل على كارت VIP مجانا.</li>
                                        <li>احصل على عضوية دائمة مجانا.</li>
                                        <li>الحصول على شهادات تعليم الانجليزي.</li>
                                        <li>ضمان لمدة عام.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div>
                    <img class="img-responsive" src="{{ asset('public/assets/landing/theme1/img/getNow.png') }}">
                </div>

            </div>
        </div>
    </section>


</div>

@include('landing.theme1.footer')
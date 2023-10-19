@extends('layouts.index')

@section('content')
    <div class="content">
        <div class="welcomeText">
            <div class="welcome">
                <h1 class="greet">WELCOME</h1>
            </div>
            <div class="subText">
                <div class="subTexts">
                    <p class="subscribe">Chúc Mọi Người Một Ngày Hiệu Quả</p>
                    <p class="soon">We are launching soon</p>
                </div>
            </div>
        </div>

        <div class="form">
            <form action="" class="sub">
                <input class='email' type="email">
                <button class="button" value="Send">This is nice day</button>
            </form>
        </div>

        <div class="social">
            <div class="follow">
                <p class="followUs">Or follow us</p>
            </div>
            <div class="socialIcons">
                <div class="socialIcon facebook brandico-facebook-rect"></div>
                <div class="socialIcon  twitter brandico-twitter-bird"></div>
                <div class="socialIcon  github brandico-github"></div>
            </div>
        </div>
    </div>
@endsection
@push('header_css')
    <style>
        @import url(http://weloveiconfonts.com/api/?family=brandico);
        @import url(https://fonts.googleapis.com/css?family=Junge);

        * {
            margin: 0;
            padding: 0;


        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            background: url('http://farm1.staticflickr.com/36/111023917_8de2b23011_o.jpg')no-repeat;
            background-size: cover;
            font-family: junge, georgia;
            text-align: center;
        }


        /* brandico */
        [class*="brandico-"]:before {
            font-family: 'brandico', sans-serif;
        }

        .page-body-wrapper {
            background: none
        }

        .content {
            max-width: 40%;
            max-height: 50%;
            margin: 100px auto;
        }

        .welcomeText,
        .form,
        .social {
            width: 100%;
        }

        /*welcome text*/
        .welcome {
            height: 100px;
            position: relative;
            border-bottom: 1px solid;
            overflow: hidden;
        }

        .greet {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 100%;
            font-size: 50px;
            text-align: center;
            line-height: 100px;
            transition: all .5s;
        }

        /*taglines*/
        .subText {
            width: 100%;
            height: 100px;
            position: relative;
            font-size: 30px;
            overflow: hidden;
        }

        .subText p {
            height: 100%;
            line-height: 100px;
            text-align: center;

        }

        .subTexts {
            width: 100%;
            position: absolute;
            bottom: 100%;
            text-align: center;
            overflow: hidden;
            transition: all .5s;
        }

        /*FORM*/
        .form {
            width: 100%;
            height: 100px;
            position: relative;
        }

        .sub {
            width: 90%;
            height: 50px;
            margin: auto;
            opacity: 0;
            border: none;
            border-radius: 50px;
            background: rgba(0, 0, 0, .05);
            box-shadow: inset 0 0 5px rgba(0, 0, 0, .4), 0 0 0px 5px rgba(0, 0, 0, .1);
            transition: all .5s;


        }

        .email {
            width: 70%;
            height: 70%;
            margin: 1% 0;
            padding-left: 10px;
            background: none;
            border: none;
            font-size: 20px;
        }

        input:focus {
            outline: none;
        }

        .button {
            width: 20%;
            height: 100%;
            float: right;
            border: none;
            border-radius: 0 50px 50px 0;
            font-size: 16px;
            background: red;
            background-color: #49afcd;
            background-image: linear-gradient(top, #5bc0de, #2f96b4);
            cursor: pointer;
            transition: all .5s;
        }

        .button:hover {
            background: #2f96b4;
            box-shadow: inset 0 1px 5px rgba(0, 0, 0, .3);
        }

        /*footer-follow us*/
        .follow {
            width: 100%;
            height: 100px;
            position: relative;
            overflow: hidden;
        }

        .followUs {
            width: 100%;
            height: 100%;
            position: absolute;
            bottom: 100%;
            line-height: 100px;
            text-align: center;
            font-size: 40px;
            transition: all .5s;
        }

        .socialIcons {
            width: 100%;
            height: 100px;
            position: relative;
            overflow: hidden;
        }

        .socialIcon {
            width: 33.33%;
            height: 100px;
            float: left;
            margin-top: 100px;
            font-size: 50px;
            line-height: 100px;
            transition: margin-top .5s, color .5s;
            cursor: pointer;

        }

        .socialIcon:hover {
            color: #49afcd;
            text-shadow: 0 0 20px white;
        }

        .twitter {
            transition-delay: .5s, 0;
        }

        .github {
            transition-delay: 1s, 0;
        }

        @media screen and (max-width:930px) {
            .subTexts p {
                font-size: 20px
            }

            .button {
                font-size: 12px
            }

        }

        @media screen and (max-width:600px) {

            .welcome,
            .subText,
            .sub {
                background: rgba(255, 255, 255, .3);
            }

            .welcome {
                border-radius: 20px 20px 0 0;
            }

            .subText {
                border-radius: 0 0 20px 20px;
            }

            .sub {
                border: 1px solid;
            }

            .greet {
                font-size: 30px
            }

            .subTexts p {
                font-size: 16px;
            }

            .button {
                font-size: 8px;
                margin-right: -3%
            }

        }
    </style>
@endpush
@push('footer_js')
    <script>
        window.addEventListener('load', function() {
            var welcome = document.querySelector('.greet'),
                subtext = document.querySelector('.subTexts'),
                form = document.querySelector('.sub'),
                follow = document.querySelector('.followUs'),
                social = document.querySelectorAll('.socialIcon'),
                delay = 1000;


            setTimeout(function() {
                welcome.style.top = '0';
            }, delay);
            setTimeout(function() {
                subtext.style.bottom = '0%';
            }, delay * 2);
            setTimeout(function() {
                subtext.style.bottom = '-100%';
            }, delay * 4);
            setTimeout(function() {
                form.style.opacity = '1';
            }, delay * 5);
            setTimeout(function() {
                follow.style.bottom = '0%';
            }, delay * 6);
            setTimeout(
                function() {
                    social[0].style.marginTop = '0px';
                    social[1].style.marginTop = '0px';
                    social[2].style.marginTop = '0px';
                }, delay * 7
            );

        });
    </script>
@endpush

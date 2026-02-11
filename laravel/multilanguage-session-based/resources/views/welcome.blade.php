<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <title>Flight Booking</title>

    <link rel="stylesheet" href="/css/app.css">

    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="/css/rtl.css">
    @endif

    <style>
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }
        .col {
            flex: 1;
            min-width: 200px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input, select, button {
            width: 100%;
            padding: 8px;
        }
        .lang-switch {
            text-align: right;
            margin-bottom: 15px;
        }
        button {
            background: #0d6efd;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
        .lang-switch button {
            background: #fff;
            border: 1px solid #ccc;
        }

        .lang-switch ul li a:hover {
            background: #f0f0f0;
        }

            .header {
        text-align: center;       /* Text center */
        margin-bottom: 20px;
    }

    .header img {
        max-width: 200px;         /* Plane image width */
        height: auto;
        display: block;           /* Block for center */
        margin: 0 auto 10px auto; /* Center + bottom margin */
    }

    .header h2 {
        margin-top: 0;
    }
    </style>
</head>

<body>

<div class="container">
@php
    $name = "Welcome to Holiday" ;
@endphp
<h3  style="text-align:center">{{ __($name) }}</h3>
    {{-- Language Switcher --}}
    <div class="lang-switch" style="text-align: right; margin-bottom: 15px; position: relative; display: inline-block;">
        <button style="padding:5px 10px; border:1px solid #ccc; border-radius:5px; cursor:pointer;">
            <img src="/flags/{{ app()->getLocale() }}.png" width="20" style="vertical-align:middle;"> 
            {{ strtoupper(app()->getLocale()) }} ▼
        </button>
        
        <ul style="display:none; position:absolute; right:0; background:#fff; border:1px solid #ccc; list-style:none; padding:5px 0; margin:0; border-radius:5px; min-width:120px; z-index:100;">
            <li style="padding:5px 10px;">
                <a href="{{ url('lang/en') }}" style="text-decoration:none; color:#333;">
                    <img src="/flags/en.png" width="20" style="vertical-align:middle;"> English
                </a>
            </li>
            <li style="padding:5px 10px;">
                <a href="{{ url('lang/bn') }}" style="text-decoration:none; color:#333;">
                    <img src="/flags/bn.png" width="20" style="vertical-align:middle;"> বাংলা
                </a>
            </li>
            <li style="padding:5px 10px;">
                <a href="{{ url('lang/ar') }}" style="text-decoration:none; color:#333;">
                    <img src="/flags/ar.png" width="20" style="vertical-align:middle;"> العربية
                </a>
            </li>
        </ul>
    </div>

    
    {{-- Header with airplane image --}}
    <div class="header center">
        <img src="/images/plane.png" alt="Airplane">
        <h2>{{ __('flight_booking') }}</h2>
    </div>

    <form>
        <div class="row">
            <div class="col">
                <label>{{ __('from') }}</label>
                <input type="text" placeholder="{{ __('from_city') }}">
            </div>

            <div class="col">
                <label>{{ __('to') }}</label>
                <input type="text" placeholder="{{ __('to_city') }}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label>{{ __('departure_date') }}</label>
                <input type="date">
            </div>

            <div class="col">
                <label>{{ __('return_date') }}</label>
                <input type="date">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label>{{ __('passengers') }}</label>
                <select>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>

            <div class="col">
                <label>{{ __('class') }}</label>
                <select>
                    <option>{{ __('economy') }}</option>
                    <option>{{ __('business') }}</option>
                </select>
            </div>
        </div>

        <button type="submit">{{ __('search_flights') }}</button>
    </form>

</div>

<script>
    const dropdown = document.querySelector('.lang-switch');
    const btn = dropdown.querySelector('button');
    const menu = dropdown.querySelector('ul');

    btn.addEventListener('click', () => {
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });

    // Click outside close
    document.addEventListener('click', function(e){
        if (!dropdown.contains(e.target)) {
            menu.style.display = 'none';
        }
    });
</script>
</body>
</html>

{{-- 

সংক্ষেপে

dropdown → পুরো language switcher container

btn → যেটায় click করলে dropdown open/close হবে

menu → dropdown list (ul), যেটা show/hide হবে
-----------------

document.querySelector('.lang-switch')

এটা HTML document থেকে .lang-switch class যুক্ত div কে select করছে।

অর্থাৎ পুরো language switcher container কে ধরছে।

এই variable পরে use করা হচ্ছে যাতে dropdown behavior control করা যায়। 

----
২️⃣ dropdown.querySelector('button')

dropdown এর ভেতরের button element select করছে।

আমাদের এখানে button হলো যে অংশে user ক্লিক করে, তারপর language list (ul) open/close হবে।
------
dropdown.querySelector('ul')

ul element select করছে, যেটা language options ধরে রাখে।
--}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <title>Language Project</title>

    <link rel="stylesheet" href="/css/app.css">

    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="/css/rtl.css">
    @endif
</head>

<body>

<div style="margin:20px;">
    <h1>{{ __('welcome') }}</h1>
    <button>{{ __('login') }}</button>
    <p>{{ __('dashboard') }}</p>

    <hr>

    <div>
        <a href="{{ url('lang/en') }}">
            <img src="/flags/en.png" width="20"> English
        </a>

        <a href="{{ url('lang/bn') }}">
            <img src="/flags/bn.png" width="20"> বাংলা
        </a>

        <a href="{{ url('lang/ar') }}">
            <img src="/flags/ar.png" width="20"> العربية
        </a>
    </div>
</div>

</body>
</html>

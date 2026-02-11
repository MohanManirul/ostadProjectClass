<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" 
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>Translation Example</title>
</head>
<body>
    <h1>Translation Examples</h1>

    <!-- 1️⃣ __() function -->
    <h2>1. __() function: {{ __('flight_booking') }}</h2>

    <!-- 2️⃣ @lang directive -->
    <h2>2. @lang directive: @lang('flight_booking')</h2>

    <!-- 3️⃣ trans() function -->
    <h2>3. trans() function: {{ trans('flight_booking') }}</h2>

    <!-- 4️⃣ trans_choice() function (pluralization) -->
    <h3>4. trans_choice() function:</h3>
    <p>{{ trans_choice('flight_count', 0) }}</p> <!-- No flights -->
    <p>{{ trans_choice('flight_count', 1) }}</p> <!-- One flight -->
    <p>{{ trans_choice('flight_count', 5) }}</p> <!-- 5 flights -->

    <!-- 5️⃣ @choice directive (Blade plural) -->
    <h3>5. @choice directive:</h3>
    <p>@choice('flight_count', 0)</p>
    <p>@choice('flight_count', 1)</p>
    <p>@choice('flight_count', 5)</p>

</body>
</html>

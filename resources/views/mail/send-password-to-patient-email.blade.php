<x-mail::message>
Hello {{ $user->full_name }},<br>
Your account has been created with the <b>{{ config('app.name') }}</b>.
Please visit us below to login and update your information on your health.
<br>
Use your email as user name and <b>{{ $password }}</b> as  password.

<x-mail::button :url="$loginUrl">
Click here to visit
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

<x-mail::message>
Hello Admin, 
A new caretaker has been Registered in the system with name {{ $user->full_name }}.
Please review the details below:
<x-mail::panel>
    <strong>Full Name:</strong> {{ $user->full_name }}<br>
    <strong>Email:</strong> {{ $user->email }}<br>
</x-mail::panel>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

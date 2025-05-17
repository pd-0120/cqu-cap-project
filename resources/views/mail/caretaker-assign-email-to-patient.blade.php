<x-mail::message>

Hello, {{ $patient->full_name  }}

It is informed to you that, a caretaker has been assign to you named as <b>{{ $caretaker->full_name  }}</b>.<br/>
Caretaker will contact you soon or will meet you at house.
You can contact them on {{ $caretaker->email }}
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

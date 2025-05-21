<x-mail::message>

	Hello, {{ $caretaker->full_name  }}

	It is informed to you that, a patient has been assign to you named as <b>{{ $patient->full_name  }}</b>.<br/>
	Please check and meet them at the allocated location.
	You can contact them on {{ $patient->email }}
	Thanks,<br>
	{{ config('app.name') }}
</x-mail::message>

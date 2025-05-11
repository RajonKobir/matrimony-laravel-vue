<x-mail::message>
# {!! $mailData['subject'] !!}

{!! $mailData['message'] !!}

<x-mail::button :url="config('app.url') . '/login'">
    Login To Shadibari
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

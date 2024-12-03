<x-mail::message>
# {!! $mailData['subject'] !!}

{!! $mailData['message'] !!}

<x-mail::button :url="'https://shadibari.com'">
Go To Our Site
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

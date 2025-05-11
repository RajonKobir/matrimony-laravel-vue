<x-mail::message>
# {!! $mailData['subject'] !!}

{!! $mailData['message'] !!}

<x-mail::button :url="config('app.url') . '/biodata_search?codeNumber=' . $mailData['name'] . '&searchNumber=2'">
    {{ $mailData['name'] }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

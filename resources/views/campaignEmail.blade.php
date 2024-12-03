@component('mail::message')
    {!! $mailData['message'] !!}

    Thanks,
    {{ config('app.name') }}
@endcomponent

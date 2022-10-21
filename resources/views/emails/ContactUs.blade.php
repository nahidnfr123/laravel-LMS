{{--@component('mail::message')--}}
    @component('mail::panel')
        <p><b>Hello, </b> {!! $contact->name !!}!</p><br>
        <br>
        <div class="text-justify">
            <div>{!! $message !!}</div>
        </div>
    @endcomponent

    @component('mail::panel')
        @php
            $url = route('home');
        @endphp
        @component('mail::button', ['url' => $url, 'color' => 'green'])
            Go back to website
        @endcomponent
    @endcomponent

    @component('mail::panel')
        <h3>Thanks for getting connected to us,<br>
            {{ config('app.name') }}
        </h3>
    @endcomponent
{{--@endcomponent--}}

@component('mail::message')
# One last Step

We just need you to confirm you email address to prove that you're a human. You get it, right? cool.

@component('mail::button', ['url' => '#'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

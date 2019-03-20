@component('mail::message')
# Reset Account
    welcome to {{$data['data']->name}}
The body of your message.

@component('mail::button', ['url' => 'admin/reset/password/'.$data['token']])
reset password
@endcomponent
or
Copy this link

<a href="{{url('admin/reset/password/'.$data['token'])}}">{{url('admin/reset/password/'.$data['token'])}}</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent

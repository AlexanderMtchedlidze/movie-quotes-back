@php
    $url = str_replace(config('app.url'), config('app.vite_app_url'), $url);
@endphp

<x-ui.base-email :user-name="$userName" :url="$url">
    <x-slot:text>Please click the button below to reset your password:</x-slot:text>
    <x-slot:linkText>Reset Password</x-slot:linkText>
</x-ui.base-email>

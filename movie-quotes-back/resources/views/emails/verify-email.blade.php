@php
    $url = str_replace(config('app.url'), config('app.vite_app_url'), $url);
@endphp

<x-ui.base-email :user-name="$userName" :url="$url">
    <x-slot:text>Thanks for joining Movie quotes! We really appreciate it. Please click the button below to verify your account:</x-slot:text>
    <x-slot:linkText>Verify Account</x-slot:linkText>
</x-ui.base-email>

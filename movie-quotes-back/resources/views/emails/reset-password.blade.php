@php
$fullUrl = $url . '?email=' . $email
@endphp

<x-ui.base-email :user-name="$userName" :url="$fullUrl">
    <x-slot:text>Please click the button below to reset your password:</x-slot:text>
    <x-slot:linkText>Reset Password</x-slot:linkText>
</x-ui.base-email>

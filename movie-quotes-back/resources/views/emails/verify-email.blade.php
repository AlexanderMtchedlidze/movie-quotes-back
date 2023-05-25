<style>
    .paragraph__main {
        margin-bottom: 3.2rem;
    }

    .verify__link {
        padding: 0.7rem 1.3rem;
        background-color: #E31221;
        color: white;
        border-radius: 4px;
    }
</style>

<x-ui.base-email :user-name="$userName" :url="$url">
    <p class="paragraph__main">Thanks for joining Movie quotes! We really appreciate it. Please click the button below to verify your account:</p>
    <a class="verify__link" href="{{ $url }}">Verify Account</a>
</x-ui.base-email>

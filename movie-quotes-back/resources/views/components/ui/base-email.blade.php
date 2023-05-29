@props(['$userName', 'url'])
<style>
    html {
        font-size: 10px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-weight: normal;
    }

    body {
        background-color: #11101A;
        color: white;
        width: 70%;
        margin: 0 auto;
        padding: 8rem 0;
        font-size: 1.6rem;
        font-family: 'Arial', monospace;
    }

    header {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        margin-bottom: 8rem;
    }

    h1 {
        color: #DDCCAA;
        text-transform: uppercase;
        font-size: 1.2rem;
        text-align: center;
        font-weight: 500;
    }

    h4 {
        font-size: 1.6rem;
        margin-bottom: 2.4rem;
    }

    .paragraph__helper, .paragraph__footer {
        margin-bottom: 2.4rem;
    }


    a {
        text-decoration: none;
        display: inline-block;
        margin-bottom: 4rem;
    }

    .verify__link-helper {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #DDCCAA;
    }

    .mail__link {
        color: white
    }

    img {
        width: 2.2rem;
        height: 2.2rem;
    }

    .paragraph__footer {
        display: inline;
    }

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

<html lang="en">
<head>
    <title>Movie Quotes</title>
    <link href="https://fonts.googleapis.com/css?family=Arial" rel="stylesheet">
</head>
<body>
<header>
    <img src="https://i.ibb.co/8MkTr2k/Vector.png" alt="Movie quotes icon">
    <h1>movie quotes</h1>
</header>
<main>
    <h4>Hola {{ $userName }}!</h4>
    <div>
        <p class="paragraph__main">{{ $text }}</p>
        <a class="verify__link" href="{{ $url }}">{{ $linkText }}</a>
    </div>
    <div>
        <p class="paragraph__helper">If clicking doesn't work, you can try copying and pasting it to your browser:</p>
        <a class="verify__link-helper" href="{{ $url }}">{{ $url }}</a>
    </div>
</main>
<footer>
    <p class="paragraph__footer">If you have any problems, please contact us:</p>
    <a class="mail__link" href="mailto:support@moviequotes.ge">support@moviequotes.ge</a>
    <p>MovieQuotes Crew</p>
</footer>
</body>
</html>

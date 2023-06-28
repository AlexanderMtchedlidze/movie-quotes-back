<html lang="en">
<head>
    <title>Movie Quotes</title>
    <link href="https://fonts.googleapis.com/css?family=Arial" rel="stylesheet">
</head>
<body style="background-color: #11101A; color: white; padding: 4rem 8rem; font-size: 16px; font-family: 'Arial', monospace;">
<header style="margin-bottom: 80px;">
    <img src="https://i.ibb.co/8MkTr2k/Vector.png" alt="Movie quotes icon" style="width: 22px; height: 22px; margin: 0 auto; display: block">
    <h1 style="color: #DDCCAA; text-transform: uppercase; font-size: 12px; text-align: center; font-weight: 500; margin: 10px auto 0 auto;">movie quotes</h1>
</header>
<main>
    <h4 style="font-size: 16px; margin-bottom: 24px; color: white">Hola {{ $userName }}!</h4>
    <div>
        <p class="paragraph__main" style="margin-bottom: 32px; color: white">{{ $text }}</p>
        <a class="verify__link" href="{{ $url }}" style="padding: 7px 13px; background-color: #E31221; color: white; border-radius: 4px; text-decoration: none; display: inline-block; margin-bottom: 40px;">{{ $linkText }}</a>
    </div>
    <div>
        <p class="paragraph__helper" style="margin-bottom: 24px; color: white">If clicking doesn't work, you can try copying and pasting it to your browser:</p>
        <a class="verify__link-helper" href="{{ $url }}" style="max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #DDCCAA; text-decoration: none; display: inline-block; margin-bottom: 40px;">{{ $url }}</a>
    </div>
</main>
<footer>
    <p class="paragraph__footer" style="display: inline; color: white">If you have any problems, please contact us:</p>
    <a class="mail__link" href="mailto:support@moviequotes.ge" style="color: white; text-decoration: none;">support@moviequotes.ge</a>
    <p style="color: white">MovieQuotes Crew</p>
</footer>
</body>
</html>

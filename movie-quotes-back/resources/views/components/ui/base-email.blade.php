<html lang="en">
<head>
    <title>Movie Quotes</title>
    <link href="https://fonts.googleapis.com/css?family=Arial" rel="stylesheet">
</head>
<body style="background-color: #11101A; color: white; width: 70%; margin: 0 auto; padding: 8rem 0; font-size: 16px; font-family: 'Arial', monospace;">
<header style="display: flex; flex-direction: column; align-items: center; gap: 10px; margin-bottom: 80px;">
    <img src="https://i.ibb.co/8MkTr2k/Vector.png" alt="Movie quotes icon" style="width: 2.2rem; height: 2.2rem;">
    <h1 style="color: #DDCCAA; text-transform: uppercase; font-size: 12px; text-align: center; font-weight: 500;">movie quotes</h1>
</header>
<main>
    <h4 style="font-size: 16px; margin-bottom: 24px;">Hola {{ $userName }}!</h4>
    <div>
        <p class="paragraph__main" style="margin-bottom: 32px;">{{ $text }}</p>
        <a class="verify__link" href="{{ $url }}" style="padding: 7px 13px; background-color: #E31221; color: white; border-radius: 4px; text-decoration: none; display: inline-block; margin-bottom: 40px;">{{ $linkText }}</a>
    </div>
    <div>
        <p class="paragraph__helper" style="margin-bottom: 24px;">If clicking doesn't work, you can try copying and pasting it to your browser:</p>
        <a class="verify__link-helper" href="{{ $url }}" style="max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #DDCCAA; text-decoration: none; display: inline-block; margin-bottom: 40px;">{{ $url }}</a>
    </div>
</main>
<footer>
    <p class="paragraph__footer" style="display: inline;">If you have any problems, please contact us:</p>
    <a class="mail__link" href="mailto:support@moviequotes.ge" style="color: white; text-decoration: none;">support@moviequotes.ge</a>
    <p>MovieQuotes Crew</p>
</footer>
</body>
</html>

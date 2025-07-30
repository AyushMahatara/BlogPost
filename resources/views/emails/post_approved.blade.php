<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Post has been Approved</title>
</head>

<body>
    <h1>Your Post Has Been Approved!</h1>
    <p>Dear {{ $post->user->name }},</p>
    <p>We're excited to inform you that your post titled <strong>{{ $title }}</strong> has been approved!</p>
    <p>Here is the content of your post:</p>
    <blockquote>
        {{ $content }}
    </blockquote>
    <p>Thank you for contributing to our platform!</p>
</body>

</html>

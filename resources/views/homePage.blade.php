<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->

</head>

<body
    style="background-color: #FDFDFC; color: #1b1b18; display: flex; padding: 6px; justify-content: center; align-items: center; min-height: 100vh; flex-direction: column;">
    <div class="container">
        @forelse ($posts as $post)
        <div class="post" style="margin-bottom: 20px; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
            <h2 style="font-size: 24px; font-weight: bold;">{{ $post->title }}</h2>
            <p style="font-size: 16px; color: #555;">{!! str($post->content)->markdown()->sanitizeHtml() !!}</p>
            <p style="font-size: 14px; color: #999;">Posted by {{ $post->user->name }} on {{
                $post->created_at->format('M d, Y') }}</p>
        </div>
        @empty
        <p style="font-size: 18px; color: #999;">No posts available at the moment.</p>
        @endforelse
    </div>

</body>

</html>

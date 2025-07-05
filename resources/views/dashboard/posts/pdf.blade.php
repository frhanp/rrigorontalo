<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
        }

        h1 {
            font-size: 24px;
        }

        .meta {
            color: #555;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .content {
            text-align: justify;
        }
    </style>
</head>

<body>
    <h1>{{ $post->title }}</h1>
    <p class="meta">
        <strong>Penulis:</strong> {{ $post->user->name }} <br>
        <strong>Kategori:</strong> {{ $post->category->name }} <br>
        <strong>Dibuat pada:</strong> {{ $post->created_at->format('d F Y H:i') }}
    </p>
    <hr>
    <div class="content">
        {!! $post->content !!}
    </div>
</body>

</html>

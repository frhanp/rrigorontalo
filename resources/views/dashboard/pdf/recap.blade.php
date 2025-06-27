<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rekap Laporan Berita</title>
    <style>
        @page { margin: 1in; }
        body { 
            font-family: 'DejaVu Sans', sans-serif; 
            font-size: 11pt; 
            line-height: 1.5; 
            color: #212529; 
        }
        .cover-page {
            text-align: center;
            page-break-after: always;
        }
        .cover-page h1 { font-size: 26pt; margin-top: 2.5in; margin-bottom: 0; }
        .cover-page h2 { font-size: 18pt; color: #0d6efd; margin-top: 0.25in; }
        .cover-page p { font-size: 14pt; margin-top: 1in; }
        .article {
            /* Hindari konten terpotong antar halaman jika memungkinkan */
            page-break-inside: avoid;
        }
        .article-title { font-size: 20pt; font-weight: bold; margin-bottom: 0.1in; color: #000; }
        .article-meta { font-size: 9pt; color: #6c757d; margin-bottom: 0.3in; border-bottom: 1px solid #dee2e6; padding-bottom: 0.2in; }
        .article-content { text-align: justify; }
        .page-break { page-break-after: always; }
        .footer { position: fixed; bottom: -0.5in; left: 0; right: 0; height: 0.5in; text-align: center; font-size: 8pt; color: #777; }
        p { margin: 0 0 1em 0; }
        ul, ol { padding-left: 20px; }
        li { margin-bottom: 0.5em; }
    </style>
</head>
<body>

    <div class="footer">
        Rekap Berita RRI Gorontalo - Dicetak pada {{ now()->format('d F Y, H:i:s') }}
    </div>

    <div class="cover-page">
        <h1>REKAPITULASI BERITA</h1>
        <h2>PORTAL INTERNAL RRI GORONTALO</h2>
        <p>
            <strong>Filter Kategori:</strong> {{ $categoryName }}<br>
            <strong>Filter Waktu:</strong> {{ $monthName }}
        </p>
        <p>Total Berita Direkap: {{ $posts->count() }}</p>
    </div>

    @foreach ($posts as $post)
        <div class="article">
            <h2 class="article-title">{{ $post->title }}</h2>
            <div class="article-meta">
                <strong>Penulis:</strong> {{ $post->user->name }} | 
                <strong>Kategori:</strong> {{ $post->category->name }} | 
                <strong>Diterbitkan:</strong> {{ $post->created_at->format('d F Y') }}
            </div>
            <div class="article-content">
                {{-- Menampilkan konten HTML dari Rich Text Editor --}}
                {!! $post->content !!}
            </div>
        </div>

        {{-- Tambahkan pemisah halaman, kecuali untuk berita terakhir --}}
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>
</html>
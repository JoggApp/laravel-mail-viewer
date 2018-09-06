<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Mail Viewer</title>

    <style>
        ol {
            list-style: none;
            counter-reset: mv-counter;
        }
        li {
            counter-increment: mv-counter;
            margin: 0.25rem;
        }
        li::before {
            content: counter(mv-counter);
            background: #662974;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: inline-block;
            line-height: 2rem;
            color: white;
            text-align: center;
            margin-right: 0.5rem;
        }
        body {
            font-family: 'PT Serif', serif;
        }
    </style>
</head>
<body>
    @if(empty($mails))
        <p>There are no mails</p>
    @else
        <ol>
        @foreach($mails as $mail)
            <li><a href="{{ route('mv-mailviewer', $mail) }}">{{ $mail }}</a></li>
        @endforeach
        </ol>
    @endif
</body>
</html>
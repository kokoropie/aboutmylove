<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title }}{{ (isset($system->title) ? " | {$system->title}" : "") }}</title>
<link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}">
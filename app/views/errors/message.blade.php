@extends('template.main')
@section('content')
<br><br><br>
 <p>{{ $message }}</p>
 
        @if ($redirect)
        <script type="application/javascript">
            setTimeout(
                function() {
                    location.href = '{{ $redirect }}';
                },
                10000
            );
        </script>
        <p class="like-h">Нажмите <a href="{{ $redirect }}">эту ссылку</a>, если ваш браузер не поддерживает автоматический редирект.</p>
        @endif

@stop
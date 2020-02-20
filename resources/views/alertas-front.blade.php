@foreach ($alertas as $alerta)
    <div class="alert bg-{{ $alerta->color }} text-white alert-styled-right alert-dismissible">
        <span class="font-weight-semibold">{{ $alerta->title }}</span> 
        <p>
            {!! nl2br($alerta->body) !!}
        </p>
    </div>
@endforeach

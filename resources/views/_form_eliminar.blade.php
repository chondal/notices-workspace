<a href="javascript:document.getElementById('form-{{$p->id}}').submit();" onclick="return confirm('¿Seguro desea eliminar?')"><i class="mi-close mi-size-24"></i></a>
<form id="form-{{$p->id}}" action="{{ route('noticesWorkspace.destroy',$p) }}" method="post" style="display:inline">
    @csrf
    {{ method_field('DELETE')}}
    {{--  <button onclick="return confirm('¿Seguro desea eliminar?')" type="submit"><i class="mi-close mi-size-24"></i></button>  --}}
</form>
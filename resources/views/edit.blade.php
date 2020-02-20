@extends('admin.intranet.layout.app')

@section('title', 'Alertas')

@section('content')

    {{-- Page header --}}
    <div class="page-header page-header-light">
        {{-- Título, Subtítulo, Iconos --}}
        <div class="page-header-content header-elements-md-inline">    
            @include('admin.intranet.layout.includes.title', [
                'title' => 'Alertas', 
                'subtitle' => 'Editar Alerta', 
                'icons' => array(
                )
            ])
        </div>

        {{-- Breadcrumb  --}}
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            @include('admin.intranet.layout.includes.breadcrumb', [ 
                'links' => array(
                        ['url' => route('noticesWorkspace.index'), 'icon' => 'icon-home2', 'name' => 'Alertas'],
                        ['url' => '#', 'icon' => null, 'name' => 'Ver Alerta']
                    )
            ])
        </div>
    </div>
    {{-- /page header --}}

    {{-- Content area --}}
    

    {{-- Content area --}}

    <div class="content">
        @include('flash::message')

        <div class="card">
            <div class="card-body">
    <form action="{{ route('noticesWorkspace.update',$alerta) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group row">
                <label class="col-form-label col-md-2">Titulo de la alerta.</label>
                <div class="col-md-10">
                    <input type="text" name="title" class="form-control" placeholder="Ingrese el titulo de la promoción" value="{{ $alerta->title }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-2">Link.</label>
                <div class="col-md-10">
                    <input type="text" name="link" class="form-control" placeholder="Ingrese la URL de lo que quiere mostrar" value="{{ $alerta->link }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-2">Contenido.</label>
                <div class="col-md-10">
                    <textarea name="body" id="" cols="30" rows="5" class="form-control" placeholder="Ingrese la descripción de lo que veran los usuarios">{{ $alerta->body }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group row">
                <label class="col-form-label col-md-2">DESDE</label>
                <div class="col-md-10">
                    <input type="date" name="desde" id="" class="form-control" value="{{ $alerta->desde->format('Y-m-d') }}">
                </div>
            </div>
        </div>
    
        <div class="col-lg-6">
            <div class="form-group row">
                <label class="col-form-label col-md-2">HASTA</label>
                <div class="col-md-10">
                    <input type="date" name="hasta" id="" class="form-control" value="{{ $alerta->hasta->format('Y-m-d') }}">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group row">
                <label class="col-form-label col-md-2">Color de Fondo <a class="btn" data-popup="popover" title="Color de fondo para los baners y para los carteles" data-html="true" data-content="<img style='width:250px' src='{{ asset('img/admin/muestras/banerPromo.png') }}'>" data-original-title=""><i class="icon-question3 ml-2"></i></a></label>
                <div class="col-md-10">
                    <select class="form-control" name="color" id="">
                        <option value="">Seleccionar Color</option>
                        <option {{ NoticeWorkspace::ComboCheck($alerta->color, 'info') }} value="info">Celeste</option>
                        <option {{ NoticeWorkspace::ComboCheck($alerta->color, 'success') }} value="success">Verde</option>
                        <option {{ NoticeWorkspace::ComboCheck($alerta->color, 'warning') }} value="warning">Naranja</option>
                        <option {{ NoticeWorkspace::ComboCheck($alerta->color, 'danger') }} value="danger">Rojo</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group row">
                <label class="col-form-label col-md-2">Seccion a mostrar </label>
                <div class="col-md-10">
                    <select class="form-control" name="seccion" id="">
                        <option value="">Seleccionar Seccion donde se muestra</option>
                        @foreach (config('notices-workspace.workspaces') as $item)
                            <option {{ NoticeWorkspace::ComboCheck($alerta->seccion, $item) }} value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            @include('admin.common.includes._form_buttons', [
                'block' => 'btn-block',
                'type' => 'update'
            ])
        </div>
    </div>    
    </form>


            </div>
        </div>
    </div>
    
    
    
    

    {{-- /content area --}}
@endsection


@push('scripts')
    
<!-- Load base -->
<script type="text/javascript" src="{{ asset('limitless/global_assets/js/plugins/pickers/pickadate/picker.js') }}"></script>

<!-- Load date picker -->
<script type="text/javascript" src="{{ asset('limitless/global_assets/js/plugins/pickers/pickadate/picker.date.js') }}"></script>

<!-- Load time picker -->
<script type="text/javascript" src="{{ asset('limitless/global_assets/js/plugins/pickers/pickadate/picker.time.js') }}"></script>

<script>
    
    $('.pickadate').pickadate({
        format: 'dd/mm/yyyy',
    });

</script>
@endpush


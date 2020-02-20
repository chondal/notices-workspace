@extends('admin.intranet.layout.app')

@section('title', 'Alertas')

@section('content')

    {{-- Page header --}}
    <div class="page-header page-header-light">
        {{-- Título, Subtítulo, Iconos --}}
        <div class="page-header-content header-elements-md-inline">    
            @include('admin.intranet.layout.includes.title', [
                'title' => 'Alertas', 
                'subtitle' => 'Listado', 
                'icons' => array(
                    ['img' => 'icon-users', 'name' => 'Usuarios', 'url' => route('intranet.usuarios.index')],
                    ['img' => 'icon-copy', 'name' => 'Presupuestos', 'url' => route('presupuestos.index')],
                )
            ])
        </div>

        {{-- Breadcrumb  --}}
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            @include('admin.intranet.layout.includes.breadcrumb', [ 
                'links' => array(
                        ['url' => '#', 'icon' => 'icon-home2', 'name' => 'Principal'],
                        ['url' => '#', 'icon' => null, 'name' => 'Home']
                    )
            ])
        </div>
    </div>
    {{-- /page header --}}

    {{-- Content area --}}
    

    {{-- Content area --}}
    <div class="content">
        @include('flash::message')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                            <h5 class="card-title">Crear Nueva Alerta</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
                        </div>
                    <div class="card-body">
                        <p>
                            Aquí podra crear alertas que van a estar disponibles en los diferentes espacios. Ejemplo:
                        </p>
                                    <div class="col-lg-12">
                                        <div id="muestraColor" class="alert bg-warning text-white alert-styled-right alert-dismissible">
                                            <span id="mostrarTitulo" class="font-weight-semibold">TITULO DE LA ALERTA</span> 
                                            <p id="mostrarContenido">
                                                Esto es el contenido de la alerta
                                            </p>
                                        </div>
                                    </div>
                        <form action="{{ route('noticesWorkspace.store') }}" method="post" autocomplete="off">
                            @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Titulo de la Alertas.</label>
                            <div class="col-md-10">
                                <input id="titulo" type="text" name="title" class="form-control" placeholder="Ingrese el titulo de la alerta">
                             {{ Validation::DisplayError($errors, 'title') }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Color.</label>
                            <div class="col-md-10">
                                <select name="color" class="form-control" id="color">
                                    <option value="">Seleccionar Color</option>
                                    <option value="info">Celeste</option>
                                    <option value="success">Verde</option>
                                    <option value="warning">Naranja</option>
                                    <option value="danger">Rojo</option>
                                </select>
                                {{ Validation::DisplayError($errors, 'body') }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Contenido.</label>
                            <div class="col-md-10">
                                <textarea name="body" id="contenido" cols="30" rows="5" class="form-control" placeholder="Ingrese contenido de la alerta"></textarea>
                                {{ Validation::DisplayError($errors, 'body') }}
                            </div>
                        </div>
                        @include('admin.common.includes._form_buttons', [
                            'block' => 'btn-block',
                            'type' => 'create'
                        ])
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="mi-format-list-numbered"></i> Listado de Alertas
                </h5>
                <hr>
            </div>
            <div class="card-body">

                <table class="table table-hover" id="listar-promos">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titulo</th>
                            <th>Contenido</th>
                            <th>Alerta Vigente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alertas as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->title }}</td>
                            <td>{{ $p->body }}</td>
                            <td>{{ $p->estado() }}</td>
                            <td>
                                <a href="{{ route('noticesWorkspace.edit', $p) }}"><i class="mi-mode-edit mi-size-24"></i> </a>
                                @include('NoticesWorkspace::_form_eliminar')  
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No se encontraron registros.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table> 

           </div>
        </div>





    </div>



    {{-- /content area --}}
@endsection


@push('scripts')
    <script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){

            $("#titulo").keyup(function () {
                if ($(this).val().length === 0) {
                    var value = 'TITULO DE LA ALERTA';
                }
                else {
                    var value = $(this).val();
                }
                $("#mostrarTitulo").text(value);
            }).keyup();

            $('#color').on('change', function (e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                $("#muestraColor").attr('class', 'alert bg-'+valueSelected+' text-white alert-styled-right alert-dismissible');
            });

            $("#contenido").keyup(function () {
                if ($(this).val().length === 0) {
                    var value = 'Esto es el contenido de la alerta';
                }
                else {
                    var value = $(this).val();
                }
                var myLineBreak = value.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br/>');
                $("#mostrarContenido").html(myLineBreak);
            }).keyup();


            $('#listar-promos').dataTable({
                language: datatableLang,
                responsive: true,
            });
        });
    </script>
@endpush
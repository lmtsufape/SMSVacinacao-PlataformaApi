<script>
    $(document).ready(function($) {
        var table = $('#alltable').DataTable({
            "responsive": true,
            "language": {
                "lengthMenu": "Exibir _MENU_ registros por página",
                "zeroRecords": "Nada encontrado - desculpe",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ total de registros)"
            },
            'columnDefs': [{
                'targets': 0,
                'checkboxes': {
                    'selectRow': true,
                    'selectAllCallback': function(nodes, selected) {
                        selected ? $("#delegar").removeAttr('disabled') : $("#delegar").attr('disabled', true);
                    }
                }
            }, ],
            'select': {
                'style': 'multi'
            },
            'order': [
                [1, 'asc']
            ],
        });

        $("#delegar").click(function(e) {
            $.get("{{action('AgenteController@list')}}?json=true", function(data, status) {
                $("#agente").html('');
                $.each(data, function() {
                    $("#agente").append($("<option/>").val(this.id).text(this.nome));
                });
            });
        });

        $("#delegar-modal-button").click(function() {
            var selectComponent = $("#agente").children("option:selected");
            var selected = selectComponent.val();
            var checks = Array.from(table.column(0).checkboxes.selected());

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            console.log('checks', checks)

            $url = "{{action('AgendamentoController@createMultiple')}}/" + selected + "?json=true";
            console.log("sl", $url);
            $.post($url, {
                agenteChefe: "{{ Auth::user()->id }}",
                solicitacoes: checks,
            }, function(data, status) {
                console.log("res", data);
            });

            $("#modal-delegar").modal('hide');
            setTimeout(() => {
                alert(`Você delegou ${checks.length} solicitações para ${selectComponent.text()}`);
                window.location.href = "{{action('SolicitacaoController@list')}}";
            }, 100);

        });

        $(".location").click(function() {
            console.log($(this).data("lat"));
            let lat = $(this).data("lat");
            let lng = $(this).data("lng");
            navigator.geolocation.getCurrentPosition(function(position) {
                window.open(
                    `https://www.google.com/maps/dir/?api=1&origin=${position.coords.latitude},${position.coords.longitude}&destination=${lat},${lng}`,
                    '_blank' // <- This is what makes it open in a new window.
                );
            });
        });
    });
</script>
<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="h4">Todos as Solicitações</div>
        <div class="btn-toolbar mb-2 mb-md-0">
            @can('create', App\Agendamento::class)
            <button data-toggle="modal" data-target="#modal-delegar" disabled id="delegar" class="btn btn-sm btn-primary pt-2 ml-2">
                <span data-feather="arrow-up-right" stroke="#fff"></span> Delegar
            </button>
            @endcan
            <a href="{{action('SolicitacaoController@list')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="rotate-ccw"></span> Atualizar
            </a>
            <div class="modal fade " id="modal-delegar" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Delegação de solicitações</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <dl class="row pl-2 pr-2 ">
                                <label for="desc">Selecione o agente</label>
                                <select id="agente" class="form-control agente" name="agente">
                                </select>
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close" href="">Cancelar</a>
                            <button id="delegar-modal-button" class="btn btn-primary btn-sm">Delegar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <table id="alltable" class="table table-striped table-sm display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Id</th>
                <th>Paciente</th>
                <th>Campanha</th>
                <th>Status</th>
                <th>Agente</th>
                <th>Momento</th>
                <th width="20%">Opções</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($objs as $obj)
            <tr>
                <td>{{$obj->id}}</td>
                <td>{{$obj->id}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="text-wrap">{{$obj->paciente->nome}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="text-wrap">Campanha {{$obj->campanhaidadepublico->campanha->nome}}, Púlico {{$obj->campanhaidadepublico->publico->nome}}, Grupo {{$obj->campanhaidadepublico->idade->grupo}} de {{$obj->campanhaidadepublico->idade->idade_ini}} à {{$obj->campanhaidadepublico->idade->idade_end}}</td>
                @if ($obj->status == 'Aceito')
                <td style="color:#388E8E;" data-toggle="modal" data-target="#modalAt{{$loop->iteration}}">{{$obj->status}}</td>
                @elseif ($obj->status == 'Recusado')
                <td style="color:#ff1919;" data-toggle="modal" data-target="#modalAt{{$loop->iteration}}">{{$obj->status}}</td>
                @elseif ($obj->status == 'Vacinado')
                <td style="color:#32CD32;" data-toggle="modal" data-target="#modalAt{{$loop->iteration}}">{{$obj->status}}</td>
                @else
                <td style="color:#ffbf00;" data-toggle="modal" data-target="#modalAt{{$loop->iteration}}">{{$obj->status}}</td>
                @endif
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="text-wrap">@if(isset($obj->agente->nome)){{$obj->agente->nome}} @endif</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="text-wrap">{{$obj->data_time}}</td>
                <td>
                    <div class="d-flex justify-content-around flex-wrap">
                        <div class="d-flex flex-column justify-content-center ">
                            <a href="tel:{{$obj->paciente->tel}}" class="btn btn-primary btn-sm mb-1 mr-1">Ligar</a>
                            <a data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="btn btn-info btn-sm">Detalhes</a>
                        </div>
                        @can('create', App\Agendamento::class)
                        <div class="d-flex flex-column ">
                            <form class="form-soft aceitar{{$obj->id}} mb-1 mr-1" action="{{action('SolicitacaoController@aceitar', $obj->id)}}" method="post">
                                @method('post')
                                @csrf
                                <a href="" class="btn btn-primary btn-sm {{($obj->agente? 'disabled' : '')}}" onclick="if(confirm('Deseja realmente aceitar a solicitação de {{$obj->paciente->nome}}?')){this.closest('form.aceitar{{$obj->id}}').submit(); return false;}else{return false}">
                                    Aceitar
                                </a>
                            </form>
                            <a data-toggle="modal" data-target="#modal-r{{$loop->iteration}}" href="" class="btn btn-danger btn-sm {{($obj->agente? 'disabled' : '')}}">
                                Recusar
                            </a>
                        </div>
                        @endcan
                        <div class="d-flex flex-column ">
                            <form class="form-soft atender{{$obj->id}} mb-1 mr-1 " action="{{action('SolicitacaoController@atender', $obj->id)}}" method="post">
                                @method('post')
                                @csrf
                                <a href="" class="btn btn-success btn-sm {{($obj->status === 'Aceito' ? '' : 'disabled')}}" onclick="if(confirm('Deseja realmente atender a solicitação de {{$obj->paciente->nome}}?')){this.closest('form.atender{{$obj->id}}').submit(); return false;}else{return false}">
                                    Vacinar
                                </a>
                            </form>
                            <button data-lat="{{$obj->paciente->lat}}" data-lng="{{$obj->paciente->lng}}" class="btn btn-info btn-sm location ">Ir até</button>
                        </div>

                    </div>
                </td>
            </tr>
            <div class="modal fade " id="modal-r{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="false">
                <form class="form-soft recusar{{$obj->id}}" action="{{action('SolicitacaoController@recusar', $obj->id)}}" method="post">
                    @method('post')
                    @csrf
                    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Motivo da recusa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <dl class="row pl-2 pr-2 ♦">
                                    <label for="desc">Descrição</label>
                                    <textarea class="form-control" id="desc" name="desc" rows="6"></textarea>
                                </dl>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close" href="">Cancelar</a>
                                <button type="submit" class="btn btn-danger btn-sm">Recusar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal fade bd-example-modal-lg" id="modal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes do Paciente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <dl class="row mt-3 pt-3 pl-2 ">
                                <dt class="h4 col-sm-3">Nome:</dt>
                                <dd class="h4 col-sm-9">{{$obj->paciente->nome}}</dd>
                                <dt class="h4 col-sm-3">CNS:</dt>
                                <dd class="h4 col-sm-9">{{$obj->paciente->cns}}</dd>
                                <dt class="h4 col-sm-3">Telefone:</dt>
                                <dd class="h4 col-sm-9"><a href="tel:{{$obj->paciente->tel}}">{{$obj->paciente->tel}}</a> <a href="tel:{{$obj->paciente->tel}}" class="btn btn-primary btn-sm">Ligar</a></dd>
                                <dt class="h4 col-sm-3">Endereço:</dt>
                                <dd class="h4 col-sm-9">Rua {{$obj->paciente->rua}}, Bairro: {{$obj->paciente->bairro}}</dd>
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
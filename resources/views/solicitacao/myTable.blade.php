<script>
    $(document).ready(function($) {
        var table = $('#mytable').DataTable({
            "responsive": true,
            "language": {
                "lengthMenu": "Exibir _MENU_ registros por página",
                "zeroRecords": "Nada encontrado - desculpe",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ total de registros)"
            },
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
        <div class="h4">Minhas Solicitações</div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a id="myTableUpdate" href="{{action('SolicitacaoController@list')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="rotate-ccw"></span> Atualizar
            </a>
        </div>
    </div>

    <table id="mytable" class="table table-striped table-sm display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Paciente</th>
                <th>Campanha</th>
                <th>Status</th>
                <th>Delegado Por</th>
                <th>Agente</th>
                <th>Momento</th>
                <th width="20%">Opções</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($objsAt as $objAt)
            <tr>
                <td>{{$objAt->id}}</td>
                <td data-toggle="modal" data-target="#modalAt{{$loop->iteration}}" class="text-wrap">{{$objAt->paciente->nome}}</td>
                <td data-toggle="modal" data-target="#modalAt{{$loop->iteration}}" class="text-wrap">Campanha {{$objAt->campanhaidadepublico->campanha->nome}}, Público {{$objAt->campanhaidadepublico->publico->nome}}, Grupo {{$objAt->campanhaidadepublico->idade->grupo}} de {{$objAt->campanhaidadepublico->idade->idade_ini}} à {{$objAt->campanhaidadepublico->idade->idade_end}} {{$objAt->campanhaidadepublico->idade->mes?'meses':'anos'}}</td>
                @if ($objAt->status == 'Aceito')
                <td style="color:#388E8E;" data-toggle="modal" data-target="#modalAt{{$loop->iteration}}">{{$objAt->status}}</td>
                @elseif ($objAt->status == 'Recusado')
                <td style="color:#ff1919;" data-toggle="modal" data-target="#modalAt{{$loop->iteration}}">{{$objAt->status}}</td>
                @elseif ($objAt->status == 'Vacinado')
                <td style="color:#32CD32;" data-toggle="modal" data-target="#modalAt{{$loop->iteration}}">{{$objAt->status}}</td>
                @else
                <td style="color:#ffbf00;" data-toggle="modal" data-target="#modalAt{{$loop->iteration}}">{{$objAt->status}}</td>
                @endif
                <td data-toggle="modal" data-target="#modalAt{{$loop->iteration}}" class="text-wrap">{{$objAt->chiefAgent_nome}}</td>
                <td data-toggle="modal" data-target="#modalAt{{$loop->iteration}}" class="text-wrap">@if(isset($objAt->agente->nome)){{$objAt->agente->nome}} @endif</td>
                <td data-toggle="modal" data-target="#modalAt{{$loop->iteration}}" class="text-wrap">{{$objAt->data_time}}</td>
                <td>
                    <div class="d-flex justify-content-around flex-wrap">
                        <div class="d-flex flex-column justify-content-center mt-1">
                            <a href="tel:{{$objAt->paciente->tel}}" class="btn btn-primary btn-sm mb-1 mr-1">Ligar</a>
                            <a data-toggle="modal" data-target="#modalAt{{$loop->iteration}}" class="btn btn-info btn-sm">Detalhes</a>
                        </div>
                        @can('create', App\Agendamento::class)
                        <div class="d-flex flex-column mt-1">
                            <form class="form-soft aceitar{{$objAt->id}} mb-1 mr-1" action="{{action('SolicitacaoController@aceitar', $objAt->id)}}#my" method="post">
                                @method('post')
                                @csrf
                                <a href="" class="btn btn-primary btn-sm {{($objAt->agente? 'disabled' : '')}}" onclick="if(confirm('Deseja realmente aceitar a solicitação de {{$objAt->paciente->nome}}?')){this.closest('form.aceitar{{$objAt->id}}').submit(); return false;}else{return false}">
                                    Aceitar
                                </a>
                            </form>
                            <a data-toggle="modal" data-target="#modalAt-r{{$loop->iteration}}" href="" class="btn btn-danger btn-sm {{($objAt->agente? 'disabled' : '')}}">
                                Recusar
                            </a>
                        </div>
                        @endcan
                        <div class="d-flex flex-column mt-1">
                            <form class="form-soft atender{{$objAt->id}} mb-1 mr-1" action="{{action('SolicitacaoController@atender', $objAt->id)}}" method="post">
                                @method('post')
                                @csrf
                                <a href="" class="btn btn-success btn-sm {{($objAt->status === 'Aceito' ? '' : 'disabled')}}" onclick="if(confirm('Deseja realmente atender a solicitação de {{$objAt->paciente->nome}}?')){this.closest('form.atender{{$objAt->id}}').submit(); return false;}else{return false}">
                                    Vacinar
                                </a>
                            </form>
                            <button data-lat="{{$objAt->paciente->lat}}" data-lng="{{$objAt->paciente->lng}}" class="btn btn-info btn-sm location">Ir até</button>
                        </div>

                    </div>
                </td>
            </tr>
            <div class="modal fade " id="modalAt-r{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="false">
                <form class="form-soft recusarAt{{$objAt->id}}" action="{{action('SolicitacaoController@recusar', $objAt->id)}}" method="post">
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
                                <dl class="row pl-2 pr-2">
                                    <label for="desc">Descrição</label>
                                    <textarea class="form-control" id="desc" name="desc" required rows="6"></textarea>
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
            <div class="modal fade bd-example-modal-lg" id="modalAt{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="false">
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
                                <dd class="h4 col-sm-9">{{$objAt->paciente->nome}}</dd>
                                <dt class="h4 col-sm-3">CNS:</dt>
                                <dd class="h4 col-sm-9">{{$objAt->paciente->cns}}</dd>
                                <dt class="h4 col-sm-3">Telefone:</dt>
                                <dd class="h4 col-sm-9"><a href="tel:{{$objAt->paciente->tel}}">{{$objAt->paciente->tel}}</a> <a href="tel:{{$objAt->paciente->tel}}" class="btn btn-primary btn-sm">Ligar</a></dd>
                                <dt class="h4 col-sm-3">Endereço:</dt>
                                <dd class="h4 col-sm-9">Rua {{$objAt->paciente->rua}}, Bairro: {{$objAt->paciente->bairro}}</dd>
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
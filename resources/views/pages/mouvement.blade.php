@extends('template')

@section('contenu')
<div class="move-me">
    <div class="container">
        <div class="card" style="width: 900px; height : 500px">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Mouvement</h4>
                    <h6 class="card-subtitle">Liste de tous les mouvements</h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Motif</th>
                                    <th>Montant</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

    <div id="move-me">
        <div class="container">
            <div class="card" style="width: 380px">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive m-t-40">

                            <h4>Formulaire client</h4>
                            <form method='POST' action="{{ route('ajouter_mouvement') }}" id="formMouvement">
                                @csrf
                                <table>
                                    <tr>
                                        <td><input type="hidden" class="form-control" name="id_mouvement" id="idMouvement"></td>
                                    </tr>
                                    <tr>
                                        <td>Date mouvement :</td>
                                        <td><input type="date" class="form-control" name="date_mouvement" id="dateMouvement">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Motif :</td>
                                        <td><input type="text" class="form-control" name="motif_mouvement" id="motifMouvement">
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td>Total :</td>
                                        <td><input type="text" class="form-control" name="montant" id="montant">
                                        </td>
                                    </tr>
                                    <tr id="idEntre">
                                    </tr>
                                    <tr>
                                        <td><button type="submit" class="btn btn-outline-success" id="boutton">Enregistrer</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('script')
    <script>
        var table;
        $(document).ready(function(){
            table = $("#myTable").DataTable({
                "ajax" : {
                    "url" : '{{ route("lister_mouvement") }}',
                    "dataSrc" : "data"
                },
                "columns" : [
                    {data:"date_mouvement"},
                    {data:"motif_mouvement"},
                    {data:"montant"},
                    {data:"id_type"},
                    {data:"action"}
                ]
            });

            
        })

        $.ajax({
                        url : "{{ route('getIdType') }}",
                        type : 'get',
                        dataType : 'json',
                        success : function(data){
                            document.getElementById('idEntre').innerHTML = data;
                        },
                        error : function(error){
                            console.log(error.responseText);
                        }
                    });

        function modifier(id){
            if(id){
                $.ajax({
                    url : '{{ route("getMouvementById") }}',
                    type : 'post',
                    dataType : 'json',
                    data : {
                        _token : '{{ csrf_token() }}',
                        id_mouvement : id
                    },
                    success : function(response){
                        $("#idMouvement").val(id);
                        $("#dateMouvement").val(response.date_mouvement);
                        $("#motifMouvement").val(response.motif_mouvement);
                        $("#montant").val(response.montant);
                        $("#idType").val(response.id_type);
                        $("#boutton").text("Modifier");
                    }
                });
            }
        }

        function supprimer(id){
            if(id){
                if(confirm("Etes-vous sur de le supprimer?")){
                    $.ajax({
                        url : '{{ route("supprimer_mouvement") }}',
                        type : 'post',
                        dataType : 'json',
                        data : {
                            _token : '{{ csrf_token() }}',
                            id_mouvement : id
                        },
                        success : function (response) {
                            table.ajax.reload();                            
                        }
                    });
                }
            }
        }

        $("#formMouvement").unbind('submit').bind('submit', function () {
            var form = $(this);
            var date = $("#dateMouvement").val();
            var motif = $("#motifMouvement").val();
            var total = $("#montant").val();
            var idType = $("#idType").val();
            var url = ($("#boutton").text() == "Modifier") ? '{{ route("modifier_mouvement") }}' : '{{ route("ajouter_mouvement") }}';
            var ajout = ($("#boutton").text() == "Enregistrer") || ($("#boutton").text() == "Modifier" && $("#idMouvement").val()) ? true : false; 
            if(date && motif && total && idType && ajout){
                $.ajax({
                    url : url,
                    type : 'post',
                    dataType : 'json',
                    data : form.serialize(),
                    success : function(response){
                        table.ajax.reload();
                        form[0].reset();
                        $("#boutton").text("Enregistrer");
                    }
                });
            }
            return false;
        });
    </script>
@endsection
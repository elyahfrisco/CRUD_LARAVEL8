@extends('template')

@section('contenu')
<div class="move-me">
    <div class="container">
        <div class="card" style="width: 900px; height : 500px">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Compte client</h4>
                    <h6 class="card-subtitle">Liste des comptes clients</h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Total</th>
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

                            <h4>Formulaire fond compte client</h4>
                            <form method='POST' action="{{ route('ajouter_compteClient') }}" id="formCptClient">
                                @csrf
                                <table>
                                    <tr>
                                        <td><input type="hidden" class="form-control" name="num_compte" id="numCompte"></td>
                                    </tr>
                                    <tr id="idCptClient">
                                    </tr>
                                    <tr>
                                        <td>Total :</td>
                                        <td><input type="text" class="form-control" name="total" id="total">
                                        </td>
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
                    "url" : '{{ route("lister_compteClient") }}',
                    "dataSrc" : "data"
                },
                "columns" : [
                    {data:"id_client"},
                    {data:"total"},
                    {data:"action"}
                ]
            });
        })

        $.ajax({
                        url : "{{ route('getIdClient') }}",
                        type : 'get',
                        dataType : 'json',
                        success : function(data){
                            document.getElementById('idCptClient').innerHTML = data;
                        },
                        error : function(error){
                            console.log(error.responseText);
                        }
                    });


        function modifier(id){
            if(id){
                $.ajax({
                    url : '{{ route("getCompteClienttById") }}',
                    type : 'post',
                    dataType : 'json',
                    data : {
                        _token : '{{ csrf_token() }}',
                        num_compte : id
                    },
                    success : function(response){
                        $("#numCompte").val(id);
                        $("#total").val(response.total);
                        $("#idClient").val(response.id_client);
                        $("#boutton").text("Modifier");
                    }
                });
            }
        }

        function supprimer(id){
            if(id){
                if(confirm("Etes-vous sur de le supprimer?")){
                    $.ajax({
                        url : '{{ route("supprimer_compteClient") }}',
                        type : 'post',
                        dataType : 'json',
                        data : {
                            _token : '{{ csrf_token() }}',
                            num_compte : id
                        },
                        success : function (response) {
                            table.ajax.reload();                            
                        }
                    });
                }
            }
        }

        $("#formCptClient").unbind('submit').bind('submit', function () {
            var form = $(this);
            var total = $("#total").val();
            var idClient = $("#idClient").val();
            var url = ($("#boutton").text() == "Modifier") ? '{{ route("modifier_compteClient") }}' : '{{ route("ajouter_compteClient") }}';
            var ajout = ($("#boutton").text() == "Enregistrer") || ($("#boutton").text() == "Modifier" && $("#numCompte").val()) ? true : false; 
            if(total && idClient && ajout){
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
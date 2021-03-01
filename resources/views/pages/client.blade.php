@extends('template')

@section('contenu')
<div class="move-me">
    <div class="container">
        <div class="card" style="width: 900px; height : 500px">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Client</h4>
                    <h6 class="card-subtitle">Liste de tous les clients</h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nom client</th>
                                    <th>CIN</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Adresse</th>
                                    <th>Entreprise</th>
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
                            <form method='POST' action="{{ route('ajouter_client') }}" id="formClient">
                                @csrf
                                <table>
                                    <tr>
                                        <td><input type="hidden" class="form-control" name="id_client" id="idClient"></td>
                                    </tr>
                                    <tr>
                                        <td>Nom client :</td>
                                        <td><input type="text" class="form-control" name="nom_client" id="nomClient">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CIN:</td>
                                        <td><input type="text" class="form-control" name="cin_client" id="cinClient">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Téléphone :</td>
                                        <td><input type="text" class="form-control" name="tel_client" id="telClient">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email :</td>
                                        <td><input type="text" class="form-control" name="email_client" id="emailClient">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Adresse :</td>
                                        <td><input type="text" class="form-control" name="adresse_client" id="adresseClient">
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
                    "url" : '{{ route("lister_client") }}',
                    "dataSrc" : "data"
                },
                "columns" : [
                    {data:"nom_client"},
                    {data:"cin"},
                    {data:"tel"},
                    {data:"email"},
                    {data:"adresse"},
                    {data:"id_entreprise"},
                    {data:"action"}
                ]
            });

            
        })

        $.ajax({
                        url : "{{ route('getIdEntreprise') }}",
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
                    url : '{{ route("getClientById") }}',
                    type : 'post',
                    dataType : 'json',
                    data : {
                        _token : '{{ csrf_token() }}',
                        id_client : id
                    },
                    success : function(response){
                        $("#idClient").val(id);
                        $("#nomClient").val(response.nom_client);
                        $("#cinClient").val(response.cin);
                        $("#telClient").val(response.tel);
                        $("#emailClient").val(response.email);
                        $("#adresseClient").val(response.adresse);
                        $("#idEntreprise").val(response.id_entreprise);
                        $("#boutton").text("Modifier");
                    }
                });
            }
        }

        function supprimer(id){
            if(id){
                if(confirm("Etes-vous sur de le supprimer?")){
                    $.ajax({
                        url : '{{ route("supprimer_client") }}',
                        type : 'post',
                        dataType : 'json',
                        data : {
                            _token : '{{ csrf_token() }}',
                            id_client : id
                        },
                        success : function (response) {
                            table.ajax.reload();                            
                        }
                    });
                }
            }
        }

        $("#formClient").unbind('submit').bind('submit', function () {
            var form = $(this);
            var nom = $("#nomClient").val();
            var cin = $("#cinClient").val();
            var url = ($("#boutton").text() == "Modifier") ? '{{ route("modifier_client") }}' : '{{ route("ajouter_client") }}';
            var ajout = ($("#boutton").text() == "Enregistrer") || ($("#boutton").text() == "Modifier" && $("#idClient").val()) ? true : false; 
            if(nom && cin && ajout){
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
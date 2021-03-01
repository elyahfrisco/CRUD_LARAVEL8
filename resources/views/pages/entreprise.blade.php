@extends('template')

@section('contenu')
<div class="move-me">
    <div class="container">
        <div class="card" style="width: 900px; height : 500px">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Entreprise</h4>
                    <h6 class="card-subtitle">Liste de tous les entreprises partenaires</h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nom entreprise/th>
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

                            <h4>Formulaire fond caisse</h4>
                            <form method='POST' action="{{ route('ajouter_entreprise') }}" id="formEntreprise">
                                @csrf
                                <table>
                                    <tr>
                                        <td><input type="hidden" class="form-control" name="id_entreprise" id="idEntreprise"></td>
                                    </tr>
                                    <tr>post
                                        <td>Nom entreprise :</td>
                                        <td><input type="text" class="form-control" name="nom_entreprise" id="nomEntreprise">
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
                    "url" : '{{ route("lister_entreprise") }}',
                    "dataSrc" : "data"
                },
                "columns" : [
                    {data:"nom_entreprise"},
                    {data:"action"}
                ]
            });
        })

        function modifier(id){
            if(id){
                $.ajax({
                    url : '{{ route("getEntrepriseById") }}',
                    type : 'post',
                    dataType : 'json',
                    data : {
                        _token : '{{ csrf_token() }}',
                        id_entreprise : id
                    },
                    success : function(response){
                        $("#idEntreprise").val(id);
                        $("#nomEntreprise").val(response.nom_entreprise);
                        $("#boutton").text("Modifier");
                    }
                });
            }
        }

        function supprimer(id){
            if(id){
                if(confirm("Etes-vous sur de le supprimer?")){
                    $.ajax({
                        url : '{{ route("supprimer_entreprise") }}',
                        type : 'post',
                        dataType : 'json',
                        data : {
                            _token : '{{ csrf_token() }}',
                            id_entreprise : id
                        },
                        success : function (response) {
                            table.ajax.reload();                            
                        }
                    });
                }
            }
        }

        $("#formEntreprise").unbind('submit').bind('submit', function () {
            var form = $(this);
            var nom = $("#nomEntreprise").val();
            var url = ($("#boutton").text() == "Modifier") ? '{{ route("modifier_entreprise") }}' : '{{ route("ajouter_entreprise") }}';
            var ajout = ($("#boutton").text() == "Enregistrer") || ($("#boutton").text() == "Modifier" && $("#idEntreprise").val()) ? true : false; 
            if(nom && ajout){
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
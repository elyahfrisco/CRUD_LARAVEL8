@extends('template')

@section('contenu')
<div class="move-me">
    <div class="container">
        <div class="card" style="width: 900px; height : 500px">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Articles</h4>
                    <h6 class="card-subtitle">Liste de tous les articles</h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Libelle</th>
                                    <th>Quantite</th>
                                    <th>Prix</th>
                                    <th>Id Designation</th>
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
                            <form method='POST' action="{{ route('ajouter_article') }}" id="formClient">
                                @csrf
                                <table>
                                    <tr>
                                        <td><input type="hidden" class="form-control" name="id_article" id="id_article"></td>
                                    </tr>
                                    <tr>
                                        <td>Libelle :</td>
                                        <td><input type="text" class="form-control" name="libelle" id="libelle">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quantite:</td>
                                        <td><input type="text" class="form-control" name="quantite" id="quantite">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prix :</td>
                                        <td><input type="text" class="form-control" name="prix" id="prix">
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
                    "url" : '{{ route("lister_article") }}',
                    "dataSrc" : "data"
                },
                "columns" : [
                    {data:"libelle"},
                    {data:"quantite"},
                    {data:"prix"},
                    {data:"id_famille"},
                    {data:"action"}
                ]
            });


        })

        $.ajax({
                        url : "{{ route('getIdFamille') }}",
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
                    url : '{{ route("getArticleById") }}',
                    type : 'post',
                    dataType : 'json',
                    data : {
                        _token : '{{ csrf_token() }}',
                        id_article : id
                    },
                    success : function(response){
                        $("#id_article").val(response.id_article);
                        $("#libelle").val(response.libelle);
                        $("#quantite").val(response.quantite);
                        $("#prix").val(response.prix);
                        $("#id_famille").val(response.id_famille);
                        $("#boutton").text("Modifier");
                    }
                });
            }
        }

        function supprimer(id){
            if(id){
                if(confirm("Etes-vous sur de le supprimer?")){
                    $.ajax({
                        url : '{{ route("supprimer_article") }}',
                        type : 'post',
                        dataType : 'json',
                        data : {
                            _token : '{{ csrf_token() }}',
                            id_article : id
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
            var libelle = $("#libelle").val();
            var quantite = $("#quantite").val();
            var prix = $("#prix").val();
            var idFam = $("#idFamille").val();
            var url = ($("#boutton").text() == "Modifier") ? '{{ route("modifier_article") }}' : '{{ route("ajouter_article") }}';
            var ajout = ($("#boutton").text() == "Enregistrer") || ($("#boutton").text() == "Modifier" && $("#id_article").val()) ? true : false;
            if(libelle && quantite && prix && idFam && ajout){
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

@extends('template')

@section('contenu')
<div class="move-me">
    <div class="container">
        <div class="card" style="width: 900px; height : 500px">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Designation Article</h4>
                    <h6 class="card-subtitle">Liste des familles</h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Designation</th>
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

                            <h4>Formulaire Famille Articles</h4>
                            <form method='POST' action="{{ route('ajouter_famille') }}" id="formFond">
                                @csrf
                                <table>
                                    <tr>
                                        <td><input type="hidden" class="form-control" name="id_famille" id="id_famille"></td>
                                    </tr>
                                    <tr>post
                                        <td>Designation :</td>
                                        <td><input type="text" class="form-control" name="famille" id="famille">
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
                    "url" : '{{ route("lister_famille") }}',
                    "dataSrc" : "data"
                },
                "columns" : [
                    {data:"famille"},
                    {data:"action"}
                ]
            });
        })

        function modifier(id){
            if(id){
                $.ajax({
                    url : '{{ route("getfamilleById") }}',
                    type : 'post',
                    dataType : 'json',
                    data : {
                        _token : '{{ csrf_token() }}',
                        id_famille : id
                    },
                    success : function(response){
                        $("#id_famille").val(id);
                        $("#famille").val(response.famille);
                        $("#boutton").text("Modifier");
                    }
                });
            }
        }

        function supprimer(id){
            if(id){
                if(confirm("Etes-vous sur de le supprimer?")){
                    $.ajax({
                        url : '{{ route("supprimer_famille") }}',
                        type : 'post',
                        dataType : 'json',
                        data : {
                            _token : '{{ csrf_token() }}',
                            id_famille : id
                        },
                        success : function (response) {
                            table.ajax.reload();
                        }
                    });
                }
            }
        }

        $("#formFond").unbind('submit').bind('submit', function () {
            var form = $(this);
            var total = $("#famille").val();

            var url = ($("#boutton").text() == "Modifier") ? '{{ route("modifier_famille") }}' : '{{ route("ajouter_famille") }}';
            var ajout = ($("#boutton").text() == "Enregistrer") || ($("#boutton").text() == "Modifier" && $("#id_famille").val()) ? true : false;
            if(total && ajout){
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

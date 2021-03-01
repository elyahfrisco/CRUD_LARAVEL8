@extends('template')

@section('contenu')
<div class="move-me">
    <div class="container">
        <div class="card" style="width: 900px; height : 500px">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Fond caisse</h4>
                    <h6 class="card-subtitle">Liste de tous les fonds</h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Total fond</th>
                                    <th>Date</th>
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
                            <form method='POST' action="{{ route('ajouter_fondCaisse') }}" id="formFond">
                                @csrf
                                <table>
                                    <tr>
                                        <td><input type="hidden" class="form-control" name="id_fond" id="idFond"></td>
                                    </tr>
                                    <tr>post
                                        <td>Total fond :</td>
                                        <td><input type="text" class="form-control" name="total_fond" id="totalFond">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date :</td>
                                        <td><input type="date" class="form-control" name="date_fond" id="dateFond"></td>
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
                    "url" : '{{ route("lister_fondCaisse") }}',
                    "dataSrc" : "data"
                },
                "columns" : [
                    {data:"total_fond"},
                    {data:"date"},
                    {data:"action"}
                ]
            });
        })

        function modifier(id){
            if(id){
                $.ajax({
                    url : '{{ route("getFondById") }}',
                    type : 'post',
                    dataType : 'json',
                    data : {
                        _token : '{{ csrf_token() }}',
                        id_fond : id
                    },
                    success : function(response){
                        $("#idFond").val(id);
                        $("#totalFond").val(response.total_fond);
                        $("#dateFond").val(response.date);
                        $("#boutton").text("Modifier");
                    }
                });
            }
        }

        function supprimer(id){
            if(id){
                if(confirm("Etes-vous sur de le supprimer?")){
                    $.ajax({
                        url : '{{ route("supprimer_fondCaisse") }}',
                        type : 'post',
                        dataType : 'json',
                        data : {
                            _token : '{{ csrf_token() }}',
                            id_fond : id
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
            var total = $("#totalFond").val();
            var date = $("#dateFond").val();
            var url = ($("#boutton").text() == "Modifier") ? '{{ route("modifier_fondCaisse") }}' : '{{ route("ajouter_fondCaisse") }}';
            var ajout = ($("#boutton").text() == "Enregistrer") || ($("#boutton").text() == "Modifier" && $("#idFond").val()) ? true : false; 
            if(total && date && ajout){
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
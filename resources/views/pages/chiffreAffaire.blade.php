@extends('template')

@section('contenu')
<div class="move-me">
    <div class="container">
        <div class="card" style="width: 900px; height : 500px">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Chiffre d'affaire</h4>
                    <h6 class="card-subtitle">Liste des chiffres d'affaire</h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Total CA</th>
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

                            <h4>Formulaire fond CA</h4>
                            <form method='POST' action="{{ route('ajouter_chiffreAffaire') }}" id="formCA">
                                @csrf
                                <table>
                                    <tr>
                                        <td><input type="hidden" class="form-control" name="id_ca" id="idCA"></td>
                                    </tr>
                                    <tr>post
                                        <td>Total fond :</td>
                                        <td><input type="text" class="form-control" name="total_ca" id="totalCA">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date :</td>
                                        <td><input type="date" class="form-control" name="date_ca" id="dateCA"></td>
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
                    "url" : '{{ route("lister_chiffreAffaire") }}',
                    "dataSrc" : "data"
                },
                "columns" : [
                    {data:"total_ca"},
                    {data:"date_ca"},
                    {data:"action"}
                ]
            });
        })

        function modifier(id){
            if(id){
                $.ajax({
                    url : '{{ route("getCAById") }}',
                    type : 'post',
                    dataType : 'json',
                    data : {
                        _token : '{{ csrf_token() }}',
                        id_ca : id
                    },
                    success : function(response){
                        $("#idCA").val(id);
                        $("#totalCA").val(response.total_ca);
                        $("#dateCA").val(response.date_ca);
                        $("#boutton").text("Modifier");
                    }
                });
            }
        }

        function supprimer(id){
            if(id){
                if(confirm("Etes-vous sur de le supprimer?")){
                    $.ajax({
                        url : '{{ route("supprimer_chiffreAffaire") }}',
                        type : 'post',
                        dataType : 'json',
                        data : {
                            _token : '{{ csrf_token() }}',
                            id_ca : id
                        },
                        success : function (response) {
                            table.ajax.reload();                            
                        }
                    });
                }
            }
        }

        $("#formCA").unbind('submit').bind('submit', function () {
            var form = $(this);
            var total = $("#totalCA").val();
            var date = $("#dateCA").val();
            var url = ($("#boutton").text() == "Modifier") ? '{{ route("modifier_chiffreAffaire") }}' : '{{ route("ajouter_chiffreAffaire") }}';
            var ajout = ($("#boutton").text() == "Enregistrer") || ($("#boutton").text() == "Modifier" && $("#idCA").val()) ? true : false; 
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
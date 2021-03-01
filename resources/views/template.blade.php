<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Vente | Mora Prix </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/vendors/bootstrap.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/vendors/datatables.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/vendors/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">

    <script src="{{ url('/') }}/js/vendors/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="{{ url('/') }}/js/vendors/jquery.dataTables.min.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>

    <div class="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
    <div class="side-bar">
        <div class="close-btn">
            <i class="fas fa-times"></i>
        </div>
        <div class="menu">
            <div class="item"><a href="{{ route("liste_fondCaisse") }}"><i class="fas fa-wallet"></i>FOND DE CAISSE</a></div>
            <div class="item">
                <a class="sub-btn"><i class="fas fa-cash-register"></i>PRODUITS<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="#" class="sub-item"><a href="{{ route("liste_famille") }}">DESIGNATION</a>
                    <a href="#" class="sub-item"><a href="{{ route("liste_article") }}">ARTICLES</a>
                </div>
            </div>
            <div class="item"><a href="{{ route("liste_client") }}"><i class="fas fa-laptop-house"></i>CLIENTS</a></div>
            <div class="item"><a href="{{ route("liste_entreprise") }}"><i class="fas fa-laptop-house"></i>ENTREPRISE</a></div>
            <div class="item"><a href="{{ route("liste_chiffreAffaire") }}"><i class="fas fa-laptop-house"></i>CHIFFRE D'AFFAIRES</a></div>
            <div class="item"><a href="{{ route("liste_mouvement") }}"><i class="fas fa-laptop-house"></i>MOUVEMENTS</a></div>
            <div class="item"><a href="{{ route("liste_compteClient") }}"><i class="fas fa-laptop-house"></i>COMPTE CLIENT</a></div>
            <div class="item"><a href="#"><i class="fas fa-laptop-house"></i>VENTES</a></div>
            <div class="item">
                <a class="sub-btn"><i class="fas fa-chart-line"></i>STATISTIQUES<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="#" class="sub-item">DETAILS TICKETS</a>
                    <a href="#" class="sub-item">BALANCES PAR REGLEMENT</a>
                    <a href="#" class="sub-item">BALANCES PAR FAMILLE</a>
                </div>
            </div>
            <div class="item"><a href="#"><i class="fas fa-info-circle"></i>DECONEXION</a></div>
        </div>
    </div>
    <section class="main">

        @yield('contenu')

    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            //jquery for toggle sub menus
            $('.sub-btn').click(function() {
                $(this).next('.sub-menu').slideToggle();
                $(this).find('.dropdown').toggleClass('rotate');
            });

            //jquery for expand and collapse the sidebar
            $('.menu-btn').click(function() {
                $('.side-bar').addClass('active');
                $('.menu-btn').css("visibility", "hidden");
            });

            $('.close-btn').click(function() {
                $('.side-bar').removeClass('active');
                $('.menu-btn').css("visibility", "visible");
            });
        });
    </script>
    @yield('script')
</body>

</html>

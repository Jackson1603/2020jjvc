<?php
session_start();
if(!isset($_SESSION['login'])) {
    header('LOCATION:login/login.php'); die();
} else {
}
if(isset($_POST['but_logout'])){



    session_destroy();
    header('Location: index.php');
}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <title>
        CC-CHECKER
    </title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />

    <link href="./assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />

    <link href="./assets/demo/demo.css" rel="stylesheet" />
    <script type="text/javascript">
        $(document).ready(function() {


            $("#bode").hide();
            $("#esconde").show();

            $('#mostra').click(function() {
                $("#bode").slideToggle();
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {


            $("#bode2").hide();
            $("#esconde2").show();

            $('#mostra2').click(function() {
                $("#bode2").slideToggle();
            });

        });
    </script>

    <script title="ajax do checker">
        function enviar() {
            var linha = $("#lista").val();
            var linhaenviar = linha.split("\n");
            var total = linhaenviar.length;
            var ap = 0;
            var rp = 0;
            linhaenviar.forEach(function(value, index) {
                setTimeout(
                    function() {
                        $.ajax({
                            url: 'api.php?lista=' + value,
                            type: 'GET',
                            async: true,
                            success: function(resultado) {
                                if (resultado.match("Approved")) {
                                    removelinha();
                                    ap++;
                                    aprovadas(resultado + "");
                                } else {
                                    removelinha();
                                    rp++;
                                    reprovadas(resultado + "");
                                }
                                $('#carregadas').html(total);
                                var fila = parseInt(ap) + parseInt(rp);
                                $('#cLive').html(ap);
                                $('#cDie').html(rp);
                                $('#total').html(fila);
                                $('#cLive2').html(ap);
                                $('#cDie2').html(rp);
                            }
                        });
                    }, 2 * index);
            });
        }

        function aprovadas(str) {
            $(".aprovadas").append(str + "<br>");
        }

        function reprovadas(str) {
            $(".reprovadas").append(str + "<br>");
        }

        function removelinha() {
            var lines = $("#lista").val().split('\n');
            lines.splice(0, 1);
            $("#lista").val(lines.join("\n"));
        }
    </script>

</head>

<body class="">
    <div class="wrapper">
        <div class="sidebar">

            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="javascript:void(0)" class="simple-text logo-normal">
CCs-Checker
</a>
                </div>
                <ul class="nav">
                    <li class="active ">
                        <a href="./">
                            <i class="tim-icons icon-badge"></i>
                            <p>Gate 1</p>
                        </a>
                    </li>
                    <li>
                </ul>
            </div>
        </div>
        <div class="main-panel">

            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle d-inline">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="content">
                <center>
                    <h1>GodHacker_SC</h1>
                </center>
                <center>
                    <center>
                        <div class="row col-md-12">
                            <div class="card col-sm-12">
                                <span class="badge badge-info"><h4>Gate 1 - CCN/CVV</h4></span>
                                <div class="card-body">
                                    <div class="md-form">
                                        <div class="col-md-12">
                                            <center>
                                                <div class="md-form">
                                                    <span>Approved:</span>&nbsp<span id="cLive" class="badge badge-success">0</span>
                                                    <span>Declined:</span>&nbsp<span id="cDie" class="badge badge-danger"> 0</span>
                                                    <span>Checked:</span>&nbsp<span id="total" class="badge badge-info">0</span>
                                                    <span>Total:</span>&nbsp<span id="carregadas" class="badge badge-dark">0</span>
                                                </div>
                                                <br>
                                                <span class="badge badge-white" <label for="lista">Cards should be in here.</label></span>
                                                <br>
                                                <textarea type="text" style="text-align: center;" id="lista" class="md-textarea form-control" rows="50" placeholder="FORMAT: xxxxxxxxxxxxxxxx|mm|year|cvv"></textarea>
                                                <br>
                                        </div>
                                        <center>
                                            <button class="btn btn-primary" style="width: 200px; outline: none;" id="testar" onclick="enviar()">START</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            </center>
                            <br>
                            <br>
                            <div class="col-md-12">
                                <div class="card">
                                    <div style="position: absolute;
        top: 0;
        right: 0;">
                                        <button id="mostra" class="btn btn-primary">MOSTRAR</button>
                                    </div>
                                    <div class="card-body">
                                        <h6 style="font-weight: bold;" class="card-title">Approved - <span id="cLive2" class="badge badge-success">0</span></h6>
                                        <div id="bode"><span id=".aprovadas" class="aprovadas"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="col-md-12">
                                <div class="card">
                                    <div style="position: absolute;
        top: 0;
        right: 0;">
                                        <button id="mostra2" class="btn btn-primary">MOSTRAR</button>
                                    </div>
                                    <div class="card-body">
                                        <h6 style="font-weight: bold;" class="card-title">Declined - <span id="cDie2" class="badge badge-danger">0</span></h6>
                                        <div id="bode2"><span id=".reprovadas" class="reprovadas"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
        </center>
        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright">
                    © 2020 made with <i class="tim-icons icon-heart-2"></i> by
                    <a href="https://t.me/GodHacker_SC"> The God Hacker</a>
                </div>
            </div>
        </footer>
    </div>
    </div>

    <script src="./assets/js/core/jquery.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>


    <script src="./assets/js/plugins/chartjs.min.js"></script>

    <script src="./assets/js/plugins/bootstrap-notify.js"></script>

    <script src="./assets/js/black-dashboard.min.js?v=1.0.0"></script>
    <script src="./assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
        $().ready(function() {
            $sidebar = $('.sidebar');
            $navbar = $('.navbar');
            $main_panel = $('.main-panel');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');
            sidebar_mini_active = true;
            white_color = false;

            window_width = $(window).width();


            var new_color = $(this).data('color');

            if ($sidebar.length != 0) {
                $sidebar.attr('data', new_color);
            }

            if ($main_panel.length != 0) {
                $main_panel.attr('data', new_color);
            }

            if ($full_page.length != 0) {
                $full_page.attr('filter-color', new_color);
            }

            if ($sidebar_responsive.length != 0) {
                $sidebar_responsive.attr('data', new_color);
            }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
            var $btn = $(this);

            if (sidebar_mini_active == true) {
                $('body').removeClass('sidebar-mini');
                sidebar_mini_active = false;
                blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
            } else {
                $('body').addClass('sidebar-mini');
                sidebar_mini_active = true;
                blackDashboard.showSidebarMessage('Sidebar mini activated...');
            }

            // we simulate the window Resize so the charts will get updated in realtime.
            var simulateWindowResize = setInterval(function() {
                window.dispatchEvent(new Event('resize'));
            }, 180);

            // we stop the simulation of Window Resize after the animations are completed
            setTimeout(function() {
                clearInterval(simulateWindowResize);
            }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
            var $btn = $(this);

            if (white_color == true) {

                $('body').addClass('change-background');
                setTimeout(function() {
                    $('body').removeClass('change-background');
                    $('body').removeClass('white-content');
                }, 900);
                white_color = false;
            } else {

                $('body').addClass('change-background');
                setTimeout(function() {
                    $('body').removeClass('change-background');
                    $('body').addClass('white-content');
                }, 900);

                white_color = true;
            }


        });

        $('.light-badge').click(function() {
            $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
            $('body').removeClass('white-content');
        });
        });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

        });
    </script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "black-dashboard-free"
            });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>
</body>

</html>
<?php 

    //variaveis para o menu
    $pag = @$_GET["pag"];
    $menu1 = "Cadastro de Sindicos";
    $menu2 = "Cadastro de Inquilinos";
    $menu3 = "Cadastro de Imóveis";
    $menu4 = "Painel Financeiro";
    $menu5 = "Painel de Solicitações";
    $menu6 = "Relatórios";
    $menu7 = "Chat";

 ?>



<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Hugo Vasconcelos">

        <title>Painel Administrativo</title>

        <!-- Custom fonts for this template-->
        <link href="<?php echo e(URL::asset('vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="<?php echo e(URL::asset('css/sb-admin-2.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(URL::asset('css/style.css')); ?>" rel="stylesheet">
        
        <link href="<?php echo e(URL::asset('vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">


        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo e(URL::asset('vendor/jquery/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
        
         <link rel="shortcut icon" href="../../img/favicon0.ico" type="image/x-icon">
    <link rel="icon" href="../../img/favicon0.ico" type="image/x-icon">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                    <div class="sidebar-brand-text mx-3">Administrador</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">



                <!-- Divider -->
                <hr class="sidebar-divider">

               
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pag=<?php echo $menu6 ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Cadastros de Síndicos</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pag=<?php echo $menu7 ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Cadastros de Inquilinos</span></a>
                </li>                
                

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                
                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pag=<?php echo $menu6 ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Cadastro de Imóveis</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pag=<?php echo $menu7 ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Cadastro de Apartamentos</span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pag=<?php echo $menu4 ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Painel Financeiro</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?pag=<?php echo $menu4 ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Relatórios</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?pag=<?php echo $menu4 ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Chat</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>



                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">



                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nome do usuario</span>
                                    <img class="img-profile rounded-circle" src="">

                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#ModalPerfil">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                        Editar Perfil
                                    </a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../logout.php">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        Sair
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <?php if ($pag == null) { 
                       return View('painel-adm.home'); 
                        
                        } else if ($pag==$menu1) {
                        include_once($menu1.".php");
                        
                        } else if ($pag==$menu2) {
                        include_once($menu2.".php");

                         } else if ($pag==$menu3) {
                        include_once($menu3.".php");

                        } else if ($pag==$menu4) {
                        include_once($menu4.".php");

                        } else if ($pag==$menu5) {
                        include_once($menu5.".php");

                        } else if ($pag==$menu6) {
                        include_once($menu6.".php");

                        } else if ($pag==$menu7) {
                        include_once($menu7.".php");

                        } else if ($pag==$menu8) {
                        include_once($menu8.".php");
                        
                        } else {
                        include_once("home.php");
                        }
                        ?>
                        
                        

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->



            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>




        <!--  Modal Perfil-->
        <div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>



                    <form id="form-perfil" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label >Nome</label>
                                        <input value="<?php echo $nome ?>" type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                                    </div>

                                    <div class="form-group">
                                        <label >CPF</label>
                                        <input value="<?php echo $cpf ?>" type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                                    </div>

                                    <div class="form-group">
                                        <label >Email</label>
                                        <input value="<?php echo $email ?>" type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <label >Senha</label>
                                        <input value="" type="password" class="form-control" id="text" name="senha" placeholder="Senha">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="col-md-12 form-group">
                                        <label>Foto</label>
                                        <input value="<?php echo $img ?>" type="file" class="form-control-file" id="imagem" name="imagem" onchange="carregarImg();">

                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <img src="../img/profiles/<?php echo $img ?>" alt="Carregue sua Imagem" id="target" width="100%">
                                    </div>
                                </div>
                            </div> 



                            <small>
                                <div id="mensagem" class="mr-4">

                                </div>
                            </small>



                        </div>
                        <div class="modal-footer">



                            <input value="<?php echo $idUsuario ?>" type="hidden" name="txtid" id="txtid">
                            <input value="<?php echo $cpf ?>" type="hidden" name="antigo" id="antigo">

                            <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>


        <!-- Core plugin JavaScript-->
        <script src="<?php echo e(URL::asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?php echo e(URL::asset('js/sb-admin-2.min.js')); ?>"></script>

        <!-- Page level plugins -->
        <script src="<?php echo e(URL::asset('vendor/chart.js/Chart.min.js')); ?>"></script>

        <!-- Page level custom scripts -->
        <script src="<?php echo e(URL::asset('js/demo/chart-area-demo.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('js/demo/chart-pie-demo.js')); ?>"></script>

        <!-- Page level plugins -->
        <script src="<?php echo e(URL::asset('vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

        <!-- Page level custom scripts -->
        <script src="<?php echo e(URL::asset('js/demo/datatables-demo.js')); ?>"></script>

    </body>

</html>



<?php /**PATH C:\xampp\htdocs\predial\resources\views/painel-adm/index.blade.php ENDPATH**/ ?>
<?php
	include_once('../views/includes/header.php');
?>
<link rel="stylesheet" href="../public/css/style_index.css">
<script type="text/javascript" href="../public/js/index_script.js"></script>
</head>
<body>
</style>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">T-aér</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        	<div class="navbar-nav mr-auto" ></div>
            <div class="form-inline my-2 my-lg-0">
                <a href="login.php" class="btn btn-success p-2">Connexion / Créer un compte</a>
            </div>
        </div>
    </nav>
<!-- ------------------------------------------------- -->
<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../public/images/slide/black-and-brown-wooden-plane-scale-model-1720957.jpg" class="d-block w-100" alt="image slider">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
    <div class="carousel-item">
      <img src="../public/images/slide/gray-and-black-airplane-under-blue-sky-4116184.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
    <div class="carousel-item">
      <img src="../public/images/slide/white-airplane-wing-3453030.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- ---------------------------------------------------------->
<div class="container my-5 py-5 z-depth-1">
 <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">
   <div class="row">
     <div class="col-md-6 mb-4 mb-md-0">
       <h3 class="font-weight-bold">Material Design Blocks</h3>
       <p class="text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id quam sapiente
         molestiae
         numquam quas, voluptates omnis nulla ea odio quia similique corrupti magnam, doloremque laborum.</p>
       <a class="btn btn-purple btn-md ml-0" href="#" role="button">Start now<i class="fa fa-gem ml-2"></i></a>
     </div>
     <div class="col-md-6 mb-4 mb-md-0">
       <!--Image-->
       <div class="view overlay z-depth-1-half">
         <img src="../public/images/back_ground/back_round_home2.jpg" class="img-fluid"
           alt="">
         <a href="#">
           <div class="mask rgba-white-light"></div>
         </a>
       </div>
     </div>
   </div>
 </section>
</div>
<?php
	include_once('../views/includes/footer.php');
?>
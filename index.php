<!DOCTYPE html>
<html lang="en">
    <head>
    <script>
  		document.cookie='resolution='+Math.max(window.innerWidth)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';
  		try{console.log(" ")} catch(e){console={},console.log=function(a){}}
		</script>
		<meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" class="layoutcss" />
    </head>
    <body>
      <header>
        <div class="container-fixed">
          <div class="col-lg-12 block-default block-logout">
            <a class="btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Logout</a>
          </div>
        </div>
      </header>
      <div id="wrapper" class="container-fixed">
          <?php include('inc/menu.php');?>
          <!-- Page Content -->
          <div id="page-content-wrapper">
              <div class="container-fluid">
                    <?php include('pages/pages.php');?>
                    <!--<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>-->
              </div>
          </div>
      </div>

      <!-- jQuery -->
      <script src="js/jquery.js"></script>
      <script>
        $(window).load(function() {
          $(".page-credit, .page-payment, .page-card").hide();
        });

        $(function() {
          $("#translation").click(function() {
              $(this).addClass("active");
              $("#credits, #payment-type, #card-type").removeClass("active");
              $(".page-translation").show();
              $(".page-credit, .page-payment, .page-card").hide();
          });

          $("#credits").click(function() {
              $(this).addClass("active");
              $("#translation, #payment-type, #card-type").removeClass("active");
              $(".page-credit").show();
              $(".page-translation, .page-payment, .page-card").hide();
          });

          $("#payment-type").click(function() {
              $(this).addClass("active");
              $("#translation, #credits, #card-type").removeClass("active");
              $(".page-payment").show();
              $(".page-translation, .page-credit, .page-card").hide();
          });

          $("#card-type").click(function() {
              $(this).addClass("active");
              $("#translation, #credits, #payment-type").removeClass("active");
              $(".page-card").show();
              $(".page-translation, .page-credit, .page-payment").hide();
          });
        });
      </script>
      <!-- Bootstrap Core JavaScript -->
      <script src="assets/javascripts/bootstrap.min.js"></script>

      <!-- Menu Toggle Script -->
      <script>
      $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
      });
      </script>

    </body>
</html>

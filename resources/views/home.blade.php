<!doctype html>
<html lang="pt-BR">
  <head>
  <link id="favicon" rel="shortcut icon" type="image/png" href="imgs/B&BAnalytics.png">
  	<title>B&B Analytics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

<!-- css bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- css bootstrap icons -->	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">


	<!-- css modelo  -->

		
<link rel="stylesheet" href="css/style.css">
<!-- meu css   -->
<link rel="stylesheet" href="css/home.css">

  </head>
  <body>

    <div id="cabessalho" class="d-flex align-items-center p-1 my-1 "> 

	<h1 id="idvisual" class="p-1 text-center font-weight-bold"> 
	 B&B Analytics
	<img  id="logoCabessalho" src="{{ asset('imgs/B&BAnalytics.png') }}" />
	</h1>
	
	
	</div>
	


		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div  class="custom-menu">
					<button  type="button" id="sidebarCollapse" class="btn btn-primary">
						
	          <i  class="fa fa-bars"></i>
	          <span  class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4">
		  		<h1><a href="https://github.com/fabricio-dev" class="logo"> <span><img src="{{ asset('imgs/B&BAnalytics.png') }}" /> </span>B&B Analytics </a></h1>


	        <ul class="list-unstyled components mb-5" >
	          <li class="active">
	            <a href="#"><span class="fa fa-home mr-3"></span> Home</a>
	          </li>
	          <li>
	              <a href="#"><span class="fa fa-user mr-3"></span> About</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-briefcase mr-3"></span> Works</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-sticky-note mr-3"></span> Blog</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-paper-plane mr-3"></span> Contacts</a>
	          </li>
	        </ul>

	        <div class="footer">
	        	<p>
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
						  All rights reserved  <i class="icon-heart" aria-hidden="true"></i> by
						   <a href="https://github.com/fabricio-dev" id="corp" target="_blank">Fabricio.com</a>
				 </p>
	        </div>

	      </div>
    	</nav>

        <!-- inicio div conteudo so site   -->
      <div id="content" class="p-4 p-md-5 pt-5" >





<!-- inicio grafico   -->
<div id="Grafico">
    
	<!-- o grafico e montado na dive   -->
	<div id="columnchart_values" class=""  ></div>

</div>
     <!-- fim grafico   -->
	  	<!-- inicio tabela de dados -->

<div id=”tabela”>
<h1>
	Analize de Atendimento
</h1>
<table class="table table-striped">
  <thead id="table">
    <tr>
	  <th scope="col">Id</th>
      <th scope="col">Data</th>
      <th scope="col">Demanda</th>
      <th scope="col">Capacidade</th>
      <th scope="col">Atendimento planejado</th>
	  <th scope="col">Atendimento Realizado</th>
	  <th scope="col">Desvio</th>
    </tr>
  </thead>
  <tbody>
<!--povoando a tabela com os dados do banco-->
  @foreach($atendimento as $atendi)
  
  
    <tr>
      <td>{{$atendi->id}}</td>
      <td>{{$atendi->data}}</td>
	  <td>{{$atendi->demanda}}</td>
	  <td>{{$atendi->capacidade}}</td>
      <td>{{$atendi->atendimento_planejado}}</td>
	  <td>{{$atendi->atendimento_realizado}}</td>
	  <td>{{$atendi->desvio}}</td>
	  
    </tr>
	@endforeach

  </tbody>
</table>
</div>
<!-- fim tabela de dados -->
    </div>
 </div>

</div>
 



    <script src="js/menu/jquery.min.js"></script>
    <script src="js/menu/popper.js"></script>
    <script src="js/menu/bootstrap.min.js"></script>
    <script src="js/menu/main.js"></script>


	<!-- js bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	
	
	
	<!-- js grafico -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


  <script type="text/javascript">

    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
   

        ["data", "desvio", { role: "style" } ],
		<?php 
		foreach ($atendimento as $atendiment) {
		?>
		 ["<?php echo $atendiment->data  ?>", <?php echo $atendiment->desvio ?>, "#DAA520"],
	<?php }?>

      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Capacidade X Atendimento Realizado",
        width:"100%" ,
        height: 400,
        bar: {groupWidth: "80%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
  

<!--
corrigir readequaçao do grafico


-->


  </body>
</html>
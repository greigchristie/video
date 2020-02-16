
</head>

<body>
 <div class="container">
	 <div class="row hidden-print">

 		<!-- <ul class="nav navbar-nav"> -->
 		<nav class="navbar navbar-default">
 			<div class="container-fluid">
 				<div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>

       <a class="navbar-brand" href="index.php"><img src="images/e7-2-40.png"></a>

     </div>
     <div class="collapse navbar-collapse" id="collapse-1">
 		<ul class="nav navbar-nav">
 		<li><a href="index.php">SEARCH</a></li>
 		<li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BROWSE <span class="caret"></span></a>
           <ul class="dropdown-menu">
           	<li><a href="all_movies.php">All Videos</a></li>
 			<li><a href="movies.php">All Movies</a></li>
 			<li><a href="series.php">All Series</a></li>
           </ul>
         </li>
         <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">RECENT <span class="caret"></span></a>
           <ul class="dropdown-menu">
 			<li><a href="recent_movies.php">RECENT Movies</a></li>
 			<li><a href="recent_series.php">RECENT Series</a></li>
           </ul>
         </li>

 			<li><a href="posters.php">POSTERS</a></li>
 			<li><a href="about.php">ABOUT</a></li>

 		</ul>
 	</div>
 			</div>
 	</nav>

 	</div>
<div class="row hidden-print">
<div class="col-xs-12 col-md-8 col-lg-8"><h1>EVERYTHING <small>DVDs, Blu-Rays, VHS, &amp; Digital</small></h1></div>
<div class="col-xs-12 col-md-4 col-lg-4 well well-sm text-right">
<form action="search.php" method="get">
	<div class="input-group">
  <input type="text" class="form-control" name="requery" placeholder="Keyword search" />
  	<span class="input-group-btn">
  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
</span>
</form>
</div>

</div>
</div>

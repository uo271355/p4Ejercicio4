<!DOCTYPE  html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Ejercicio 4</title>
<link rel="stylesheet" href="Ejercicio4.css">
</head>
<body>
<header>
<h1>Servicios Web de Noticias</h1>
<p>Informacion</p>
</header>
<section>
<pre>
<code>
<?php
class Noticias{
	public function __construct(){
		session_start();
		$this->noticia();
	
	}
	public function noticia(){
		$url = "http://newsapi.org/v2/top-headlines?country=us&apiKey=f73146cb78d245e199586af1bce3ebad";

		$datos = file_get_contents($url);
		$json = json_decode($datos, true);

		$articles = $json["articles"];
		for($i = 0; $i < count($articles); $i++){
			$noticia = "";
			$noticia .= "<article>";
			$noticia .= "<h2>" . $articles[$i]["title"] . "</h2>";
			$noticia .= "<img src='" . $articles[$i]["urlToImage"] . "' alt='Imagen Noticias' />";
			$noticia .= "<p>" . $articles[$i]["description"] . "</p>";
			$noticia .= "<p>" . $articles[$i]["content"] . "</p>";
			
			$noticia .= "<p>Autor: " . $articles[$i]["author"] . "</p>";
			$noticia .= "<p>Fecha: " . $articles[$i]["publishedAt"] . "</p>";
			$noticia .= "<a href='" . $articles[$i]["url"] . "'>Ver la noticia completa</a>";
			$noticia .= "</article>";
			
			$this->mostrar($noticia);
		}
	}
	public function mostrar($noticia){
		if(isset($_SESSION["mostrar"])){
			$_SESSION["mostrar"] .= $noticia;
		}else{
			$_SESSION["mostrar"] = $noticia;
		}
	}
	public function ver(){
		if(isset($_SESSION["mostrar"])){
            return $_SESSION["mostrar"];
        }
	}
}
$noticias=new Noticias();
?>
</code>
</pre>
</section>
<section>
<form action='#' method='post' name='noticias'>
<div id='noticias'>
<?php echo $noticias->ver();?>
</div>
</form>
</section>

<footer>
<a href="http://validator.w3.org/check/referer" hreflang="en-us"> <img src="valid-html5-button.png" alt="¡HTML5 válido!"></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="¡CSS válido!"></a>
</footer>
</body>
</html>
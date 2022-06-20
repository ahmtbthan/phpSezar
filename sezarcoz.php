<?php 
set_time_limit(1000);
error_reporting(0);
$yenidizi=[];
$ofset = 0;
$alfabe= ['a','b','c','ç','d','e','f','g','ğ','h','i','ı','j','k','l','m','n','o','ö','p','r','s','ş','t','u','ü','v','y','z'];
$mesaj = $_POST['mesaj'];
$ayirma = mb_str_split($mesaj);
if (isset($_POST['gonder'])) {
	while ($ofset<30) { 
		for ($i=0; $i <mb_strlen($mesaj) ; $i++) { 
			if (in_array($ayirma[$i], $alfabe)) {
				$bul = array_search($ayirma[$i], $alfabe);
				$sorgula = $bul - $ofset;
				if ($sorgula<0) {
					$topla = 29 + $bul;
					$uzunluk = $topla - $ofset;
					$mod = $uzunluk % 29;
					if ($mod<0) {
						$yeniuzunluk = 29 + $mod;
						$yenimod = $yeniuzunluk % 29;
						$atama = $ayirma[$i];
						$atama = $alfabe[$yenimod];
						array_push($yenidizi, $atama);
					}else{
						$atama = $ayirma[$i];
						$atama = $alfabe[$mod];
						array_push($yenidizi, $atama);
					}

				}else{
					$uzunluk = array_search($ayirma[$i], $alfabe) - $ofset;
					$mod = $uzunluk % 29;
					if ($mod<0) {
						$yeniuzunluk = 29 + $mod;
						$yenimod = $yeniuzunluk % 29;
						$atama = $ayirma[$i];
						$atama = $alfabe[$yenimod];
						array_push($yenidizi, $atama);
					}else{
						$atama = $ayirma[$i];
						$atama = $alfabe[$mod];
						array_push($yenidizi, $atama);
					}

				}
			}else{
				array_push($yenidizi," ");
			}

		}

		$ofset++;
	}
	$dizibol = array_chunk($yenidizi,mb_strlen($mesaj), true);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
	<div class="container px-6">
		<div class="row px-auto mt-5">
			<div class="col-md-5 mx-auto">
				<div class="mb-5">
					<h1 align="center">Sezar Şifreleme <h1 align="center">Çözümü</h1> </h1>
				</div>
				<form action="sezarcoz.php" method="post">
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Şifreli Mesaj</label>
						<input type="text" name="mesaj" class="form-control" placeholder="Mesajı Giriniz">
					</div>
					<div align="center" class="mb-3">
						<button name="gonder" class="btn btn-success btn-lg">Şifreyi Çöz</button>
					</div>
				</form>
				<div align="center" class="mt-3">
					<?php if (isset($_POST['gonder'])){ ?>
						<h1><p style="color:red;">Şifreli Mesajınız :</p> <span style="color:green;"><?php echo $mesaj; ?></span></h1>
						<h2><p style="color:red;">Çözülmüş Şifre :</p> <span style="color:green;"><?php 
						for ($i=0; $i < count($dizibol) ; $i++) { 
							$sozcukbirlestir = implode("",$dizibol[$i]);
							?>
							<p style="color:blue;"><?php echo $i ?>. Ofset</p><?php 
							echo $sozcukbirlestir."<br>";
							echo "---------------------<br>";
						}


					?></span></h2>
				<?php } ?>
			</div>

		</div>
	</div>
</div>
</body>
</html>
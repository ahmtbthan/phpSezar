<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<?php 
	$ekle = [];
	$alfabe= ['a','b','c','ç','d','e','f','g','ğ','h','i','ı','j','k','l','m','n','o','ö','p','r','s','ş','t','u','ü','v','y','z'];
	if (isset($_POST['gonder'])) {
		$mesaj = $_POST['mesaj'];
		$ofset = $_POST['ofset'];
		$dizi = mb_str_split($mesaj);
		for ($i=0; $i < mb_strlen($mesaj) ; $i++) { 
			if (in_array($dizi[$i], $alfabe)) {
				$uzunluk = array_search($dizi[$i], $alfabe) + $ofset;
				$mod = $uzunluk % 29;
				$dizi[$i] = $alfabe[$mod];
				array_push($ekle, $dizi[$i]);
			}else{
				array_push($ekle," ");
			}
		}
		$enc_mesaj = implode("", $ekle);
	}
	






	?>
</head>
<body">
	<div class="container">
	<div class="container px-6">
		<div class="row px-auto mt-5">
			<div class="col-md-5 mx-auto">
				<div class="mb-5">
					<h1 align="center">Sezar Şifreleme</h1>
				</div>
				<form action="index.php" method="post">
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Sezar Şifrelenecek Mesaj</label>
						<input type="text" name="mesaj" class="form-control" placeholder="Mesajı Giriniz">
					</div>
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Sezar Ofset</label>
						<input type="number" class="form-control" name="ofset"  placeholder="Ofset Giriniz">
					</div>
					<div align="center" class="mb-3">
						<button name="gonder" class="btn btn-success btn-lg">Şifrele</button>
					</div>
				</form>
				<div align="center" class="mt-3">
					<?php if (isset($_POST['gonder'])){ ?>
						<h1><p style="color:red;">Mesajınız :</p> <span style="color:green;"><?php echo $mesaj; ?></span></h1>
						<h2><p style="color:red;">Şifreli Mesajınız :</p> <span style="color:green;"><?php echo $enc_mesaj; ?></span></h2>
						<h2><p style="color:red;">Alfabe :</p> <strong><?php for ($i=0; $i < count($alfabe); $i++) { 
							echo "$alfabe[$i] ";
						} ?></strong> </h2>
					<?php } ?>
				</div>

			</div>
		</div>
	</div>

</div>

</body>
</html>


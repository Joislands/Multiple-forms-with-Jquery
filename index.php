<?php
// Connect to the DB
$link = mysqli_connect("localhost","root","","registration") or die("Error " . mysqli_error($link));

// store in the DB 
if(!empty($_POST['ok'])) {	
	// first delete the records marked for deletion. Why? Because we don't want to process them in the code below
	if( !empty($_POST['delete_ids']) and is_array($_POST['delete_ids'])) {
		// you can optimize below into a single query, but let's keep it simple and clear for now:
		foreach($_POST['delete_ids'] as $id) {
			$sql = "DELETE FROM products WHERE id=$id";
			$link->query($sql);
		}
	}

	// now, to edit the existing data, we have to select all the records in a variable.
	$sql="SELECT * FROM products ORDER BY id";
	$result = $link->query($sql);
	
	// now edit them
	while($product = mysqli_fetch_array($result)) {
		// remember how we constructed the field names above? This was with the idea to access the values easy now
		$sql = "UPDATE products SET qty='".$_POST['qty'.$product['id']]."', name='".$_POST['name'.$product['id']]."'
		WHERE id='$product[id]'";		
		$link->query($sql);
	}
	// (feel free to optimize this so query is executed only when a product is actually changed)
	
	// adding new products
	if(!empty($_POST['qty'])) {
		foreach($_POST['qty'] as $cnt => $qty) {
			$sql = "INSERT INTO products (qty, name) VALUES ('$qty', '".$_POST['name'][$cnt]."');";
			$link->query($sql);
		}
	}	
}

// select existing products here
$sql="SELECT * FROM products ORDER BY id";
$result = $link->query($sql);
?>

<html>
<head >
	<title>infinite form fields</title>
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>

<div class="header" >
	<h1>infinite form fields</h1>
	<img class="logo" src="logoforform.png" alt="">
	</div>
	<form method="post">
	<div class="input-group" id="itemRows">
	(Complete and click first "ADD" then "UPDATE") </br></br>
	<input type="text" name="add_qty" placeholder="email" /> <input type="text" name="add_name" placeholder="name" /> <input class="btn" onclick="addRow(this.form);" type="button"  value="ADD" />
	
	<?php
	// Assume you have the data from the DB
	while($product = mysqli_fetch_array($result)): ?>
		<p id="oldRow<?=$product['id']?>"> <input type="text" name="qty<?=$product['id']?>" value="<?=$product['qty']?>" placeholder="email" /> <input type="text" name="name<?=$product['id']?>" value="<?=$product['name']?>" placeholder="name" /> <input class="checkbox" type="checkbox" name="delete_ids[]" value="<?=$product['id']?>">mark to delete</p>
	<?php endwhile;?>
	
	</div>
	
	<p><input class="upbutton" type="submit" name="ok" value="FLUSH :-) OR UPDATE"></p>
	</form>

<div><form action="export.php" method="post">
    <input class="exportbutton" type="submit" value="EXPORT THE FILE">
</form></div>

<script type="text/javascript">
var rowNum = 0;
function addRow(frm) {
	rowNum ++;
	var row = '<p id="rowNum'+rowNum+'"> <input type="text" name="qty[]" placeholder="email" value="'+frm.add_qty.value+'"> <input type="text" name="name[]" placeholder="name" value="'+frm.add_name.value+'"> <input type="button" class="removebtn" value="REMOVE" onclick="removeRow('+rowNum+');"></p>';
	jQuery('#itemRows').append(row);
	frm.add_qty.value = '';
	frm.add_name.value = '';
}

function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
</script>
</body>	
</html>
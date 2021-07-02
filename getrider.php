<?php 

require 'include/dbconfig.php';

$cid = $_POST['catid'];
//cid = 24

$c = $con->query("select * from rider where shop_id=".$cid."");
?>
<option value="">Select Driver</option>
<?php 

while($row = $c->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
	<?php 
}
<?php 
require 'admin/include/dbconfig.php'; 
$path = 'admin/';  
if(isset($_POST['keywords']))
{
	$keywords = $_POST['keywords'];
	$sql = $con->query("SELECT * FROM `product` where pname LIKE '%".$keywords."%' and status =1 ");
  
  echo '<table class="table cart_summary"> <tbody>';
  if($sql->num_rows > 0) {
    
    while($row = $sql->fetch_assoc()) {
		$price = explode('$;',$row['pprice']);
		$ptype = explode('$;',$row['pgms']);
?>

<tr>

<td class="" style="    width: 90px;"><a href="single.php?id=<?php echo $row['id'];?>"><img class="img-fluid" src="<?php echo $path.$row['pimg'];?>" alt="" width="80"></a></td>
<td class="cart_description">
<h5 class="product-name"><a href="single.php?id=<?php echo $row['id'];?>"><?php echo $row['pname'];?></a></h5>
 <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php echo $ptype[0];?></h6>
</td>

<td class="price"><span><strong><?php echo $price[0].' '.$fset['currency'];?></strong></span></td>
</tr>
<?php } ?>

	  <?php
    }
    
  else {
    echo "<td>No match found!</td>";
  }
  echo "</tbody></table>";
  echo "<div class='clearfix'></div>";
}
?>
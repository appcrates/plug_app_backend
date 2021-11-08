<?php 
require 'admin/include/dbconfig.php'; 
$path = 'admin/';  
if(isset($_POST['cid']))
{
	$cid = $_POST['cid'];
	?>
	<div class="owl-carousel owl-carousel-category">
	<?php 
$category = $con->query("select * from subcategory where cat_id=".$cid."");
while($row = $category->fetch_assoc())
{
	
?>
<div class="item">
<div class="category-item">
<a href="javascript:void(0);" <?php if($con->query("select * from product where sid=".$row['id']."")->num_rows != 0){?>class="subcat_click" <?php } ?> data-id="<?php echo $row['id'];?>">
<img class="img-fluid" src="<?php echo $path.$row['img'];?>" alt="">
<h6><?php echo $row['name'];?></h6>
<p><?php echo $con->query("select * from product where sid=".$row['id']."")->num_rows.' Products';?></p>
</a>
</div>
</div>
<?php   }?>
</div>
	<?php 
}
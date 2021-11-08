<?php 
if(isset($_GET['msg']))
{
    if(isset($_GET['charge_id']))
    {
    $returnArr = array("charge_id"=>$_GET['charge_id'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>$_GET['msg']);
 echo json_encode($returnArr);
}
else {
$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>$_GET['msg']);
echo json_encode($returnArr);
}
}
else {
    

?>
<form   action="form.php" method="post"  >
<input type="hidden" value="<?php echo $_GET['amt']* 100;?>" name="amt"/>
 <div 
    class="myuserPay-button" 
    data-public_key="pk_test_9e09edba0df96c600faf2f22e1ffce1b"
    data-amount="<?php echo $_GET['amt'] * 100;?>"
    data-description="Order"
    data-email="<?php echo $_GET['email'];?>"
    data-name="theplugg Order" 
    data-image="https://admin.theplugg.app/website/thump_1623732517.png"
    >
 </div>
</form>

<script type="text/javascript" src="https://api.myuser.com/js/checkout.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
    .myuserPay-Paybutton
    {
        display:none;
    }
    button.close-btn {
    display: none !important;
}
</style>
  <script>
    $(window).on('load', function() {
     jQuery('.myuserPay-Paybutton').click();
    });
  </script>
<?php } ?>
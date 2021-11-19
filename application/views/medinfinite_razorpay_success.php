<?php 


//$api_key='rzp_test_BGLPFtM9zlOVDY';
//$api_secret='P6EVJZ59BYmsx1N0E6sLFGsr'; // issm test keys

//$api_key='rzp_live_aNXO7tqUxvv7rl';
//$api_secret='V0z4mq5OtX2yL8vOd3Kz7fMw';  // issm live keys


//$api_key='rzp_test_EKzZtSCRLMnLtC';
//$api_secret='Ss84oH7P5OhNAG7X1rEPVRwP';  // plato text keys

//$api_key='rzp_live_Cx7apcIOg1pHp6';
//$api_secret='sUw0Dk8vaxETdH2Arlwkje3d';  // plato live keys

$payment_keys=$this->db->query("select * from payment_gateway where id='1'")->row_array();

$api_key=$payment_keys['key'];
$api_secret=$payment_keys['secret'];  

//require('razorpay/config.php');
require('Razorpay/Razorpay.php');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$api = new Api($api_key, $api_secret);
$success = false;
$message='';
$error='';

date_default_timezone_set('Asia/Kolkata');
if ( ! empty( $_POST['razorpay_payment_id'] ) ) {

 try
    {
        $attributes = array(
            'razorpay_order_id' => $_POST['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
        $success = true;
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }

    //$api = new Api('YOUR_KEY_ID', 'YOUR_KEY_SECRET');

    //$payment1 = $api->payment->fetch($_POST['razorpay_payment_id']);
    

}

if (($success === true) || ($success == 1))
{
    $html = "Payment success/ Signature Verified";

    $update_array=array(
                        'payment_status'=>'success',
                        'razorpay_payment_id'=>$_POST['razorpay_payment_id'],
                        'razorpay_signature'=>$_POST['razorpay_signature'],
                        'payment_msg'=>'Signature Verified',
                        'payment_created_on'=>date('Y-m-d H:i:s')
                       );
    //$this->db->where('id',$payment_id);
    $this->db->update('medinfinite_users',$update_array,array('id'=>$payment_id));

    $ppquery="select * from tbl_medinfinite_users where id='".$payment_id."' ";
    $payment_info=$this->db->query($ppquery)->row_array();


    /*--Start QR code-Generation--
    $this->load->library('ciqrcode');
    $name=$payment_info['name'];
    $email=$payment_info['email'];
    $mobile=$payment_info['phone'];
    $event=$payment_info['event'];
    $college_name=$payment_info['college_name'];
    $member_id=$payment_info['member_id'];
    $year_of_study=$payment_info['year_of_study'];

    $params['data'] = $name.'##'.$email.'##'.$mobile.'##'.$event.'##'.$college_name.'##'.$member_id.'##'.$year_of_study;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = FCPATH.'storage/medinfiniteqrcodes/'.$mobile.'.png';
    $this->ciqrcode->generate($params);
    $qrcode_path='storage/medinfiniteqrcodes/'.$mobile.'.png';
    $payment_info['qrcode_path']=base_url().$qrcode_path;

    $up_data=array('qrcode_path'=>$payment_info['qrcode_path']);
    $result=$this->db->update('medinfinite_users',$up_data,array('id'=>$payment_id));
   --End QR code-Generation--*/


         $to = "asrinivas433@somedomain.com";
         $subject = "This is subject";
         
         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From:akurathisrinivas433@gmail.com \r\n";
       //  $header .= "Cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";exit;
         }else {
            echo "Message could not be sent...";exit;
         }

           



    $message='success';
    


    /*--stop insert student record in dbmci database---*/
}
else
{
    $ppquery="select * from tbl_medinfinite_users where id='".$payment_id."' ";
    $payment_info=$this->db->query($ppquery)->row_array();
    


    

    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
    $update_array=array(
                        'payment_status'=>'failed',
                        'payment_msg'=>$error,
                        'payment_created_on'=>date('Y-m-d H:i:s')
                       );
    $this->db->where('id',$payment_id);
    $this->db->update('medinfinite_users',$update_array);

    $message='failed';
}

//echo $html;
?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>


<div class="container">
    <div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
        
        <?php if($message == 'success'){?>
        <br><br> <h2 style="color:#0fad00">Payment Success</h2>
        <!--<img src="http://osmhotels.com//assets/check-true.jpg">-->
        <h3>Dear, <?php echo $payment_info['name'];?></h3>
        <b style="font-size:20px;">Thank you for Payment with Medinfinite2.o.
        </b>
        <br><br>    
        <p>Razor Pay Order ID:<b><?php echo $_POST['razorpay_order_id'];?></b></p>
        <br><br>
        <p>Razor Pay Payment ID:<b><?php echo $_POST['razorpay_payment_id'];?></b></p>
        <br><br>
        <p>Receipt ID:<b><?php echo $payment_info['receipt_id'];?></b></p>
        <br><br>
        <p>Event:<b><?php echo $payment_info['event'];?></b></p>
        <br><br>
        <p>Payment Done On:<b><?php echo $payment_info['payment_created_on'];?></b></p>
        <br><br>
        <br><br>
        <p>QR Code:
            <img src="<?php echo $payment_info['qrcode_path'];?>" alt="QrCode">
        </p>
        <br><br>
        <p>Amount Paid:<b><?php echo $payment_info['paid_amt'];?> Rs/-</b></p>

       <!-- <a href="http://platoonline.in/payment/start_preparation" class="btn btn-success"> Start Preparation  </a>-->
       <!-- <a href="<?php echo base_url()?>/payment/start_preparation"> <button class="btn btn-success">Start Preparation</button></a> -->
        <?php }else{?>
        <br><br> <h2 style="color:red">Payment Failed</h2>
        
        <h3>Dear, <?php echo $payment_info['name'];?></h3>
        <p style="font-size:20px;color:#5C5C5C;">Sory,Your Payment was failed.
        </p>
        <br><br>
        <p>Razor Pay Reference ID:<b><?php echo $payment_info['receipt_id'];?></b></p>
        <br><br>
        <!-- <a href="<?php echo base_url()?>/payment/try_again" class="btn btn-success"> Please try Once.  </a> -->
           <?php }?>
        <br><br>

        
        </div>
        
    </div>
</div>
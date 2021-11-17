<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include 'db_connection.php';
    require_once('Vendor/PHPMailer/src/PHPMailer.php');
	require_once('Vendor/PHPMailer/src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php 
if(isset($_POST['submit'])){

    $filename = $_FILES["d_license"]["name"];
    $tempname = $_FILES["d_license"]["tmp_name"];
    $license = "driverImg/a".time().$filename;
    uploadFile($tempname, $license);

    $filename = $_FILES["d_insurance"]["name"];
    $tempname = $_FILES["d_insurance"]["tmp_name"];
    $insurance = "driverImg/b".time().$filename;
    uploadFile($tempname, $insurance);

    $filename = $_FILES["front_credit"]["name"];
    $tempname = $_FILES["front_credit"]["tmp_name"];
    $frontcard = "driverImg/c".time().$filename;
    uploadFile($tempname, $frontcard);

    $filename = $_FILES["back_credit"]["name"];
    $tempname = $_FILES["back_credit"]["tmp_name"];
    $backcard = "driverImg/d".time().$filename;
    uploadFile($tempname, $backcard); 

    // form fields
    $property= $_POST['property'];
    $dfirstname= $_POST['d_firstname'];
    $dlastname= $_POST['d_lastname'];
    $checkindate= $_POST['checkindate'];
    $demail= $_POST['d_email'];

   
		$dataRet = $db->query('INSERT into golfcartusers (Firstname, Lastname, Property, Checkindate, emailaddress, DLpiclink, Inspiclink, CCfrontpiclink, CCbackpiclink) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', $dfirstname, $dlastname, $property, $checkindate, $demail, $license, $insurance, $frontcard, $backcard);
        
        if ($dataRet) {
        // Admin Email
            $date = date("d-m-Y", strtotime($checkindate) );
        
            $bodytext ='Hey, <br> <p> Please find below driver details:- <p> <div><p>First Name = '.$dfirstname.' </p><p> Last Name = '.$dlastname.' </p><p> Property Name= '.$property.' </p><p> Check In Date = '.$date.' </p> <p> Driver Email = '.$demail.' </p> </div>';
        
            $email = new PHPMailer();
            $email->SetFrom('noreply@equisourceholdings.com');
            $email->Subject   = $dfirstname.', ' .$property. ', ' .$checkindate  ;
            $email->Body      = $bodytext;
            $email->AddAddress( 'golfcartagreements@gmail.com' );  // admin email: golfcartagreements@gmail.com
            $email->isHTML(true);
        
            $email->AddAttachment( $license );
            $email->AddAttachment( $insurance );
            $email->AddAttachment( $frontcard );
            $email->AddAttachment( $backcard );
            
            $email->Send();
            $email->clearAllRecipients();
            $email->clearAttachments();

            // Sender Email 
            $emailbody = $db->query("SELECT Emailbody FROM properties WHERE name='$property'")->fetchArray();
                if($emailbody['Emailbody']!= ""){
            $bodytext ='Hi '.$dfirstname.', <br> <p>' .$emailbody['Emailbody'].'</p>';
        
            $email->Subject   =  'Golf cart lockbox code for '. $dfirstname .' '. $dlastname . ' for '. $checkindate .' at '. $property ;
            $email->Body      = $bodytext;
            $email->AddAddress($demail);
            $email->isHTML(true);
            
            $email->Send();
                }
          ?>
    <section class="thank_you m-4">
        <div class="container">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card_wrapper ">
                    <div class="brand text-center mb-4">
                        <a href="/"><img src="img/finallogo.png" alt="Koastal Karts" width="200px"></a>
                    </div>
                    <div class="card col-md-12 m-auto p-0">
                        <div class="card-header text-center">
                            Complimentary Use Agreement
                        </div>
                        <div class="card-body text-center">
                            <p>Thank you for submitting your
                                golf cart use agreement and
                                documents <span style="font-weight: 600;"> <?=  $dfirstname; ?>! </span>
                            </p>
                            <p>An email has been sent to
                                <span style="font-weight: 600;"> <?= $demail; ?> </span> with the
                                lockbox code for your golf cart
                                keys.
                            </p>
                        </div>
                        <div class="card-footer text-center">Please drive safely and please enjoy your stay!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        }
        else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
}

function uploadFile($tempname, $folder){
    if (move_uploaded_file($tempname, $folder))  {
        return true;
    }else{
        return false;
    }
}
?>
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
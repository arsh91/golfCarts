<?php
	include 'db_connection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Golf Carts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div id="divLoading">
        <div class="container">
            <div class="row">
                <div class="col-md-8 m-auto text-center">
                    <div class="loading">
                        <p>Your pictures will now be uploaded.</p>
                        <p>It may appear that your screen is “locked up” or “frozen” for up to 60 seconds.</p>
                        <p>This is normal. Please allow at least 60 seconds for the upload to complete.</p>
                        <p>Please do not click the back button or refresh until the upload completes.</p>
                        <img src="img/loader.gif">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="driver_form m-4">
        <div class="container">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card_wrapper ">
                    <div class="brand text-center mb-4">
                        <a href="/"><img src="img/finallogo.png" alt="Koastal Karts" width="200px"></a>
                    </div>
                    <form method="POST" name="driver_details" action="success.php" class="needs-validation golfcartForm"
                        id="driver_details" enctype="multipart/form-data" novalidate>
                        <div class="card col-md-12 m-auto p-0">
                            <div class="card-header text-center">
                                Complimentary Use Agreement
                            </div>
                            <div class="card-body">
                                <div class="drivers_det">
                                    <div class="form-group">
                                        <div class="form-group mb-3">
                                            <label for="property_name">Property Name</label>
                                            <?php $properties = $db->query('SELECT * FROM properties ORDER BY name ASC')->fetchAll(); ?>
                                            <select class="form-control form-select" name="property"
                                                aria-label="Default select example" required>
                                                <option value="">Select Property Name</option>
                                                <?php foreach ($properties as $row) {?>
                                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?>
                                                </option>
                                                <?php }   ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="checkindate">Select Check In Date</label>
                                            <input type="date" name="checkindate" max="2999-12-31" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="d_firstname">Driver First Name</label>
                                            <input type="text" name="d_firstname" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="d_lastname">Driver Last Name</label>
                                            <input type="text" name="d_lastname" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="d_email">Email Address</label>
                                            <input type="email" name="d_email" id="d_email"
                                                class="form-control custom_val" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="confirm_email">Repeat Email Address</label>
                                            <input type="email" name="confirm_email" id="confirm_email"
                                                class="form-control custom_val" required>
                                        </div>
                                        <div class="invalid-feedback email_match"
                                            style="font-size:14px; display:none; margin-top:-15px; margin-bottom:15px;">
                                        </div>
                                        <!-- <div class="form-group mb-3">
                                            <label for="d_dob">Driver D O B</label>
                                            <input type="date" name="d_dob" max="2999-12-31" class="form-control"
                                                required>
                                        </div> -->
                                        <div class="form-group input-group mb-3">
                                            <label class="file_fields" for="d_license">Select driver’s license
                                                image</label>
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" name="d_license" id="license"
                                                    class="custom-file-input " required>
                                                <label class="custom-file-label show_desktop_view" for="license">Choose
                                                    file</label>
                                                <label class="custom-file-label show_mobile_view" for="license">Take
                                                    Pic</label>
                                            </div>
                                            <div class="img_preview lic_preview">
                                                <img id="d_license_img" src="" class="preview_lic_img" />
                                                <input type="button" id="remove_lic_btn" value="x" class="btn-rmv1" />
                                            </div>
                                        </div>
                                        <div class="form-group input-group mb-3">
                                            <label class="file_fields" for="d_insurance">Select insurance card
                                                image</label>
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" name="d_insurance"
                                                    class="custom-file-input" id="insurance" required>
                                                <label class="custom-file-label show_desktop_view"
                                                    for="insurance">Choose
                                                    file</label>
                                                <label class="custom-file-label show_mobile_view" for="insurance">Take
                                                    Pic</label>
                                            </div>
                                            <div class="img_preview ins_preview">
                                                <img id="d_insurance_img" src="" class="preview_insurance_img" />
                                                <input type="button" id="insurance_btn" value="x" class="btn-rmv2" />
                                            </div>
                                        </div>
                                        <div class="form-group input-group mb-3">
                                            <label for="front_credit" class="file_fields">Select front of credit card
                                                for damages image</label>
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" name="front_credit"
                                                    class="custom-file-input" id="front_card" required>
                                                <label class="custom-file-label show_desktop_view"
                                                    for="front_card">Choose
                                                    file</label>
                                                <label class="custom-file-label show_mobile_view" for="front_card">Take
                                                    Pic</label>
                                            </div>
                                            <div class="img_preview frontcard_preview">
                                                <img id="fcard_img" src="" class="preview_fcard_img" />
                                                <input type="button" id="frontcard_btn" value="x" class="btn-rmv3" />
                                            </div>
                                        </div>
                                        <div class="form-group input-group mb-3">
                                            <label for="back_credit" class="file_fields">Select back of credit card for
                                                damages image</label>
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" name="back_credit"
                                                    class="custom-file-input" id="back_card" required>
                                                <label class="custom-file-label show_desktop_view"
                                                    for="back_card">Choose
                                                    file</label>
                                                <label class="custom-file-label show_mobile_view" for="back_card">Take
                                                    Pic</label>
                                            </div>
                                            <div class="img_preview backcard_preview">
                                                <img id="bcard_img" src="" class="preview_bcard_img" />
                                                <input type="button" id="backcard_btn" value="x" class="btn-rmv4" />
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="agree"
                                                required>
                                            <label class="form-check-label" for="agree">
                                                I agree to the terms of
                                                complimentary <a
                                                    href="//golfcarts.equisourceholdings.com/useagreement.pdf"
                                                    target="_blank">golf cart
                                                    use agreement </a></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="authorize"
                                                required>
                                            <label class="form-check-label" for="authorize">
                                                I authorize my credit
                                                card to be charged for
                                                damages according to
                                                this <a href="//golfcarts.equisourceholdings.com/pricelist.pdf"
                                                    target="_blank">price list </a> </label>

                                                    <div class="invalid-feedback lostErrorMsg mt-3" style="font-size: 16px;text-align: center;">
                                            Please correct the errors above that are highlighted in red
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <div class="form-group">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary submitBTN">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="js/custom.js"></script>
</body>

</html>
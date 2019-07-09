<?php

require_once __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';
require './includes/referenceDataConfig.php';


$uploadOk = 0;


$mail = new PHPMailer(true);
try {

   if (isset($_POST["submit"])) {
      $error = FALSE;
      function test_input($data)
      {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
      }


      if (isset($_POST['submit'])) {
         $firstnameError = "";
         $departmentError = "";
         $otherDepartmentError = "";
         $periodError = "";
         $uploadDocumentError = "";
         $urgentlyRequiredError = "";
         $printCopiesError = "";
         $printDateError = "";


         if (empty($_POST['firstname'])) {
            $firstnameError = "Name is required.";
            $error = TRUE;
         } else {
            $firstname = test_input($_POST["firstname"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
               $firstnameError = "Only letters and white space allowed.";
               $error = TRUE;
            }
         }

         if (empty($_POST['department'])) {
            $departmentError = "Department/Budget is required.";
            $error = TRUE;
         }

         if (empty($_POST['printCopies'])) {
            $printCopiesError = "Atleast 1 Print copy is required.";
            $error = TRUE;
         } else {

            $printCopies = test_input($_POST["printCopies"]);
            if (!preg_match("/^([1-9]|50)$/", $printCopies)) {
               $printCopiesError = "Min 1 or Max 50.";
               $error = TRUE;
            }
         }
         if (empty($_POST['Dates'])) {
            $printDateError = "Print Date is required.";
            $error = TRUE;
         } else {
            $printDate = date("m-d-Y", strtotime($_POST["Dates"]));
            $printDate_arr  = explode('-', $printDate);
            if (count($printDate_arr) == 3) {
               if (checkdate($printDate_arr[0], $printDate_arr[1], $printDate_arr[2])) {
                  $error = FALSE;
               } else {
                  $error = TRUE;
                  $printDateError = "Invalid Print Date.";
               }
            } else {
               $error = TRUE;
               $printDateError = "Print Date is required.";
            }
         }

         if (empty($_POST['period'])) {
            $periodError = "Period is required.";
            $error = TRUE;
         }

         if (empty($_FILES['uploadDocument']['name'])) {
            $uploadDocumentError = "Upload your document to print.";
            $error = TRUE;
         }

         if (empty($_POST['urgentlyRequired'])) {
            $urgentlyRequiredError = "Required.";
            $error = TRUE;
         }
         if ($error == TRUE) {
            error_log("Error Submitting the form: ", $error);
         } else {
            $errors = array();
            $file_name = $_FILES['uploadDocument']['name'];
            $file_size = $_FILES['uploadDocument']['size'];
            $file_tmp = $_FILES['uploadDocument']['tmp_name'];
            $file_type = $_FILES['uploadDocument']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['uploadDocument']['name'])));

            $extensions = array("jpeg", "jpg", "png", "docx", "pdf", "xlsx");

            if (in_array($file_ext, $extensions) === false) {
               $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }
            if ($file_size > 2097152) {
               $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors) == true) {
               move_uploaded_file($file_tmp, "images/" . $file_name);
               $uploadOk = 1;
            } else {
               print_r($errors);
               $uploadOk = 0;
            }

            if ($uploadOk == 1) {
               $printType = "";
               if (!empty($_POST['check_list'])) {
                  foreach ($_POST['check_list'] as $selected) {
                     $printType = $printType . $PRINT_TYPE_CONFIG[$selected] . ",";
                  }
               } else {
                  $printType = "Default Prints";
               }

               $firstName =  $_POST["firstname"];


               $department = $DEPARTMENT_CONFIG[$_POST["department"]];
               $printCopies =  $_POST["printCopies"];
               $dateRequired  = date("d-M-Y", strtotime($_POST["Dates"]));
               $period = $PERIOD_CONFIG[$_POST["period"]];
               $urgentlyRequired = $_POST["urgentlyRequired"];
               $specialRequirement = $_POST["specialRequirement"];


               // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
               $mail->isSMTP();                                            // Set mailer to use SMTP
               $mail->Host       = getenv('HOST');                       // Specify main and backup SMTP servers
               $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
               $mail->Username   = getenv('USER_NAME');                            // SMTP username
               $mail->Password   = getenv('PASSWORD');                             // SMTP password
               $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
               $mail->Port       = 587;                                    // TCP port to connect to

               if ($urgentlyRequired == 'Yes') {
                  $mail->Priority = 1;
               }
               //Recipients
               $mail->setFrom(getenv('FROM_EMAIL'), 'Mailer');
               $mail->addAddress(getenv('TO_EMAIL'), getenv('TO_NAME'));     // Add a recipient
               $file_to_attach = "images/" . $file_name;
               $mail->AddAttachment($file_to_attach, $file_name);
               // Content
               $mail->isHTML(true);                                  // Set email format to HTML
               $mail->Subject = 'Reprographic Requirement for : ' . $firstName;
               $mail->Body    = '<html>
               <head>
               <style>
                           th, td {
                 padding: 5px;
                 text-align: left;
               }
               </style>
               </head>
               <body>
                           <table style="width:100%" border="1">
                   <tr>
                     <th>Name</th>
                     <td>' . $firstName . '</td>
                   </tr>
                   <tr>
                     <th>Department</th>
                     <td>' . $department . '</td>
                   </tr>
                   <tr>
                   <th>Number of Copies</th>
                   <td>' . $printCopies . '</td>
                   </tr>
                   <tr>
                     <th>Date Required</th>
                     <td>' . $dateRequired . '</td>
                   </tr>
                   <tr>
                     <th>Period</th>
                     <td>' . $period . '</td>
                   </tr>
                   <tr>
                     <th>Urgently required</th>
                     <td>' . $urgentlyRequired . '</td>
                   </tr>
                   <tr>
                     <th>Print Requirements</th>
                     <td>' . $printType . '</td>
                   </tr>
                   <tr>
                     <th>Special Requirements (if any)</th>
                     <td>' . $specialRequirement . '</td>
                   </tr>
                 </table>
                 <br/>
                 </body>
                           </html>';

               $mail->send();
               $_POST = array();
               unset($_POST);


            } else {
               error_log("Failed to send email, upload status is ", $uploadOk);
            }
         }
      }
   }
} catch (Exception $e) {

   error_log( "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
   error_log("Message could not be sent. Mailer Error: ", $mail->ErrorInfo . $e);
}

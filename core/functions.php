<?php
// header('Content-Type: application/json');
include('db_config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Admin Login

if (isset($_POST['login_admin'])) {

    $name = mysqli_real_escape_string($con, $_POST['admin_name']);
    $password = mysqli_real_escape_string($con, $_POST['admin_password']);

    $user_sql = mysqli_query($con, "SELECT * FROM users WHERE Email='$name' AND Password='$password'");
    $fetch_user_sql = mysqli_fetch_assoc($user_sql);

    if ($fetch_user_sql) { // Check if a matching user was found
        session_start();

        // Store user information in the session
        $_SESSION['user_id'] = $fetch_user_sql['user_id'];
        $_SESSION['user_name'] = $fetch_user_sql['Email'];
        $_SESSION['name'] = $fetch_user_sql['Name'];
        header("location: $mainlink" . "admin/dashboard");
        // exit();

    } else {
        // Handle the case where no user with the specified 'Name' was found
        $_SESSION['message'] = "User not found";
        header("location: $mainlink" . "admin/");
        // exit();
    }


    // if($password = )

    // header('location: ../dashboard');
} elseif (isset($_POST['topic_manage'])) {
    $topic = $_POST['topic'];
    $currentDate = date("Y-m-d H:i:s");
    $insert_query = mysqli_query($con, "INSERT INTO topics(topicName,createdOn,isActive) VALUES('$topic','$currentDate',1)");

    if ($insert_query) {
        header("location: $mainlink" . "./admin/topic");
    } else {
        echo "not done";
    }



} elseif (isset($_POST['checking_topic_btn'])) {
    $topic_id = $_POST['topicId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `topics` WHERE Id = $topic_id";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update_topic'])) {
    $id = $_POST['topicId'];
    $topic_name = $_POST['topic_name'];

    $update_topic = "UPDATE topics set topicName='$topic_name' WHERE Id='$id'";
    $query = mysqli_query($con, $update_topic);

    if ($query) {
        header("location: $mainlink" . "./admin/topic");
    } else {
        echo "not working";
    }
} elseif (isset($_POST['delete_topic'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM topics WHERE Id = $id";
    $query = mysqli_query($con, $sql);
    if ($query) {
        // If the delete operation is successful, you can redirect to a success page
        header("location: $mainlink" . "./admin/topic");
        // exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($conn);
} elseif (isset($_POST['subtopic_manage'])) {
    $topic = $_POST['topic'];
    $subtopic = $_POST['subtopic'];
    $currentDate = date("Y-m-d H:i:s");
    $insert_query = mysqli_query($con, "INSERT INTO subtopics (topicId,subTopicName,createdOn) VALUES('$topic','$subtopic','$currentDate')");

    if ($insert_query) {
        header("location: $mainlink" . "./admin/subtopic");
        // echo "hii";
    } else {
        echo "not done";
        echo $topic, $subtopic, $currentDate;
    }
} elseif (isset($_POST['delete_subtopic'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql = "UPDATE subtopics SET isActive = 0 WHERE id = $id";
    $query = mysqli_query($con, $sql);
    if ($query) {
        // If the delete operation is successful, you can redirect to a success page
        header("location: $mainlink" . "./admin/subtopic");
        // exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($conn);
} elseif (isset($_POST['course_manage'])) {
    $topic = $_POST['topic'];
    $subtopic = $_POST['subtopic'];
    $courseName = $_POST['courseName'];
    $price = $_POST['price'];
    $summary = $_POST['Summary'];
    $desc = $_POST['description'];
    $wyl = $_POST['wyl'];
    $requirements = $_POST['req'];
    // Handle image upload
    if (isset($_FILES['image'])) {
        $imageFile = $_FILES['image'];
        $imageFileName = $imageFile['name'];
        // Process and move the image file to your desired location
        move_uploaded_file($imageFile['tmp_name'], 'upload/image/' . $imageFileName);
    }
    // $uploadfile = $_POST['uploadfile'];
    // Handle file upload
    if (isset($_FILES['uploadfile'])) {
        $uploadFile = $_FILES['uploadfile'];
        $uploadFileName = $uploadFile['name'];
        // Process and move the upload file to your desired location
        move_uploaded_file($uploadFile['tmp_name'], 'uploads/files' . $uploadFileName);
    }

    // Handle video upload
    if (isset($_FILES['video'])) {
        $videoFile = $_FILES['video'];
        $videoFileName = $videoFile['name'];
        // Process and move the video file to your desired location
        move_uploaded_file($videoFile['tmp_name'], 'upload/video/' . $videoFileName);
    }

    $insert_course = mysqli_query($con, "INSERT INTO courses(topicID,subTopicId,courseName,courseCost,courseDesc,learn,summary,requirements,bannerImage,uploadfile,video) VALUES('$topic','$subtopic','$courseName','$price','$desc','$wyl','$summary','$requirements','$imageFileName','$uploadFileName','$videoFileName')");
    // $insert_query = mysqli_query($con, "INSERT INTO courses(topicID ,subTopicId ,courseName,courseCost,bannerImage,uploadfile,video,courseDesc,learn,summary,requirements) VALUES('$topic','$subtopic','$courseName','$price','$imageFileName','$uploadFileName','$videoFileName','$desc','$wyl','$summary','$requirements')");

    if ($insert_course) {
        header("location: $mainlink" . "admin/manageCourse");
    } else {
        echo "not done";
    }
} elseif (isset($_POST['checking_course_btn'])) {
    $courseId = $_POST['course_id'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `courses` WHERE id = $courseId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['subscription_manage'])) {
    $subscription = $_POST['subscription'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $courseName = $_POST['courseName'];

    $insert_query = mysqli_query($con, "INSERT INTO subscriptions_1(subscription, type, price, duration,courseName) VALUES('$subscription','$type','$price','$duration','$courseName')");

    if ($insert_query) {
        header("location: $mainlink" . "manageSubscriptions");
    } else {
        echo "not done";
    }
} elseif (isset($_POST['checking_subscription_btn'])) {
    $subscriptionId = $_POST['subscription_id'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `subscriptions_1` WHERE id = $subscriptionId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update_subscription'])) {
    $id = $_POST['subscription_id'];
    $name = $_POST['editname'];
    $type = $_POST['edittype'];
    $price = $_POST['editprice'];
    $duration = $_POST['editduration'];
    $courseId = $_POST['courseId'];

    $update = "UPDATE subscriptions_1 set subscription='$name', type ='$type', price='$price', duration='$duration', courseName='$courseId' WHERE id='$id'";
    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "manageSubscriptions");
    } else {
        echo "not working";
    }
} elseif (isset($_POST['blog_manage'])) {
    // Process the form data as needed
    $title = $_POST['title'];
    if (isset($_FILES['image'])) {
        $imageFile = $_FILES['image'];
        $imageFileName = $imageFile['name'];
        // Process and move the image file to your desired location
        move_uploaded_file($imageFile['tmp_name'], '../assets/images/blog/' . $imageFileName);
    }
    $writer = $_POST['writer'];
    $desc = $_POST['desc'];
    // $category = $_POST['category'];
    // $created_on = $_POST['created_on'];

    // Insert the blog into the database and get the blog ID
    $insert_query = mysqli_query($con, "INSERT INTO blogs(blogTitle, bannerImage, writer, description,createdOn) VALUES('$title','$imageFileName','$writer','$desc',NOW())");

    // Get the ID of the newly inserted blog
    $blogId = mysqli_insert_id($con);

    // Check if tags have been provided
    if (isset($_POST['tags'])) {
        $tags = $_POST['tags'];

        // Split the comma-separated tags string into an array
        $tagsArray = explode(',', $tags);

        foreach ($tagsArray as $tag) {
            $tag = mysqli_real_escape_string($con, trim($tag)); // Remove leading/trailing whitespace
            $insertTagQuery = "INSERT INTO blogtag (name, blog_id) VALUES ('$tag', $blogId)";
            mysqli_query($con, $insertTagQuery);
        }

        header("location: $mainlink" . "./admin/blog");
    } else {
        echo "Tag insertion failed";
    }
} elseif (isset($_POST['checking_edit_btn'])) {
    $blogId = $_POST['blog_id'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `blogs` WHERE id = $blogId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update'])) {
    $id = $_POST['blog_id'];
    $title = mysqli_real_escape_string($con, $_POST['editTitle']);
    $writer = mysqli_real_escape_string($con, $_POST['editWriter']);
    $description = mysqli_real_escape_string($con, $_POST['editDescription']);

    if (isset($_FILES['editImage']['tmp_name']) && !empty($_FILES['editImage']['tmp_name'])) {
        // Handle the new image upload
        $newImage = mysqli_real_escape_string($con, $_FILES['editImage']['name']);

        // Debugging for file path
        $imagePath = "../assets/images/blog/" . $newImage;
        echo "Image Path: $imagePath<br>";

        // Move the uploaded image to the destination folder
        move_uploaded_file($_FILES['editImage']['tmp_name'], $imagePath);

        // Update the database with the new image filename
        $update = "UPDATE blogs SET blogTitle='$title', writer ='$writer', description='$description', bannerImage='$newImage' WHERE id='$id'";
    } else {
        // No new image uploaded, keep the old image
        $update = "UPDATE blogs SET blogTitle='$title', writer ='$writer', description='$description' WHERE id='$id'";
    }

    // Debugging for SQL query
    echo "SQL Query: $update<br>";

    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "admin/blog");
    } else {
        echo "Query Error: " . mysqli_error($con);
    }
}


if (isset($_POST['delete_blog'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];

    // Create a database connection (adjust these settings according to your database)

    // Check the database connection
    // UPDATE orderdetails SET status = 1 WHERE id = $co_id
    // Perform the delete operation using the ID (replace "your_table" with your table name)
    $sql = "UPDATE blogs SET isActive = 0 WHERE id = $id";
    $query = mysqli_query($con, $sql);
    if ($query) {
        // If the delete operation is successful, you can redirect to a success page
        header("location: $mainlink" . "admin/blog");
        // exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($conn);
} elseif (isset($_POST['freeResources_manage'])) {
    $heading = $_POST['heading'];
    $title = $_POST['title'];
    if (isset($_FILES['image'])) {
        $imageFile = $_FILES['image'];
        $imageFileName = $imageFile['name'];
        // Process and move the image file to your desired location
        move_uploaded_file($imageFile['tmp_name'], '../assets/images/freeResource/' . $imageFileName);
    }
    // $writer = $_POST['writer'];
    $desc = $_POST['desc'];

    $insert_query = mysqli_query($con, "INSERT INTO freeresources(resourcesName, title, bannerImage, description, createdOn) VALUES('$heading', '$title', '$imageFileName','$desc',NOW())");

    if ($insert_query) {
        header("location: $mainlink" . "admin/freeResources");
    } else {
        echo "not done";
    }
} elseif (isset($_POST['checking_resource_btn'])) {
    $resource_id = $_POST['resourceId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `freeresources` WHERE id = $resource_id";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }
} else {
    //echo $return = "<h5>No Record Found</h5>";
}

if (isset($_POST['update_resources'])) {

    $id = $_POST['resourceId'];
    $resourcename = mysqli_real_escape_string($con, $_POST['resourses_name']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    if (isset($_FILES['banner_image']['tmp_name']) && !empty($_FILES['banner_image']['tmp_name'])) {
        // Handle the new image upload
        $newImage = mysqli_real_escape_string($con, $_FILES['banner_image']['name']);
        // Debugging for file path
        $imagePath = "../assets/images/freeResource/" . $newImage;
        echo "Image Path: $imagePath<br>";

        // Move the uploaded image to the destination folder
        move_uploaded_file($_FILES['banner_image']['tmp_name'], $imagePath);

        $update = "UPDATE freeresources SET resourcesName='$resourcename', title='$title', bannerImage='$imagePath', description='$description' WHERE id='$id'";
    } else {
        // No new image uploaded, keep the old image
        $update = "UPDATE freeresources SET resourcesName='$resourcename', title ='$title', description='$description' WHERE id='$id'";
    }

    // Debugging for SQL query
    echo "SQL Query: $update<br>";

    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "admin/freeResources");
    } else {
        echo "Update failed: " . mysqli_error($con);
        exit; // Terminate script if update fails
    }
} elseif (isset($_POST['affiliate_manage'])) {
    $name = $_POST['name'];
    $details = $_POST['details'];
    $contactdetails = $_POST['contactdetails'];
    $contactPerson = $_POST['contactPerson'];
    $address = $_POST['address'];


    $insert_query = mysqli_query($con, "INSERT INTO affiliates(companyName, details, contactDetail, contactPerson, address) VALUES('$name', '$details', '$contactdetails','$contactPerson','$address')");

    if ($insert_query) {
        header("location: $mainlink" . "affiliate");
    } else {
        echo "not done";
    }
} elseif (isset($_POST['checking_affiliate_btn'])) {
    $affiliateId = $_POST['affiliateId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `affiliates` WHERE id = $affiliateId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update_affiliate'])) {
    $id = $_POST['affiliateId'];
    $company_name = $_POST['company_name'];
    $details = $_POST['details'];
    $contact_details = $_POST['contact_details'];
    $contact_person = $_POST['contact_person'];
    $address = $_POST['address'];

    $update = "UPDATE affiliates set companyName='$company_name', details ='$details', contactDetail='$contact_details', contactPerson='$contact_person', address='$address' WHERE id='$id'";
    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "affiliate");
    } else {
        echo "not working";
    }
} elseif (isset($_POST['career_manage'])) {
    $title = $_POST['title'];
    $exp = $_POST['exp'];
    $desc = $_POST['desc'];

    $insert_query = mysqli_query($con, "INSERT INTO careers(Title, Experience, Description) VALUES('$title', '$exp', '$desc')");

    if ($insert_query) {
        header("location: $mainlink" . "admin/career");
    } else {
        echo "not done";
    }
} elseif (isset($_POST['checking_career_btn'])) {
    $careerId = $_POST['careerId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `careers` WHERE id = $careerId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update_career'])) {
    $id = $_POST['careerId'];
    $title = $_POST['title'];
    $yoe = $_POST['yoe'];
    $description = $_POST['description'];


    $update = "UPDATE careers set Title='$title', Experience ='$yoe', Description='$description' WHERE id='$id'";
    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "admin/career");
    } else {
        echo "not working";
    }
}
if (isset($_POST['delete_career'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql = "UPDATE careers SET isActive = 0  WHERE Id = $id";
    $query = mysqli_query($con, $sql);
    if ($query) {
        // If the delete operation is successful, you can redirect to a success page
        header("location: $mainlink" . "admin/career");
        // exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($conn);
} elseif (isset($_POST['apply_job'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $exp = $_POST['experience'];
    $careerId = $_POST['CareerId'];

    // Process file upload
    $cvpath = '';
    if (isset($_FILES['cv'])) {
        $imageFile = $_FILES['cv'];
        $cvpath = '../assets/upload/' . $imageFile['name'];
        // Process and move the image file to your desired location
        move_uploaded_file($imageFile['tmp_name'], $cvpath);
    }

    // Insert data into the database
    $insertQuery = "INSERT INTO careersapplications (Name, Phone, Email, Experience, Attachment, CareerId,CreatedOn) 
                    VALUES ('$name', '$phone', '$email', '$exp', '$cvpath', '$careerId',NOW())";

    if (mysqli_query($con, $insertQuery)) {
        header("location: $mainlink" . "career");

    } else {
        echo "failed";
    }
} elseif (isset($_POST['corporateGovernance_manage'])) {
    $title = $_POST['title'];
    if (isset($_FILES['image'])) {
        $imageFile = $_FILES['image'];
        $imageFileName = $imageFile['name'];
        // Process and move the image file to your desired location
        move_uploaded_file($imageFile['tmp_name'], 'upload/image/' . $imageFileName);
    }
    $name = $_POST['name'];

    $insert_query = mysqli_query($con, "INSERT INTO corporategovernance(title, image, name) VALUES('$title', '$imageFileName', '$name')");

    if ($insert_query) {
        header("location: $mainlink" . "corporateGovernance");
    } else {
        echo "not done";
    }
} elseif (isset($_POST['checking_cg_btn'])) {
    $careerId = $_POST['cgId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `corporategovernance` WHERE id = $careerId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update_cg'])) {
    $id = $_POST['cgId'];
    $title = $_POST['title'];
    $name = $_POST['name'];
    $image = $_POST['image'];

    // Check if a new image has been uploaded
    if (isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name'])) {
        // Handle the new image upload
        $newImage = $_FILES['image']['name'];
        $imagePath = "upload/image/" . $newImage; // Update with your actual image upload path
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        // No new image uploaded, keep the old image
        $imagePath = $_POST['oldImage']; // This should be the path to the old image
    }

    $update = "UPDATE corporategovernance SET Title='$title', name='$name', image='$imagePath' WHERE id='$id'";
    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "corporateGovernance");
    } else {
        echo "not working";
    }
} elseif (isset($_POST['contact_details'])) {

    $email = $_POST['email'];
    $phone = $_POST['phone_no'];
    $address = $_POST['address'];

    $currentDate = date("Y-m-d H:i:s");

    $insert_query1 = mysqli_query($con, "INSERT INTO contact_details(email, phone_no, address, created_on) VALUES('$email','$phone','$address','$currentDate')");

    if ($insert_query1) {
        header("location: $mainlink" . "admin/contactdetails");
    } else {
        echo "Error: " . mysqli_error($con);
    }
} elseif (isset($_POST['checking_edit_contacts_btn'])) {
    $contactId = $_POST['contactId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `contact_details` WHERE id = $contactId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update_contactDetaills'])) {
    $id = $_POST['contatId'];
    $email = $_POST['editEmail'];
    $phone = $_POST['editPhone'];
    $address = $_POST['editAddress'];


    $update_contact = "UPDATE contact_details SET email = '$email', phone_no = '$phone', address = '$address' WHERE id='$id'";
    $query = mysqli_query($con, $update_contact);

    if ($query) {
        header("location: $mainlink" . "admin/contactdetails");
    } else {
        echo "not working";
    }
}
if (isset($_POST['delete_contact'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql = "UPDATE contact_details SET status = 0  WHERE id = $id";
    $query = mysqli_query($con, $sql);
    if ($query) {
        // If the delete operation is successful, you can redirect to a success page
        header("location: $mainlink" . "admin/contactdetails");
        // exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($conn);
}
if (isset($_POST['sending_email'])) {
    $des = $_POST['descriptions'];

    // Check if a file was uploaded
    if (isset($_FILES['uploads']) && $_FILES['uploads']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "upload/image/"; // Change this to your desired upload directory
        $upload_file = $upload_dir . basename($_FILES['uploads']['name']);

        if (move_uploaded_file($_FILES['uploads']['tmp_name'], $upload_file)) {
            // File uploaded successfully, insert into the database
            $insert_info = mysqli_query($con, "INSERT INTO adminnewsletter (upload, description, created_on) VALUES ('$upload_file', '$des', NOW())");

            if ($insert_info) {
                // Fetch email addresses from the subscribers table
                $select_subscribers = mysqli_query($con, "SELECT email FROM newsletter");

                $recipient_emails = array();

                while ($row = mysqli_fetch_assoc($select_subscribers)) {
                    $recipient_emails[] = $row['email'];
                }

                // Use PHPMailer to send emails
                require "../PHPMailer/PHPMailer.php";
                require "../PHPMailer/SMTP.php";
                require "../PHPMailer/Exception.php";
                $mail = new PHPMailer(true);

                $subject = "Your Newsletter Subject";
                $sender_email = "soumya05ranjan@gmail.com"; // Change to your sender email address

                // Set up SMTP configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'soumya05ranjan@gmail.com'; // Replace with your Gmail username
                $mail->Password = 'omxnmogdokgduolo'; // Replace with your Gmail app password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom($sender_email);
                $mail->isHTML(true);

                foreach ($recipient_emails as $email) {
                    $mail->addAddress($email);
                    $mail->Subject = $subject;

                    $unsubscribe_link = "$mainlink" . "unsubscribe.php?email=" . urlencode($email);
                    $message = "$des<br><br>";
                    $message .= "The content of your newsletter goes here.";
                    $message .= "<br><a href='$unsubscribe_link'>Unsubscribe</a>";

                    $mail->Body = $message;

                    // Attach the uploaded file
                    $mail->addAttachment($upload_file);

                    try {
                        $mail->send();
                    } catch (Exception $e) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }

                    $mail->clearAddresses();
                    $mail->clearAttachments();
                }

                // Redirect to the desired page after sending emails
                header("location: $mainlink" . "managenewsLetter");
            } else {
                echo "Error inserting data into the database: " . mysqli_error($con);
            }
        } else {
            echo "Failed to move the uploaded file to the destination directory.";
        }
    } else {
        echo "No file was uploaded or an error occurred during the upload.";
    }
} elseif (isset($_POST['chapter_manage'])) {
    $topicName = $_POST['topic'];
    $subtopicName = $_POST['subtopic'];
    $courseName = $_POST['courseName'];
    $chapterName = $_POST['chapter'];
    $chapterContent = $_POST['chapterContent'];
    if (isset($_FILES['uploadfile'])) {
        $uploadFile = $_FILES['uploadfile'];
        $uploadFileName = $uploadFile['name'];
        // Process and move the upload file to your desired location
        move_uploaded_file($uploadFile['tmp_name'], 'upload/file/' . $uploadFileName);
    }

    if (isset($_FILES['video'])) {
        $videoFile = $_FILES['video'];
        $videoFileName = $videoFile['name'];
        // Process and move the video file to your desired location
        move_uploaded_file($videoFile['tmp_name'], 'upload/video/' . $videoFileName);
    }


    $insert_chapters = mysqli_query($con, "INSERT INTO chapters(topicID,subTopicId,courseId,chapterName,chapterContent,uploadfile,video,isActive) VALUES('$topicName','$subtopicName','$courseName','$chapterName','$chapterContent','$uploadFileName','$videoFileName',1)");

    if ($insert_chapters) {
        header("location: $mainlink" . "admin/manageChapter");
    } else {
        echo "not done";
    }


} elseif (isset($_POST['checking_chapters_btn'])) {
    $chapterId = $_POST['chapterId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT 
    topics.Id AS topic_id,
    topics.topicName,
    subtopics.Id AS subtopic_id,
    subtopics.subtopicName,
    courses.id AS course_id,
    courses.courseName,
    chapters.id AS chapter_id,
    chapters.chapterName,
    chapters.uploadFile,
    chapters.video
    FROM
    topics
    JOIN
    subtopics ON topics.Id = subtopics.topicId
    JOIN
    courses ON subtopics.Id = courses.subTopicId
    JOIN
    chapters ON courses.id = chapters.courseId
    WHERE chapters.id=$chapterId";
    // $query = "SELECT * FROM `chapters` WHERE id = $chapterId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }

} elseif (isset($_POST['update_chapter'])) {
    $chapterId = $_POST['chapterId'];
    $chapterName = $_POST['chapter'];
    $date = date("Y-m-d H:i:s");
    $maxUploadFileSize = 10 * 1024 * 1024;
    $maxVideoFileSize = 100 * 1024 * 1024;

    // Check if uploadfile is provided in the form
    if (isset($_FILES['uploadfile'])) {
        $uploadFile = $_FILES['uploadfile'];
        $uploadFileName = $uploadFile['name'];

        // Process and move the upload file to your desired location
        move_uploaded_file($uploadFile['tmp_name'], 'upload/file/' . $uploadFileName);
    } else {
        // If not provided, keep the existing value
        $uploadFileName = ''; // Assuming it's a string field in the database
    }

    // Check if video is provided in the form
    if (isset($_FILES['video'])) {
        $videoFile = $_FILES['video'];
        $videoFileName = $videoFile['name'];

        move_uploaded_file($videoFile['tmp_name'], 'upload/video/' . $videoFileName);
    } else {
        // If not provided, keep the existing value
        $videoFileName = ''; // Assuming it's a string field in the database
    }

    // Update the database, considering the file values
    $update = "UPDATE chapters SET chapterName='$chapterName',";

    if (!empty($uploadFileName)) {
        $update .= " uploadFile='$uploadFileName',";
    }

    if (!empty($videoFileName)) {
        $update .= " video='$videoFileName',";
    }

    $update .= " modifiedOn='$date' WHERE id='$chapterId'";

    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "admin/manageChapter");
    } else {
        echo "not working";
    }
} elseif (isset($_POST['deleteChapter'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql = "UPDATE chapters SET isActive = 0 WHERE Id = $id";
    $query = mysqli_query($con, $sql);
    if ($query) {
        header("location: $mainlink" . "admin/manageChapter");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($conn);
} elseif (isset($_POST['assessment_manage'])) {
    $topicName = $_POST['topic'];
    $subtopicName = $_POST['subtopic'];
    $courseName = $_POST['courseName'];
    $chapterName = $_POST['chapter'];
    $question = $_POST['question'];
    $optionA = $_POST['optionA'];
    $optionB = $_POST['optionB'];
    $optionC = $_POST['optionC'];
    $optionD = $_POST['optionD'];
    $correctAnswer = $_POST['correctAns'];


    $insert_assessment = mysqli_query($con, "INSERT INTO assessment(topicId,subTopicId,courseId,chapterId,questions,a,b,c,d,correctAnswer,isActive) VALUES('$topicName','$subtopicName','$courseName','$chapterName','$question','$optionA','$optionB','$optionC','$optionD','$correctAnswer',1)");

    if ($insert_assessment) {
        header("location: $mainlink" . "admin/manageAssessment");
    } else {
        echo "not done";
    }


} elseif (isset($_POST['checking_assessment_btn'])) {
    $assessmentId = $_POST['assessmentId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT 
    topics.Id AS topic_id,
    topics.topicName,
    subtopics.Id AS subtopic_id,
    subtopics.subtopicName,
    courses.id AS course_id,
    courses.courseName,
    chapters.id AS chapter_id,
    chapters.chapterName,
    assessment.id AS assessment_id,
    assessment.questions,
    assessment.a,
    assessment.b,
    assessment.c,
    assessment.d,
    assessment.correctAnswer
    FROM
    topics
    JOIN
    subtopics ON topics.Id = subtopics.topicId
    JOIN
    courses ON subtopics.Id = courses.subTopicId
    JOIN
    chapters ON courses.id = chapters.courseId
    JOIN 
    assessment ON chapters.id = assessment.chapterId
    WHERE
    assessment.id = $assessmentId";
    // $query = "SELECT * FROM `chapters` WHERE id = $chapterId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        //echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update_assessment'])) {
    $assessmentId = $_POST['assessmentId'];
    $questions = $_POST['questions'];
    $optionA = $_POST['optionA'];
    $optionB = $_POST['optionB'];
    $optionC = $_POST['optionC'];
    $optionD = $_POST['optionD'];
    $correctAns = $_POST['correctAnswer'];

    $update = "UPDATE assessment SET 
                questions='$questions',
                a='$optionA',
                b='$optionB',
                c='$optionC',
                d='$optionD',
                correctAnswer='$correctAns',
                modifiedOn=NOW() 
                WHERE id='$assessmentId'";

    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "admin/manageAssessment");
    } else {
        echo "Error: " . mysqli_error($con);
    }
} elseif (isset($_POST['deleteAssesment'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql1 = "UPDATE assessment SET isActive = 0 WHERE id = $id";
    $query1 = mysqli_query($con, $sql1);
    if ($query1) {
        header("location: $mainlink" . "admin/manageAssessment");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
} elseif (isset($_POST['deleteStudent'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql2 = "UPDATE students SET isActive = 0 WHERE id = $id";
    $query2 = mysqli_query($con, $sql2);
    if ($query2) {
        header("location: $mainlink" . "admin/manageStudents");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
} elseif (isset($_POST['deletebulk'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql3 = "UPDATE company SET isActive = 0 WHERE id = $id";
    $query3 = mysqli_query($con, $sql3);
    if ($query3) {
        header("location: $mainlink" . "admin/manageBulkRegistration");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
} elseif (isset($_POST['user_manage'])) {
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $userType = $_POST['userType'];
    $email = $_POST['email'];
    $uid = $_POST['user_id'];
    $pwd = $_POST['pwd'];
    $address = $_POST['address'];

    $insert_query = mysqli_query($con, "INSERT INTO users(Name,Email,Phone,Address,UserType,UserId,Password) VALUES('$name','$email','$phoneNumber','$address','$userType','$uid','$pwd')");

    if ($insert_query) {
        header("location: $mainlink" . "admin/manageUser");
    } else {
        echo "not done";
    }
}

// End Inserting User

// Start Fetching User
elseif (isset($_POST['checking_user_btn'])) {
    $userId = $_POST['userId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `users` WHERE Id = $userId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        ////echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update_user'])) {
    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $update_topic = "UPDATE users set Name = '$name',Email = '$email',Phone = '$phone',Address = '$address' WHERE id='$id'";
    $query = mysqli_query($con, $update_topic);

    if ($query) {
        header("location: $mainlink" . "admin/manageUser");
    } else {
        echo "not working";
    }
}

//  Inserting Home
elseif (isset($_POST['insert_home'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];


    if (isset($_FILES['bannerImage'])) {
        $imageFile = $_FILES['bannerImage'];
        $imageFileName = $imageFile['name'];
        // Process and move the image file to your desired location
        move_uploaded_file($imageFile['tmp_name'], '../assets/images/home/' . $imageFileName);
    }
    // $name = $_POST['name'];

    $insert_query = mysqli_query($con, "INSERT INTO home(Title, Description, bannerImage, createdOn) VALUES('$title','$desc','$imageFileName',NOW())");

    if ($insert_query) {
        header("location: $mainlink" . "./admin/home");
    } else {
        echo "not done";
    }
}

// End Inserting Home

// Start Fetching Home
elseif (isset($_POST['checking_edit_home_btn'])) {
    $homeId = $_POST['homeId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `home` WHERE Id = $homeId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        ////echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update_home'])) {
    $id = $_POST['homeId'];
    $title = mysqli_real_escape_string($con, $_POST['editTitle']);
    $description = mysqli_real_escape_string($con, $_POST['editDesc']);


    if (isset($_FILES['editImage']['tmp_name']) && !empty($_FILES['editImage']['tmp_name'])) {
        // Handle the new image upload
        $newImage = mysqli_real_escape_string($con, $_FILES['editImage']['name']);

        // Debugging for file path
        $imagePath = "../assets/images/home/" . $newImage;
        echo "Image Path: $imagePath<br>";

        // Move the uploaded image to the destination folder
        move_uploaded_file($_FILES['editImage']['tmp_name'], $imagePath);

        // Update the database with the new image filename
        $update = "UPDATE home SET Title='$title', Description='$description', bannerImage='$newImage' WHERE id='$id'";
    } else {
        // No new image uploaded, keep the old image
        $update = "UPDATE home SET Title='$title', Description='$description' WHERE id='$id'";
    }

    // Debugging for SQL query
    echo "SQL Query: $update<br>";

    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "./admin/home");
    } else {
        echo "Query Error: " . mysqli_error($con);
    }
} elseif (isset($_POST['delete_home'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql3 = "UPDATE home SET isActive = 0 WHERE id = $id";
    $query3 = mysqli_query($con, $sql3);
    if ($query3) {
        header("location: $mainlink" . "./admin/home");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}


// Inserting About
elseif (isset($_POST['insert_about'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];


    if (isset($_FILES['bannerImage'])) {
        $imageFile = $_FILES['bannerImage'];
        $imageFileName = $imageFile['name'];
        // Process and move the image file to your desired location
        move_uploaded_file($imageFile['tmp_name'], '../assets/images/about/' . $imageFileName);
    }
    // $name = $_POST['name'];

    $insert_query = mysqli_query($con, "INSERT INTO about(Title, Description, bannerImage, createdOn) VALUES('$title','$desc','$imageFileName',NOW())");

    if ($insert_query) {
        header("location: $mainlink" . "./admin/about");
    } else {
        echo "not done";
    }
}

// End Inserting Home

// Start Fetching Home
elseif (isset($_POST['checking_edit_about_btn'])) {
    $aboutId = $_POST['aboutId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `about` WHERE Id = $aboutId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        ////echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update_about'])) {
    $id = $_POST['aboutId'];
    $title = mysqli_real_escape_string($con, $_POST['editTitle']);
    $description = mysqli_real_escape_string($con, $_POST['editDesc']);


    if (isset($_FILES['editImage']['tmp_name']) && !empty($_FILES['editImage']['tmp_name'])) {
        // Handle the new image upload
        $newImage = mysqli_real_escape_string($con, $_FILES['editImage']['name']);

        // Debugging for file path
        $imagePath = "../assets/images/about/" . $newImage;
        echo "Image Path: $imagePath<br>";

        // Move the uploaded image to the destination folder
        move_uploaded_file($_FILES['editImage']['tmp_name'], $imagePath);

        // Update the database with the new image filename
        $update = "UPDATE about SET Title='$title', Description='$description', bannerImage='$newImage' WHERE id='$id'";
    } else {
        // No new image uploaded, keep the old image
        $update = "UPDATE about SET Title='$title', Description='$description' WHERE id='$id'";
    }

    // Debugging for SQL query
    echo "SQL Query: $update<br>";

    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "./admin/about");
    } else {
        echo "Query Error: " . mysqli_error($con);
    }
} elseif (isset($_POST['delete_about'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql3 = "UPDATE about SET isActive = 0 WHERE id = $id";
    $query3 = mysqli_query($con, $sql3);
    if ($query3) {
        header("location: $mainlink" . "./admin/about");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}

// Inserting Privacy
elseif (isset($_POST['insert_privacy'])) {
    $heading = $_POST['heading'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];

    $insert_query = mysqli_query($con, "INSERT INTO privacy(Heading, Title, Description,createdOn) VALUES('$heading','$title','$desc',NOW())");

    if ($insert_query) {
        header("location: $mainlink" . "./admin/privacypolicy");
    } else {
        echo "not done";
    }
}

// End Inserting Home

// Start Fetching Home
elseif (isset($_POST['checking_edit_privacy_btn'])) {
    $privacyId = $_POST['privacyId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `privacy` WHERE Id = $privacyId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        ////echo $return = "<h5>No Record Found</h5>";
    }

} elseif (isset($_POST['update_privcy'])) {
    $id = $_POST['privacyId'];
    $heading = mysqli_real_escape_string($con, $_POST['editHeading']);
    $title = mysqli_real_escape_string($con, $_POST['editTitle']);
    $description = mysqli_real_escape_string($con, $_POST['editDesc']);



    // No new image uploaded, keep the old image
    $update = "UPDATE privacy SET Heading ='$heading', Title='$title', Description='$description' WHERE id='$id'";


    // Debugging for SQL query
    // echo "SQL Query: $update<br>";

    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "./admin/privacypolicy");
    } else {
        echo "Query Error: " . mysqli_error($con);
    }
} elseif (isset($_POST['delete_privacy'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql3 = "UPDATE privacy SET isActive = 0 WHERE id = $id";
    $query3 = mysqli_query($con, $sql3);
    if ($query3) {
        header("location: $mainlink" . "./admin/privacy");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}



// Inserting Privacy
elseif (isset($_POST['insert_terms'])) {
    $heading = $_POST['heading'];
    $desc = $_POST['Desc'];

    $insert_query = mysqli_query($con, "INSERT INTO terms(Heading, Description,createdOn) VALUES('$heading','$desc',NOW())");

    if ($insert_query) {
        header("location: $mainlink" . "./admin/terms");
    } else {
        echo "not done";
    }
}

// End Inserting Home

// Start Fetching Home
elseif (isset($_POST['checking_edit_terms_btn'])) {
    $termsId = $_POST['termsId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT * FROM `terms` WHERE Id = $termsId";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        ////echo $return = "<h5>No Record Found</h5>";
    }

} elseif (isset($_POST['update_terms'])) {
    $id = $_POST['termsId'];
    $heading = mysqli_real_escape_string($con, $_POST['editheading']);
    $description = mysqli_real_escape_string($con, $_POST['editDesc']);



    // No new image uploaded, keep the old image
    $update = "UPDATE terms SET Heading ='$heading', Description='$description' WHERE id='$id'";


    // Debugging for SQL query
    // echo "SQL Query: $update<br>";

    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "./admin/terms");
    } else {
        echo "Query Error: " . mysqli_error($con);
    }
} elseif (isset($_POST['delete_terms'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql3 = "UPDATE terms SET isActive = 0 WHERE id = $id";
    $query3 = mysqli_query($con, $sql3);
    if ($query3) {
        header("location: $mainlink" . "./admin/terms");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}




if (isset($_GET['topicId'])) {
    // Assuming you have a function to fetch subtopics based on topicId
    $topicId = $_GET['topicId'];
    // echo $topicId;
    $subt_query_conn = mysqli_query($con, "SELECT id, subTopicName FROM subtopics WHERE topicId = $topicId");

    if ($subt_query_conn) {
        // Fetch all rows from the result set
        $subtopics = array();
        while ($row = mysqli_fetch_assoc($subt_query_conn)) {
            $subtopics[] = $row;

        }

        // Output the subtopics as JSON (or in any other suitable format)
        echo json_encode($subtopics);

    } else {
        // Handle the case where the query fails
        echo "Error: " . mysqli_error($con);
    }

    // Close the connection
    // mysqli_close($con);
}


if (isset($_POST['delete_user'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql = "UPDATE users SET IsActive = 0 WHERE Id = $id";
    $query = mysqli_query($con, $sql);
    if ($query) {
        // If the delete operation is successful, you can redirect to a success page
        header("location: $mainlink" . "admin/manageUser");
        // exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    // mysqli_close($conn);
}
// blog_comments functionality ( for admin side) starts

// ******** this is for fetch the data into the modal of commentsBlog page in admin starts
if (isset($_POST['Comment_id'])) {
    $comment_id = $_POST['Comment_id'];
    $query_fetch_blog_comment_to_admin = mysqli_query($con, "SELECT comment, isactive FROM comments_blog where id = $comment_id");
    $row = mysqli_num_rows($query_fetch_blog_comment_to_admin) > 0;
    if ($row) {
        $data = mysqli_fetch_assoc($query_fetch_blog_comment_to_admin);
        echo json_encode($data);

    } else {
        echo "No comments found for the specified $Comment_id.";
    }
}
// ******** this is for Approving the comment by admin
if (isset($_POST['modal_comment_id']) && !empty($_POST['modal_comment'])) {
    $modal_comment_id = $_POST['modal_comment_id'];
    $modal_comment = $_POST['modal_comment'];
    $query_fetch_blog_comment_to_admin = mysqli_query($con, "UPDATE comments_blog SET isactive=1 where id = $modal_comment_id");
    if ($query_fetch_blog_comment_to_admin) {
        echo "Comment is approved";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
if (isset($_POST['disapprove'])) {
    $for_disapprove = $_POST['disapprove'];
    echo $for_disapprove;
    $query_fetch_blog_comment_to_admin_disapprove = mysqli_query($con, "UPDATE comments_blog SET isactive=0 where id = $for_disapprove");
    if ($query_fetch_blog_comment_to_admin_disapprove) {
        echo "Comment is disapprove";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
if (isset($_POST['delete_blog_comment_id'])) {
    $delete_blog_comment = $_POST['delete_blog_comment_id'];
    // echo $delete_blog_comment;
    $query_fetch_blog_comment_to_admin_delete = mysqli_query($con, "DELETE FROM comments_blog WHERE id = $delete_blog_comment");
    if ($query_fetch_blog_comment_to_admin_delete) {
        $response = array('success' => true, 'message' => 'Operation successful');
    } else {
        $response = array('success' => false, 'message' => 'Error: ' . mysqli_error($con));
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
// blog_comments functionality ( for admin side) Ends

// course_review functionality ( for admin side) starts

// ******** this is for fetch the data into the modal of commentsBlog page in admin starts
if (isset($_POST['Review_id'])) {
    $review_id = $_POST['Review_id'];
    $query_fetch_course_review_to_admin = mysqli_query($con, "SELECT review, isactive FROM comment_course_review where id = $review_id");
    $row = mysqli_num_rows($query_fetch_course_review_to_admin) > 0;
    if ($row) {
        $data = mysqli_fetch_assoc($query_fetch_course_review_to_admin);
        echo json_encode($data);

    } else {
        echo "No comments found for the specified $review_id.";
    }
}
// ******** this is for Approving the comment by admin
if (isset($_POST['modal_review_id']) && !empty($_POST['modal_review'])) {
    $modal_review_id = $_POST['modal_review_id'];
    $modal_review = $_POST['modal_review'];
    $query_fetch_course_review_to_admin = mysqli_query($con, "UPDATE comment_course_review SET isactive=1 where id = $modal_review_id");
    if ($query_fetch_course_review_to_admin) {
        echo "Comment is approved";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
if (isset($_POST['disapprove'])) {
    $for_disapprove = $_POST['disapprove'];
    $query_fetch_course_review_to_admin_disapprove = mysqli_query($con, "UPDATE comment_course_review SET isactive=0 where id = $for_disapprove");
    if ($query_fetch_course_review_to_admin_disapprove) {
        echo "Comment is disapprove";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
if (isset($_POST['delete_course_review_id'])) {
    $delete_course_review_id = $_POST['delete_course_review_id'];
    // echo $delete_blog_comment;
    $query_fetch_course_review_to_admin_delete = mysqli_query($con, "DELETE FROM comment_course_review WHERE id = $delete_course_review_id");
    if ($query_fetch_course_review_to_admin_delete) {
        $response = array('success' => true, 'message' => 'Operation successful');
    } else {
        $response = array('success' => false, 'message' => 'Error: ' . mysqli_error($con));
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
// blog_comments functionality ( for admin side) Ends
?>
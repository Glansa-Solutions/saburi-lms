<?php
include('db_config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Admin Login

if (isset($_POST['login_admin'])) {

    $name = mysqli_real_escape_string($con, $_POST['admin_name']);
    $password = mysqli_real_escape_string($con, $_POST['admin_password']);

    $user_sql = mysqli_query($con, "SELECT * FROM users WHERE Email='$name'");
    $fetch_user_sql = mysqli_fetch_assoc($user_sql);

    if ($fetch_user_sql) { // Check if a matching user was found
        $user_name = $fetch_user_sql['Email'];
        $pwd = $fetch_user_sql['Password'];
        header("location: $mainlink" . "admin/dashboard");
        exit();
        // Use password_hash and password_verify for password hashing
        // if (password_verify($password, $pwd)) {
        //     header("location: $mainlink" . "admin/dashboard");
        //     exit();
        // } else {
        //     $_SESSION['message'] = "Wrong Username or Password";
        //     header("location: $mainlink" . "404");
        //     exit();
        // }
    } else {
        // Handle the case where no user with the specified 'Name' was found
        $_SESSION['message'] = "User not found";
        header("location: $mainlink" . "404");
        exit();
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
        echo $return = "<h5>No Record Found</h5>";
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
        move_uploaded_file($imageFile['tmp_name'], '../uploads/images/' . $imageFileName);
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
        move_uploaded_file($videoFile['tmp_name'], 'uploads/videos' . $videoFileName);
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
        echo $return = "<h5>No Record Found</h5>";
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
        echo $return = "<h5>No Record Found</h5>";
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
        move_uploaded_file($imageFile['tmp_name'], '../assets/images/blog' . $imageFileName);
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
        echo $return = "<h5>No Record Found</h5>";
    }
} elseif (isset($_POST['update'])) {
    $id = $_POST['blog_id'];
    $title = mysqli_real_escape_string($con, $_POST['editTitle']);
    $writer = mysqli_real_escape_string($con, $_POST['editWriter']);
    $description = mysqli_real_escape_string($con, $_POST['editDescription']);

    if (isset($_FILES['editImage']['tmp_name']) && !empty($_FILES['editImage']['tmp_name'])) {
        // Handle the new image upload
        $newImage = mysqli_real_escape_string($con, $_FILES['editImage']['name']);
        $imagePath = "upload/image/" . $newImage; // Update with your actual image upload path
        move_uploaded_file($_FILES['editImage']['tmp_name'], $imagePath);
    } else {
        // No new image uploaded, keep the old image
        $newImage = mysqli_real_escape_string($con, $_POST['oldImage']); // This should be the filename of the old image
    }

    $update = "UPDATE blogs SET blogTitle='$title', writer ='$writer', description='$description'";

    if (!empty($newImage)) {
        // If a new image is provided, include it in the update statement
        $update .= ", bannerImage='$newImage'";
    }

    $update .= " WHERE id='$id'";

    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "admin/blog");
    } else {
        echo "not working";
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
        move_uploaded_file($imageFile['tmp_name'], 'upload/image/' . $imageFileName);
    }
    // $writer = $_POST['writer'];
    $desc = $_POST['desc'];

    $insert_query = mysqli_query($con, "INSERT INTO freeresources(resourcesName, title, bannerImage,description) VALUES('$heading', '$title', '$imageFileName','$desc')");

    if ($insert_query) {
        header("location: $mainlink" . "freeResources");
    } else {
        echo "not done";
    }
} elseif (isset($_POST['checking_resource_btn'])) {
    $resource_id = $_POST['resource_id'];
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
        echo $return = "<h5>No Record Found</h5>";
    }
}

if (isset($_POST['update_resources'])) {
    $id = $_POST['resource_id'];
    $resourcename = $_POST['resourses_name'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Check if a new image has been uploaded
    if (isset($_FILES['banner_image']['tmp_name']) && !empty($_FILES['banner_image']['tmp_name'])) {
        // Handle the new image upload
        $newImage = $_FILES['banner_image']['name'];
        $imagePath = "upload/image/" . $newImage; // Update with your actual image upload path
        move_uploaded_file($_FILES['banner_image']['tmp_name'], $imagePath);
    } else {
        // No new image uploaded, keep the old image
        $imagePath = $_POST['oldImage']; // This should be the path to the old image
    }

    $update = "UPDATE freeresources SET resourcesName='$resourcename', title='$title', bannerImage='$imagePath', description='$description' WHERE id='$id'";
    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "freeResources");
    } else {
        echo "Update failed!";
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
        echo $return = "<h5>No Record Found</h5>";
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
        echo $return = "<h5>No Record Found</h5>";
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
        echo $return = "<h5>No Record Found</h5>";
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
        header("location: $mainlink" . "contactdetails");
    } else {
        echo "Error: " . mysqli_error($con);
    }
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

                    $unsubscribe_link = "$mainlink"."unsubscribe.php?email=" . urlencode($email);
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


    $insert_chapters = mysqli_query($con, "INSERT INTO chapters(topicID,subTopicId,courseId,chapterName,uploadfile,video,isActive) VALUES('$topicName','$subtopicName','$courseName','$chapterName','$uploadFileName','$videoFileName',1)");

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
        echo $return = "<h5>No Record Found</h5>";
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
        echo $return = "<h5>No Record Found</h5>";
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
        echo $return = "<h5>No Record Found</h5>";
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

        foreach ($subtopics as $subtopic) {
            echo "<option value='{$subtopic['id']}'>{$subtopic['subTopicName']}</option>";
        }
        
    } else {
        // Handle the case where the query fails
        echo "Error: " . mysqli_error($con);
    }

    // Close the connection
    mysqli_close($con);
}


?>
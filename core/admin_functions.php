<?php
session_start();
include('db_config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Admin Login start

if (isset($_POST['login_admin'])) {
    $name = mysqli_real_escape_string($con, $_POST['admin_name']);
    $password = mysqli_real_escape_string($con, $_POST['admin_password']);

    $admin_sql = mysqli_query($con, "SELECT * FROM users WHERE Name='$name'");
    $fetch_admin_sql = mysqli_fetch_assoc($admin_sql);

    if ($admin_sql) {
        $admin_pass = $fetch_admin_sql['Password'];

        if ($admin_pass === $password) {
            // Store user information in the session
            $_SESSION['admin_id'] = $fetch_admin_sql['id'];
            $_SESSION['admin_email'] = $fetch_admin_sql['Email'];
            $_SESSION['admin_name'] = $fetch_admin_sql['Name'];

            // echo $_SESSION['admin_name'];
            // exit();
            header("location: $mainlink" . "admin/dashboard");
            exit();
        } else {
            $_SESSION['errormessage'] = "Entered password is incorrect";
            header("location: $mainlink" . "admin/");
            exit();
        }
    } else {
        $_SESSION['errormessage'] = "Entered Username is incorrect";
        header("location: $mainlink" . "admin/");
        exit();
    }

    // Admin Login End

    // Topic Management start
} elseif (isset($_POST['topic_manage'])) {
    $topic = $_POST['topic'];
    $currentDate = date("Y-m-d H:i:s");
    $insert_query = mysqli_query($con, "INSERT INTO topics(topicName,createdOn,isActive) VALUES('$topic','$currentDate',1)");

    if ($insert_query) {
        header("location: $mainlink" . "./admin/topic");
    } else {
        echo "not done";
    }
    // Topic Management end 



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
    $insert_query = mysqli_query($con, "INSERT INTO subtopics (topicId,subTopicName,isActive) VALUES('$topic','$subtopic',1)");

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
    $wyl = $_POST['learn'];
    $requirements = $_POST['requirements'];
    $duration = $_POST['durations'];
    $tags = $_POST['tags'];
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

    $insert_course = mysqli_query($con, "INSERT INTO courses(topicID,subTopicId,courseName,courseCost,courseDesc,learn,duration,requirements,bannerImage,uploadfile,video,tag) VALUES('$topic','$subtopic','$courseName','$price','$desc','$wyl','$duration','$requirements','$imageFileName','$uploadFileName','$videoFileName','$tags')");
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
        $cvpath = '../uploads/' . $imageFile['name'];
        // Process and move the image file to your desired location
        move_uploaded_file($imageFile['tmp_name'], $cvpath);
    }

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';

    // Insert data into the database
    $insertQuery = "INSERT INTO careersapplications (Name, Phone, Email, Experience, Attachment, CareerId,CreatedOn) 
                    VALUES ('$name', '$phone', '$email', '$exp', '$cvpath', '$careerId',NOW())";

    if (mysqli_query($con, $insertQuery)) {
        echo '<script>
        var mainlink = "' . $mainlink . '";
        setTimeout(function() {
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "Inserted successfully, and an email has been sent.",
            }).then(function(){
                window.location.href = mainlink + "career";
            });
        }, 100);
      </script>';


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
        move_uploaded_file($uploadFile['tmp_name'], '../uploads/files/' . $uploadFileName);
    }

    if (isset($_FILES['video'])) {
        $videoFile = $_FILES['video'];
        $videoFileName = $videoFile['name'];
        // Process and move the video file to your desired location
        move_uploaded_file($videoFile['tmp_name'], '../uploads/videos/' . $videoFileName);
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
        move_uploaded_file($uploadFile['tmp_name'], '../uploads/files/' . $uploadFileName);
    } else {
        // If not provided, keep the existing value
        $uploadFileName = ''; // Assuming it's a string field in the database
    }

    // Check if video is provided in the form
    if (isset($_FILES['video'])) {
        $videoFile = $_FILES['video'];
        $videoFileName = $videoFile['name'];

        move_uploaded_file($videoFile['tmp_name'], '../uploads/videos/' . $videoFileName);
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
} 
// elseif (isset($_POST['assessment_manage'])) {
//     $courseName = $_POST['courseName'];
//     $assessmentName = $_POST['assessmentName'];
//     $question = $_POST['question'];
//     $optionA = $_POST['optionA'];
//     $optionB = $_POST['optionB'];
//     $optionC = $_POST['optionC'];
//     $optionD = $_POST['optionD'];
//     $correctAnswer = $_POST['correctAns'];

//     $result = mysqli_query($con, "SELECT * FROM assessment WHERE courseId = '$courseName' AND assessmentName = '$assessmentName'");
//     $row_count = mysqli_num_rows($result);
//     if ($row_count > 0) {
//         echo json_encode("Can not add already having same name in id");
//     } else {
//         $insert_assessment = mysqli_query($con, "INSERT INTO assessment(courseId, assessmentName, isActive) VALUES('$courseName', '$assessmentName', 1)");

//         if ($insert_assessment) {
//             $assessmentId = $con->insert_id;
//             // echo $assessmentId;
//             // Insert data into the 'questions' table
//             $insertedQuestions = mysqli_query($con, "INSERT INTO questions (assessmentId, questionsName, a, b, c, d, correctAnswer, isActive) VALUES ('$assessmentId', '$question', '$optionA', '$optionB', '$optionC', '$optionD', '$correctAnswer', 1)");

//             if ($insertedQuestions) {
//                 header("location: $mainlink" . "admin/manageAssessment");
//             } else {
//                 echo "Failed to insert questions.";
//             }
//         } else {
//             echo "Failed to insert assessment.";
//         }
//     }
// } 
elseif (isset($_POST['checking_assessment_btn'])) {
    $assessmentId = $_POST['assessmentId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT 
    courses.id AS course_id,
    courses.courseName,
    assessment.id as assessment_id,
    assessment.assessmentName
FROM
    courses
JOIN
    assessment ON courses.id = assessment.courseId
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
    $assessmentName = $_POST['assessmentName'];
    $assessmentId = $_POST['assessmentId'];

    $update = "UPDATE assessment SET 
                assessmentName='$assessmentName',
                modifiedOn=NOW() 
                WHERE id='$assessmentId'";

    $query = mysqli_query($con, $update);

    if ($query) {
        header("location: $mainlink" . "admin/assessmentManage");
    } else {
        echo "Error: " . mysqli_error($con);
    }
} elseif (isset($_POST['deleteAssesment'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql1 = "UPDATE assessment SET isActive= 0 WHERE id = $id";
    $query1 = mysqli_query($con, $sql1);
    if ($query1) {
        header("location: $mainlink" . "admin/assessmentManage");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // mysqli_close($con);
}
elseif (isset($_POST['checking_questions'])) {
    $assessmentId = $_POST['assessmentId'];
    $result_array = [];

    // Prepare and execute a query to fetch the blog data by ID
    $query = "SELECT 
    courses.id AS course_id,
    courses.courseName,
    assessment.id as assessment_id,
    assessment.assessmentName,
    questions.id as questions_id,
    questions.questionsName,
    questions.a,
    questions.b,
    questions.c,
    questions.d,
    questions.correctAnswer
    FROM
    courses
    JOIN
    assessment ON courses.id = assessment.courseId
    JOIN
    questions ON assessment.id = questions.assessmentId
    -- JOIN
    -- chapters ON courses.id = chapters.courseId
    -- JOIN 
    -- assessment ON chapters.id = assessment.chapterId
    WHERE
  questions.id = $assessmentId";
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
}

elseif (isset($_POST['update_questions'])) {
    $assessmentId = $_POST['assessmentId'];
    $questionsId = $_POST['questionsId'];
    $questions = $_POST['questions'];
    $optionA = $_POST['optionA'];
    $optionB = $_POST['optionB'];
    $optionC = $_POST['optionC'];
    $optionD = $_POST['optionD'];
    $correctAns = $_POST['correctAnswer'];

    $update = "UPDATE questions SET 
                questionsName='$questions',
                a='$optionA',
                b='$optionB',
                c='$optionC',
                d='$optionD',
                correctAnswer='$correctAns',
                modifiedOn=NOW() 
                WHERE id='$questionsId'";

    $query = mysqli_query($con, $update);

    if ($query) {
        $fetchQuestions = mysqli_query($con,"SELECT * FROM questions WHERE id = '$questionsId'");
        if($fetchQuestions){
            $questionsData = mysqli_fetch_array($fetchQuestions);
            $aId = $questionsData["assessmentId"];
            header("location: {$mainlink}admin/questionsManage?aid={$aId}");
        }
        
    } else {
        echo "Error: " . mysqli_error($con);
    }
}


elseif (isset($_POST['deleteQuestions'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql1 = "UPDATE questions SET isActive= 0 WHERE id = $id";
    $query1 = mysqli_query($con, $sql1);
    if ($query1) {
        $fetchQuestions = mysqli_query($con,"SELECT * FROM questions WHERE id = '$id'");
        if($fetchQuestions){
            $questionsData = mysqli_fetch_array($fetchQuestions);
            $aId = $questionsData["assessmentId"];
            header("location: {$mainlink}admin/questionsManage?aid={$aId}");
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // mysqli_close($con);
}


// Questions End

elseif (isset($_POST['deleteStudent'])) {
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
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $desc_text = mysqli_real_escape_string($con, $_POST['desc']);
    $admin_name = mysqli_real_escape_string($con, $_POST['admin_name']);
    $desc = strip_tags($desc_text);

    $select_query = mysqli_query($con, "SELECT * FROM home");
    $fetch_home_rows = mysqli_fetch_assoc($select_query);
    $row_count = mysqli_num_rows($select_query);

    if ($row_count > 0) {
        // Existing record, update operation
        if (isset($_FILES['bannerImage']) && $_FILES['bannerImage']['error'] === UPLOAD_ERR_OK) {
            // Case 1: New image is uploaded
            $imageFile = $_FILES['bannerImage'];
            $imageFileName = $imageFile['name'];
            $trimmed_banner_name = str_replace(" ", "", $imageFileName);
            move_uploaded_file($imageFile['tmp_name'], '../assets/images/home/' . $trimmed_banner_name);

            // Delete old image file
            $oldBannerName = $fetch_home_rows['bannerImage'];
            unlink('../assets/images/home/' . $oldBannerName);
        } else {
            // Case 2: No new image uploaded, use the existing banner name
            $trimmed_banner_name = $fetch_home_rows['bannerImage'];
        }

        $update_query = mysqli_query($con, "UPDATE home SET Title='$title', Description='$desc', bannerImage='$trimmed_banner_name', modifyOn=NOW(), modifyBy='$admin_name' WHERE id=1");

        if ($update_query) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Successfully Updated";

        } else {
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Not Updated";
        }
    } else {
        // New record, insert operation
        if (isset($_FILES['bannerImage'])) {
            $imageFile = $_FILES['bannerImage'];
            $imageFileName = $imageFile['name'];
            $trimmed_banner_name = str_replace(" ", "", $imageFileName);
            move_uploaded_file($imageFile['tmp_name'], '../assets/images/home/' . $trimmed_banner_name);
        }

        $insert_query = mysqli_query($con, "INSERT INTO home(id,Title, Description, bannerImage, createdOn, createdBy) VALUES(1,'$title','$desc','$trimmed_banner_name',NOW(), '$admin_name')");

        if ($insert_query) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Successfully Inserted";
        } else {
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Not Inserted";
        }
    }

    // Redirect to the appropriate page
    header("location: $mainlink" . "./admin/home");
    exit();

} elseif (isset($_POST['delete_home'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql3 = "DELETE from home";
    $query3 = mysqli_query($con, $sql3);
    if ($query3) {
        header("location: $mainlink" . "./admin/home");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
} elseif (isset($_POST['insert_about'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $desc_text = mysqli_real_escape_string($con, $_POST['desc']);
    $admin_name = mysqli_real_escape_string($con, $_POST['admin_name']);
    $desc = strip_tags($desc_text);
    $select_query = mysqli_query($con, "SELECT * FROM about");
    $fetch_about_rows = mysqli_fetch_assoc($select_query);
    $row_count = mysqli_num_rows($select_query);

    if ($row_count > 0) {
        // Existing record, update operation
        if (isset($_FILES['bannerImage']) && $_FILES['bannerImage']['error'] === UPLOAD_ERR_OK) {
            // Case 1: New image is uploaded
            $imageFile = $_FILES['bannerImage'];
            $imageFileName = $imageFile['name'];
            $trimmed_banner_name = str_replace(" ", "", $imageFileName);
            move_uploaded_file($imageFile['tmp_name'], '../assets/images/about/' . $trimmed_banner_name);
            $oldBannerName = $fetch_about_rows['bannerImage'];
            unlink('../assets/images/about/' . $oldBannerName);
        } else {
            // Case 2: No new image uploaded, use the existing banner name
            $trimmed_banner_name = $fetch_about_rows['bannerImage'];
        }
        $update_query = mysqli_query($con, "UPDATE about SET Title='$title', Description='$desc', bannerImage='$trimmed_banner_name', modifyOn=NOW(), modifyBy='$admin_name' WHERE id=1");

        if ($update_query) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Successfully Updated";

        } else {
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Not Updated";
        }
    } else {
        // New record, insert operation
        if (isset($_FILES['bannerImage'])) {
            $imageFile = $_FILES['bannerImage'];
            $imageFileName = $imageFile['name'];
            $trimmed_banner_name = str_replace(" ", "", $imageFileName);
            move_uploaded_file($imageFile['tmp_name'], '../assets/images/about/' . $trimmed_banner_name);
        }

        $insert_query = mysqli_query($con, "INSERT INTO about(id,Title, Description, bannerImage, createdOn, createdBy) VALUES(1,'$title','$desc','$trimmed_banner_name',NOW(), '$admin_name')");

        if ($insert_query) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Successfully Inserted";
        } else {
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Not Inserted";
        }
    }

    // Redirect to the appropriate page
    header("location: $mainlink" . "./admin/about");
    exit();
} elseif (isset($_POST['delete_about'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql3 = "DELETE from about";
    $query3 = mysqli_query($con, $sql3);
    if ($query3) {
        header("location: $mainlink" . "./admin/about");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // mysqli_close($con);
}
// Contact Details Page Crud
elseif (isset($_POST['contact_details'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone_no']);
    $address_text = mysqli_real_escape_string($con, $_POST['address']);
    $admin_name = mysqli_real_escape_string($con, $_POST['admin_name']);
    $address = strip_tags($address_text);


    $select_query = mysqli_query($con, "SELECT * FROM contact_details");
    $fetch_contact_rows = mysqli_fetch_assoc($select_query);
    $row_count = mysqli_num_rows($select_query);
    if ($row_count > 0) {

        $update_query = mysqli_query($con, "UPDATE contact_details SET email='$email', phone_no='$phone', address='$address', modify_on=NOW(), modify_by='$admin_name' WHERE id=1");

        if ($update_query) {

            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Successfully Updated";

        } else {
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Not Updated";
        }
    } else {
        $insert_query = mysqli_query($con, "INSERT INTO contact_details(id,email, phone_no, address, created_on, created_by) VALUES(1,'$email','$phone','$address',NOW(), '$admin_name')");

        if ($insert_query) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Successfully Inserted";
        } else {
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Not Inserted";
        }

    }
    header("location: $mainlink" . "./admin/contactdetails");
    exit();


}
if (isset($_POST['delete_contact'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM contact_details";
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

// Inserting Privacy
elseif (isset($_POST['insert_privacy'])) {
    // $heading = $_POST['heading'];
    // $title = $_POST['title'];

    $desc = mysqli_real_escape_string($con, $_POST['desc']);
    $admin_name = mysqli_real_escape_string($con, $_POST['admin_name']);
    // $desc = strip_tags($desc_text);


    $select_query = mysqli_query($con, "SELECT * FROM privacy");
    $fetch_privacy_rows = mysqli_fetch_assoc($select_query);
    $row_count = mysqli_num_rows($select_query);

    if ($row_count > 0) {
        $update_query = mysqli_query($con, "UPDATE privacy SET Description='$desc', modifyOn=NOW(), modifyBy='$admin_name' WHERE id=1");

        if ($update_query) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Successfully Updated";

        } else {
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Not Updated";
        }
    } else {
        $insert_query = mysqli_query($con, "INSERT INTO privacy(id,Description,createdOn, createdBy) VALUES(1,'$desc',NOW(),'$admin_name')");

        if ($insert_query) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Successfully Inserted";
        } else {
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Not Inserted";
        }
    }


    header("location: $mainlink" . "./admin/privacy");
    exit();
}
elseif (isset($_POST['delete_privacy'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql3 = "DELETE FROM privacy";
    $query3 = mysqli_query($con, $sql3);
    if ($query3) {
        header("location: $mainlink" . "./admin/privacy");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
// Inserting Termsa
elseif (isset($_POST['insert_terms'])) {
    // $heading = $_POST['heading'];
    // $title = $_POST['title'];

    $desc = mysqli_real_escape_string($con, $_POST['desc']);
    $admin_name = mysqli_real_escape_string($con, $_POST['admin_name']);
    // $desc = strip_tags($desc_text);


    $select_query = mysqli_query($con, "SELECT * FROM terms");
    $fetch_terms_rows = mysqli_fetch_assoc($select_query);
    $row_count = mysqli_num_rows($select_query);

    if ($row_count > 0) {
        $update_query = mysqli_query($con, "UPDATE terms SET Description='$desc', modifyOn=NOW(), modifyBy='$admin_name' WHERE id=1");

        if ($update_query) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Successfully Updated";

        } else {
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Not Updated";
        }
    } else {
        $insert_query = mysqli_query($con, "INSERT INTO terms(id,Description,createdOn, createdBy) VALUES(1,'$desc',NOW(),'$admin_name')");

        if ($insert_query) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Successfully Inserted";
        } else {
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Not Inserted";
        }
    }


    header("location: $mainlink" . "./admin/terms");
    exit();
}
elseif (isset($_POST['delete_terms'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql3 = "DELETE FROM terms";
    $query3 = mysqli_query($con, $sql3);
    if ($query3) {
        header("location: $mainlink" . "./admin/terms");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}


    elseif(isset($_POST['checking_assessment_creation_btn'])){
        $chapterAssessmentCreationId = $_POST['chapterAssessmentCreationId'];
    $result_array = [];
    
    $query = "SELECT 
    topics.Id as tId,
    topics.topicName, 
    subtopics.id as sId,
    subtopics.subTopicName, 
    courses.id as cId,
    courses.courseName,
    chaptersassessmentorders.id AS chapter_assessment_order_id,
    chaptersassessmentorders.type,
    CASE
        WHEN chaptersassessmentorders.type = 'chapters' THEN chapters.chapterName
        WHEN chaptersassessmentorders.type = 'assessments' THEN assessment.assessmentName
        ELSE NULL 
    END AS names,
    CASE
        WHEN chaptersassessmentorders.type = 'chapters' THEN chapters.id
        WHEN chaptersassessmentorders.type = 'assessments' THEN assessment.id
        ELSE NULL 
    END AS caId
    FROM 
    chaptersassessmentorders
    JOIN 
    topics ON chaptersassessmentorders.topicId = topics.id
    JOIN 
    subtopics ON chaptersassessmentorders.subTopicId = subtopics.id
    JOIN 
    courses ON chaptersassessmentorders.courseId = courses.id
    LEFT JOIN 
    chapters ON chaptersassessmentorders.typeId = chapters.id AND chaptersassessmentorders.type = 'chapters'
    LEFT JOIN 
    assessment ON chaptersassessmentorders.typeId = assessment.id AND chaptersassessmentorders.type = 'assessments'
    WHERE
    chaptersassessmentorders.courseId = $chapterAssessmentCreationId;
    ";
    
    $query_run = mysqli_query($con, $query);
    
    while ($queryData = mysqli_fetch_assoc($query_run)) {
        $result_array[] = $queryData;
    }
    
    // Echo the JSON-encoded array after the loop is completed
    echo json_encode($result_array);
    
    }

    // Pradip Code Insert
elseif (isset($_POST['assessment_creation'])) {
    // Retrieve selected rows data
    $selectedRows = $_POST['selectedRows'];

    // Initialize an array to store query values
    $insertValues = [];

    // Loop through the selected rows and prepare data for insertion
    foreach ($selectedRows as $row) {
        $topicId = $row['topicId'];
        $subtopicId = $row['subtopicId'];
        $courseNameId = $row['courseId'];
        $srNo = $row['Sr. No'];
        $name = $row['radioButtonValue'];
        $chapterId = $row['chapterId'];

        $deleteQuery = mysqli_query($con, "DELETE FROM chaptersassessmentorders WHERE courseId = $courseNameId");

        if($deleteQuery){
            $insertValues[] = "('$topicId', '$subtopicId', '$courseNameId', '$srNo', '$name', '$chapterId', '1')";
            $insertQuery = "INSERT INTO chaptersassessmentorders (topicId, subTopicId, courseId, serialNumber, type, typeId, isActive)
              VALUES " . implode(', ', $insertValues);

        $insertResult = mysqli_query($con, $insertQuery);
        }
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



// Freeze and unfreeze user

if (isset($_POST['freeze_id']) && !empty($_POST['freeze_id'])) {
    $freezeId = $_POST['freeze_id'];

    $query_freeze_user = mysqli_query($con, "UPDATE companyusers SET isactive=0 where id = $freezeId");

    if ($query_freeze_user) {
        echo "User freezed";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}


if (isset($_POST['unfreeze_id']) && !empty($_POST['unfreeze_id'])) {
    $unfreezeId = $_POST['unfreeze_id'];

    $query_unfreeze_user = mysqli_query($con, "UPDATE companyusers SET isactive=1 where id = $unfreezeId");

    if ($query_unfreeze_user) {
        echo "User unfreezed";
    } else {
        echo "Error: " . mysqli_error($con);
    }
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

// Pradip Chapter Assessment Order data delete
if (isset($_POST['deleteAssesmentCreation'])) {
    // Get the ID from the URL
    $id = $_POST['delete_id'];
    $sql1 = "UPDATE chaptersassessmentorders SET isActive = 0 WHERE courseId = $id";
    $query1 = mysqli_query($con, $sql1);
    if ($query1) {
        header("location: $mainlink" . "admin/caoGrid");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}


// blog_comments functionality ( for admin side) Ends



// Assessment functionality Start


// Insert of assessment 

if (isset($_POST['assessment_manage'])) {
    $courseName = $_POST['courseName'];
    $assessmentName = $_POST['assessmentName'];

    $result = mysqli_query($con, "SELECT * FROM assessment WHERE courseId = '$courseName' AND assessmentName = '$assessmentName'");
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0) {
        echo json_encode("Can not add already having same name in id");
    } else {
        $insert_assessment = mysqli_query($con, "INSERT INTO assessment(courseId, assessmentName, isActive) VALUES('$courseName', '$assessmentName', 1)");
        header("location: $mainlink" . "admin/assessmentManage");
    }
} 



// Questions Insert

if (isset($_POST['questions_manage'])) {
    $assessmentId = $_POST['assessment_id'];
    $questions = $_POST['question'];
    $optionA = $_POST['optionA'];
    $optionB = $_POST['optionB'];
    $optionC = $_POST['optionC'];
    $optionD = $_POST['optionD'];
    $correctAns = $_POST['correctAns'];


    $insertQuestions = mysqli_query($con,"INSERT INTO questions(assessmentId, questionsName, a, b, c, d, correctAnswer, isActive) VALUES ('$assessmentId', '$questions', '$optionA', '$optionB', '$optionC', '$optionD', '$correctAns',1)");

    if($insertQuestions){
        $id = $con->insert_id;
        $fetchQuestions = mysqli_query($con,"SELECT * FROM questions WHERE id = '$id'");
        if($fetchQuestions){
            $questionsData = mysqli_fetch_array($fetchQuestions);
            $aId = $questionsData["assessmentId"];
            header("location: {$mainlink}admin/questionsManage?aid={$aId}");
        }
        header("location: {$mainlink}admin/questionsManage?aid={$assessmentId}");
    }
}
?>
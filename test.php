<form action="sql/contactus.php" method="post" role="form" class="php-email-form">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Your Name

            </label>
            <input type="text" name="name" class="form-control" id="name" required="">
        </div>
        <div class="form-group col-md-6">
            <label for="name">Your Email

            </label>
            <input type="email" class="form-control" name="email" id="email" required="">
        </div>
    </div>
    <div class="form-group">
        <label for="name">Mobile No

        </label>
        <style>
            .hidden {
                display: none;
            }
        </style>
        <input type="number" class="form-control" name="mobileno" id="subject" maxlength="13" required="">
        <!--<input class="w-100" type="text" id="TextInput" class="form-control"-->
        <!--        onkeypress="return onlyNumberKey(event)" maxlength="13" placeholder="Mobile / Phone"-->
        <!--        name="mobile" required>-->
    </div>
    <!-- <div class="form-group"> 
        <label for="name">Subject
        
            </label> 
        <input type="text" class="form-control" name="subject" id="subject" required="">
    </div> -->
    <div class="form-group">
        <label for="name">Message
            <style>
                .msg {
                    padding: 3px;
                }
            </style>
        </label>
        <input type="text" class="form-control hidden" name="hidden" id="hidden" maxlength="13" required="">
        <textarea class="form-control msg" name="message" rows="8"></textarea>
        <!--<textarea class="form-control" name="message" rows="8" required="">-->

        </textarea>
    </div>
    <!-- <div class="my-3">
        <div class="loading">Loading
        
            </div>
        <div class="error-message">
        
            </div>
       <div class="sent-message"><p>Your message has been sent. Thank you!</p>
        
            </div> -->
    <!-- </div> -->
    <div class="text-center mt-3">
        <button type="submit" class="enqBtn btn mt-3" style="
    width: 25%;
    color: white;">Submit</button>
    </div>
</form>
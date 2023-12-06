document.addEventListener('DOMContentLoaded', function() {
    // Your code here
    document.getElementById('home_form').addEventListener('submit', function(event) {
        event.preventDefault();

        const banner_title = document.getElementById("banner_title").value;
        const banner_desc = document.getElementById("banner_desc").value;
        const banner_image = document.getElementById("banner_image").files[0];

        if (!banner_image) {
            console.log("No image selected");
            return;
        }

        // Create a FormData object to send the data
        const formData = new FormData();
        formData.append("title", banner_title);
        formData.append("description", banner_desc);
        formData.append("image", banner_image);

        // Log the FormData object to see its contents
        console.log("FormData:", formData);

        // Send the data via AJAX
        $.ajax({
            url: '../core/admin_functions.php',
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function(data) {
                console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error: " + textStatus, errorThrown);
            }
        });
    });
});

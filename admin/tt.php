<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/froala_editor.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/froala_style.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/code_view.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/draggable.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/colors.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/emoticons.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/image_manager.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/image.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/line_breaker.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/table.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/char_counter.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/video.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/fullscreen.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/file.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/quick_insert.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/help.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/third_party/spell_checker.css">
    <link rel="stylesheet" href="assets/vendors/froala_editor/css/plugins/special_characters.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css">

    <style>
        body {
            text-align: center;
        }

        div#editor {
            width: 81%;
            margin: auto;
            text-align: left;
        }

        .ss {
            background-color: red;
        }
        #fr-logo{
            visibility: hidden;
        }
    </style>
</head>

<body>
    <div id="editor">
        <textarea id='edit' style="margin-top: 30px;">

        </textarea>
    </div>
    <script>
        // Declare a variable and set a valueasdasd
        var a = "This is the value to be displayed in thasdasde textarea.";

        // Set the value of the textarea with id 'edit'
        document.getElementById('edit').value = a;
    </script>

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.7/purify.min.js"></script>

    <script type="text/javascript" src="assets/vendors/froala_editor/js/froala_editor.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/align.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/char_counter.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/code_beautifier.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/code_view.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/colors.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/draggable.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/emoticons.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/entities.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/file.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/font_size.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/font_family.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/fullscreen.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/image.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/image_manager.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/line_breaker.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/inline_style.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/link.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/lists.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/paragraph_format.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/paragraph_style.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/quick_insert.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/quote.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/table.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/save.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/url.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/video.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/help.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/print.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/third_party/spell_checker.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/special_characters.min.js"></script>
    <script type="text/javascript" src="assets/vendors/froala_editor/js/plugins/word_paste.min.js"></script>

    <script>
        (function () {
            new FroalaEditor("#edit")
        })()
    </script>
</body>

</html>
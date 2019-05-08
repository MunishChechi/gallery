<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>
        <title>Gallery</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google web fonts -->
        <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />


        <!-- The main CSS file -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
    </head>

    <body>

        <form id="upload" method="post" action="home/upload" enctype="multipart/form-data">

        	<input type="text" id="uploaded_by" name="upload_by" placeholder="Your Name" required="required">
            <div id="drop">
                Drop Here

                <a>Browse</a>
                <input type="file" name="userfile" multiple accept="image/*" />
            </div>

            <ul>
                <!-- The file uploads will be shown here -->
            </ul>
			<div style="text-align: center">
	            <a href="home/images">View Images</a>
	        </div>

        </form>

        <!-- JavaScript Includes -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.knob.js"></script>

        <!-- jQuery File Upload Dependencies -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.ui.widget.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.iframe-transport.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.fileupload.js"></script>

        <!-- Our main JS file -->
        <script src="<?php echo base_url(); ?>assets/js/script.js"></script>

    </body>
</html>
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

        <table>
            <thead>
                <tr>
                    <th>Image Name</th>
                    <th>Width</th>
                    <th>Height</th>
                    <th>Size</th>
                    <th>Extension</th>
                    <th>Uploaded By</th>
                    <th>Time</th>
                    <th>View</th>
                    <th>Map View</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($images as $image) { ?>
                    <tr>
                        <td><?php echo $image['image_name'] ?></td>
                        <td><?php echo $image['image_width'] ?> px</td>
                        <td><?php echo $image['image_height'] ?> px</td>
                        <td><?php echo $image['image_size'] ?> kb</td>
                        <td><?php echo $image['image_ext'] ?></td>
                        <td><?php echo $image['uploaded_by'] ?></td>
                        <td><?php echo $image['uploaded_at'] ?></td>
                        <td><a href="<?php echo base_url() ?>uploads/<?php echo $image['image_name']; ?>" target="_blank">View</a></td>
                        <td><a href='map/<?php echo $image['id']; ?>' target='_blank'>Map Location</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div style="text-align: center;margin-top: 30px">
                <a href='/'>Upload Image</a>
            </div>

        

        <!-- JavaScript Includes -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        

    </body>
</html>
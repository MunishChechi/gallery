<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('gallery_model');
	}


	public function index()
	{
		$this->load->view('home');
	}


	public function upload()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
                $error = $this->upload->display_errors();

                echo json_encode($error);
        }
        else
        {
                $data =  $this->upload->data();
                	
            	$location = $this->_read_image_location($data['full_path']);

            	//print_r($location);
            	if($location !== false){
            		$longitude = $location['longitude'];
            		$latitude = $location['latitude'];
            	}else{
            		$user_location = $this->_get_user_location();
            		$longitude = $user_location['longitude'];
            		$latitude = $user_location['latitude'];
            	}

                $formdata = array(
                			"image_name" => $data['file_name'],
                			"image_height" => $data['image_height'],
                			"image_width" => $data['image_width'],
                			"image_size" => $data['file_size'],
                			"image_ext" => $data['file_ext'],
                			"longitude" => $longitude,
                			"lattitude" => $latitude,
                			"uploaded_by" => $_POST['upload_by']
            			);

                $id = $this->gallery_model->insert_image($formdata);

                if($id > 0){
                	print_r($data);    	
                }else{
                	echo '{"status":"error"}';
                }
            	

                //echo '{"status":"success"}';
        }
	}

	public function images()
	{
		$data['images'] = $this->gallery_model->get_images();

		$this->load->view('images', $data, FALSE);
	}

	public function map($id = '')
	{
		if($id == ''){
			header('location: /');
			exit();
		}


		$image = $this->gallery_model->get_image($id);

		$data['image'] = $image[0];

		$this->load->view('map', $data, FALSE);


	}


	private function _read_image_location($image){
	    $exif = exif_read_data($image, 0, true);
	    
	    if($exif && isset($exif['GPS'])){
	        $GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
	        $GPSLatitude    = $exif['GPS']['GPSLatitude'];
	        $GPSLongitudeRef= $exif['GPS']['GPSLongitudeRef'];
	        $GPSLongitude   = $exif['GPS']['GPSLongitude'];
	        
	        $lat_degrees = count($GPSLatitude) > 0 ? $this->_gps2Num($GPSLatitude[0]) : 0;
	        $lat_minutes = count($GPSLatitude) > 1 ? $this->_gps2Num($GPSLatitude[1]) : 0;
	        $lat_seconds = count($GPSLatitude) > 2 ? $this->_gps2Num($GPSLatitude[2]) : 0;
	        
	        $lon_degrees = count($GPSLongitude) > 0 ? $this->_gps2Num($GPSLongitude[0]) : 0;
	        $lon_minutes = count($GPSLongitude) > 1 ? $this->_gps2Num($GPSLongitude[1]) : 0;
	        $lon_seconds = count($GPSLongitude) > 2 ? $this->_gps2Num($GPSLongitude[2]) : 0;
	        
	        $lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
	        $lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;
	        
	        $latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60*60)));
	        $longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60*60)));

	        return array('latitude'=>$latitude, 'longitude'=>$longitude);
	    }else{
	        return false;
	    }
	}

	private function _gps2Num($coordPart){
	    $parts = explode('/', $coordPart);
	    if(count($parts) <= 0)
	    return 0;
	    if(count($parts) == 1)
	    return $parts[0];
	    return floatval($parts[0]) / floatval($parts[1]);
	}

	private function _get_user_location()
	{
		$getloc = json_decode(file_get_contents("http://ipinfo.io/"));
		$coordinates = explode(",", $getloc->loc); // -> '32,-72' becomes'32','-72'
		return array('latitude'=>$coordinates[0], 'longitude'=>$coordinates[1]);
	
	}
}

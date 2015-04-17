<?php
/**************************************************************
/* By Motyar (Google it for more info)
***************************************************************/
if(isset($_GET)){
	$imagedata = explode('-',$_GET['id']); 
	if (!is_array($imagedata) || count($imagedata) != 4) //If something goes wrong
        {
            die("Something wrong there!! It should be like - placeholder/350-150-CCCCCC-969696");
        }
	create_image($imagedata[0], $imagedata[1], $imagedata[2], $imagedata[3]);
	exit;

}

//Function that has all the magic
function create_image($width, $height, $bg_color, $txt_color )
{
    //Define the text to show
    $text = "$width X $height";

    //Create the image resource 
    $image = ImageCreate($width, $height);  

    //We are making two colors one for BackGround and one for ForGround
	$bg_color = ImageColorAllocate($image, base_convert(substr($bg_color, 0, 2), 16, 10), 
										   base_convert(substr($bg_color, 2, 2), 16, 10), 
										   base_convert(substr($bg_color, 4, 2), 16, 10));

	$txt_color = ImageColorAllocate($image,base_convert(substr($txt_color, 0, 2), 16, 10), 
										   base_convert(substr($txt_color, 2, 2), 16, 10), 
										   base_convert(substr($txt_color, 4, 2), 16, 10));

    //Fill the background color 
    ImageFill($image, 0, 0, $bg_color); 
    
	//Calculating (Actually astimationg :) ) font size
	$fontsize = ($width>$height)? ($height / 10) : ($width / 10) ;
    
	//Write the text .. with some alignment astimations
	imagettftext($image,$fontsize, 0, ($width/2) - ($fontsize * 2.75), ($height/2) + ($fontsize* 0.2), $txt_color, 'Crysta.ttf', $text);
 
    //Tell the browser what kind of file is come in 
    header("Content-Type: image/png"); 

    //Output the newly created image in png format 
    imagepng($image);
   
    //Free up resources
    ImageDestroy($image);
}

//Ok thank you. Bye
//
?>

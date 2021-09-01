<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload</title>
</head>
<body>
<?php
// Required: anonymous function reference number as explained above.
$funcNum = $_GET['CKEditorFuncNum'] ;
// Optional: instance name (might be used to load a specific configuration file or anything else).
$CKEditor = $_GET['CKEditor'] ;
// Optional: might be used to provide localized messages.
$langCode = $_GET['langCode'] ;
// Optional: compare it with the value of `ckCsrfToken` sent in a cookie to protect your server side uploader against CSRF.
// Available since CKEditor 4.5.6.
$token = $_POST['ckCsrfToken'] ;

function uppic_only($img,$imglocate,$limit_size=2000000,$limit_width=0,$limit_height=0,$i_num=NULL){  
    $allowed_types=array("jpg","jpeg","gif","png");     
//  echo "1<br>";  
    $file_up=NULL;  
    if($img["name"]!=""){  
        $fileupload1=$img["tmp_name"];  
        $data_Img=@getimagesize($fileupload1);  
        $g_img=explode(".",$img["name"]);  
        $ext = strtolower(array_pop($g_img));    
        if($i_num){  
            $file_up=time()."-".$i_num.".".$ext;          
        }else{  
            $file_up=time().".".$ext;                     
        }  
        $canUpload=0;  
//      echo "2<br>";  
        if(isset($data_Img) && $data_Img[0]>0 && $data_Img[1]>0){  
//          echo "3<br>";  
            if($img["size"]<=$limit_size){                 
                if($limit_width>0 && $limit_height>0){  
                    if($data_Img[0]<=$limit_width && $data_Img[1]<=$limit_height){  
                        $canUpload=1;  
//                      echo "5<br>";  
                    }                     
                }elseif($limit_width>0 && $limit_height==0){  
                    if($data_Img[0]<=$limit_width){  
                        $canUpload=1;  
//                      echo "6<br>";  
                    }         
                }elseif($limit_width==0 && $limit_height>0){  
                    if($data_Img[1]<=$limit_height){  
                        $canUpload=1;  
//                      echo "7<br>";  
                    }                                                 
                }else{  
                    $canUpload=1;                     
//                  echo "8<br>";  
                }             
            }else{  
//              echo "4<br>";  
            }             
        }         
        if($fileupload1!="" && @in_array($ext,$allowed_types) && $canUpload==1){              
                if(is_uploaded_file($fileupload1)){  
                    @move_uploaded_file($fileupload1,$imglocate.$file_up);    
                    @chmod($imglocate.$file_up,0777);                                 
                }  
        }else{  
            $file_up=NULL;  
        }  
    }  
    return $file_up; // ส่งกลับชื่อไฟล์  
}  
// ถ้ามีการส่งไฟล์มาทำการอัพโหลด
if($_FILES["upload"]){
	// อัพโหลดรูปพาพไปที่โฟลเดอร์ picupload เปลี่ยนชื่ออื่นถ้าต้องการ
	$file_up=uppic_only($_FILES["upload"],"picupload/");  
/*  สามารถดูรูปแบบการเรียกใช้งานฟังก์ชั่นอัพโหลดเพิ่มได้ที่ 
สร้างฟังก์ชันสำหรับอัพโหลดรูป แบบกำหนดเงื่อนไข อย่างง่าย 
http://www.ninenik.com/content.php?arti_id=440 via @ninenik	*/
}



// ตรวจสอบชื่อไฟล์ที่อัพโหลด
if($file_up!=NULL){  // ถ้าอัพโหลดแล้วชื่อไฟล์ไม่ว่าง
	$url = 'ckeditor_upload/picupload/'.$file_up; // กำหนด path ของรูปภาพ 
	// สามารถกำหนด path เต็มได้เช่น $url = 'http://www.ninenik.com/picupload/'.$file_up;
	// ข้อความแจ้งอัพโหลดเรียบร้อยแล้ว
	$message = 'File successfully uploaded.';	
}else{
	$url=NULL;
	// ข้อความแจ้งอัพโหลดไม่สำเร็จ
	$message = 'Can not upload file Over 2Mb, Please try agian!';	
}
echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
?>
</body>
</html>
<?php /*?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">  
  <input type="file" name="pic_upload" id="pic_upload" />  
  <input type="submit" name="bt_upload" id="bt_upload" value="Submit" />  
</form>  
<pre>  
<?php   
if(isset($_POST["bt_upload"])){  
//  อัพโหลดรูปในโฟลเดอร์ชื่อ picup  
//  ตัวอย่างการใช้งานแบบปกติ อัพรูปภาพขนาดไม่เกิน 2 MB  
//  $dataUpPic=uppic_only($_FILES["pic_upload"],"picup/");  
      
//  ตัวอย่างการใช้งานแบบปกติ อัพรูปภาพขนาดไม่เกิน 1 MB กว้างไม่เกิน 700   
    $dataUpPic=uppic_only($_FILES["pic_upload"],"picup/",1000000,700);  
      
//  ตัวอย่างการใช้งานแบบปกติ อัพรูปภาพขนาดไม่เกิน 1 MB กว้างไม่เกิน 700 สูงไม่เกิน 500  
    $dataUpPic=uppic_only($_FILES["pic_upload"],"picup/",1000000,700,500);  
      
//  ตัวอย่างการใช้งานแบบปกติ อัพรูปภาพขนาดไม่เกิน 1 MB  สูงไม่เกิน 500  
    $dataUpPic=uppic_only($_FILES["pic_upload"],"picup/",1000000,0,500);      
      
    echo $dataUpPic; // แสดงชื่อไฟล์รูป   
      
//  print_r($dataUpPic);  
}  
?>  
  สามารถดูรูปแบบการเรียกใช้งานฟังก์ชั่นอัพโหลดเพิ่มได้ที่ 
สร้างฟังก์ชันสำหรับอัพโหลดรูป แบบกำหนดเงื่อนไข อย่างง่าย 
http://www.ninenik.com/content.php?arti_id=440 via @ninenik
</pre>  <?php */?>
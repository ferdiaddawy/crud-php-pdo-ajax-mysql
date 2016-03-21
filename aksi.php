<?php
include'config.php';
session_start();
$page = $_GET['page'];

if ($page == 'form-latihan')
{
	$id    = $_POST[id];
	$nama  = $_POST['nama'];
	$email = $_POST['email'];
	$telp  = $_POST['telp'];
	$lokasi_file  = $_FILES["foto"]["tmp_name"];
	$nama_file    = $_FILES["foto"]["name"];
	move_uploaded_file($lokasi_file,"foto/$nama_file");
	
	if ($id == 0)
	{
		$query = $db->prepare("INSERT INTO tbl_latihan (nama, email, telp, foto) VALUES ('$nama','$email','$telp','$nama_file')");
	}
	else
	{
		$query = $db->prepare("UPDATE tbl_latihan SET nama = '$nama', email = '$email', telp = '$telp', foto = '$nama_file' WHERE id = '$id'");
	}
							
	$query -> execute();
	
	if ($query)
	{
		echo 'true';
	}
	else
	{
		echo 'false';
	}
}


if ($page == 'delete-latihan')
{
	$id    = $_POST[id];
	$query = $db->prepare("DELETE FROM tbl_latihan WHERE id = '$id'");
						
	$query -> execute();
	
	if ($query)
	{
		echo 'true';
	}
	else
	{
		echo 'false';
	}
}
	
?>
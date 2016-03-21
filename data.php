<?php
include'config.php';
$page = $_GET['page'];
?>

<?php
if ($page=='form-latihan')
{
	$id = $_POST['id'];
	$query = $db->prepare("SELECT * FROM tbl_latihan WHERE id = '$id'");
	$query -> execute();
	$data = $query->fetch(PDO::FETCH_ASSOC);
	
	if ($id == 0)
	{
		$nid  	= "";
		$nama 	= "";
		$email 	= "";
		$telp 	= "";
		$foto 	= "";

	}
	else
	{
		$nid  	= $data['id'];
		$nama 	= $data['nama'];
		$email 	= $data['email'];
		$telp 	= $data['telp'];
		$foto 	= $data['foto'];
	}
?>

<div class="form-group form-md-line-input has-success">
<label class="col-md-2 control-label" for="form_control_1">Nama</label>
<div class="col-md-10">
<input type="hidden" class="form-control" id="form_control_1" name="id"  value="<?php echo $id; ?>">
<input type="text" class="form-control" id="form_control_1" name="nama" value="<?php echo $nama; ?>" required >
<div class="form-control-focus"> </div>
</div>
</div>

<div class="form-group form-md-line-input has-success">
<label class="col-md-2 control-label" for="form_control_1">Email</label>
<div class="col-md-10">
<input type="email" class="form-control" id="form_control_1" name="email" value="<?php echo $email; ?>" required >
<div class="form-control-focus"> </div>
</div>
</div>

<div class="form-group form-md-line-input has-success">
<label class="col-md-2 control-label" for="form_control_1">No Telp</label>
<div class="col-md-10">
<input type="text" class="form-control" id="form_control_1" name="telp" value="<?php echo $telp; ?>" required >
<div class="form-control-focus"> </div>
</div>
</div>


<div class="form-group form-md-line-input has-success">
<label class="col-md-2 control-label" for="form_control_1">Foto</label>
<div class="col-md-10">
<input type="file" class="form-control" id="form_control_1" name="foto"  required>
<div class="form-control-focus"> </div>
</div>
</div>

<?php
if (empty($foto == ""))
{
echo'
<div class="form-group form-md-line-input has-success">
<label class="col-md-2 control-label" for="form_control_1">Foto</label>
<div class="col-md-10">
<img src="foto/'.$foto.'" height="100px" width="100px">
<div class="form-control-focus"> </div>
</div>
</div>
</div>
';
}

?>

<?php
}
?>
        

<?php
if ($page == 'data-latihan')
{
?>
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th> Nama </th>
<th> Email </th>
<th> No Telp </th>
<th> Foto </th>
<th> Aksi </th>
</tr>
</thead>
<tbody>
<?php
$query = $db->prepare("SELECT * FROM tbl_latihan");
$query -> execute();
while($data  = $query->fetch(PDO::FETCH_ASSOC))
{
echo'
<tr>
<td> '.$data['nama'].' </td>
<td> '.$data['email'].' </td>
<td> '.$data['telp'].' </td>
<td><img src="foto/'.$data['foto'].'" width="100px" height="100px"> </td>
<td> <a href="javascript:;" id="'.$data['id'].'" class="add-latihan btn btn-sm green"> Edit <i class="fa fa-edit"></i></a> <a href="javascript:;" id="'.$data['id'].'" class="delete-latihan btn btn-sm red"><i class="fa fa-times"></i> Delete </a>                                                      </td>
</tr>';
}
?>
</tbody>
</table>
<?php
}
?>
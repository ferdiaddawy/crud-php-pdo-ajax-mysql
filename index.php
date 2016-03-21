<?php
date_default_timezone_set('Asia/Jakarta');
include'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>CRUD WITH PDO</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link rel="stylesheet" href="lobibox/bootstrap.css"/>
<link rel="stylesheet" href="lobibox/Lobibox.min.css"/>
<link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-boxed">
<div class="page-container">
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="container">
                <div class="page-content-inner" style="margin-top: 100px;">
                    <div class="row latihan">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                <div class="caption font-dark">
                                <button type="button" id="0" class="btn green add-latihan"><i class="fa fa-user-plus"></i> Tambah Data</button>
                                </div>
                                </div>
                                
                                <!--DATA KETIKA DI LOAD OLEH JAVASCRIPT-->
                                <div class="portlet-body data-latihan">
                                </div>	
                                <!--END DATA KETIKA DI LOAD OLEH JAVASCRIPT-->
                            </div>
                        </div>
                    </div>
                    
                    
                    <!--FORM INPUT & UPDATE DENGAN DEFAULTNYA TIDAK TAMPIL -->
                    <div class="row form_latihan" style="display:none;" >
                    <div class="col-md-12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light">
                    <div class="portlet-title">
                    <div class="caption font-green-haze">
                    <span class="caption-subject bold uppercase"> FORM INPUT siswa</span>
                    </div>
                    </div>
                    <div class="portlet-body form" style="height: auto;">
                    <form role="form" action="aksi.php?page=form-latihan" method="POST" id="Upload" class="form-horizontal">
                    <div class="form-body">
                    </div>
                    <div class="progress" style="display:none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    <span class="sr-only">0% Complete </span>
                    </div>
                    </div>
                    <div class="form-actions">
                    <div class="row">
                    <div class="col-md-offset-2 col-md-10">
                    <button type="reset" class="btn default">Cancel</button>
                    <button type="submit" class="submit-siswa btn blue">Submit</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>		
                    <!--END FORM INPUT & UPDATE DENGAN DEFAULTNYA TIDAK TAMPIL -->
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
  
  
    <!-- BEGIN CORE PLUGINS -->
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="lobibox/lobibox.min.js"></script>
		<script src="lobibox/demo.js"></script>
		<script src="jquery.form.js"></script>
    <script> 
    /*SCRIPT UNTUK NGELOAD DATA KEDALAM HTML*/
    var data_latihan = "data.php?page=data-latihan";
    $(".data-latihan").load(data_latihan);
    /*END SCRIPT UNTUK NGELOAD DATA KEDALAM HTML*/

    /*SCRIPT ADD & UPDATE DATA*/
    $('body').on('click', '.add-latihan', function(e) {
      e.preventDefault();
      var id = this.id;
      $.ajax({
          type : "POST",
          url  : "data.php?page=form-latihan",
          data : {id : id},
          success : function(data){
              $('.latihan').hide();
              $(".form-body").html(data);
              $(".form_latihan").show();
          }
      });
    });
    /*END SCRIPT INPUT & UPDATE DATA*/
    


    /*SCRIPT UNTUK MENGHAPUS DATA*/
    $('body').on('click', '.delete-latihan', function(e) {   
        e.preventDefault();
        var id = this.id;
        
        Lobibox.confirm({
        msg: "Apakah anda yakin ingin menghapus data ini?",
        callback: function ($this, type, ev) {
            if (type === 'yes') {
            $.ajax({
            type : "POST",
            url  : "aksi.php?page=delete-latihan",
            data : {id: id},
            success : function(data){
            Lobibox.notify('success', {
            msg: 'Data berhasil di hapus.'
            });
            $(".data-latihan").load(data_latihan);
            }
            });

            } else if (type === 'no') {
            
            }
        }
        });
    });
    /*END SCRIPT UNTUK MENGHAPUS DATA*/

    /*SCRIPT UNTUK MENYIMPAN DATA*/
    $(document).ready(function() { 
        $('#Upload').ajaxForm({
            beforeSend:function(){
            $(".progress").show();
            },
            
            uploadProgress:function(event, position, total, percentComplete){
            $(".progress-bar").width(percentComplete+'%');
            $(".sr-only").html(percentComplete+'%');
            },
            
            success:function(){
            $(".progress").hide();
            },
            
            complete:function(data)
            {
                if (data.responseText == 'else')
                {
                  Lobibox.notify('error', {
                  msg: 'Maaf file tidak boleh kosong.'
                  });
                }
                else
                {
                  Lobibox.notify('success', {
                  msg: 'Berhasil.'
                  });
                  $(".form_latihan").hide();
                  $('.latihan').show();
                  $(".data-latihan").load(data_latihan);
                }
            }
        });
    }); 
    /*END SCRIPT UNTUK MENYIMPAN DATA*/
    </script> 
</body>
</html>
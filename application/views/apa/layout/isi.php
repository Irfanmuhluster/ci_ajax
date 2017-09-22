<div class="container">
<div class="col-md-1">
</div>
<div class="col-md-10">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-md" id="btnAdd">Tambah</button>
<div class="alert alert-success" style="display: none;"></div>
<table class="table table-bordered table-hover">
	<caption>table title and/or explanatory text</caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pegawai</th>
			<th>Alamat</th>
			<th>Umur</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody id="tampil">
	
	</tbody>
</table>
</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" data-toggle="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      <form action="" id="myForm" method="POST" class="form-horizontal">
      <input type="hidden" name="Id" value="">
        <div class="form-inline">
   		 <div class="col-md-3"><label for="exampleInputName2">Name :</label></div>
    <input type="text" class="form-control" name="Nama" value="">
  	</div><br>
  <div class="form-inline">
    <div class="col-md-3"><label for="exampleInputName2">Alamat :</label></div>
    <input type="text" class="form-control" id="exampleInputName2" name="Alamat" placeholder="">
  </div><br>
  <div class="form-inline">
   <div class="col-md-3"><label for="exampleInputName2">Umur :</label></div>
    <input type="text" class="form-control" id="exampleInputName2" name="Umur" placeholder="">
  </div>
  </form>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="myModalDelete" tabindex="-1" data-toggle="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Konfirmasi Hapus</h4>
      </div>
      <div class="modal-body">
 		<p><b>
 			Yakin ingin menghapus Data ini?
 		</b></p>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
tampilPegawai();

//iki ki njikuk data soko myform yoo..
$('#btnSave').click(function(){
	var url = $('#myForm').attr('action');
	var data = $('#myForm').serialize();

	var nama = $('input[name=Nama]');
	var alamat = $('input[name=Alamat]');
	var umur = $('input[name=Umur]');
	var result = '';

	//jika kosong maka error dg merubah Bapaknya ditambahi class has-error
	if(nama.val()==''){
		nama.parent().addClass('has-error');
	}else{
		nama.parent().removeClass('has-error');
		result +='1';
	}
	if(alamat.val()==''){
		alamat.parent().addClass('has-error');
	}else{
		alamat.parent().removeClass('has-error');
		result +='2';
	}
	if(umur.val()==''){
		umur.parent().addClass('has-error');
	}else{
		umur.parent().removeClass('has-error');
		result +='3';
	}
	if(result=='123'){
		      $.ajax({
		       	 type: 'ajax',
		       	 method: 'POST',
		         url: url, //krn sudah dideklarasikan di var url diatas
		         data: data,
		     	 async: false,
		     	 dataType: 'json',
		         success: function(data){
				  if (data.success) {
		            	$('#myModal').modal('hide');
		            	$('#myForm')[0].reset();
		            	if(data.type=='tambah'){
		            		var type ="tambah"; //cuma variabel saja
		            	}else if(data.type=='update'){
		            		var type ="update";
		            	}
		            	$('.alert-success').html('<b>Data berhasil di '+type+'</b>').fadeIn().delay(4000).fadeOut('slow');
		            	tampilPegawai();
		            //reloadTable();
		            } else {
		            	alert('gagal');
		            }

		         },
		         error:function() {
		           alert('error');
		         }
		      });
		  
	}
});
function tampilPegawai(){
	      $.ajax({
	         type:'ajax',
	         url: '<?php echo base_url()?>Welcome/getPegawai',
	         async: false,
	         dataType : 'json',
	         success:function(data){
	            var html = '';
	            var i;
	            var no=1;
	            for(i=0; i<data.length; i++){
	            	html += '<tr>'+
							'<td>'+no+'</td>'+
							'<td>'+data[i].Nama+'</td>'+
							'<td>'+data[i].Alamat+'</td>'+
							'<td>'+data[i].Umur+'</td>'+
							'<td>'+
							'<a href="javascript:;" class="btn btn-success item-edit" type="button" data="'+data[i].Id+'">Edit</a> '+
							'<a href="javascript:;" class="btn btn-warning item-delete" type="button" data="'+data[i].Id+'">Hapus</a></td>'+
					'</tr>';
					no++;
	            }
	            $('#tampil').html(html);
	         },
	         error:function() {
	            alert("data");
	         }
	      });
	   }


//button add ki gur go ngerubah tampilane yooo
$('#btnAdd').click(function(){
	$('#myModal').modal('show');
	$('#myModal').find('.modal-title').text('Tambah Pegawai');
	$('#myForm').attr('action','<?php base_url() ?>Welcome/GetPegawaiInsert');
});


//edit
$('#tampil').on('click','.item-edit',function(){
	var id = $(this).attr('data');
	$('#myForm').attr('action','<?php echo base_url() ?>Welcome/UpdatePegawai'); //ini untuk update ke database
	$('#myModal').modal('show');
	$('#myModal').find('.modal-title').html('<b>Edit Employee</b>');
	//var url = $('#myForm').attr('action'); //bisa gini
	      $.ajax({
	         type: 'ajax',
		     method: 'get', //krn data ada dlm href data
		     url: '<?php echo base_url() ?>Welcome/EditPegawai', //ini untuk menampilkan di form
		     data: {id: id}, //json dalam kurung
		   	 async: false,
		     dataType: 'json',
	         success:function(data){

	            $('input[name=Nama]').val(data.Nama);
	           	$('input[name=Alamat]').val(data.Alamat);
	           	$('input[name=Umur]').val(data.Umur);
	           	$('input[name=Id]').val(data.Id);

	         },
	         error:function() {
	            alert("Search failed");
	         }
	      });
	});

//delete

$('#tampil').on('click','.item-delete',function(){
	var id = $(this).attr('data');
    $('#myModalDelete').modal('show');
    //menge,balikan ke aksi sebelumnya
    $('#btnDelete').unbind().click(function(){
    		 $.ajax({
	         type: 'ajax',
		     method: 'get', //krn data ada dlm href data
		     url: '<?php echo base_url() ?>Welcome/DeletePegawai', //ini untuk menampilkan di form
		     data: {id: id}, //json dalam kurung
		   	 async: true,
		     dataType: 'json',
	         success:function(data){
	         	if (data.success) {
	           	$('#myModalDelete').modal('hide');
	           	$('#myForm')[0].reset();
	           	$('.alert-success').html('<b>Data berhasil di hapus').fadeIn().delay(4000).fadeOut('slow');
	           	
	           }else {
		            alert('gagal');
		         }
		          tampilPegawai();
	           	
	         },
	         error:function() {
	            alert("Search failed");
	         }
	      });
	});
    
});

function reloadTable(){
		if(table){
			
			table.clear();
			table.ajax.reload();
		}
	}

	   </script>
<!-- Esta vista nos mostrará un formulario en el que podremos tanto crear una nota, como edtar una existente. -->

<?php require_once 'template/header.php'; ?>

<?php
$id = $nombre = $puesto = $email ="";

if (isset($dataToView["data"]["id"])) {
    $id = $dataToView["data"]["id"];
}
if (isset($dataToView["data"]["nombre"])) {
    $nombre = $dataToView["data"]["nombre"];
}
if (isset($dataToView["data"]["puesto"])) {
    $puesto = $dataToView["data"]["puesto"];
}
if (isset($dataToView["data"]["email"])) {
    $email= $dataToView["data"]["email"];
}
?>


<div class="row">
	<?php
        //si se ha realizado correctamente la operación muestro el div
	if(isset($_GET["response"]) && $_GET["response"] === true){
		?>
		<div class="alert alert-success">
			Operación realizada correctamente. <a href="index.php?controller=employee_controller&action=list">Volver al listado</a>
		</div>
		<?php
	}
	?>
    <form id="form" class="form" action="index.php?controller=employee_controller&action=save" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<div class="form-group">
                    <label class="fontGeneral">Nombre</label>
                    <span id="pAvisoCoin" style="color: red"></span>
                <input class="form-control" id="nameEmployeeEdit" type="text" name="nombre" value="<?php echo $nombre; ?>" required/>
		</div>
		<div class="form-group mb-2">
			<label class="fontGeneral">Puesto</label>
			<textarea id="puestoEmployee" class="form-control fondoReadOnly" readonly style="white-space: pre-wrap;" name="puesto" required><?php echo $puesto; ?></textarea>
		</div>
                <div class="form-group">
			<label class="fontGeneral">Email</label>
			<input id="emailEmployee" class="form-control fondoReadOnly" readonly type="text" name="email" value="<?php echo $email; ?>" required/>
		</div>
                <br>
                <div class="form-group fontGeneral">
                    <label>Subir imagen: </label>
                    <input name="archivo" id="archivo" type="file" disabled required/>
		</div>
                <br>
                
                <p id="pValidar"></p>
                
                <p id="pBtnGuardar" class="visibility"><input id="btnGuardar"type="submit" value="Guardar" class="button1 btn-filtrar2 " name="subir"/>
                 <a class="button1" href="index.php?controller=employee_controller&action=list">Cancelar</a></p>
	</form>
</div>
<?php require_once 'template/footer.php'; ?>

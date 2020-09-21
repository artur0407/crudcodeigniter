<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4 pb-4 mb-4">
	<div class="container-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"> <?=$title?> </h1>
	</div>

	<?php if(!empty(validation_errors())) { ?>
		<div class="col-md-12">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<?php echo validation_errors(); ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	<?php } ?>

	<?php $readonly = isset($action) && $action == "view" ? "readonly" : ""; ?> 
	<?php $disabled = isset($action) && $action == "view" ? "disabled" : ""; ?> 

	<div class="col-md-12">

		<?php if(isset($paciente)) {  ?>

		<form action="<?=base_url()?>pacientes/update/<?=$paciente['id'];?>" method="post" enctype="multipart/form-data">

		<?php } else { ?>

		<form action="<?=base_url()?>pacientes/store" method="post" enctype="multipart/form-data">
 
		<?php } ?>

			<div class="card mb-3">
				<div class="card-header bg-secondary text-white">Dados Pessoais</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-9">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="name">Nome Completo<small class="text-danger"> * </small> </label>
									<input type="text" class="form-control" name="nome_completo" id="nome_completo"
										value="<?= isset($paciente) ? $paciente['nome_completo'] : '' ?> " <?=$readonly;?>>
								</div>
								<div class="form-group col-md-6">
									<label for="name">Nome Completo da Mãe<small class="text-danger"> * </small> </label>
									<input type="text" class="form-control" name="nome_completo_mae" id="nome_completo_mae"
										value="<?= isset($paciente) ? $paciente['nome_completo_mae'] : '' ?>" <?=$readonly;?>>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="release_date">Data de Nascimento<small class="text-danger"> * </small> </label>
									<input type="text" class="form-control" name="data_nascimento" id="data_nascimento"
										value="<?=isset($paciente) ? $paciente['data_nascimento'] : '';?>" <?=$readonly;?>>
								</div>
								<div class="form-group col-md-4">
									<label for="developer">CPF <small class="text-danger">*</small> </label>
									<input type="text" class="form-control" name="cpf" id="cpf" 
										value="<?=isset($paciente) ? $paciente['cpf'] : '';?>" <?=$readonly;?>>
								</div>
								<div class="form-group col-md-4">
									<label for="developer">CNS <small class="text-danger">*</small> </label>
									<input type="text" class="form-control" name="cns" id="cns" 
										value="<?=isset($paciente) ? $paciente['cns'] : '';?>" maxlength="15" <?=$readonly;?>>
								</div>
							</div>
							<div class="form-row">
								<label for="estado">Foto do Paciente </label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="foto" name="foto" <?=$readonly;?> <?=$disabled;?>>
									<label class="custom-file-label" for="foto">
										<?=isset($paciente) ? $paciente['foto'] : 'Escolha a imagem...';?>
									</label>
								</div>
								<input type="hidden" name="foto" value="<?=isset($paciente) ? $paciente['foto'] : 'Escolha a imagem...';?>">
							</div>
						</div>
						<div class="col-sm-3">
							<?php if(empty($paciente["foto"])) { ?>
								<svg class="bd-placeholder-img img-thumbnail" width="230" height="230" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="">
									<title></title>
									<rect width="100%" height="100%" fill="#868e96"></rect>
									<text x="50%" y="50%" fill="#dee2e6" dy=".3em">Sem Foto</text>
								</svg>
							<?php } else { ?>
								<img src="<?=base_url()."application/uploads/pacientes/".$paciente["foto"]; ?>" style="width:250px; height:250px" class="rounded img-thumbnail">
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header bg-secondary text-white">Dados de Localização</div>
				<div class="card-body">
					<div class="form-row">
						<div class="form-group col-md-2">
							<label for="CEP">CEP <small class="text-danger">*</small> </label>
							<input type="text" class="form-control" id="cep" name="cep" 
								value="<?=isset($paciente) ? $paciente['cep'] : '';?>" <?=$readonly;?>>
						</div>
						<div class="form-group col-md-6">
							<label for="endereco">Endereço <small class="text-danger">*</small> </label>
							<input type="text" class="form-control" id="endereco" name="endereco" readonly 
								value="<?=isset($paciente) ? $paciente['endereco'] : '';?>">
						</div>
						<div class="form-group col-md-4">
							<label for="bairro">Bairro <small class="text-danger">*</small> </label>
							<input type="text" class="form-control" id="bairro" name="bairro" readonly 
								value="<?=isset($paciente) ? $paciente['bairro'] : '';?>">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="cidade">Cidade <small class="text-danger">*</small> </label>
							<input type="text" class="form-control" id="cidade" name="cidade" readonly
								value="<?=isset($paciente) ? $paciente['bairro'] : '';?>">
						</div>
						<div class="form-group col-md-2">
							<label for="estado">Estado <small class="text-danger">*</small> </label>
							<input type="text" class="form-control" id="estado" name="estado" readonly 
								value="<?=isset($paciente) ? $paciente['estado'] : '';?>">
						</div>
						<div class="form-group col-md-2">
							<label for="numero">Número </label>
							<input type="text" class="form-control" id="numero" name="numero" 
								value="<?=isset($paciente) ? $paciente['numero'] : '';?>" <?=$readonly;?>>
						</div>
						<div class="form-group col-md-2">
							<label for="complemento">Complemento </label>
							<input type="text" class="form-control" id="complemento" name="complemento" 
								value="<?=isset($paciente) ? $paciente['complemento'] : '';?>" <?=$readonly;?>>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<small class="d-block py-2 text-danger"> Os campos marcados com (*) são de preenchimento obrigatório </small>
				<button type="submit" class="btn btn-success btn-xs" <?=$disabled;?>><i class="fas fa-check"></i> Salvar </button>
				<a href="<?=base_url();?>pacientes" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancelar </a>
			</div>
		</form>
	</div>
</main>
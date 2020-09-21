<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4 pb-4 mb-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"><?=$title;?></h1>
		<div class="btn-group mr-2">
            <a href="<?=base_url()?>pacientes/new" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-plus-square"></i> <?=$buttonnew;?> </a>
		</div>
	</div>

	<?php if ($this->session->userdata('sucesso')) { ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
  			<?=$this->session->flashdata('sucesso'); ?>
		</div>
	<?php } ?>
	
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome</th>
					<th>CPF</th>
					<th>CNS</th>
					<th>Data Nascimento</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
            <?php foreach($pacientes as $paciente) { ?>
                <tr>
                    <td><?=$paciente['id'];?>				</td>
                    <td><?=$paciente['nome_completo'];?>	</td>
                    <td><?=$paciente['cpf'];?>				</td>
                    <td><?=$paciente['cns'];?>				</td>
                    <td><?=$paciente['data_nascimento'];?>	</td>
                    <td>
						<a href="<?=base_url();?>pacientes/view/<?=$paciente['id'];?>" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="<?=base_url();?>pacientes/edit/<?=$paciente['id'];?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="javascript:goDelete(<?=$paciente['id'];?>)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
			</tbody>
		</table>
	</div>
</main>
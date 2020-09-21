
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script type="text/javascript">
     $(document).ready(function() {    
        $("#cep").mask('00000-000');
        $("#data_nascimento").mask('00/00/0000');
        $('#cpf').mask('000.000.000-00', {reverse: true});

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $("#cep").blur(function() {
            var cep = $(this).val();
            if (cep!='' && !validaCEP(cep)) {
                $(this).val('');
                alert('CEP Inválido');
                $(this).focus();
            } else {
                /* Post jquery recebe 3 params: endereco url, valor do parametro e funcao de callback */
                $.post('<?=base_url();?>pacientes/consultaCEP', {cep : cep}, 
                function(dados) {
                    console.log('teste');
                    if(dados.erro){
                        alert('Atenção, CEP ' + cep + ' não encontrado'); 
                        $("#cep").val('');
                        $('#endereco').val('');
                        $('#bairro').val('');
                        $('#cidade').val('');
                        $('#estado').val('');
                        return false;
                    }
                    $('#endereco').val(dados.logradouro);
                    $('#bairro').val(dados.bairro);
                    $('#cidade').val(dados.localidade);
                    $('#estado').val(dados.uf);
                }, 'json');
            }
        });
    });

	function validaCEP(strCEP, blnVazio) {
		//Caso o CEP não esteja no formato 99999-999 ele é inválido!
		var objCEP = /^[0-9]{5}-[0-9]{3}$/;//
		strCEP = strCEP.trim();
		if(strCEP.length > 0) {
			if(objCEP.test(strCEP))
				return true;
			else
				return false;
		} else {
			return blnVazio;
		}  
    }

    function goDelete(id) {
		var myUrl = 'pacientes/delete/'+id;
		if(confirm('Deseja realmente apagar este registro')) {
			window.location.href = myUrl; 
			return true;
		} 
		return false;
    }
</script>

<footer class="fixed-bottom py-2 bg-dark text-white">
    <div class="container text-center pb-1">
        <small>Copyright &copy; Your Website</small>
    </div>
</footer>

</body>
</html>

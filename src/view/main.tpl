		<section id="carregando" class="l-centro hide l-area-util">
			<img src="imagens/carregando.gif" alt="" class="l-centro">
		</section>
		
		<section id="conteudo" class="l-centro">
			<?php 
				
				if (isset($_GET['rota'])) {

			    	if(file_exists('src/'.$_GET['rota'].".tpl")){
        				include('src/'.$_GET['rota'].".tpl");
    				}

    				else {
        				include('src/view/home.tpl');
    				}
				} 
				else {
    				include('src/view/home.tpl');
				}

			?>
		</section>
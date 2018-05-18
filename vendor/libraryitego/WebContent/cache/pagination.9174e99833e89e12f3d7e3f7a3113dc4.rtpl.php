<?php if(!class_exists('Rain\Tpl')){exit;}?><nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

    <li class="page-item">
      <a class="page-link" href="/crud/livro/0/10/read" tabindex="-1">Primeira</a>
    </li>
    
    	<li class="page-item"><a class="page-link" href="/crud/livro/<?php echo htmlspecialchars( $value1["pag1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/10/read"><?php echo htmlspecialchars( $value1["numero1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
    	<li class="page-item"><a class="page-link" href="/crud/livro/<?php echo htmlspecialchars( $value1["pag2"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/10/read"><?php echo htmlspecialchars( $value1["numero2"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
    	<li class="page-item"><a class="page-link" href="/crud/livro/<?php echo htmlspecialchars( $value1["pag3"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/10/read"><?php echo htmlspecialchars( $value1["numero3"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
    
    
    <li class="page-item">
      <a class="page-link " href="/crud/livro/<?php echo htmlspecialchars( $value1["ultima"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/10/read">Última</a>
    </li>
    <?php } ?>

  </ul>
</nav>
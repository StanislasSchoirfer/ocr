<?php
/**
 * The template for displaying archive-activite_cpt pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ocr_wp
 */

get_header(); ?>

<div class="container">
	<div class="row">
	<?
	
	function convertDate($dateString) {
	return date_format(date_create_from_format('Y-m-d', $dateString), 'd/m/Y');
	}
	$success =false;
	if (isset( $_REQUEST['_wpnonce'] ) &&  wp_verify_nonce( $_REQUEST['_wpnonce'], 'inscription_activite' )){
	
		$options = get_option('activite_options');  
		$from =  $options['email_to_send']; 
		$activite = htmlentities($_REQUEST['activite']);
		$prenom = htmlentities($_REQUEST['prenom']);
		$nom = htmlentities($_REQUEST['nom']);
		$personne  = htmlentities($_REQUEST['adresse']);
		$subject= "[inscription] à ".$activite ." [" .$ID ."]" ;
		$message= $prenom . ' '. $nom. ' souhaite s\'inscrire à l\'activité ' . ' ' . $activite . '\n';
		$message .= 'adresse de contact : ' . $personne;
		$headers = 'From: Conatc mairie <' . $from .'>' . "\r\n";
		
		//wp_mail ( string|array $to, string $subject, string $message, string|array $headers = '', string|array $attachments = array() )
		$sendToMairie = wp_mail($from, $subject, $message, $headers);
		if($sendToMairie) {
		$confirmation = "Nous avons bien recu votre demande d\'inscription";
		$msg = 'Votre de mande est ' . $message;
			wp_mail($personne, $confirmation, $msg, $headers);
			$success = true;
		}
	
	}?> 
	
	
	

		
			<?php
			$date = date('Y-m-d', time());
			$args = array(
				
				'post_type' => 'activite_cpt',
				'post_status' => 'publish',
				'posts_per_page' => -1,
                'orderby' => 'meta_value',
                'meta_key' => 'activite_date_date',
                'order'=>'ASC',
                
				'meta_query' => array(
									array(
										'key'     => 'activite_date_date',
										'value'   => $date,
										'compare' => '>'
	)
				
				)
			
			);
			
			$the_query = new WP_Query( $args ); 
			
			?>
	
			

				<?php if ( $the_query->have_posts() ) : ?>

					<header>
						
							<h2>Activités à venir</h2>
						
					</header><!-- .page-header -->

					<div class="table-responsive">
					<table class="table table-bordered table-hover">
					<?php  // table-inverse     ?>
					<thead class="thead-inverse">
    				<tr>
      					<th>#</th>
      					<th>Date</th>
      					<th>Titre</th>
      					<th>Résumé</th>
      					<th>Plus d'infos</th>
      					<th>S'inscrire</th>
    				</tr>
  					</thead>
  					<tbody>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<tr>
					<th scope="row">
						<?php 
						if (has_post_thumbnail()) {
						
						echo get_the_post_thumbnail( get_the_ID (), 'activity-small' );
						
						}
						
						?>
					</th>
						
						<td><?php echo convertDate( rwmb_meta( 'activite_date_date', get_the_ID () ) ); ?></td>
						<td><?php the_title() ; ?></td>
						<td><?php the_excerpt(); ?></td>
						<td><a href="<?php the_permalink(); ?>">en savoir +</a></td>
						<td><button class="btn btn-secondary" data-toggle="modal" data-target=".modal-mail" data-activity="<?php the_title()?>" data-id="<?php the_ID(); ?>">S'inscrire</button></td>
					</tr>
					<?php endwhile; ?>
					</tbody>
					</table>
					</div>

					<?php ocr_page_navi(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>


<!-- the modal -->
<div class="modal fade modal-mail" tabindex="-1" role="dialog" aria-labelledby="ModalInscription" aria-hidden="true">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Inscription</h4>
      </div>
      
    <div class="col-xs-12">
    Vous êtes en train de vous inscrire à l'activité : <span class="title-activity"></span>
    </div>
    <form method='get'>
      <div class="form-group col-xs-12">
      	<label for="prenom" name="prenom" class="form-control-label">Entrer votre prénom : </label>
        <input id="prenom" type="text" class="form-control" placeholder="prénom" required />
        
        <label for="nom" class="form-control-label">Entrer votre adresse nom : </label>
        <input id="nom" name="nom" type="text" class="form-control" placeholder="nom" required/>
      </div>
      <div class="form-group col-xs-12">
              <label for="adresse" class="form-control-label">Entrer votre adresse email:</label>
               <input id="adresse" name="adresse" type="email" class="form-control" placeholder="Adresse email" required/>
      </div>
      
      <div class="form-group col-xs-12">
             <div class="pull-right"> <button class="btn btn-secondary pull-right" type="submit">Envoyer</button></div>
      </div>
      <input type="hidden" name="send_activite" id="send_activite"/>
      <?php wp_nonce_field( 'inscription_activite' ); ?>
    </form>
    </div>
  </div>
</div>
<!-- /modal -->
<?php
if($success):
?>
<!-- confirmation modal -->
<div class="modal fade" id="ok">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Demande envoyée</h4>
      </div>
      <div class="modal-body">
        <p>Votre demande à bien été envoyée.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<?php
endif
?>
	

		<?php get_sidebar(); ?>
	</div> <!-- .row -->
</div> <!-- .container -->

<?php get_footer(); ?>
<?php 
if($success) : ?>
<script type="text/javascript">
    $(window).load(function(){
        $('#ok').modal('show');
    });
</script>
<?php endif ?>

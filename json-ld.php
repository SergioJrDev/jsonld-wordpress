<?php 

/*
 * Plugin Name: Json LD
 * Plugin URI: http://www.horaluterana.org.br/
 * Author URI: http://www.sergiojunior.com.br/
 * Description: Adiciona jsonLD no head
 * Author: Sergio Junior
 * Version: 1.0
 */

class jsonLd
{	

	public $args;
	public $home;
	public $person;
	public $single;
	public $default;
	public $jsonLdHome;
	public $jsonLdSingle;
	public $jsonLdDefault;
	public $jsonLd;

	public function __construct()
	{
		add_action( 'admin_menu', [$this, 'registerMenu'], 0 );
		add_action('wp_head', [$this, 'getJsonld'], 0);
	}


	public function registerMenu()
	{
	    add_submenu_page( 
	       'options-general.php',
	        __( 'Configuração JsonLD', 'textdomain' ),
	        __( 'JsonLD', 'textdomain' ),
	        'manage_options',
	        'slug-pagina',
	        'contentMenuCallBack'
	    ); 

	    function contentMenuCallBack() {
	    	?>
			    <div class="wrap">
			        <h1><?php _e( 'Configuração JsonLD', 'textdomain' ); ?></h1>
			        <form action="" method="POST">
			        	<h2>Informações</h2>
						<table class="form-table">
							<tbody>
								<tr>
									<th>
										<label for="">Nome do Site</label>
									</th>
									<td>
										<input name="website"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_website')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Imagem Principal</label>
									</th>
									<td>
										<input name="thumbnail"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_thumbnail')[0]; ?>">
									</td>
								</tr>
							</tbody>
						</table>

			        	<h2>Dados Pessoais</h2>
						<table class="form-table">
							<tbody>
								<tr>
									<th>
										<label for="">Nome pessoal</label>
									</th>
									<td>
										<input name="personal_name"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_personal_name')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Data de Nascimento</label>
									</th>
									<td>
										<input name="nascimento"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_nascimento')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Genero</label>
									</th>
									<td>
										<input name="genero"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_genero')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Nickname</label>
									</th>
									<td>
										<input name="nickname"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_nickname')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Atuação</label>
									</th>
									<td>
										<input name="jobtitle"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_jobtitle')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Nacionalidade</label>
									</th>
									<td>
										<input name="nacionalidade"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_nacionalidade')[0]; ?>">
									</td>
								</tr>
							</tbody>
						</table>

			        	<h2>Endereço</h2>
						<table class="form-table">
							<tbody>
								<tr>
									<th>
										<label for="">Endereço</label>
									</th>
									<td>
										<input name="rua" type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_rua')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Cidade</label>
									</th>
									<td>
										<input name="cidade"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_cidade')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Estado</label>
									</th>
									<td>
										<input name="estado"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_estado')[0]; ?>">
									</td>
								</tr>
							</tbody>
						</table>

			        	<h2>Contato</h2>
						<table class="form-table">
							<tbody>
								<tr>
									<th>
										<label for="">E-mail</label>
									</th>
									<td>
										<input name="email"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_email')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Telefone</label>
									</th>
									<td>
										<input name="telefone"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_tel')[0]; ?>">
									</td>
								</tr>
							</tbody>
						</table>

			        	<h2>Redes Sociais</h2>
						<table class="form-table">
							<tbody>
								<tr>
									<th>
										<label for="">Twitter</label>
									</th>
									<td>
										<input name="twitter"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_twitter')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Instagram</label>
									</th>
									<td>
										<input name="instagram"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_instagram')[0]; ?>">
									</td>
								</tr>
								<tr>
									<th>
										<label for="">Facebook</label>
									</th>
									<td>
										<input name="facebook"  type="text" class="regular-text" value="<?php echo get_user_meta('1', 'jsonld_facebook')[0]; ?>">
									</td>
									<input type="hidden" name="update" value="1">
								</tr>
							</tbody>
						</table>

						<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Salvar alterações"></p>
					</form>
			    </div>
			<?php	

			if(isset($_REQUEST['update'])) {
				update_user_meta('1', 'jsonld_website', $_REQUEST['website']);
				update_user_meta('1', 'jsonld_thumbnail', $_REQUEST['thumbnail']);
				update_user_meta('1', 'jsonld_personal_name', $_REQUEST['personal_name']);
				update_user_meta('1', 'jsonld_nascimento', $_REQUEST['nascimento']);
				update_user_meta('1', 'jsonld_genero', $_REQUEST['genero']);
				update_user_meta('1', 'jsonld_nickname', $_REQUEST['nickname']);
				update_user_meta('1', 'jsonld_jobtitle', $_REQUEST['jobtitle']);
				update_user_meta('1', 'jsonld_nacionalidade', $_REQUEST['nacionalidade']);
				update_user_meta('1', 'jsonld_twitter', $_REQUEST['twitter']);
				update_user_meta('1', 'jsonld_instagram', $_REQUEST['instagram']);
				update_user_meta('1', 'jsonld_facebook', $_REQUEST['facebook']);
				update_user_meta('1', 'jsonld_rua', $_REQUEST['rua']);
				update_user_meta('1', 'jsonld_cidade', $_REQUEST['cidade']);
				update_user_meta('1', 'jsonld_estado', $_REQUEST['estado']);
				update_user_meta('1', 'jsonld_email', $_REQUEST['email']);
				update_user_meta('1', 'jsonld_tel', $_REQUEST['telefone']);

				wp_redirect( home_url('/wp-admin/options-general.php?page=slug-pagina'), 302 );
			}
	    }
	}


	public function setJsonldHome()
	{
		$this->home = [
			"logo" => get_user_meta('1', 'jsonld_thumbnail')[0],
			"address" => [
				"@type" => "postalAddress",
				"streetAddress" => get_user_meta('1', 'jsonld_rua')[0],
				"addressLocality" => get_user_meta('1', 'jsonld_cidade')[0],
				"addressRegion" => get_user_meta('1', 'jsonld_estado')[0],
				"addressCountry" => "BR",	
			],
			"contactPoint" => [
					"@type" => "contactPoint",
					"email" => get_user_meta('1', 'jsonld_email')[0],
					"contactType" => "customer support",
					"telephone" => '+55'.get_user_meta('1', 'jsonld_tel')[0],
				]
		];

		return $this->home;
	}

	public function setJsonldSingle()
	{
		$this->single = [
			"@type" => "article",
			"name" => get_the_title(),
			"url" => get_the_permalink(),
			"datePublished" => get_the_time('Y-m-d h:m:s'),
			"dateModified" => get_the_time('Y-m-d h:m:s'),
			"image" => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID()) : "",
			"headline" => get_the_title(),
	      	"mainEntityOfPage" => [
	         "@type" => "WebPage",
	      	],
			"Publisher" => [
				$this->setJsonldOrganization(),
			],
			"author" => [
				$this->setJsonldPerson(),
			],
			"articleBody" => get_post_field('post_content', get_the_ID()),
		];

		return $this->single;
	}

	public function setJsonldPerson() 
	{
		$this->person = [
			"@type" => "Person",
			"additionalName" => get_user_meta('1', 'jsonld_nickname')[0],
			"birthDate" => get_user_meta('1', 'jsonld_nascimento')[0],
			"contactPoint" => [
				"@type" => "contactPoint",
				"email" => get_user_meta('1', 'jsonld_email')[0],
				"contactType" => "customer support",
				"telephone" => '+55'.get_user_meta('1', 'jsonld_tel')[0]
			],
			"email" => get_user_meta('1', 'jsonld_email')[0],
			"gender" => get_user_meta('1', 'jsonld_genero')[0],
			"jobTitle" => get_user_meta('1', 'jsonld_jobtitle')[0],
			"nationality" => get_user_meta('1', 'jsonld_nacionalidade')[0],
			"sameAs" => [
				get_user_meta('1', 'jsonld_twitter')[0],
				get_user_meta('1', 'jsonld_instagram')[0],
				get_user_meta('1', 'jsonld_facebook')[0],
			],
			"name" => get_user_meta('1', 'jsonld_personal_name')[0],
			"id" => get_user_meta('1', 'jsonld_website')[0],
			"url" => get_user_meta('1', 'jsonld_website')[0],
		];

		return $this->person;

	}

	public function setJsonldOrganization() 
	{
		$this->person = [
			"@type" => "Organization",
			"additionalName" => get_user_meta('1', 'jsonld_nickname')[0],
			"logo" => get_user_meta('1', 'jsonld_thumbnail')[0],
			"birthDate" => get_user_meta('1', 'jsonld_nascimento')[0],
			"contactPoint" => [
				"@type" => "contactPoint",
				"email" => get_user_meta('1', 'jsonld_email')[0],
				"contactType" => "customer support",
				"telephone" => '+55'.get_user_meta('1', 'jsonld_tel')[0]
			],
			"email" => get_user_meta('1', 'jsonld_email')[0],
			"gender" => get_user_meta('1', 'jsonld_genero')[0],
			"jobTitle" => get_user_meta('1', 'jsonld_jobtitle')[0],
			"nationality" => get_user_meta('1', 'jsonld_nacionalidade')[0],
			"sameAs" => [
				get_user_meta('1', 'jsonld_twitter')[0],
				get_user_meta('1', 'jsonld_instagram')[0],
				get_user_meta('1', 'jsonld_facebook')[0],
			],
			"name" => get_user_meta('1', 'jsonld_personal_name')[0],
			"id" => get_user_meta('1', 'jsonld_website')[0],
			"url" => get_user_meta('1', 'jsonld_website')[0],
		];

		return $this->person;

	}

	public function setJsonldDefault() 
	{
		$this->default = [
			"@context" => "http://schema.org/",
			"@type" => "Organization",
			"url" => home_url(),
			"name" => get_bloginfo(),
		];
		
		return $this->default;

	}

	public function getJsonld() 
	{

		$this->jsonLdHome = $this->setJsonldHome();

		$this->jsonLdSingle = $this->setJsonldSingle();

		$this->jsonLdDefault = $this->setJsonldDefault();

		if(is_front_page()) {

			$this->jsonLd = array_merge($this->jsonLdDefault, $this->jsonLdHome);

		} elseif(is_single()) {

			$this->jsonLd = array_merge($this->jsonLdDefault, $this->jsonLdSingle);

		}

		echo '<script type="application/ld+json">'.json_encode($this->jsonLd, JSON_PRETTY_PRINT).'</script>';
	}

}

new jsonLd();


 ?>
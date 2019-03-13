<?php /* Template Name: Contato */
    get_header(); 
?>
<?php get_template_part('template-parts/banner'); ?>
<div class="columns">
    <div class="container">
        <div class="content">
            <?php if ( have_posts () ) : while (have_posts()) : the_post(); ?>
            <h5>Preencha o Formulário</h5>
            <?php 
                the_content();
            ?>
                <?php endwhile; 
            endif; ?>
            <?php 
                if(isset($_GET['sent'])){
                    echo '<p style="text-align: center; font-size: 16px; font-style: italic;display: block;margin: 35px auto 0;">Enviado com sucesso!</p>';
                }
            ?>
            <form action="<?php echo site_url('PHPMailer/send.php'); ?>" id="contact-form" class="contact-form forms" name="contato" method="POST">
                <span><label for="nome">Nome: *</label><input required="required" onkeypress="mascara(this,soLetras)"  name="nome" type="text"/></span>
                <span><label for="sobrenome">Sobrenome: *</label><input required="required" onkeypress="mascara(this,soLetras)"  name="sobrenome" type="text"/></span>
                <span><label for="email">E-mail: *</label><input required="required"  name="email" type="email"/></span>
                <span><label for="telefone">Telefone/Whats:</label><input class="telefone" name="telefone" type="tel"/></span>
                <span><label for="mensagem">Comentários: *</label><textarea required="required"  name="mensagem"></textarea></span>
                <span><button class="btn btn-2">Enviar</button></span>
            </form>
        </div>
        <?php get_sidebar( 'contato' ); ?>					
    </div>
</div>
<?php get_footer(); ?>
    </main>
</div>
<footer class="footer">
    <div id="footer">
            <div class="container">
                <div>
                    <strong>Sitemap</strong>
                    <nav class="footer-navigation">
                        <ul class="menu">
                            <?php wp_nav_menu( array( 'container' => false, 'menu' => 'navigation', 'items_wrap' => '%3$s', 'container_class'=>'sitemap' ) ); ?>
                        </ul>
                    </nav>
                </div>
                <div class="address_row">
                    <strong>Onde Estamos</strong>
                    <?php 
                        foreach (get_field('enderecos', option) as $key => $addresses) {
                            echo '<div class="address_item">';
                                echo '<strong>'.$addresses['titulo_endereco'].'</strong><p>';
                                    echo ($addresses['endereco']) ? $addresses['endereco'].'<br/><br/>' : '';
                                    echo ($addresses['telefone_endereco']) ? $addresses['telefone_endereco'].'<br/><br/>' : '';
                                    echo ($addresses['email_endereco']) ? '<a href="mailto:'.$addresses['email_endereco'].'" title="'.$addresses['email_endereco'].'">'.$addresses['email_endereco'].'</a>' : '';
                                echo '</p>';
                                echo ($addresses['logo_endereco']) ? '<br/><img height="120" title="'.$addresses['endereco'].'" src="'.$addresses['logo_endereco'].'"/>' : '';
                            echo '</div>';
                        }
                    ?>  
                </div>
            </div>
    </div>
    <div class="copyright">
        <div class="container">
            <p><?php echo "&#x24B8; COPYRIGHT ".date('Y')." - FHMendes CLÍNICA DE CIRURGIA PLÁSTICA - TODOS OS DIREITOS RESERVADOS"; ?></p>
            <p class="stamps">
                <a href="#" title="Developed by SD">Developed by SD</a>
                <a href="javascript:void(0)">W3C|HTML5</a>
            </p>
        </div>
    </div>
</footer>
<?php if(get_theme_mod('facebook')) : ?>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.1&appId=827613747400657&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<noscript>Seu Navegador pode não aceitar javascript.</noscript>
<?php endif; ?>
<div id="fb-root"></div>
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC5QMfSnVnSCcmkFag0ygrXzj2QJ9usEG4'></script>
<script>
    function init_map(){
        <?php 
            foreach (get_field('enderecos', option) as $key => $addresses) {
                $coordinates = str_replace(' ','',$addresses['coordenadas_endereco']);
                
                $lat = explode(',',$coordinates)[0];
                $lng = explode(',',$coordinates)[1];
                
                echo '
                    var mapProp'.$key.' = {
                        zoom: 15,
                        center: new google.maps.LatLng('.$lat.','.$lng.'), 
                        disableDefaultUI: false,
                        mapTypeId: google.maps.MapTypeId.TERRAIN
                    };
                    var aside_map'.$key.' = new google.maps.Map(document.getElementById("aside_map'.$key.'"),mapProp'.$key.');
                        var marker'.$key.' = new google.maps.Marker({
                            position: "'.str_replace(' ','',$addresses['coordenadas_endereco']).'",
                            map: aside_map'.$key.',
                            title: "Hello World!"
                        });
                        
                        var pos'.$key.' = {lat: '.$lat.', lng: '.$lng.'};
                        
                        var marker'.$key.' = new google.maps.Marker({position: pos'.$key.', map: aside_map'.$key.'});
                    
                ';
            }    
        ?>
    }
    google.maps.event.addDomListener(window, "load", init_map);
</script>
<noscript>Seu Navegador pode não aceitar javascript.</noscript>
<?php wp_footer(); ?>
<div id="spinner"></div>
</body>
</html>
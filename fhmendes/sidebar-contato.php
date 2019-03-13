        <?php
            if(get_field('enderecos', option)) :  
                $multiple_maps = get_field('enderecos', option);
            endif;
        ?>
        <?php if($multiple_maps) : ?>
            <aside class="sidebar">
                <?php foreach ($multiple_maps as $key => $addresses) { ?>
                <div>
                    <?php echo ($key == 0) ? '<h5>Endereços</h5>' : ''; ?>
                    <div class="address-columns">
                        <p>
                            <?php 
                                echo ($addresses['endereco']) ? ' <i class="fa fa-map-pin ico"></i> <strong>Endereço:</strong> '.$addresses['endereco'].'<br/><br/>' : '';
                                echo ($addresses['telefone_endereco']) ? '<strong>Fone:</strong> '.$addresses['telefone_endereco'].'<br/><br/>' : '';
                                echo ($addresses['email_endereco']) ? '<strong>E-mail:</strong> '.$addresses['email_endereco'] : '';
                            ?>
                        </p>
                        <?php 
                            echo '<div class="map" id="aside_map'.$key.'"></div>';
                        ?>                       
                    </div>

                </div>
                <?php
                    }
                ?>                   
            </aside>
        <?php endif; ?>	
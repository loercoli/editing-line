<?php get_header(); 

   if ( have_posts() ) {
    while ( have_posts() ) {


        the_post();

        $post_id = get_the_ID(); // Assicurati di essere nel Loop di WordPress o di avere l'ID del post
        
        $digital_print_title = get_the_title();

        $cover_group = lom_get_group_contents(get_the_ID(), 'cover_group');
        $digital_print_subtitle =  $cover_group['digital_print_subtitle'][0];
        $digital_print_cover =  $cover_group['digital_print_cover'][0];
        $digital_print_product_description =  $cover_group['digital_print_product_description'][0];

        // Recupera i figli
        $args = array(
            'post_type' => get_post_type($post_id),
            'posts_per_page' => -1, // Ottieni tutti i post figli
            'post_parent' => $post_id,
            'post_status' => 'publish',
        );

        $children = new WP_Query($args);
        if ($children->have_posts()) {
            while ($children->have_posts()) {
                $children->the_post();
                $child_id = get_the_ID();
                $width = get_post_meta($child_id, 'dp_width', true);
                $height = get_post_meta($child_id, 'dp_height', true);
                $children_data[] = [
                    'title' => get_the_title(),
                    'width' => $width,
                    'height' => $height
                ];
            }
        }
        wp_reset_postdata(); // Resetta il post data al contesto originale


        $info_group = lom_get_group_contents(get_the_ID(), 'info_group');
        $digital_print_main_feature = $info_group['digital_print_main_feature'][0];
        $digital_print_additional_features = $info_group['digital_print_additional_features'][0];
        

        $main_features = lom_get_group_contents(get_the_ID(), 'features_group');
        $digital_print_card_main_features =  $main_features['card_main_features'];
    
        
        
        $link_group = lom_get_group_contents(get_the_ID(), 'link_group');
        $digital_print_external_link = $link_group['digital_print_external_link'][0];
        preg_match('/href="([^"]+)"/', $digital_print_external_link, $external_link);
        $digital_print_external_link_href = $external_link[1];

        

        $digital_print_pdf = $link_group['digital_print_pdf'][0];
        preg_match('/href="([^"]+)"/', $digital_print_pdf, $print_pdf);
        $digital_print_pdf_href = $print_pdf[1];
        
        
        $media_group = lom_get_group_contents(get_the_ID(), 'media_group');
        $digital_print_gallery = $media_group['digital_print_gallery'][0];
        $digital_print_video  = $media_group['digital_print_video'][0];
        if (empty($digital_print_video)){
            $digital_print_video = $media_group['wp-embed-aspect-16-9 wp-has-aspect-ratio'][0];
        }

        $brands = get_the_terms( $post_id, 'brand' );
        if ( !empty( $brands ) && !is_wp_error( $brands ) ) {
            foreach ( $brands as $brand ) {
               $digital_print_brand = $brand->name;
            }
        }

        $typologies = get_the_terms( $post_id, 'digital-print-typology' );
        if ( !empty( $typologies ) && !is_wp_error( $typologies ) ) {
            foreach ( $typologies as $typology ) {
               $digital_print_typology = $typology->name;
            }
        }

    }
}


?>



<div class="block digital-print cover-post">
    <div class="main-column">
        <div class="flex">
            <div class="info-container col-6 ">
                <div class="tag-category-post">
                    <?php 
                    if ( !empty( $digital_print_typology )){
                        echo chip("filled", "primary",$digital_print_typology, "none" , false); }
                    if ( !empty( $digital_print_brand )){
                        echo chip("filled", "bright" ,$digital_print_brand, "none" , false); }
                    ?>
                </div>
                <div class="title-post">
                    <h1 class="display"><?=$digital_print_title?></h1>
                </div>
                <div class="subtitle-post title-small uppercase"><?=$digital_print_subtitle?></div>
                <div class="description-post body-small">
                    <?=$digital_print_product_description?>
                </div>
                <div class="button-container">
                    <?php if($digital_print_external_link_href) { ?>
                    <a class="button-esternal-link" href="<?=$digital_print_external_link_href ?>" target=" _blank">
                        <?= 
                    button(array(
                            'size' => 'medium', 
                            'style' => 'outlined', 
                            'color' => 'primary',
                            'label' => 'Link Pagina',
                        )) ?>

                    </a>
                    <?php };
                
                if($digital_print_pdf_href) { ?>
                    <a class="button-pdf-link" href="<?= $digital_print_pdf_href ?>" target=" _blank">
                        <?= 
                    button(array(
                            'size' => 'medium', 
                            'style' => 'outlined', 
                            'color' => 'primary',
                            'label' => 'Scarica brochure'
                        )) ?>
                    </a>
                    <?php };?>
                </div>
            </div>
            <div class="image-container col-6 ">
                <?= $digital_print_cover?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($children_data)) : ?>
<div class="block digital-print children-post">
    <div class="main-column">
        <h2>Modelli disponibili</h2>
        <div class="types-container col-12">
            <?php foreach ($children_data as $child) : ?>
            <?php if (!empty($child)) : ?>
            <div class="type-container">
                <h3 class="title-big-bold type-title"><?php echo esc_html($child['title']); ?></h3>
                <?php if (!empty($child['width'])) : ?>
                <label class="label-big-medium">Formato di stampa</label>
                <p class="type-size body-small"><?= esc_html($child['width']); ?>
                    <?php if (!empty($child['height'])) : ?>
                    x
                    <?= esc_html($child['height']); ?>
                    <?php endif; ?>
                    cm
                </p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>



<div class="block digital-print features-post">
    <div class="main-column">
        <h2>Caratteristiche principali</h2>
        <div class="main-features-container flex">
            <div class="left-container col-6">
                <?php 
                    foreach ($digital_print_card_main_features as $card){
                        if ( !empty( $card )){
                        echo $card;
                    };
                }
                ?>
            </div>
            <div class="right-container col-6">
                <?php if (!empty($digital_print_main_feature)){ ?>
                <div class="title-section label-big-medium">Altre caratteristiche:</div>
                <?= $digital_print_main_feature?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php if ( !empty($digital_print_gallery)) : ?>
<div class="block digital-print gallery-post">
    <div class="main-column">
        <h2>Le applicazioni</h2>
        <?= $digital_print_gallery ?>
    </div>
</div>
<?php endif; ?>

<?php if ( !empty($digital_print_video)) : ?>
<div class="block digital-print video-post">
    <div class="main-column">
        <h2>Guarda con i tuoi occhi</h2>
        <div class="video-container">
            <?= $digital_print_video ?>
        </div>
    </div>
</div>
<?php endif; ?>







<?= insert_img_modal(); ?>
<?php get_footer(); ?>
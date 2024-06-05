<?php get_header(); 

   if ( have_posts() ) {
    while ( have_posts() ) {


        the_post();

        $post_id = get_the_ID(); // Assicurati di essere nel Loop di WordPress o di avere l'ID del post
        
        $pre_printing_title = get_the_title();

        $cover_group = lom_get_group_contents(get_the_ID(), 'cover_group');
        $pre_printing_subtitle =  $cover_group['pre_printing_subtitle'][0];
        $pre_printing_cover =  $cover_group['pre_printing_cover'][0];
        $pre_printing_product_description =  $cover_group['pre_printing_product_description'][0];

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
        $pre_printing_main_feature = $info_group['pre_printing_main_feature'][0];
        $pre_printing_additional_features = $info_group['pre_printing_additional_features'][0];
        

        $main_features = lom_get_group_contents(get_the_ID(), 'features_group');
        $pre_printing_card_main_features =  $main_features['card_main_features'];
    
        
        
        $link_group = lom_get_group_contents(get_the_ID(), 'link_group');
        $pre_printing_external_link = $link_group['pre_printing_external_link'][0];
        preg_match('/href="([^"]+)"/', $pre_printing_external_link, $external_link);
        $pre_printing_external_link_href = $external_link[1];

        

        $pre_printing_pdf = $link_group['pre_printing_pdf'][0];
        preg_match('/href="([^"]+)"/', $pre_printing_pdf, $print_pdf);
        $pre_printing_pdf_href = $print_pdf[1];
        
        
        $media_group = lom_get_group_contents(get_the_ID(), 'media_group');
        $pre_printing_gallery = $media_group['pre_printing_gallery'][0];
        $pre_printing_video  = $media_group['pre_printing_video'][0];

        $brands = get_the_terms( $post_id, 'brand' );
        if ( !empty( $brands ) && !is_wp_error( $brands ) ) {
            foreach ( $brands as $brand ) {
               $pre_printing_brand = $brand->name;
            }
        }

        $typologies = get_the_terms( $post_id, 'pre-printing-typology' );
        if ( !empty( $typologies ) && !is_wp_error( $typologies ) ) {
            foreach ( $typologies as $typology ) {
               $pre_printing_typology = $typology->name;
            }
        }

    }
}


?>



<div class="block pre-printing cover-post">
    <div class="main-column">
        <div class="flex">
            <div class="info-container col-6 ">
                <div class="tag-category-post">
                    <?php 
                    if ( !empty( $pre_printing_typology )){
                        echo chip("filled", "tertiary",$pre_printing_typology, "none" , false); }
                    if ( !empty( $pre_printing_brand )){
                        echo chip("filled", "bright" ,$pre_printing_brand, "none" , false); }
                    ?>
                </div>
                <div class="title-post">
                    <h1 class="display"><?=$pre_printing_title?></h1>
                </div>
                <div class="subtitle-post title-small"><?=$pre_printing_subtitle?></div>
                <div class="description-post body-small">
                    <?=$pre_printing_product_description?>
                </div>
                <div class="button-container">
                    <?php if($pre_printing_external_link_href) { ?>
                    <a class="button-esternal-link" href="<?=$pre_printing_external_link_href ?>" target=" _blank">
                        <?= 
                    button(array(
                            'size' => 'medium', 
                            'style' => 'outlined', 
                            'color' => 'tertiary',
                            'label' => 'Link Pagina',
                        )) ?>

                    </a>
                    <?php };
                
                if($pre_printing_pdf_href) { ?>
                    <a class="button-pdf-link" href="<?= $pre_printing_pdf_href ?>" target=" _blank">
                        <?= 
                    button(array(
                            'size' => 'medium', 
                            'style' => 'outlined', 
                            'color' => 'tertiary',
                            'label' => 'Scarica brochure'
                        )) ?>
                    </a>
                    <?php };?>
                </div>
            </div>
            <div class="image-container col-6 ">
                <?= $pre_printing_cover?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($children_data)) : ?>
<div class="block pre-printing children-post">
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



<div class="block pre-printing features-post">
    <div class="main-column">
        <h2>Caratteristiche principali</h2>
        <div class="main-features-container flex">
            <div class="left-container col-6">
                <?php 
                    foreach ($pre_printing_card_main_features as $card){
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

<?php if ( !empty($pre_printing_gallery)) : ?>
<div class="block pre-printing gallery-post">
    <div class="main-column">
        <h2>Le applicazioni</h2>
        <?= $pre_printing_gallery ?>
    </div>
</div>
<?php endif; ?>

<?php if ( !empty($pre_printing_video)) : ?>
<div class="block pre-printing video-post">
    <div class="main-column">
        <h2>Guarda con i tuoi occhi</h2>
        <div class="video-container">
            <?= $pre_printing_video ?>
        </div>
    </div>
</div>
<?php endif; ?>







<?= insert_img_modal(); ?>
<?php get_footer(); ?>
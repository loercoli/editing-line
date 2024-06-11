<?php get_header(); 

   if ( have_posts() ) {
    while ( have_posts() ) {


        the_post();

        $post_id = get_the_ID(); // Assicurati di essere nel Loop di WordPress o di avere l'ID del post
        
        $consumable_title = get_the_title();

        $cover_group = lom_get_group_contents(get_the_ID(), 'cover_group');
        $consumable_subtitle =  $cover_group['consumable_subtitle'][0];
        $consumable_cover =  $cover_group['consumable_cover'][0];
        $consumable_product_description =  $cover_group['consumable_product_description'][0];

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
        
        $link_group = lom_get_group_contents(get_the_ID(), 'link_group');
        $consumable_external_link = $link_group['consumable_external_link'][0];
        preg_match('/href="([^"]+)"/', $consumable_external_link, $external_link);
        $consumable_external_link_href = $external_link[1];

        $consumable_pdf = $link_group['consumable_pdf'][0];
        preg_match('/href="([^"]+)"/', $consumable_pdf, $print_pdf);
        $consumable_pdf_href = $print_pdf[1];
        
        $columns_group = lom_get_all_inner_blocks(get_the_ID(), 'columns_group');
        $consumable_columns_blocks = $columns_group;

        $media_group = lom_get_group_contents(get_the_ID(), 'media_group');
        $consumable_gallery = !empty($media_group['consumable_gallery'][0]) ? $media_group['consumable_gallery'][0] : null;
        $video_keys = [
            'consumable_video',
            'wp-embed-aspect-16-9 wp-has-aspect-ratio',
            'consumable_video wp-embed-aspect-16-9 wp-has-aspect-ratio'
        ];
        $consumable_video = get_first_non_empty($media_group, $video_keys);


        $brands = get_the_terms( $post_id, 'brand' );
        if ( !empty( $brands ) && !is_wp_error( $brands ) ) {
            foreach ( $brands as $brand ) {
               $consumable_brand = $brand->name;
            }
        }

        $typologies = get_the_terms( $post_id, 'consumable-typology' );
        if ( !empty( $typologies ) && !is_wp_error( $typologies ) ) {
            foreach ( $typologies as $typology ) {
               $consumable_typology = $typology->name;
            }
        }

    }
}


?>



<div class="block consumable cover-post">
    <div class="main-column">
        <div class="flex">
        <!-- <div class="image-container col-4 ">
                <?= $consumable_cover?>
            </div> -->
            <div class="info-container col-12 ">
                <div class="tag-category-post">
                    <?php 
                    if ( !empty( $consumable_typology )){
                        echo chip("filled", "bright",$consumable_typology, "none" , false); }
                    if ( !empty( $consumable_brand )){
                        echo chip("filled", "bright" ,$consumable_brand, "none" , false); }
                    ?>
                </div>
                <div class="title-post">
                    <h1 class="display"><?=$consumable_title?></h1>
                </div>
                <div class="subtitle-post title-small uppercase"><?=$consumable_subtitle?></div>
                <!-- <?php if($consumable_product_description) { ?>
                    <div class="description-post body-small">
                        <?=$consumable_product_description?>
                    </div>
                <?php };?> -->
                <?php if($consumable_external_link_href || $consumable_pdf_href) { ?>
                <div class="button-container">
                    <?php if($consumable_external_link_href) { ?>
                    <a class="button-esternal-link" href="<?=$consumable_external_link_href ?>" target=" _blank">
                        <?= 
                    button(array(
                            'size' => 'medium', 
                            'style' => 'outlined', 
                            'color' => 'quaternary',
                            'label' => 'Link Pagina',
                        )) ?>

                    </a>
                    <?php };
                
                if($consumable_pdf_href) { ?>
                    <a class="button-pdf-link" href="<?= $consumable_pdf_href ?>" target=" _blank">
                        <?= 
                    button(array(
                            'size' => 'medium', 
                            'style' => 'outlined', 
                            'color' => 'quaternary',
                            'label' => 'Scarica brochure'
                        )) ?>
                    </a>
                    <?php };?>
                    </div>
                <?php };?>
            </div>
        </div>
    </div>
</div>



<div class="block consumable features-post">
    <div class="main-column">
        <h2>Caratteristiche</h2>
        <div class="main-features-container consumable flex">
            <div class="col-12">
                <?php 
                    foreach ($consumable_columns_blocks as $block){
                        if ( !empty( $block )){
                        echo $block;
                    };
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php if ( !empty($consumable_gallery)) : ?>
<div class="block digital-print gallery-post">
    <div class="main-column">
        <h2>Lasciati stupire</h2>
        <?= $consumable_gallery ?>
    </div>
</div>
<?php endif; ?>

<?php if ( !empty($consumable_video)) : ?>
<div class="block consumable video-post">
    <div class="main-column">
        <h2>Guarda con i tuoi occhi</h2>
        <div class="video-container">
            <?= $consumable_video ?>
        </div>
    </div>
</div>
<?php endif; ?>







<?= insert_img_modal(); ?>
<?php get_footer(); ?>
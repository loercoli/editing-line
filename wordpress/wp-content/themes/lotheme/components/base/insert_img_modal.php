<?php

function insert_img_modal() {

    $insert_img_modal = '';
    $insert_img_modal.='<div id="imageModal" class="modal"><div class ="close">';
    $insert_img_modal.= button(array(
        'size' => 'big', 
        'style' => 'tonal', 
        'color' => 'primary',
        'icon'=>'close'
    )) ;
    $insert_img_modal.='</div><img class="modal-content" id="modalImage" src="" alt="Image preview" /></div>';
return $insert_img_modal;

}
<div class="grid-item <?php echo $termsString;?>">
<?php 
if( $settings['select_layout'] == 'layout1' ) {
    echo 'The style One' . '<br>';
} elseif( $settings['select_layout'] == 'layout2' ) {
    echo 'The style Two' . '<br>';
} else {

}
echo the_title() . 'Tabs view' . '<br>'; ?>
</div>

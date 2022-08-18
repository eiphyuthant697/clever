<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Real_Home
 */

?>

</div><!-- #content -->

<?php
/**
 * Functions hooked into real_home_footer_before action
 *
 */
do_action( 'real_home_footer_before' );
?>

<footer id="colophon" class="site-footer">

    <?php
    /**
     * Functions hooked into real_home_footer_before action
     *
     */
    do_action( 'real_home_footer_top' );
    ?>

    <?php
    /**
     * Functions hooked into real_home_footer action
     *
     * @hooked real_home_footer_site_info - 10
     */
    do_action( 'real_home_footer' );
    ?>

    <?php
    /**
     * Functions hooked into real_home_footer_before action
     *
     */
    do_action( 'real_home_footer_bottom' );
    ?>

</footer><!-- #colophon -->

<?php
/**
 * Functions hooked into real_home_footer_after action
 *
 * @hooked real_home_footer_back_to_top - 10
 */
do_action( 'real_home_footer_after' );
?>

</div><!-- #page -->


<?php
/**
 * Functions hooked into real_home_body_bottom action
 *
 */
do_action( 'real_home_body_bottom' );
?>

<?php wp_footer(); ?>
<script>
    jQuery(document).ready(function($){
		$('html[lang="my-MM"] .property-location-section h2.entry-title').html('တည်နေရာများ');
		$('html[lang="my-MM"] .latest-news-section h2.entry-title').html('နောက်ဆုံးရသတင်းများနှင့် ဘလော့ဂ်');
		$('html[lang="my-MM"] .partner-section h2.entry-title').html('ကျွန်ုပ်တို့၏ မိတ်ဖက်များ');
		$('html[lang="my-MM"] .address h2.entry-title').html('ဆက်သွယ်ရန်အချက်အလက်');
		$('html[lang="my-MM"] #media_gallery-2 h2.entry-title').html('ပြခန်း');
		$('html[lang="my-MM"] #block-13 h2.entry-title').html('လတ်တလော ပို့စ်များ');
		$('html[lang="my-MM"] .why-choose-us-section h2.entry-title').html('ဘာကြောင့် ငါတို့ကို ရွေးချယ်သင့်လဲ?');
		$('html[lang="my-MM"] #keyword_search').attr('placeholder','စာသား');
		$('html[lang="my-MM"] #property_divi').attr('placeholder','တိုင်း/ပြည်နယ်').html('တိုင်း/ပြည်နယ်');
		$('html[lang="my-MM"] #location_tsp').attr('placeholder','မြို့နယ်').html('မြို့နယ်');
		$('html[lang="my-MM"] #property_type').attr('placeholder','အမျိုးအစားများ').html('အမျိုးအစားများ');
		$('html[lang="my-MM"] #property_features').attr('placeholder','အင်္ဂါရပ်များ').html('အင်္ဂါရပ်မျာ');
		$('html[lang="my-MM"] #property_min').attr('placeholder','အနည်းဆုံးစျေးနှုန်း').html('အနည်းဆုံးစျေးနှုန်း');
		$('html[lang="my-MM"] #property_max').attr('placeholder','အမြင့်ဆုံးစျေးနှုန်း').html('အမြင့်ဆုံးစျေးနှုန်း');
        $('a, img').attr('bis_size','');
        $('a img').attr('style','');
		
        $('select#location_tsp').attr('disabled', 'disabled');
        $('select#location').on('change', function() {
          var selectedParentName =  $(this).children("option:selected").attr('data-id'); //it tracks changes dropdown value
          //console.log(selectedParentName);
          $('select#location_tsp').removeAttr('disabled');
          $.post(
              "/real-estate/wp-content/themes/real-home/child_categories.php", { selectedParent : selectedParentName },
              function(data) {
                $('select#location_tsp').html(data);
                
              }
          );
        });

        // Booking Form
        setTimeout(function() {
              $.post(
                  "/real-estate/wp-content/themes/real-home/parent_type_form.php", { },
                  function(data) {
                      $('select.property-type').html(data);
                  }
              );
        }, 50);
        setTimeout(function() {
            $.post(
                "/real-estate/wp-content/themes/real-home/parent_division_form.php", { },
                function(data) {
                    $('select.property-division').html(data);
                }
            );
        }, 50);

        setTimeout(function() {
            $.post(
                "/real-estate/wp-content/themes/real-home/parent_features_form.php", { },
                function(data) {
                    $('select.property-feature').html(data);
                }
            );
        }, 50);
        
        $('select.property-tsp').attr('disabled', 'disabled');
        $('select.property-division').on('change', function() {
          var selectedParentFormName =  $(this).children("option:selected").attr('data-id'); //it tracks changes dropdown value
          //console.log(selectedParentFormName);
          $('select.property-tsp').removeAttr('disabled');
          $.post(
              "/real-estate/wp-content/themes/real-home/child_categories_form.php", { selectedDivisionName : selectedParentFormName },
              function(data) {
                $('select.property-tsp').html(data);
                
              }
          );
        });
    })
</script>
</body>
</html>

<?php

/**
 * @var $media object
 */

?>
<?php if(count($media->data) > 0): ?>
<section class="instaBlock">
    <div class="container">
        <div class="row">
            <img src="/images/instagram.png" alt="Instagram" title="Instagram">
            <div class="col-md-12">
                <div class="instaPluginBlock">
                    <?php
                    foreach ($media->data as $photo) {
                        echo '<div role="img" aria-label="Images from Instagram" class="col-sm-2 instaItem">';
                            echo '<a rel="noreferrer" target="_blank" class="instaImage" href="'.$photo->link.'">';
                            echo '<div class="instahover"></div>';
                                echo '<img aria-title="Image" src="'.$photo->images->thumbnail->url.'" alt="'.$photo->link.'">';
                            echo '</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
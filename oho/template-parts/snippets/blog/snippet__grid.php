<?php

/**
 * Snippet to generate the Grid
 * Used for CPT Blog
 * 
 * Post Type must be passed as $args['data'] to the snippet using get_template_part( <path>, null, ['data' => $postData] )
 */

$postTypeSlug = $args['posttype'] ?? '';
$taxonomySlug = $args['taxonomy'] ?? '';
$filterTitle  = $args['filter_title'] ?? '';
$postsPerPage = 3;

// guard: 
if (empty($postTypeSlug) || empty($taxonomySlug) || empty($filterTitle)) {
  exit('Template part arguments missing in snippet__grid.php');
}

?>

<?php
$post_query_args = [
  'post_type'      => $postTypeSlug,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'has_password'   => false,
  'posts_per_page' => $postsPerPage,
];

$terms = get_used_terms($taxonomySlug, $post_query_args);
?>
<?php if (!empty($terms)) : ?>
  <div class="filter-wrap mb-xl-3">
    <div class="block--buttons">

      <button class="button primary--light filter-button clear-filters p fma-control-active" data-slug="">Alle</button>
      <?php
      // Output the buttons
      foreach ($terms as $term) {
        echo ' <button class="button primary--light filter-button cat-filter p" data-slug="' . $term->slug . '">' . $term->name . '</button>';
      }
      ?>
    </div>
  </div>
<?php endif; ?>

<div class="grid-wrap mixitup-grid mixitup--ajax gap-xl-2" data-posttype="<?= $postTypeSlug; ?>">
  <?php
  $initialData = [];

  $the_query = new WP_Query($post_query_args);
  while ($the_query->have_posts()) {
    $the_query->the_post();

    // get html snippet
    $postData = include(get_template_directory() . '/template-parts/snippets/' . $postTypeSlug . '/snippet__grid-item--data.php');
    get_template_part('template-parts/snippets/' . $postTypeSlug . '/snippet__grid-item--html', null, ['data' => $postData]);

    // add data to initial data array
    $initialData[] = $postData;
  }
  wp_reset_postdata();
  ?>
  <script id="initial-data-wrapper" type="application/json">
    <?= json_encode($initialData); ?>
  </script>
</div>

<div class="mt-xl-5"></div>
<?php if ($the_query->found_posts > $postsPerPage) : ?>

  <div class="flex-wrap justify-center-xl">
    <div class="box">
      <div class="load-more button p bg--dark fcolor--strawberry">mehr Beiträge laden</div>
    </div>
  </div>

<?php endif; ?>

<div class="grid-wrap">
  <div class="box box-xl-8 box-md-12">
    <div id="empty-notice" class="empty-notice" style="visibility: hidden;">
      <p>Leider ist unter dieser Kategorie noch kein Beitrag vorhanden.</p>
    </div>
  </div>
</div>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $this->escape($pageTitle ?? $this->site_name) ?></title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/main.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header-footer.css">
  <?php if (!empty($page_css)): ?>
    <?php foreach ((array)$page_css as $css): ?>
      <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/<?= $css ?>?v=<?= time() ?>">

    <?php endforeach; ?>
  <?php endif; ?>
  <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/assets/images/app/favicon.svg">
</head>

<body>
  <?= $this->insert('partials/header') ?>

  <main class="container">
    <?= $this->section('main_content') ?>
  </main>

  <?= $this->insert('partials/footer') ?>

  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/js/main.js">

  <?php if (!empty($page_js)): ?>
    <?php foreach ((array)$page_js as $js): ?>
      <script src="<?= BASE_URL ?>/assets/js/<?= $js ?>?v=<?= time() ?>"></script>
    <?php endforeach; ?>
  <?php endif; ?>


</body>

</html>
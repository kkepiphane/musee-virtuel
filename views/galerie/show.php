<?php $this->layout('layouts/default', ['pageTitle' => $oeuvre->titre]) ?>

<?php $this->start('content') ?>
    <article class="oeuvre-detail">
        <h1><?= $this->escape($oeuvre->titre) ?></h1>
        
        <div class="oeuvre-meta">
            <span class="artist"><?= $this->escape($oeuvre->artiste) ?></span>
            <span class="year"><?= $this->escape($oeuvre->annee) ?></span>
        </div>
        
        <img src="<?= $this->asset("images/artworks/medium/{$oeuvre->image}") ?>" 
             alt="<?= $this->escape($oeuvre->titre) ?>">
             
        <div class="oeuvre-description">
            <?= nl2br($this->escape($oeuvre->description)) ?>
        </div>
    </article>
<?php $this->stop() ?>


<footer class="topFooter container-fluid">
    <div class="row">
            <div class="col-md-4">
                Made with love by the Phalcon Team
            </div>
            <div class="col-md-4">
                <?= $this->tag->linkTo(['privacy', 'Privacy Policy']) ?>
                <?= $this->tag->linkTo(['terms', 'Terms']) ?>
            </div>
            <div class="col-md-4">
                 &copy; <?= date('Y') ?> Phalcon Team.
            </div>
    </div>
</footer>
            
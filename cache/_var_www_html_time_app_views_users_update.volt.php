<div class=container>
    <ul class="pager">
        <li class="previous pull-left">
            <?= $this->tag->linkTo(['time/index/' . $userId, 'Go back', 'class' => 'btn btn-outline-info']) ?>
        </li>
    </ul>
<?= $this->tag->form(['users/save', 'role' => 'form']) ?>
    <h2>Edit user time</h2>

    <fieldset>
        <?php foreach ($form as $element) { ?>

                <div class="form-group">
                    <?= $element->label() ?>
                    <?= $element->render(['class' => 'form-control']) ?>
                </div>

        <?php } ?>
        <div class="form-group">
                    <?= $this->tag->submitButton(['Save', 'class' => 'btn btn-info btn']) ?>
                </div>
    </fieldset>
    <?= $this->getContent() ?>
    </div>
<?= $this->tag->endform() ?>
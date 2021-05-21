<?= $this->getContent() ?>

<div class="row mb-4">
    <div class="col-6">
       <?= $this->tag->linkTo(['profiles/index', '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', 'class' => 'btn btn-outline-primary']) ?>
    </div>
    <div class="col-6 text-right">
        <?= $this->tag->linkTo(['profiles/create', '<span class="oi oi-plus" title="plus" aria-hidden="true"></span> Create Profile', 'class' => 'btn btn-primary']) ?>
    </div>
</div>


<div class="table-responsive">        
<?php $v152631443213852118511iterated = false; ?><?php $v152631443213852118511iterator = $page->items; $v152631443213852118511incr = 0; $v152631443213852118511loop = new stdClass(); $v152631443213852118511loop->self = &$v152631443213852118511loop; $v152631443213852118511loop->length = count($v152631443213852118511iterator); $v152631443213852118511loop->index = 1; $v152631443213852118511loop->index0 = 1; $v152631443213852118511loop->revindex = $v152631443213852118511loop->length; $v152631443213852118511loop->revindex0 = $v152631443213852118511loop->length - 1; ?><?php foreach ($v152631443213852118511iterator as $profile) { ?><?php $v152631443213852118511loop->first = ($v152631443213852118511incr == 0); $v152631443213852118511loop->index = $v152631443213852118511incr + 1; $v152631443213852118511loop->index0 = $v152631443213852118511incr; $v152631443213852118511loop->revindex = $v152631443213852118511loop->length - $v152631443213852118511incr; $v152631443213852118511loop->revindex0 = $v152631443213852118511loop->length - ($v152631443213852118511incr + 1); $v152631443213852118511loop->last = ($v152631443213852118511incr == ($v152631443213852118511loop->length - 1)); ?><?php $v152631443213852118511iterated = true; ?>

<?php if ($v152631443213852118511loop->first) { ?>
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Active?</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
<?php } ?>
        <tr>
            <td><?= $profile->id ?></td>
            <td><?= $profile->name ?></td>
            <td><?= ($profile->active == 'Y' ? 'Yes' : 'No') ?></td>
            <td width="12%"><?= $this->tag->linkTo(['profiles/edit/' . $profile->id, '<span class="oi oi-pencil" title="pencil" aria-hidden="true"></span> Edit', 'class' => 'btn btn-light btn-sm']) ?></td>
            <td width="12%"><?= $this->tag->linkTo(['profiles/delete/' . $profile->id, '<span class="oi oi-x" title="X" aria-hidden="true"></span> Delete', 'class' => 'btn btn-light btn-sm']) ?></td>
        </tr>
<?php if ($v152631443213852118511loop->last) { ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="10" class="text-right"">
                   <ul class="pagination mb-0">
                    <li class="page-item">
                        <?= $this->tag->linkTo(['profiles/search', '<span class="oi oi-media-skip-backward" title="skip backward" aria-hidden="true"></span> First', 'class' => 'page-link']) ?>
                    </li>
                    <li class="page-item">
                        <?= $this->tag->linkTo(['profiles/search?page=' . $page->before, '<span class="oi oi-media-step-backward" title="step backward" aria-hidden="true"></span> Previous', 'class' => 'page-link']) ?>
                    </li>
                    <li class="page-item disabled">
                        <?= $this->tag->linkTo(['#', $page->current . '/' . $page->total_pages, 'class' => 'page-link']) ?>
                    </li>
                    <li class="page-item">
                        <?= $this->tag->linkTo(['profiles/search?page=' . $page->next, '<span class="oi oi-media-step-forward" title="step forward" aria-hidden="true"></span> Next', 'class' => 'page-link']) ?>
                    </li>
                    <li class="page-item">
                        <?= $this->tag->linkTo(['profiles/search?page=' . $page->last, '<span class="oi oi-media-skip-forward" title="skip forward" aria-hidden="true"></span> Last', 'class' => 'page-link']) ?>
                    </li>
                </ul>
            </td>
        </tr>
    </tfoot>
</table>
<?php } ?>
<?php $v152631443213852118511incr++; } if (!$v152631443213852118511iterated) { ?>
    No profiles are recorded
<?php } ?>
</div>

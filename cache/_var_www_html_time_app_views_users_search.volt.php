<?= $this->getContent() ?>

<div class="row mb-4">
    <div class="col-6">
        <?= $this->tag->linkTo(['users/index', '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', 'class' => 'btn btn-outline-primary']) ?>
    </div>
    <div class="col-6 text-right">
        <?= $this->tag->linkTo(['users/create', '<span class="oi oi-plus" title="plus" aria-hidden="true"></span> Create User', 'class' => 'btn btn-primary']) ?>
    </div>
</div>

<div class="table-responsive">
    <?php $v108798762584193100731iterated = false; ?><?php $v108798762584193100731iterator = $page->items; $v108798762584193100731incr = 0; $v108798762584193100731loop = new stdClass(); $v108798762584193100731loop->self = &$v108798762584193100731loop; $v108798762584193100731loop->length = count($v108798762584193100731iterator); $v108798762584193100731loop->index = 1; $v108798762584193100731loop->index0 = 1; $v108798762584193100731loop->revindex = $v108798762584193100731loop->length; $v108798762584193100731loop->revindex0 = $v108798762584193100731loop->length - 1; ?><?php foreach ($v108798762584193100731iterator as $user) { ?><?php $v108798762584193100731loop->first = ($v108798762584193100731incr == 0); $v108798762584193100731loop->index = $v108798762584193100731incr + 1; $v108798762584193100731loop->index0 = $v108798762584193100731incr; $v108798762584193100731loop->revindex = $v108798762584193100731loop->length - $v108798762584193100731incr; $v108798762584193100731loop->revindex0 = $v108798762584193100731loop->length - ($v108798762584193100731incr + 1); $v108798762584193100731loop->last = ($v108798762584193100731incr == ($v108798762584193100731loop->length - 1)); ?><?php $v108798762584193100731iterated = true; ?>
        <?php if ($v108798762584193100731loop->first) { ?>
            <table class="table table-bordered table-striped" align="center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile</th>
                        <th>Banned?</th>
                        <th>Suspended?</th>
                        <th>Confirmed?</th>
                        <th colspan="2">Action</th>
                        <th colspan="2">Work</th>
                    </tr>
                </thead>
                <tbody>
                <?php } ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->profile->name ?></td>
                    <td><?= ($user->banned == 'Y' ? 'Yes' : 'No') ?></td>
                    <td><?= ($user->suspended == 'Y' ? 'Yes' : 'No') ?></td>
                    <td><?= ($user->active == 'Y' ? 'Yes' : 'No') ?></td>
                    <td width="12%"><?= $this->tag->linkTo(['users/edit/' . $user->id, '<span class="oi oi-pencil" title="pencil" aria-hidden="true"></span> Edit', 'class' => 'btn btn-light btn-sm']) ?></td>
                    <td width="12%"><?= $this->tag->linkTo(['users/delete/' . $user->id, '<span class="oi oi-x" title="X" aria-hidden="true"></span> Delete', 'class' => 'btn btn-light btn-sm']) ?></td>
                     <td width="12%"><?= $this->tag->linkTo(['time/' . $user->id, '<span class="oi oi-clock" title="clock" aria-hidden="true"></span> Work hours', 'class' => 'btn btn-light btn-sm']) ?> </td>

                </tr>
                <?php if ($v108798762584193100731loop->last) { ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10" class="text-right">
                            <ul class="pagination mb-0">
                                <li class="page-item">
                                    <?= $this->tag->linkTo(['users/search', '<span class="oi oi-media-skip-backward" title="skip backward" aria-hidden="true"></span> First', 'class' => 'page-link']) ?>
                                </li>
                                <li class="page-item">
                                    <?= $this->tag->linkTo(['users/search?page=' . $page->before, '<span class="oi oi-media-step-backward" title="step backward" aria-hidden="true"></span> Previous', 'class' => 'page-link']) ?>
                                </li>
                                <li class="page-item disabled">
                                    <?= $this->tag->linkTo(['#', $page->current . '/' . $page->total_pages, 'class' => 'page-link']) ?>
                                </li>
                                <li class="page-item">
                                    <?= $this->tag->linkTo(['users/search?page=' . $page->next, '<span class="oi oi-media-step-forward" title="step forward" aria-hidden="true"></span> Next', 'class' => 'page-link']) ?>
                                </li>
                                <li class="page-item">
                                    <?= $this->tag->linkTo(['users/search?page=' . $page->last, '<span class="oi oi-media-skip-forward" title="skip forward" aria-hidden="true"></span> Last', 'class' => 'page-link']) ?>
                                </li>

                            </ul>
                        </td>
                    </tr>
                </tfoot>
            </table>
        <?php } ?>
    <?php $v108798762584193100731incr++; } if (!$v108798762584193100731iterated) { ?>
        No users are recorded
    <?php } ?>
</div>

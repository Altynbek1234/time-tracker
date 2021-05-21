<?php
/**
 * @var \Phalcon\Mvc\View\Engine\Php $this
 */
?>

<?php use Phalcon\Tag; ?>

<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(["latecomers", "Go Back"]); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

<?php echo $this->getContent(); ?>

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Start Time</th>
            <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($page->items as $users): ?>
            <tr>
                <td><?php echo $users->id ?></td>
                <td><?php echo $users->name ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            <?php echo $page->current, "/", $page->total_pages ?>
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li><?php echo $this->tag->linkTo(["latecomers/search", "First", 'class' => 'page-link']) ?></li>
                <li><?php echo $this->tag->linkTo(["latecomers/search?page=" . $page->before, "Previous", 'class' => 'page-link']) ?></li>
                <li><?php echo $this->tag->linkTo(["latecomers/search?page=" . $page->next, "Next", 'class' => 'page-link']) ?></li>
                <li><?php echo $this->tag->linkTo(["latecomers/search?page=" . $page->last, "Last", 'class' => 'page-link']) ?></li>
            </ul>
        </nav>
    </div>
</div>
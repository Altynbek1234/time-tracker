
<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(["holidays", "Go Back"]) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create holiday
    </h1>
</div>

<?php echo $this->getContent(); ?>

<?php
    echo $this->tag->form(
        [
            "holidays/create",
            "autocomplete" => "off",
            "class" => "form-horizontal"
        ]
    );
?>

<div class="form-group">
    <label for="fieldName" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["name", "class" => "form-control", "id" => "fieldName"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldDateHoliday" class="col-sm-2 control-label">DAY Of Holiday</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["day", "type" => "date", "class" => "form-control", "id" => "fieldDateHoliday"]) ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldDateHoliday" class="col-sm-2 control-label">MONTH Of Holiday</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["month", "type" => "date", "class" => "form-control", "id" => "fieldDateHoliday"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldActive" class="col-sm-2 control-label">Active</label>
    <div class="col-sm-10">
        <?php echo $this->tag->selectStatic(["active", ['Y','N'], "class" => "form-control", "id" => "fieldActive"]) ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(["Save", "class" => "btn btn-default"]) ?>
    </div>
</div>

<?php echo $this->tag->endForm(); ?>
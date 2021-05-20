<div class="page-header">
    <h1>
        Search holiday
    </h1>
    <p>
        <?php echo $this->tag->linkTo(["holidays/new", "Create holiday"]) ?>
    </p>
</div>

<?php echo $this->getContent() ?>


<div class="form-group">
   <ul>
       <?php foreach ($holidays as $holiday) { ?>
           <li><?php echo $holiday->name ?></li>
           <button> <?php echo $this->tag->linkTo(["holidays/edit/".$holiday->id , "Edit holiday",'class'=>'btn btn-success']) ?></button>
       <?php } ?>
   </ul>
</div>

<div class="page-header">
    <h1>

    </h1>

</div>

<?php echo $this->getContent() ?>


<div class="form-group">
   <ul>
       <?php foreach ($late as $late_item) { ?>
           <li><?php echo $late_item->late_time ?></li>
           <button> <?php echo $this->tag->linkTo(["late/edit/".$late_item->id , "Edit holiday",'class'=>'btn btn-success']) ?></button>
       <?php } ?>
   </ul>
</div>

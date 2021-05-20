<?= $this->getContent() ?>


<div class="row justify-content-end mb-4">
    <div class="col-6 text-right">
    <?= $this->tag->linkTo(['profiles/create', '<span class="oi oi-plus" title="plus" aria-hidden="true"></span> Create Profile', 'class' => 'btn btn-primary']) ?>
    </div>
</div>

    <div class="row d-flex justify-content-center">
        <div class="col-xl-6  mb-4 mt-4">
            <h2 class="mb-sm-6 pb-sm-2">Search profiles</h2>        
            <?= $this->tag->form(['profiles/search', 'role' => 'form', 'autocomplete' => 'off']) ?>
            
            <div class="form-group row">
                <?= $form->label('id', ['class' => 'col-md-3 col-form-label']) ?>    
                <div class="col-md-9">
                    <?= $form->render('id', ['class' => 'form-control ']) ?>
                </div>
            </div>

            <div class="form-group row">
                <?= $form->label('name', ['class' => 'col-md-3 col-form-label']) ?>    
                <div class="col-md-9">
                    <?= $form->render('name', ['class' => 'form-control ']) ?>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-md-9" >
                    <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-success btn-block']) ?>
                </div>
            </div>
            </form>
        </div>
    </div>
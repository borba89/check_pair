<table class="table table-bordered table-striped">
    <?php foreach ($address as $key => $addArr) { ?>
        <tr>
            <?php foreach ($addArr as $model) { ?>
                <th><?php echo $form->textFieldGroup($model, "address_street", array('class' => 'form-control', 'maxlength' => 255)); ?></th>
                <td>Horizontal at all times</td>
                <td colspan="3">Collapsed to start, horizontal above breakpoints</td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>
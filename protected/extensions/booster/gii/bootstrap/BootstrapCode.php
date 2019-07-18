<?php
/**
 * BootstrapCode class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('gii.generators.crud.CrudCode');

class BootstrapCode extendS CrudCode
{
    public function generateActiveGroup($modelClass, $column)
    {
        if ($column->type === 'boolean')
            return "\$form->checkBoxGroup(\$model,'{$column->name}')";
        else if (stripos($column->dbType,'text') !== false)
            return "\$form->textAreaGroup(\$model,'{$column->name}',array('rows'=>6, 'cols'=>50, 'class'=>'form-control'))";
        else
        {
            if (preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
                $inputField='passwordFieldGroup';
            else
                $inputField='textFieldGroup';

            if ($column->type!=='string' || $column->size===null)
                return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'form-control'))";
            else
                return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'form-control','maxlength'=>$column->size))";
        }
    }
}
<script type="text/javascript">
    $(document).ready(function () {
        function changeChildNodes(elem) {
            $(elem).closest('li').find('input').attr('checked', elem.checked);
        }

        $('input.auth-item').change(function () {
            // смысл этой ужасной конструкции в том, чтобы ветки с одинаковыми именами отключались и включались согласованно
            // нужно сделать, чтобы и при выборе родительского узла для всех дочерних происходило тоже самое и выключались
            // узлы в других ролях
            $('input[value="' + this.value + '"]:not(#' + this.id + ')').attr('checked', this.checked).closest('li').find('input').attr('checked', this.checked);
            changeChildNodes(this);
        });

        // для того, чтобы дерево было развернуто только до второго уровня, как сделать это нормально не ясно
        setTimeout(function () {$('ul.treeview > li > div.hitarea').click();}, 200);
    });
</script>

<?php
$this->breadcrumbs = array(
    'Действия' => array('index'),
    'Назначение прав',
);
?>

<h3>Назначение прав пользователю "<?php echo $model->getFullName(); ?>"</h3>

<?php
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'auth-item-assign-form',
        'enableAjaxValidation' => false,
    )
);

?>

<?php $this->widget('CTreeView', array('data' => $tree, 'collapsed' => true)); ?>

<div class="form-actions">
    <?php
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => 'Сохранить',
        )
    );
    ?>
</div>

<?php $this->endWidget(); ?>
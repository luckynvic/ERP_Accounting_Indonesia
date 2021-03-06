<?php
$this->breadcrumbs=array(
		'Cash and Bank'=>array('index'),
		$model->system_ref,
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m2/mCashbank')),

		array('label'=>'Update', 'icon'=>'edit', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete', 'icon'=>'remove', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'visible'=>$model->state_id == 1),
		array('label'=>'Print', 'icon'=>'print', 'url'=>array('print', 'id'=>$model->id)),
);

$this->menu1=uJournal::getTopUpdated(2);
$this->menu2=uJournal::getTopCreated(2);
//$this->menu3=uJournal::getTopRelated($model->user_ref);
$this->menu5=array('Journal');

?>

<div class="page-header">
	<h1>
		Cash and Bank:
		<?php echo $model->system_reff(); ?>
	</h1>
</div>

<?php 

//$this->widget('bootstrap.widgets.TbDetailView', array(
$this->widget('ext.XDetailView', array(
		'ItemColumns' => 2,
		'data'=>$model,
		'attributes'=>array(
				'input_date',
				'yearmonth_periode',
				'user_ref',
				'system_ref',
				'remark',
				//'journal_type_id',
		),
)); ?>

<?php echo $this->renderPartial('/uJournal/_viewDetail', array('data'=>$model)); ?>


<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
<ul class="nav nav-list">
	<li class="nav-header"><i class="icon-fa-reorder"></i>Related Journal</li>
</ul>
</div>

<?php 
if (empty($_GET['asDialog'])) {
	//$this->widget('bootstrap.widgets.TbGridView', array(
	$this->widget('ext.groupgridview.GroupGridView', array(
			'id'=>'related-grid',
			'dataProvider'=>$dataProvider,
			'template'=>'{items}',
			'itemsCssClass'=>'table table-striped table-bordered',
			'mergeColumns' => array('input_date'),
			'enableSorting'=>false,
			'columns'=>array(
					'input_date',
					//'yearmonth_periode',
					//'user_ref',
					array(
							'header'=>'No Ref',
							'type'=>'raw',
							'value'=>'CHtml::link($data->system_ref,Yii::app()->createUrl("/m2/mCashbank/view",array("id"=>$data->id)))',
					),
					'remark',
					array(
							'header'=>'Total',
							'value'=>'Yii::app()->indoFormat->number($data->journalSum)',
							'htmlOptions'=>array(
									'style'=>'text-align: right; padding-right: 5px;'
							),
					),
			),
	));
}
?>

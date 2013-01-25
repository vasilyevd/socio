<?php
//$this->h1='Инфраструктура';
$this->breadcrumbs=array('Инфраструктура',);
$this->pageTitle='Доступность - SocInfo';
?>


<?php $this->beginClip('sidebar'); ?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'filter_form',
		'enableAjaxValidation'=>false,
		'enableClientValidation'=>false,
	)); ?>

<ul class="nav nav-list">
	<li class="nav-header">Категория</li>
	<li class="active">
		<?php echo $form->dropDownListRow(Category::model(), 'root',	CHtml::listData(Category::model()->roots()->findAll(), 'id', 'name')); ?>
	</li>
	<li class="">lvl2</li>
	<li class="">category</li>
	<li class="nav-header">Доступность</li>
	<li class="">buttons dostup</li>
</ul>

<?php $this->endWidget(); ?>
<?php $this->endClip(); ?>

<div class="row">
	<div class="span12" id="header_wrap1">
		header
	</div>

	<div class="span2">
		<?php echo $this->clips['sidebar']; ?>
	</div>


	<!-- list -->
	<div id="objects" class="span10">
		<?php $this->widget('ext.widgets.SListView.SListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			'type'=>'POST',
			'datafromid'=>array('filter_form :input[value][value!=\'\']'),
			'template'=>'{summary}{pager}{items}{pager}',
			//'ajaxUpdate'=>true,
			'enableHistory'=>true,
			'id'=>'list_content',
			'htmlOptions'=>array('class'=>'list-view inline-info'),
		)); ?>
	</div>




</div>
<?php /*
Yii::app()->clientScript->registerScript('search',
"
var ajaxUpdateTimeout;
var ajaxRequest;

function updatelistview() {
ajaxRequest = $('#filter_form').serialize();
clearTimeout(ajaxUpdateTimeout);
ajaxUpdateTimeout = setTimeout(function () {
$.fn.yiiListView.update(
'list_content',
{
data: ajaxRequest,
type: 'POST',
'loadingClass':'loading'
}
);
$('#newfilter').val('0');
},
300);

}

jQuery('#list_content').yiiListView({
'type':'POST',
'ajaxUpdate':['global_stat_table','list_content'],
'pagerClass':'pager',
'loadingClass':'loading',
'datafromid':['global_search', 'filter_form  :input[value][value!=\'\']'],
'afterAjaxUpdate': function(id, data) {update_chart(id, $('#chart-data', '<div>'+data+'</div>').val());}
});

function updt_r(r, d) {
$('#c_region').val(r);
$('#newfilter').val('1');
updatelistview();

//$('#c_region').trigger('change');

$.ajax(
{
'type':'POST',
'url':'/Select_ajax/dynamicdistricts',
'data':'c[region]='+$('#c_region').val(),
'cache':false,
'success':function(html){
$('#c_district').html(html);
$('#c_district').val(d).trigger('liszt:updated');
}
});
}


$('#c_district').change(function () {
$('#newfilter').val('1');
$('#Address_city_id').val(0); $('#c_text').val('');
$('#c_district').trigger('liszt:updated');
updatelistview();
});

$('#cat_type').change(function () {
$(this).trigger('liszt:updated');
$('#newfilter').val('1');
updatelistview();
});

$('#answer').change(function () {
$(this).trigger('liszt:updated');
$('#newfilter').val('1');
updatelistview();
});


$('#Petition_status').checkbox1({
checked_class: 'checked',
onhide: function(){}
}).change(function () {
if ($(this).is(':checked'))
$('#Petition_status2').parent().show();
else
$('#Petition_status2').parent().hide();

$('#newfilter').val('1');
updatelistview();
});

$('#Petition_status2').checkbox1({
checked_class: 'checked',
}).change(function () {
// alert('2changedom');
if ($(this).is(':checked'))	$('#Petition_status').attr('checked', true).trigger('change');
$('#newfilter').val('1');
updatelistview();
});

$(':checkbox.side_filter').checkbox1({
checked_class: 'checked',
}).change(function () {
$('#newfilter').val('1');
updatelistview();
});

"
);
*/
?>



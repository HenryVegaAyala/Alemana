<?php
/* @var $this TEMPFACDETALORDENCOMPRController */
/* @var $data TEMPFACDETALORDENCOMPR */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_ORDE')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COD_ORDE), array('view', 'id'=>$data->COD_ORDE)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->COD_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NRO_UNID')); ?>:</b>
	<?php echo CHtml::encode($data->NRO_UNID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_PREC')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_PREC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_MONT_UNID')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_MONT_UNID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_MONT_IGV')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_MONT_IGV); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_TOTAL')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_TOTAL); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('DES_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->DES_PROD); ?>
	<br />

	*/ ?>

</div>
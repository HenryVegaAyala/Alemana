<?php

/**
 * This is the model class for table "TEMP_FAC_DETAL_ORDEN_COMPR".
 *
 * The followings are the available columns in table 'TEMP_FAC_DETAL_ORDEN_COMPR':
 * @property string $COD_ORDE
 * @property string $COD_PROD
 * @property integer $NRO_UNID
 * @property string $VAL_PREC
 * @property string $VAL_IGV
 * @property string $VAL_MONT_UNID
 * @property string $VAL_MONT_IGV
 * @property string $USU_DIGI
 * @property string $FEC_DIGI
 * @property string $USU_MODI
 * @property string $FEC_MODI
 * @property string $DES_LARG
 */
class TEMPFACDETALORDENCOMPR extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TEMP_FAC_DETAL_ORDEN_COMPR';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COD_PROD', 'required'),
			array('NRO_UNID', 'numerical', 'integerOnly'=>true),
			array('COD_PROD', 'length', 'max'=>12),
			array('VAL_PREC, VAL_MONT_UNID, VAL_MONT_IGV', 'length', 'max'=>10),
			array('VAL_IGV', 'length', 'max'=>5),
			array('USU_DIGI, USU_MODI', 'length', 'max'=>20),
			array('DES_LARG', 'length', 'max'=>60),
			array('FEC_DIGI, FEC_MODI', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('COD_ORDE, COD_PROD, NRO_UNID, VAL_PREC, VAL_IGV, VAL_MONT_UNID, VAL_MONT_IGV, USU_DIGI, FEC_DIGI, USU_MODI, FEC_MODI, DES_LARG', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COD_ORDE' => 'Cod Orde',
			'COD_PROD' => 'Codigo Producto',
			'NRO_UNID' => 'Cantidad',
			'VAL_PREC' => 'Precio',
			'VAL_IGV' => 'Val Igv',
			'VAL_MONT_UNID' => 'Total',
			'VAL_MONT_IGV' => 'Val Mont Igv',
			'USU_DIGI' => 'Usu Digi',
			'FEC_DIGI' => 'Fec Digi',
			'USU_MODI' => 'Usu Modi',
			'FEC_MODI' => 'Fec Modi',
			'DES_LARG' => 'Descripción',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('COD_ORDE',$this->COD_ORDE,true);
		$criteria->compare('COD_PROD',$this->COD_PROD,true);
		$criteria->compare('NRO_UNID',$this->NRO_UNID);
		$criteria->compare('VAL_PREC',$this->VAL_PREC,true);
		$criteria->compare('VAL_IGV',$this->VAL_IGV,true);
		$criteria->compare('VAL_MONT_UNID',$this->VAL_MONT_UNID,true);
		$criteria->compare('VAL_MONT_IGV',$this->VAL_MONT_IGV,true);
		$criteria->compare('USU_DIGI',$this->USU_DIGI,true);
		$criteria->compare('FEC_DIGI',$this->FEC_DIGI,true);
		$criteria->compare('USU_MODI',$this->USU_MODI,true);
		$criteria->compare('FEC_MODI',$this->FEC_MODI,true);
		$criteria->compare('DES_LARG',$this->DES_LARG,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TEMPFACDETALORDENCOMPR the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

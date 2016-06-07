<?php

/**
 * This is the model class for table "TEMP_FAC_DETAL_ORDEN_COMPR".
 *
 * The followings are the available columns in table 'TEMP_FAC_DETAL_ORDEN_COMPR':
 * @property string $COD_ORDE
 * @property string $COD_PROD
 * @property integer $NRO_UNID
 * @property string $VAL_PREC
 * @property string $VAL_MONT_UNID
 * @property string $DES_LARG
 * @property string $VAL_USU
 * @property string $VAL_PCIP
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
			array('COD_PROD, VAL_USU, VAL_PCIP', 'required'),
			array('NRO_UNID', 'numerical', 'integerOnly'=>true),
			array('COD_PROD', 'length', 'max'=>12),
			array('VAL_PREC, VAL_MONT_UNID', 'length', 'max'=>10),
			array('DES_LARG, VAL_PCIP', 'length', 'max'=>60),
			array('VAL_USU', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('COD_ORDE, COD_PROD, NRO_UNID, VAL_PREC, VAL_MONT_UNID, DES_LARG, VAL_USU, VAL_PCIP', 'safe', 'on'=>'search'),
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
			'COD_PROD' => 'Cod Prod',
			'NRO_UNID' => 'Nro Unid',
			'VAL_PREC' => 'Val Prec',
			'VAL_MONT_UNID' => 'Val Mont Unid',
			'DES_LARG' => 'Des Larg',
			'VAL_USU' => 'Val Usu',
			'VAL_PCIP' => 'Val Pcip',
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
		$criteria->compare('VAL_MONT_UNID',$this->VAL_MONT_UNID,true);
		$criteria->compare('DES_LARG',$this->DES_LARG,true);
		$criteria->compare('VAL_USU',$this->VAL_USU,true);
		$criteria->compare('VAL_PCIP',$this->VAL_PCIP,true);

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

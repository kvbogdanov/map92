<?php

/**
 * This is the model class for table "information".
 *
 * The followings are the available columns in table 'information':
 * @property integer $id
 * @property string $u_date
 * @property string $cost
 * @property integer $id_user
 * @property integer $id_point
 * @property string $status
 * @property integer $brand
 *
 * The followings are the available model relations:
 * @property ListBrands $brand0
 * @property Points $idPoint
 * @property Users $idUser
 */
class Information extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Information the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'information';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_point, brand', 'numerical', 'integerOnly'=>true),
			array('cost', 'length', 'max'=>7),
			array('status', 'length', 'max'=>100),
			array('u_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, u_date, cost, id_user, id_point, status, brand', 'safe', 'on'=>'search'),
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
			'brand0' => array(self::BELONGS_TO, 'ListBrands', 'brand'),
			'idPoint' => array(self::BELONGS_TO, 'Points', 'id_point'),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'u_date' => 'U Date',
			'cost' => 'Cost',
			'id_user' => 'Id User',
			'id_point' => 'Id Point',
			'status' => 'Status',
			'brand' => 'Brand',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('u_date',$this->u_date,true);
		$criteria->compare('cost',$this->cost,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_point',$this->id_point);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('brand',$this->brand);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
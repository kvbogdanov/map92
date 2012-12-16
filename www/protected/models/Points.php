<?php

/**
 * This is the model class for table "points".
 *
 * The followings are the available columns in table 'points':
 * @property integer $id
 * @property string $coordinate
 * @property string $city_type
 * @property string $city_name
 * @property integer $id_user
 *
 * The followings are the available model relations:
 * @property Information[] $informations
 */
class Points extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Points the static model class
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
		return 'points';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user', 'numerical', 'integerOnly'=>true),
			array('city_type', 'length', 'max'=>10),
			array('city_name', 'length', 'max'=>100),
			array('coordinate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, coordinate, city_type, city_name, id_user', 'safe', 'on'=>'search'),
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
			'informations' => array(self::HAS_MANY, 'Information', 'id_point'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'coordinate' => 'Coordinate',
			'city_type' => 'City Type',
			'city_name' => 'City Name',
			'id_user' => 'Id User',
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
		$criteria->compare('coordinate',$this->coordinate,true);
		$criteria->compare('city_type',$this->city_type,true);
		$criteria->compare('city_name',$this->city_name,true);
		$criteria->compare('id_user',$this->id_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
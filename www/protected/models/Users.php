<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id_u
 * @property string $name
 * @property string $last_name
 * @property string $nickname
 * @property string $email
 * @property string $id_sn
 * @property string $login
 * @property string $password
 * @property boolean $ban
 *
 * The followings are the available model relations:
 * @property Information[] $informations
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, login', 'length', 'max'=>20),
			array('last_name', 'length', 'max'=>30),
			array('nickname, email', 'length', 'max'=>100),
			array('id_sn', 'length', 'max'=>200),
			array('password', 'length', 'max'=>1024),
			array('ban', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_u, name, last_name, nickname, email, id_sn, login, password, ban', 'safe', 'on'=>'search'),
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
			'informations' => array(self::HAS_MANY, 'Information', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_u' => 'Id U',
			'name' => 'Name',
			'last_name' => 'Last Name',
			'nickname' => 'Nickname',
			'email' => 'Email',
			'id_sn' => 'Id Sn',
			'login' => 'Login',
			'password' => 'Password',
			'ban' => 'Ban',
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

		$criteria->compare('id_u',$this->id_u);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_sn',$this->id_sn,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('ban',$this->ban);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
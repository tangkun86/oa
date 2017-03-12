<?php

namespace app\modules\user\models;

use Yii;
use app\models\CActiveRecord;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $name
 * @property integer $company_id
 * @property integer $department_id
 * @property integer $status
 * @property integer $create_author_uid
 * @property integer $update_author_uid
 * @property string $create_time
 * @property string $update_time
 */
class Posts extends CActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'department_id', 'company_id'], 'required'],
            [['id', 'department_id', 'company_id', 'status', 'create_author_uid', 'update_author_uid'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['name'], 'string', 'max' => 20],
            //同一部门下不能有相同岗位
            [['name'], 'unique', 'targetAttribute'=>['name','department_id'],'message'=>'同一部门下不能有相同岗位。'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '岗位名称',
            'department_id' => '所属部门',
            'company_id' => '所属公司',
            'status' => '状态',
            'create_author_uid' => '创建人',
            'update_author_uid' => '最后修改人',
            'create_time' => '创建时间',
            'update_time' => '最后修改时间',
        ];
    }

    /**
     * @inheritdoc
     * @return PostsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostsQuery(get_called_class());
    }

    /**
     * 获取创建人
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'create_author_uid'])->alias('creator');
    }

    /**
     * 获取最后修改人
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'update_author_uid'])->alias('updater');
    }

    /**
     * 获取公司
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id'])->alias('company');
    }

    /**
     * 获取部门
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id'])->alias('department');
    }

    public function getCompanyList()
    {
        return Company::find()->select(['name','id'])->where(['status'=>0])->indexBy('id')->column();
    }

    public function getDepartmentList()
    {
        $model = Department::find()->select(['name','id'])->where(['status'=>0]);
        if(Yii::$app->request->get('PostsSearch')){
            $search = Yii::$app->request->get('PostsSearch');
            $model->andWhere(['company_id'=>$search['company_id']]);
        }
        return $model->indexBy('id')->column();
    }
}

<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "Post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $author
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'author'], 'required'],
            [['content'], 'string'],
            [['title', 'author'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'author' => 'Author',
        ];
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    /**
   * is used for searching on health benefi list
   * @param array $params
   * @return ActiveDataProvider
   */
  public function search($params,$rows) {
    $query = static::find();
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => array('pageSize' => $rows)
    ]);
    if(!empty($this->userId)){
      //$user = User::find()->where()->
    }
    if (!($this->load($params))) {
      return $dataProvider;
    }    

    // $query->andFilterWhere(['like', 'title', $this->title])
    //     ->andFilterWhere(['level' => $this->level])
    //     ->andFilterWhere(['like', 'author', $this->author])
    //     ->andFilterWhere(['like', 'createdAt', $this->createdAt])    
    //     ->andFilterWhere(['like', 'healthKeywords', $this->healthKeywords]);
    
    return $dataProvider;
  } 
}

<?php

namespace matacms\settings\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use matacms\settings\models\Setting;
use mata\keyvalue\models\KeyValue;

/**
 * SettingSearch represents the model behind the search form about `matacms\settings\models\Setting`.
 */
class SettingSearch extends Setting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Key', 'FormInputField'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Setting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['value']); 

        $dataProvider->sort->attributes['value.Value'] = [
              'asc' => ['Value' => SORT_ASC],
              'desc' => ['Value' => SORT_DESC],
         ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'Key', $this->Key])
            ->andFilterWhere(['like', 'FormInputField', $this->FormInputField]);

        return $dataProvider;
    }
}
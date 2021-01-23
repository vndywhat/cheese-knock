<?php

namespace frontend\models;

use yii\base\Model;

/**
 * CallForm is the model behind the contact form.
 */
class CallForm extends Model
{
    public $name;
    public $phone;
    public $messageVariates = [
        'Что-то не так',
        'Ещё чуть-чуть',
        'Почти правильно',
        'Поднажми и всё получится'
    ];


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, phone are required
            [['name', 'phone'], 'required'],
            // phone has to be a valid phone format
            ['phone', 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{4}$/', 'message' => $this->messageVariates[rand(0,count($this->messageVariates)-1)] ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Номер телефона',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    /*public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject('Поступил новый отзыв!')
            ->setTextBody($this->body)
            ->send();
    }*/
}

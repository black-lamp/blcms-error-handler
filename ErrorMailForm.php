<?php
namespace bl\cms\error;

use yii\base\Model;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */

class ErrorMailForm extends Model
{
    /**
     * @var string
     * Error message
     */
    public $message;

    /**
     * @var string
     * Error page url
     */
    public $url;

    /**
     * @var string
     * Website visitor email
     */
    public $email;

    public function rules()
    {
        return [
            [['message', 'url'], 'string'],
            ['email', 'email']
        ];
    }
}
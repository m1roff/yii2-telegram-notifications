<?php

namespace mirkhamidov;


use Yii;
use yii\base\Component;
use yii\base\InvalidValueException;

/**
 * Class TelegramNotifications
 * @package mirkhamidov
 * @author Jasur Mirkhamidov <mirkhamidov.jasur@gmail.com>
 *
 * Для быстрых и простых нотификаций
 */
class TelegramNotifications extends Component
{
    /** @var string Токен бота */
    public $token;

    /** @var int Id чата для получения сообщения */
    public $chat;

    private $url = 'https://api.telegram.org/bot';
    private $_message;

    /** @inheritdoc */
    public function init()
    {
        parent::init();
        if (empty($this->token)) {
            throw new InvalidValueException(Yii::t('app', 'Set "token" value for TelegramBot'));
        }
    }

    /**
     * Послать просто сообщение
     * @param string $message
     * @return bool
     */
    public function sendMessage($message):bool
    {
        $this->_message = $message;
        return $this->query('sendMessage');
    }

    /**
     * Выполнить запрос
     * @param string $route
     * @return bool
     */
    private function query($route)
    {
        $cmd = ['curl -X POST'];
        $cmd[] = '--data';
        $cmd[] = '"' . $this->genQuery() . '"';
        $cmd[] = $this->genUrl($route);

        $_cmd = implode(' ', $cmd) . ' > /dev/null 2>&1 &';
        $o = '';
        exec($_cmd, $o);
        return true;
    }

    /**
     * Генерация данных для POST
     * @return string
     */
    private function genQuery()
    {
        return http_build_query([
            'chat_id' => $this->chat,
            'disable_notification' => true,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
            'text' => $this->_message,
        ], '', '&');
    }

    /**
     * Получить полный URL
     * @param string $route
     * @return string
     */
    private function genUrl($route)
    {
        return $this->url . $this->token . '/' . $route;
    }
}
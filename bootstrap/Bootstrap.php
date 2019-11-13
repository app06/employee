<?php

namespace app\bootstrap;

use app\dispatchers\LoggedEventDispatcher;
use app\dispatchers\SimpleEventDispatcher;
use app\services\Notifier;
use yii\base\BootstrapInterface;
use Yii;
use yii\di\Container;

class Bootstrap implements BootstrapInterface
{
    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $container = Yii::$container;

        $container->setSingleton('app\services\NotifierInterface', function () use ($app) {
            return new Notifier($app->params['adminEmail']);
        });

        $container->setSingleton('app\services\LoggerInterface', 'app\services\Logger');

        $container->setSingleton('app\dispatchers\EventDispatcherInterface', function (Container $container) {
            return new LoggedEventDispatcher(
                new SimpleEventDispatcher([
                    'app\events\interview\InterviewJoinEvent' => ['app\listeners\interview\InterviewJoinListener'],
                    'app\events\interview\InterviewMoveEvent' => ['app\listeners\interview\InterviewMoveListener'],
                    'app\events\interview\InterviewRejectEvent' => ['app\listeners\interview\InterviewRejectListener'],
                    'app\events\interview\InterviewDeleteEvent' => [],
                ]),
                $container->get('app\services\LoggerInterface')
            );
        });
    }
}
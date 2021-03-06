<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 * @property \App\Utils\SessionManagerUtil $sessionManager 
 * @property \App\Dto\SubscriberUserDto $postedSubscriberData
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    protected $postedJson;
    protected $postedRequest;
    protected $postedData;
    protected $postedUserInfo;
    protected $userAuthenticated;
    protected $postedSubscriberData;
    protected $sessionManager;
    //protected $empInfo;
    
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * 
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->sessionManager = new \App\Utils\SessionManagerUtil($this->request->session());
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
    protected function apiInitialize(){
        $this->autoRender = FALSE;
        $this->postedJson = $this->request->input();
        //Log::debug("posted json " . $this->postedJson);
        $this->postedRequest = \App\Dto\BaseRequestDto::Deserialize($this->postedJson);
        $this->postedData = $this->postedRequest->data;
        $this->postedUserInfo = $this->postedRequest->user;
        $this->response->type('json');
    }
    
    protected function isSubscriberAuthorised(){
        $this->postedSubscriberData = \App\Dto\SubscriberUserDto::Deserialize($this->postedUserInfo);
        $isAuthorized = $this->validateSubscriber($this->postedSubscriberData);
        return $isAuthorized;
    }
    
    /**
     * Validates subscriber
     * @param \App\Dto\SubscriberUserDto $subscriberUserData
     * @return bool
     */
    protected function validateSubscriber($subscriberUserData){
        $subscriberTable = new \App\Model\Table\SubscribersTable();
        return $subscriberTable->validateSubscriber($subscriberUserData);
    }
    
    protected function _getWebrootDir() {
        return "http://" . $this->request->host() . $this->request->webroot;
    }
}

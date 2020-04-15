<?php

namespace Profspo\Sdk\Managers;

use Exception;
use Profspo\Sdk\Client;
use Profspo\Sdk\Core\Response;

class IntegrationManager extends Response
{

    /**
     * Конструктор IntegrationManager
     * @param $client
     * @return IntegrationManager
     * @throws Exception
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        if (!$client) {
            throw new Exception('client is not init');
        }
        return $this;
    }

    /**
     * Возвращает ссылку бесшовного перехода
     * @param int $userId
     * @param null $publicationId
     * @return mixed
     */
    public function generateLoginOnceUrl($userId, $publicationId = null)
    {
        $apiMethod = '/login-once-token/{id}';
        $apiMethod = str_replace('{id}', $userId, $apiMethod);
        $params = array('publication_id' => $publicationId);

        $this->setResponse($this->getClient()->makeRequest($apiMethod, $params));
        return $this->data['link'];
    }

    /**
     * Возвращает ссылку бесшовного перехода и регистрации нового пользователя
     * @param $email
     * @param $name
     * @param $role
     * @return mixed
     */
    public function generateLoginOrRegisterUrl($email, $name, $role)
    {
        $apiMethod = '/login-or-register-token';
        $params = array(
            'email' => $email,
            'name' => $name,
            'role' => $role
        );

        $this->setResponse($this->getClient()->makeRequest($apiMethod, $params));
        return $this->data['link'];
    }

}
<?php

/**
 * Serverless GCP
 *
 * Add GCP as one of the supported hosting providers on the serverless framework module for Magento.
 *
 * @package ImDigital\ServerlessGcp
 * @author Igor Ludgero Miura <igor@imdigital.com>
 * @copyright Copyright (c) 2023 Imagination Media (https://www.imdigital.com/)
 * @license Private
 */

declare(strict_types=1);

namespace ImDigital\ServerlessGcp\Model\Cloud\Config;

class ServiceAccount
{
    // Create public const fields that represent the keys of the Google Cloud Service Account JSON file
    public const FIELD_TYPE                        = 'type';
    public const FIELD_PROJECT_ID                  = 'project_id';
    public const FIELD_PRIVATE_KEY_ID              = 'private_key_id';
    public const FIELD_PRIVATE_KEY                 = 'private_key';
    public const FIELD_CLIENT_EMAIL                = 'client_email';
    public const FIELD_CLIENT_ID                   = 'client_id';
    public const FIELD_AUTH_URI                    = 'auth_uri';
    public const FIELD_TOKEN_URI                   = 'token_uri';
    public const FIELD_AUTH_PROVIDER_X509_CERT_URL = 'auth_provider_x509_cert_url';
    public const FIELD_CLIENT_X509_CERT_URL        = 'client_x509_cert_url';

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * ServiceAccount constructor.
     * @param array $data
     * @throws \InvalidArgumentException
     */
    public function __construct(array $data)
    {
        if (!isset($data[self::FIELD_TYPE])) {
            throw new \InvalidArgumentException('Type is required');
        }

        if (!isset($data[self::FIELD_PROJECT_ID])) {
            throw new \InvalidArgumentException('Project ID is required');
        }

        if (!isset($data[self::FIELD_PRIVATE_KEY_ID])) {
            throw new \InvalidArgumentException('Private Key ID is required');
        }

        if (!isset($data[self::FIELD_PRIVATE_KEY])) {
            throw new \InvalidArgumentException('Private Key is required');
        }

        if (!isset($data[self::FIELD_CLIENT_EMAIL])) {
            throw new \InvalidArgumentException('Client Email is required');
        }

        if (!isset($data[self::FIELD_CLIENT_ID])) {
            throw new \InvalidArgumentException('Client ID is required');
        }

        if (!isset($data[self::FIELD_AUTH_URI])) {
            throw new \InvalidArgumentException('Auth URI is required');
        }

        if (!isset($data[self::FIELD_TOKEN_URI])) {
            throw new \InvalidArgumentException('Token URI is required');
        }

        if (!isset($data[self::FIELD_AUTH_PROVIDER_X509_CERT_URL])) {
            throw new \InvalidArgumentException('Auth Provider X509 Cert URL is required');
        }

        if (!isset($data[self::FIELD_CLIENT_X509_CERT_URL])) {
            throw new \InvalidArgumentException('Client X509 Cert URL is required');
        }

        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->data[self::FIELD_TYPE];
    }

    /**
     * @return string
     */
    public function getProjectId() : string
    {
        return $this->data[self::FIELD_PROJECT_ID];
    }

    /**
     * @return string
     */
    public function getPrivateKeyId() : string
    {
        return $this->data[self::FIELD_PRIVATE_KEY_ID];
    }

    /**
     * @return string
     */
    public function getPrivateKey() : string
    {
        return $this->data[self::FIELD_PRIVATE_KEY];
    }

    /**
     * @return string
     */
    public function getClientEmail() : string
    {
        return $this->data[self::FIELD_CLIENT_EMAIL];
    }

    /**
     * @return string
     */
    public function getClientId() : string
    {
        return $this->data[self::FIELD_CLIENT_ID];
    }

    /**
     * @return string
     */
    public function getAuthUri() : string
    {
        return $this->data[self::FIELD_AUTH_URI];
    }

    /**
     * @return string
     */
    public function getTokenUri() : string
    {
        return $this->data[self::FIELD_TOKEN_URI];
    }

    /**
     * @return string
     */
    public function getAuthProviderX509CertUrl() : string
    {
        return $this->data[self::FIELD_AUTH_PROVIDER_X509_CERT_URL];
    }

    /**
     * @return string
     */
    public function getClientX509CertUrl() : string
    {
        return $this->data[self::FIELD_CLIENT_X509_CERT_URL];
    }

    /**
     * @param string $type
     */
    public function setType(string $type) : void
    {
        $this->data[self::FIELD_TYPE] = $type;
    }

    /**
     * @param string $projectId
     */
    public function setProjectId(string $projectId) : void
    {
        $this->data[self::FIELD_PROJECT_ID] = $projectId;
    }

    /**
     * @param string $privateKey
     */
    public function setPrivateKey(string $privateKey) : void
    {
        $this->data[self::FIELD_PRIVATE_KEY] = $privateKey;
    }

    /**
     * @param string $privateKeyId
     */
    public function setPrivateKeyId(string $privateKeyId) : void
    {
        $this->data[self::FIELD_PRIVATE_KEY_ID] = $privateKeyId;
    }

    /**
     * @param string $clientEmail
     */
    public function setClientEmail(string $clientEmail) : void
    {
        $this->data[self::FIELD_CLIENT_EMAIL] = $clientEmail;
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId) : void
    {
        $this->data[self::FIELD_CLIENT_ID] = $clientId;
    }

    /**
     * @param string $authUri
     */
    public function setAuthUri(string $authUri) : void
    {
        $this->data[self::FIELD_AUTH_URI] = $authUri;
    }

    /**
     * @param string $tokenUri
     */
    public function setTokenUri(string $tokenUri) : void
    {
        $this->data[self::FIELD_TOKEN_URI] = $tokenUri;
    }

    /**
     * @param string $authProviderX509CertUrl
     */
    public function setAuthProviderX509CertUrl(string $authProviderX509CertUrl) : void
    {
        $this->data[self::FIELD_AUTH_PROVIDER_X509_CERT_URL] = $authProviderX509CertUrl;
    }

    /**
     * @param string $clientX509CertUrl
     */
    public function setClientX509CertUrl(string $clientX509CertUrl) : void
    {
        $this->data[self::FIELD_CLIENT_X509_CERT_URL] = $clientX509CertUrl;
    }

    /**
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }
}

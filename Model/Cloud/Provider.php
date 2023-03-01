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

namespace ImDigital\ServerlessGcp\Model\Cloud;

use Google\Cloud\Functions\V1\CloudFunctionsServiceClient;
use ImDigital\Serverless\Api\Data\CloudProviderInterface;
use ImDigital\Serverless\Api\Data\ServerlessFunctionInterface;
use ImDigital\Serverless\Model\Cloud\Provider as AbstractProvider;
use ImDigital\ServerlessGcp\Model\Cloud\Config;
use ImDigital\ServerlessGcp\Model\Cloud\Config\ServiceAccount;
use Psr\Log\LoggerInterface;

class Provider extends AbstractProvider implements CloudProviderInterface
{
    /**
     * @var CloudFunctionsServiceClient
     */
    protected CloudFunctionsServiceClient $client;

    /**
     * @var string
     */
    protected string $formattedName;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * Provider constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param ServerlessFunctionInterface $serverlessFunction
     * @throws \ValidationException
     * @return bool
     */
    public function authenticate(ServerlessFunctionInterface $serverlessFunction): bool
    {
        try {
            $cloudConfig = $this->getCloudConfig($serverlessFunction);

            $this->client = new CloudFunctionsServiceClient([
                'credentials' => $cloudConfig->getServiceAccountKey()->getData()
            ]);

            $this->formattedName = $this->client->cloudFunctionName(
                $cloudConfig->getServiceAccountKey()->getProjectId(),
                $cloudConfig->getRegionId(),
                $serverlessFunction->getName()
            );

            return true;
        } catch (\Exception $e) {
            $this->logger->error("Cannot authenticate to Google Cloud Platform: " .
                $e->getMessage() . ". Function name: " . $serverlessFunction->getName() . ".");
            return false;
        }
    }

    /**
     * @param ServerlessFunctionInterface $serverlessFunction
     * @param array $data
     * @throws \Exception
     * @return void
     */
    public function execute(ServerlessFunctionInterface $serverlessFunction, array &$data): void
    {
        if (!$this->authenticate($serverlessFunction)) {
            return;
        }

        // Transform data into array values (if they are objects)
        $requestData = $this->prepareRequestData($data);

        $response = $this->client->callFunction($this->formattedName, json_encode($requestData), [
            'timeoutMillis' => isset($_ENV['MAGENTO_SERVERLESS_TIMEOUT']) ? $_ENV['MAGENTO_SERVERLESS_TIMEOUT'] : 4000,
        ]);

        if ($response->getError()) {
            $this->logger->error("Function {$serverlessFunction->getName()} 
                returned an error: {$response->getError()}");
            throw new \Exception($response->getError());
        }

        try {
            $responseResult = json_decode($response->getResult(), true);
            $data = $this->prepareResponseData($data, $responseResult);
        } catch (\Exception $e) {
            $this->logger->error("Cannot decode response from Google Cloud Platform: " .
                $e->getMessage() . ". Function name: " . $serverlessFunction->getName() .
                ". A Json response was expected.");
            throw new \Exception($response->getError());
        }
    }

    /**
     * @param ServerlessFunctionInterface $serverlessFunction
     */
    public function getCloudConfig(ServerlessFunctionInterface $serverlessFunction): Config
    {
        $cloudConfiguration = json_decode($serverlessFunction->getCloudConfig(), true);

        if (!isset($cloudConfiguration[Config::FIELD_SERVICEACCOUNT_KEY])) {
            throw new \ValidationException(__("Service account key is missing."));
        }

        $serviceAccountKey = $cloudConfiguration[Config::FIELD_SERVICEACCOUNT_KEY];
        $serviceAccountObject = new ServiceAccount($serviceAccountKey);

        return new Config([
            Config::FIELD_REGION_ID          => $cloudConfiguration[Config::FIELD_REGION_ID],
            Config::FIELD_SERVICEACCOUNT_KEY => $serviceAccountObject
        ]);
    }
}

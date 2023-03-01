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

use ImDigital\ServerlessGcp\Model\Cloud\Config\ServiceAccount;

class Config
{
    public const FIELD_REGION_ID          = 'region_id';
    public const FIELD_SERVICEACCOUNT_KEY = 'serviceaccount_key';

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * Regions where Google can host the cloud function
     * @var array
     */
    protected const GCP_REGIONS = [
        'us-central1',
        'us-east1',
        'us-east4',
        'europe-west1',
        'europe-west2',
        'europe-west3',
        'europe-west4',
        'asia-east2',
        'asia-northeast1',
        'asia-northeast2',
        'asia-south1',
        'asia-southeast1',
        'australia-southeast1',
        'southamerica-east1'
    ];

    /**
     * Config constructor.
     * @param array $data
     * @throws \InvalidArgumentException
     */
    public function __construct(array $data)
    {
        if (!isset($data[self::FIELD_REGION_ID])) {
            throw new \InvalidArgumentException('Region ID is required');
        }

        if (!isset($data[self::FIELD_SERVICEACCOUNT_KEY])) {
            throw new \InvalidArgumentException('Service Account Key is required');
        }

        // Validate if the region_id is using one of the accepted regions by google cloud functions
        if (!in_array($data[self::FIELD_REGION_ID], self::GCP_REGIONS)) {
            throw new \InvalidArgumentException('Region ID is not valid');
        }

        if (!$data[self::FIELD_SERVICEACCOUNT_KEY] instanceof ServiceAccount) {
            throw new \InvalidArgumentException('Service Account Key must be an instance of ' . ServiceAccount::class);
        }

        $this->data = $data;
    }

    /**
     * Get region id
     * @return string
     */
    public function getRegionId(): string
    {
        return $this->data[self::FIELD_REGION_ID];
    }

    /**
     * Get service account key
     * @return ServiceAccount
     */
    public function getServiceAccountKey(): ServiceAccount
    {
        return $this->data[self::FIELD_SERVICEACCOUNT_KEY];
    }

    /**
     * Set region id
     * @param string $regionId
     * @throws \InvalidArgumentException
     */
    public function setRegionId(string $regionId): void
    {
        // Validate if the region_id is using one of the accepted regions by google cloud functions
        if (!in_array($regionId, self::GCP_REGIONS)) {
            throw new \InvalidArgumentException('Region ID is not valid');
        }

        $this->data[self::FIELD_REGION_ID] = $regionId;
    }

    /**
     * Set service account key
     * @param ServiceAccount $serviceAccountKey
     */
    public function setServiceAccountKey(ServiceAccount $serviceAccountKey): void
    {
        $this->data[self::FIELD_SERVICEACCOUNT_KEY] = $serviceAccountKey;
    }

    /**
     * Get data
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}

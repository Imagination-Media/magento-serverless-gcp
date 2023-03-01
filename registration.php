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

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(ComponentRegistrar::MODULE, 'ImDigital_ServerlessGcp', __DIR__);

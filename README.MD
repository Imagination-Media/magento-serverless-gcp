<p align="center">
<img alt="Magento logo" src="https://upload.wikimedia.org/wikipedia/en/thumb/5/53/Magento.svg/1280px-Magento.svg.png" width="224px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img alt="Google Cloud logo" src="https://camo.githubusercontent.com/2495e33867d65b0d555c281f82285ec1e13c538363a3fb75621e017e4467a20a/68747470733a2f2f636c6f75642e676f6f676c652e636f6d2f5f7374617469632f636c6f75642f696d616765732f736f6369616c2d69636f6e2d676f6f676c652d636c6f75642d313230302d3633302e706e67" width="124px"/>
</p>
<h2 align="center">
  Google Cloud Functions for the Magento 2 Serverless Framework
</h2>

<h4 align="center"><b>This Magento module will extend the <a href="https://github.com/Imagination-Media/magento-serverless">Magento 2 serverless framework module</a> allowing us to use Google Cloud Functions.</b></h4>

<br/>

<p align="center"><img src="https://img.shields.io/badge/Language-PHP-blue" />&nbsp;<img src="https://img.shields.io/badge/Ecommerce-Magento-orange"/>&nbsp;<img src="https://img.shields.io/badge/Hosting%20Provider-Google%20Cloud-blue" />&nbsp;<img src="https://img.shields.io/badge/Created%20By-IMDigital-orange" /></p>

<br/>

# Installation
## Requirements
- Magento >= 2.4.5-p1
- PHP >= 8.1
- [Grpc for PHP](https://cloud.google.com/php/grpc)

<br/>

## Installing the module and enabling it

To install this module we must run the composer require command requesting its installation:

```ssh
composer require imdigital/magento-serverless-gcp
```

<br/>

Then, enable it by modifying the app/etc/config.php or running the CLI command:

```ssh
php bin/magento module:enable ImDigital_ServerlessGcp
```

<br/>
<br/>

# Serverless function setup
When adding a new serverless function into the ***serverless_functions*** database table, we must use **gcp** as the cloud provider code on the **cloud_provider** field.

The cloud config field expects a (encrypted) JSON on this format:

```json
{
    "region_id": "us-central1",
    "serviceaccount_key": {
        "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
        "auth_uri": "https://accounts.google.com/o/oauth2/auth",
        "client_email": "my-service-account-email",
        "client_id": "my-client-id",
        "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/magento-demo-serverless%40magento-2-demo-366018.iam.gserviceaccount.com",
        "private_key": "my-private-key",
        "private_key_id": "my-private-key-id",
        "project_id": "my-gcp-project-id",
        "token_uri": "https://oauth2.googleapis.com/token",
        "type": "service_account"
    }
}
```

<br/>

The ***region_id*** is the region where the cloud function is hosted. The ***serviceaccount_key*** field is a [service account that we must create](https://cloud.google.com/iam/docs/service-account-overview), and then [generate a JSON service account key](https://cloud.google.com/iam/docs/keys-create-delete) with access to execute the functions.

These are the permissions you must add to your service account in order to be able to execute cloud functions:

<p align="center">
<img src="https://github.com/Imagination-Media/magento-serverless-gcp/blob/master/screenshots/iam-permissions.png" alt="Service Account permissions" />
<i>Service account permissions</i>
</p>

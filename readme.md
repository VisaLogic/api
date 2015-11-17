[![Total Downloads](https://poser.pugx.org/visalogic/api/d/total.svg)](https://packagist.org/packages/visalogic/api)
[![Latest Stable Version](https://poser.pugx.org/visalogic/api/v/stable.svg)](https://packagist.org/packages/visalogic/api)
[![Latest Unstable Version](https://poser.pugx.org/visalogic/api/v/unstable.svg)](https://packagist.org/packages/visalogic/api)
[![License](https://poser.pugx.org/visalogic/api/license.svg)](https://packagist.org/packages/visalogic/api)

# VisaLogic API Class

## 1. Introduction

This document holds the documentation for the Application Programming Interface of VisaLogic. This is a document in whom a technical language will be used and for which technical knowledge is required to implement.

## 2. Installation

### 2.1 Via Composer
Our API class is available through [composer](http://getcomposer.org).

You can install our dependency using the following command:
    
    composer require visalogic/api

In your project you should `require` composer's `autoload.php` file:
    
    <?php
        require 'vendor/autoload.php';

### 2.2 Via Github
Our API class is also available on [Github](http://github.com/visalogic/api).

When you choose to install from Github you need to require all the files in `src/` into your project in the following order:
- Kernel.php
- API.php

## 3 Configuration

All our API classes are namespaces with `VisaLogic`.

### 3.1 Aquire an API key

You can aquire an API key via our [backoffice](backoffice.visalogic.nl).

### 3.2 Setting the API key

You can set the API key by passing it as `__constructor` variable:

    $visalogic = new VisaLogic\Api('your-api-key');

## 4 Available methods

### 4.1 Apply for a visa
You can request a visa by calling the `requestVisa();` method with an multidimentional array which holds arrays with the personalia of the visa applicants. This way you can apply for multiple visa's in one request. This method returns the `application_id` which you can use to request it's status.

> Dates are in YYYY-MM-DD

    $personalia = [
        [
            'first_names' => 'John',
            'last_names' => 'Doe',
            'customer_addressline' => 'Streetname 1',
            'customer_addressline_1' => '9711 AA',
            'customer_city' => 'Groningen',
            'customer_country' => 'NL',
            'date_of_birth' => '1990-01-01',
            'place_of_birth' => 'Groningen',
            'nationality' => 'Dutch',
            'document_type' => 'passport',
            'document_number' => 'AA1BBBB00',
            'document_issue_date' => '2015-01-01',
            'document_expire_date' => '2020-01-01'
        ]
    ];
    
    $applicationId = $visalogic->applyForVisa($personalia);
    
`place_of_birth` can be eigther `Dutch` or `Belgium`, and `document_type` can be `passport` or `id_card`.

### 4.2 Get visa request status

You can request the status of a visa application by calling the following method, with the application_id:

    $application_id = '1';
    $application_status = $visalogic->getStatus($application_id);
    
This method will return one of the following strings:
    
- `WAITING` Application is waiting for visa supplier
- `REJECTED` Application has been rejected
- `APPROVED` Application has been approved

### 4.3 Get visa document

#### 4.3.1 Download PDF
If the application's status is `APPROVED` you can request the visa document by calling `getVisaUrl();`

    $application_id = 1;
    $visalogic->getVisaUrl($application_id);

This method will return an url from which the document can be downloaded

#### 4.3.2 Get plain visa

If the application's status is `APPROVED` you can request the visa document by calling `getVisaPlain();`

    $application_id = 1;
    $visalogic->getVisaPlain($application_id);

This method will return the plain visa as a string

### 4.4 Get rejected visa reason

If the application's status is `REJECTED` you can request the reason for the rejection by calling `getRejectionReason();`

    $application_id = 1;
    $visalogic->getRejectionReason($application_id);
    


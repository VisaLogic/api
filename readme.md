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

When you choose to install from Github you need to require all the files in `src/` into your project.

## 3 Configuration

All our API classes are namespaces with `VisaLogic`.

### 3.1 Aquire an API key

You can aquire an API key via our [backoffice](backoffice.visalogic.nl).

### 3.2 Setting the API key

You can set the API key by passing it through the `constructor`:

    $visalogic = new VisaLogic\Api('your-api-key');

## 4 Available methods

### 4.1 Get your orders
You can request your orders by calling the `getOrders();` method. This will get your last 15 orders.

    $visalogic->getOrders();

The orders are paginated. To request your next 15 orders you can provide a pagenumber as the first argument.

    $visalogic->getOrders($page = 2);

### 4.2 Get an order
To request an order and it's details, you can make a call to the `getOrder();` method. With as parameter it's id.

    $visalogic->getOrder($id = 1);

### 4.3 Creating an order
To create an order you can call the `createOrder();` method. This will return an new `VisaLogic\Resources\Order` instance.

By passing the order details in an array as argument, the properties on the `Order` instance will be set for you.

    $order = $visalogic->createOrder([
        'email'                   => 'johndoe@example.com',
        'phone_number'            => '31' . '12345678',
        'addressee'               => 'John Doe',
        'addressline'             => 'Examplestreet 1',
        'addressline_1'           => '1234 AB City',
        'country'                 => 'NL',
        'customer_purchase_price' => 25,
        'order_created'           => 'YYYY-MM-DD HH:MM:SS'
        'remote_name'             => 'Order 1' // optional
    ]);

Then you can add an application to the order by calling the `addApplication();` method on the `Order` object:

    $order->addApplication([
        'firstnames'           => 'John',
        'lastnames'            => 'Doe',
        'date_of_birth'        => '1990-01-01',
        'place_of_birth'       => 'City',
        'nationality'          => 'NL',
        'document_type'        => 'passport',
        'document_number'      => 'AA1BBBB22',
        'document_issue_date'  => '2010-01-01',
        'document_expire_date' => '2020-01-02',
        'visa_start_date'      => 'YYYY-MM-DD' // This date has to be after yesterday
    ]);

`nationality` can be either `NL` or `BE`, and `document_type` can be `passport` or `id_card`. For one order the all `document_type` values and `visa_start_date` values have to be the same. If this is not the case, please create two seprateo orders.

### 4.3 Submit the order

When you finished creating the order, you can send it to us by using the `postOrder();` method which accepts the `Order` object as first parameter:

    $visalogic->postOrder($order);

### 4.4 Get visa request status

You can request the status of a visa application by calling the following method, with the application_id:

    $application_status = $visalogic->getStatus($application_id = 1);

This method will return one of the following strings:


- `APPROVED` Application has been approved
- `PENDING` Application is pending to be processed
- `BUSY` Application is being processed by visa supplier
- `RECEIVING` Waiting to receive the visa document
- `REJECTED` Application has been rejected


### 4.3 Get the visa document

#### 4.3.1 Download PDF
If the application's status is `APPROVED` you can request the visa document by calling `getVisa();`

    $visalogic->getVisa($application_id = 1);

This method will set headers for a pdf document to be downloaded and returns the visa document.

# Magento 2 Contact Form To Database

Magento 2 plugin to store contact us form submission to database. Lightweight and will not affect existing email functionality.

# Install instructions #

`composer require dominicwatts/contacttodb`

`php bin/magento setup:upgrade`

`php bin/magento setup:di:compile`

# Usage instructions #

Customer submits via standard /contact form

![Screenshot](https://i.snipboard.io/ejoLxD.jpg)

Email is sent

![Screenshot](https://i.snipboard.io/SEcoXY.jpg)

In addition site contact is stored in db and can be edited or deleted using admin grid

    Marketing > Site Contact > Manage

![Screenshot](https://i.snipboard.io/67Kkf1.jpg)
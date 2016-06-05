
APP - basic description

The app is web shop for Hi-Fi products.

Uses Foundation 6, MySQL DB, JQUERY, AJAX, Cron and some packet (part self-made).

App has guest, private and admin part.

Each user has the option to buy products through PayPal and with cards (uses card company Stripe).

The customer also has the option to reserve product through a cart, and letter to give comment and grade to each product (also is an option to letter change grade).

The majority of a function of this app is in the file "public/function.php".

ER - diagram

![alt tag](http://www.consilium-europa.com/github/ecom/er.png)

Public part:

On the first page is an option to access basic categories (wich parent is null), and option to buy products in action.

![alt tag](http://www.consilium-europa.com/github/ecom/01-public.png)
  
Menu content navigation for each public available parts of the app, but if the user is log in, have more option, according to status (customer or admin).

In basic menu is also search part, wich work with ajax and jquery. Search part search product by model name or SKU. SKU is self-generated when a product is created in DB, and in the name have a description of a product.

![alt tag](http://www.consilium-europa.com/github/ecom/02-menu.png)

The app uses basic URL rewrite, with .htaccess.

Category of a product is connected in parent-child connection and option for choosing category is self-generated with the class made for this part of the app.

For user is also an option to check the quality or each category (by user grade) through a diagram.

![alt tag](http://www.consilium-europa.com/github/ecom/03-diagram.png)
 
The contact form is basic and uses only PHP mail function.

![alt tag](http://www.consilium-europa.com/github/ecom/04-contact.png)

The app content detail data of Hi-Fi products, wich user can search through a different category.
 
![alt tag](http://www.consilium-europa.com/github/ecom/05-products.png)


Product pages also content pagination and different order by function.
 
 ![alt tag](http://www.consilium-europa.com/github/ecom/06-paginate.png)

For each product is an option to check images, specification, description, review and grade from customer, price and quantity in stock.  

![alt tag](http://www.consilium-europa.com/github/ecom/07-product.png)

Before buying the item, a user needs to register and log in, through the form. Form for register check all data before user is actually registered, and give a user type of errors through registration process, or log into success register

![alt tag](http://www.consilium-europa.com/github/ecom/08-register.png)
 
![alt tag](http://www.consilium-europa.com/github/ecom/09-login.png)

After adding some item in cart app show user total product in the cart, and also give a customer option to increase and decrease product quantity (max. product quantity is defined by quantity in stock and product in another cart).

![alt tag](http://www.consilium-europa.com/github/ecom/10-cart.png)

After review of the cart, a customer has the option to buy or add some more product in the cart. If custom chooses to buy next will go to checkout part, in wich have the option to rewrite sending address for packet and bill (address is automatically added from user data). If a user holds on cart product more than seven days, 
this product will be deleted from a cart (through Cron task), and data for this unfinished transaction will be stored in DB.

![alt tag](http://www.consilium-europa.com/github/ecom/11-checkout.png)

![alt tag](http://www.consilium-europa.com/github/ecom/12-payment.png)

The user has two option to pay products, and when a transaction is successfully finished, product quantity is removed from stock and in DB is written all data connected with the transaction. 



Privat - customer:



Part for showing and changing personal data.

![alt tag](http://www.consilium-europa.com/github/ecom/13-personal.png)


The customer also has the option to check purchase data, and to have a bill in pdf format.

![alt tag](http://www.consilium-europa.com/github/ecom/14-purchaise.png)

HTML format:

![alt tag](http://www.consilium-europa.com/github/ecom/15-html.png)

PDF format:

![alt tag](http://www.consilium-europa.com/github/ecom/16-pdf.png)


Privat - administrator:


New product:

![alt tag](http://www.consilium-europa.com/github/ecom/17-add.png)

Review and change product dana:

 ![alt tag](http://www.consilium-europa.com/github/ecom/18-edit.png) 

Order history for all users:

![alt tag](http://www.consilium-europa.com/github/ecom/19-orders.png) 

Change the user data and status:

![alt tag](http://www.consilium-europa.com/github/ecom/20-status.png) 
  


















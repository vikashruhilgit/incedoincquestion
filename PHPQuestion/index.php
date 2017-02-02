<?php
	require_once('Clean_string.php');
	require_once('Terminal_service.php');
	$terminal = new Terminal_service();
	//$terminal->set_products('A,B,C,D');
	$terminal->set_product_price('A','2');
	$terminal->set_product_price('B','12');
	$terminal->set_product_price('C','1.25');
	$terminal->set_product_price('D','0.15');
	$terminal->set_product_pack_price('A', '4', '7');
	$terminal->set_product_pack_price('C', '6', '6');
	$terminal->scan_code($_POST['product_txt']);
	$result = $terminal->get_scan_price();
	//$prod = $terminal->get_products();
	//$prod_details = $terminal->get_product_detailss();
	
?>
<!DOCTYPE html>
<html>
<head>
  <title>php demo</title>
</head>
<body>
  <h1>Question</h1>
  <pre>Consider a store where items have prices per unit but also volume
prices. For example, apples may be $1.00 each or 4 for $3.00.

Implement a point-of-sale scanning API that accepts an arbitrary
ordering of products (similar to what would happen at a checkout line)
and then returns the correct total price for an entire shopping cart
based on the per unit prices or the volume prices as applicable.

Here are the products listed by code and the prices to use (there is
no sales tax):
Product Code | Price
--------------------
A            | $2.00 each or 4 for $7.00
B            | $12.00
C            | $1.25 or $6 for a six pack
D            | $0.15

There should be a top level point of sale terminal service object that
looks something like the pseudo-code below. You are free to design and
implement the rest of the code however you wish, including how you
specify the prices in the system:

terminal->setPricing(...)
terminal->scan("A")
terminal->scan("C")
... etc.
result = terminal->total

Here are the minimal inputs you should use for your test cases. These
test cases must be shown to work in your program:

Scan these items in this order: ABCDABAA; Verify the total price is $32.40.
Scan these items in this order: CCCCCCC; Verify the total price is $7.25.
Scan these items in this order: ABCD; Verify the total price is $15.40.
Result is: <?php echo (!empty($result))? $result : 'blank value'; ?>
</pre>

<h1>Your answer can use the form below</h1>
<form method="post" action="index.php">
  <input type="text" name="product_txt" />
  <button type="submit" name="submit">Submit</button>
</form>

</body>
</html>

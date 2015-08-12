# phpProject8-4
PHP Project assigned by Pin Chen on August 4th, 2015

August 4th, 2015
--
Hey all,

So I hear you all want some more programming oriented challenges instead of just doing tests so I'm going to get you guys started on a mini project in addition to what you already do for Brendon. Hopefully it is interesting and you learn alot!

So here is what I would like to be sent a link to

1) Create a github repo <br>
2) Create an html file with a form that collects firstname, lastname, and email <br>
3) Create an php file that the form submits to that will echo out firstname, lastname, email <br>

Push all this to a repo and link me once you're done.

Thanks!

August 5th, 2015
--
Great, let's see if you can get mysql database going locally. 

1) Create a database.<br>
2) Create a table on that database with the columns firstname, lastname, email.<br>
3) On the action_page.php, connect to the database and store the info into the database while also outputting it.<br>

--
Sweet! 

Few changes, remove all the debug code and instead of echoing on the same php page, have it redirect to a thank you page.. saying something like thank you $firstname. That way you can seperate the logic from the html

Onward!

--

As for the reg_date stuff, when dealing with databases, try not to use their baked in time stuff. Generate your own in the code.. so use time() and then plug that into the db.

Also try not to put create statements in your code. You usually want the user who accesses the db be different from the person who inserts data into it.

Thanks!

-- 
Pin Chen
CTO

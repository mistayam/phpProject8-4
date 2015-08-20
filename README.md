# phpProject8-4
PHP Project assigned by Pin Chen on August 4th, 2015

August 4th, 2015 ✔
--
Hey all,

So I hear you all want some more programming oriented challenges instead of just doing tests so I'm going to get you guys started on a mini project in addition to what you already do for Brendon. Hopefully it is interesting and you learn alot!

So here is what I would like to be sent a link to

1) Create a github repo <br>
2) Create an html file with a form that collects firstname, lastname, and email <br>
3) Create an php file that the form submits to that will echo out firstname, lastname, email <br>

Push all this to a repo and link me once you're done.

Thanks!

August 5th, 2015 ✔
--
Great, let's see if you can get mysql database going locally. 

1) Create a database.<br>
2) Create a table on that database with the columns firstname, lastname, email.<br>
3) On the action_page.php, connect to the database and store the info into the database while also outputting it.<br>

August 11th, 2015 ✔
--
Sweet! 

Few changes, remove all the debug code and instead of echoing on the same php page, have it redirect to a thank you page.. saying something like thank you $firstname. That way you can seperate the logic from the html

Onward!

--

As for the reg_date stuff, when dealing with databases, try not to use their baked in time stuff. Generate your own in the code.. so use time() and then plug that into the db.

Also try not to put create statements in your code. You usually want the user who accesses the db be different from the person who inserts data into it.

Thanks!

August 12th, 2015 ✔
--
Because the repository has a history, there isn't a reason to keep useless files. Go ahead and delete the "old" file and check pervious commits to see the changes you've made.

Additionally let's seperate out the mysql details and put them into a config.inc.php file that gets included where needed. Let's add some fields to your form, username and password (password should be password input type) and then cram that info into the database.

Then create another form that when you fill out (username,password) it sees if its in the database and if it is it will redirect to a success.php page that says you have been successful in logging in. If if fails, should redirect back to the login script and say bad creds or bad username.

August 18th, 2015✔
--
Sweet. Do a mysql dump of your database and include it in the PR (don't include any of your test data)

Next create a php object "User"

ideally these calls should work

$user = new User();<br>
$user->setValue("firstname","test");<br>
$user->setValue("lastname","test2");<br>
$user->save();<br>

echo $user->getValue("firstname"); //Should output "test"

User::Get($username)  //Should return a User object with the data populated for that user

Let me know if you need more clarity.

-- 
Pin Chen
CTO

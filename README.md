![title-image](https://i.imgur.com/RHa0TeO.gif)
## What is Honey's Café? 
**Honey's Café** is a public discord server with a welcoming community.

## Why should you join our server?
1. It's **LGBTQ friendly**. You will never feel judged in our community.
2. **SFW**. There will not be any NSFW content.
3. **Partnership**. You can parter with Honey's Café and advertise your own server.
4. **Roles**. Don't like a color? You can change it! Want to buy new roles? You can always do that in our **Sweet Shop**.
5. **Giveaways**. There will be nitro, gift cards and more giveaways.

Convinced yet? Here's our server link:
```bash
https://discord.gg/rpd98DD
```
First, you will need to install PHP and MySQL.
```bash
sudo apt-get install php
sudo apt-get install mysql-server
```
Next you will need to setup the SETUP.php script so everything will work properly.
Open SETUP.php with your favorite text editor in the Cafe-Au-Lait folder.
```bash
nano SETUP.php
```
Scroll down to the **25**th line and change **TITLE** to whatever you want to name your Café.
```php
define("TITLE", "My Developer Team");
```
New edit line **28**, the **TEAM_IMAGE_URL** should be set to the image url your guests see when they open the invitation to join your Café.
```php
define("TEAM_IMAGE_URL", "myInvitationImage.png");
```
Next up is the database setup starting at line **31**.
```php
// DATABASE SETUP
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "myDevTeamDB");
define("DB_USER", "root");
define("DB_PASSWORD", "123456");
```
Make sure to change the encryption key before you host your Café.
Change the two variables in /security/encryption.php
```php
$secret_key = 'abc123';
$secret_iv = '123abc';
```

Once you have everything installed, start the server!
```shell
#      IPADDRESS:PORT
php -S localhost:8080
```
Visit http://localhost:8080 in your browser.

**NOTE:** You may get an error when loading the page for the first time. This is because the script is still setting up the database. To fix this, just reload the page.

Once you create an account and get everything all set up, I recommend giving yourself admin privileges.
To do this, get into the mysql server console.
```bash
mysql -u root -p
```
Then use these commands.
```sql
mysql> use myDevTeamDB;
Database changed
mysql> SELECT name FROM cafeusers;
+----------------------------------+
| name                             |
+----------------------------------+
| YOUR-ENCRYPTED-USERNAME          |
+----------------------------------+
1 rows in set (0.01 sec)

mysql> UPDATE cafeusers SET role="admin" WHERE name="YOUR-ENCRYPTED-USERNAME";
Query OK, 1 row affected (0.00 sec)
Rows matched: 1  Changed: 1  Warnings: 0

mysql> exit
```

Now reload the page and you will see that you are admin! ;)

## If you're admin...
You have privileges to use special commands in the post bar.

**To kick someone**
```bash
/kick USERNAME
```
**Promote Someone To Admin Level**
This will allow this person to kick others as well. (*Just be careful, because admins can kick admins.*)
```bash
/promote USERNAME
```

## Donations
I hope I squashed all the bugs in my code--if I didn't, go ahead and post an issue. I'll respond as quickly as I can.

**Also**, Donations are greatly appreciated. I'm currently trying to start my own business, any donations **(even just $1)** are really appreciated and really help.

**BTC Donations:**  bc1qfpz9q09xmvsk206p0ts6nul88hrxzzkfr4p0rr

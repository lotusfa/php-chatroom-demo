The project is build by HO TIN LONG 20356560.
The environment: Mac OS + XAMPP server + Chrome.
Before running the project, please check the permissions of (chat_msg.json, chat_user.json and uploads) allow read and write.

Here is the structure of this project.

Client Side: 
index.html			-----	1. main page. 2. login/logout 3. keep update chats with update.php 
online_user.html	-----	to show the online user list.

Database:
chat_msg.json		-----	to store the chats records, each of the chat have 3 value. ( username , color , msg )
chat_user.json		-----	to store the users records, each of the user have 3 value. ( username (index) , last_login , icon_url)

Server: 
update.php			-----	1. get latest msg. 2. update last_login of user. 3. get online user
login.php			-----	to push new user data to chat_user.json
send_msg.php		-----	to push new msg data to chat_msg.json


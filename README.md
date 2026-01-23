## Food Blog (NOT FINISHED)


## Prerequisites
- Install XAMPP web server
- Any Editor (Preferably VS Code)
- Any web browser with latest version

## Languages and Technologies used
- HTML/CSS
- JavaScript (to create dynamically updating content)
- Bootstrap (An HTML, CSS, and JS library)
- XAMPP (A web server by Apache Friends)
- Php
- MySQL (An RDBMS that uses SQL)

## Steps to run the project in your machine
-Download and install XAMPP in your machine
-Clone or download the repository
-Extract all the files and move it to the 'htdocs' folder of your XAMPP directory.
-Start the Apache and Mysql in your XAMPP control panel.
-Open your web browser and type 'localhost/phpmyadmin'
-In phpmyadmin page, create a new database from the left panel and name it as 'foodblog'
-Import the file 'foodblog.sql' inside your newly created database and click ok.
-Open a new tab and type 'localhost/foldername' in the url of your browser


Starting Apache And MySQL in XAMPP:
The XAMPP Control Panel allows you to manually start and stop Apache and MySQL. To start Apache or MySQL manually, click the ‘Start’ button under ‘Actions’.

<img width="610" height="377" alt="59350977-fcc68900-8d3a-11e9-9450-e5c478497caa" src="https://github.com/user-attachments/assets/b2bb2e1a-2c7f-42ea-a521-
  8d2aa3a92e99" />

## GETTING INTO THE PROJECT:
## HOMEPAGE
This web page is the homepage for a recipe website called JustATaste. It displays recipe categories like Breakfast, Lunch, Dinner, Dessert, and Snack, each represented by clickable images. The page also highlights featured recipes pulled from a database, showing an image, name, and short description for each. Users can click “Read More” to open a modal with the full recipe details.
The site includes a navigation bar with links to categories and user account options. Logged-in users see a welcome message, a profile icon, and a logout button. Visitors who are not logged in see a login button instead. The footer provides contact information and social media links.
The homepage dynamically loads recipe data from the database and allows users to view detailed recipes without leaving the page, making it an interactive and user-friendly starting point for exploring recipes.
<img width="1917" height="866" alt="Screenshot 2026-01-23 184717" src="https://github.com/user-attachments/assets/28706bfc-4280-408b-b741-ccf0b2047dad" />

<img width="1918" height="875" alt="Screenshot 2026-01-23 184734" src="https://github.com/user-attachments/assets/5cc317f0-aef6-41f3-933a-0d18fa2aa252" />

<img width="1918" height="865" alt="Screenshot 2026-01-23 184744" src="https://github.com/user-attachments/assets/b7200f53-4a6e-46ee-90f5-7ca7852350ba" />

## LOG IN/REGISTER
the login page. It allows users to sign in using their username and password. When the form is submitted, the page checks the entered username against the database and verifies the password using secure password hashing. If the credentials are correct, a session is created, the user’s ID and username are stored, and the user is redirected to the homepage. If the login details are incorrect, the page displays an error message telling the user that the username or password is wrong.

<img width="1918" height="872" alt="Screenshot 2026-01-23 184801" src="https://github.com/user-attachments/assets/b163fc26-6dd9-4f30-817a-8913309fd6a9" />



This page is the user registration page. It allows new users to create an account by entering a username, password, and email address. The page validates user input to ensure the email format is correct and the password is strong, requiring a minimum length, uppercase and lowercase letters, numbers, and special characters. If the chosen username already exists or the input does not meet the requirements, the page displays a clear error message explaining what needs to be fixed. When registration is successful, the password is securely hashed, the user is added to the database, a session is created, and the user is redirected to the homepage as a logged-in user.

<img width="1914" height="864" alt="Screenshot 2026-01-23 184811" src="https://github.com/user-attachments/assets/4e5401b0-648c-4fe4-8bba-8c0ff757a1b5" />

## RECIPES
The recipes pages(Breakfast, Lunch, Dinner, Dessert, Snack) lists all recipes in the breakfast category, showing each recipe with an image, name, short description, and the user who uploaded it.If a user is logged in, they can like or unlike recipes and see the total number of likes. They can also click a button to comment on a recipe. If a user is not logged in, the like and comment buttons are disabled, and clicking them shows a message prompting the user to log in.
The page also has a navigation bar linking to the homepage and other recipe categories, displaying login or logout options depending on whether the user is signed in. When a logged-in user clicks logout, their session ends and they return to the page as a guest.
Likes are stored in the database, so the page shows which recipes the user has already liked. When a like or unlike happens, the page reloads and preserves the scroll position so the user stays in the same place.  

<img width="1917" height="865" alt="Screenshot 2026-01-23 184825" src="https://github.com/user-attachments/assets/0428df9e-e9b6-4c22-a05e-ac41c1607ea9" />
All recipes pages(Breakfast, Lunch, Dinner, Dessert, Snack) have the same layout

## PROFILE
This page is the user profile dashboard. It is only accessible to logged-in users and serves as a personal space where users can manage their own recipes.
When the page loads, it identifies the currently logged-in user and displays a navigation bar with recipe categories, a welcome message using the user’s username, and logout and profile options.
The main section shows all recipes uploaded by the user. Each recipe is displayed with its image, title, and short description. From this page, users can edit or delete their own recipes, giving them full control over the content they have shared. If the user has not uploaded any recipes yet, the page clearly informs them.
An upload button is provided at the bottom, allowing users to add new recipes directly from their profile. The page ends with a footer containing contact details and social media links.
<img width="1919" height="860" alt="Screenshot 2026-01-23 190337" src="https://github.com/user-attachments/assets/26652dba-848b-4037-bb13-64982b2083f1" />
<img width="1917" height="874" alt="Screenshot 2026-01-23 190409" src="https://github.com/user-attachments/assets/3b2c64e4-5230-4c3f-9135-97e3cc234151" />

## EDIT RECIPES
This page allows a logged-in user to edit one of their own recipes. If the user is not logged in, they are redirected to the login page. The page also verifies that the recipe being edited belongs to the current user, preventing unauthorized edits.
When the page loads, it retrieves the selected recipe’s current title, description, and image and pre-fills them into an edit form. The user can update the recipe title and description and optionally upload a new image. If no new image is uploaded, the existing one is kept.
After submitting the form, the recipe is updated in the database. A confirmation popup is shown to inform the user that the update was successful, and the user can return to their profile page afterward.
<img width="1918" height="863" alt="Screenshot 2026-01-23 190349" src="https://github.com/user-attachments/assets/7b5dd86d-8a87-4c2e-a349-14d9eba8c965" />





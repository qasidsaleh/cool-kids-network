
# Cool Kids Network Plugin Explanation

## The Problem to Be Solved
The aim of the "Cool Kids Network" WordPress plugin is to enable signup/signin, see character data and admin can  update user roles dynamically and display user-specific content through shortcodes. A key feature of the plugin is providing the ability to update a user's role via a REST API endpoint, which can be accessed through tools like PowerShell. This plugin should simplify role management, provide customizable features, and display all users data based on user roles.

## Folder Structure
```
cool-kids-network/
├── includes/
│   ├── class-api-endpoint.php
│   ├── class-character-data.php
│   ├── class-role-handler.php
│   ├── class-shortcodes.php
│   └── class-user-access.php
├── templates/
│   ├── character-data.php
│   ├── login-form.php
│   └── signup-form.php
├── assets/
│   ├── css
|       ├── style.css
└── main.php
```

## How It Works

### Plugin Features
1. **Role Management**:
   - Adds custom roles (`cool_kid`, `cooler_kid`, `coolest_kid`).
   - Provides functionality to update a user's role via the REST API endpoint.

2. **Shortcodes**:
   - `[ckn_signup_form]`: Display Signup Form
   - `[ckn_login_form]`: Display Signin Form
   - `[ckn_character_data]`: Display User Data if loggedin
   - `[user_list]`: Displays a list of all users based on `cooler_kid`, `coolest_kid` role.

3. **REST API Endpoint**:
   - URL: `https://wakeful-channel.localsite.io/wp-json/ckn/v1/change-role`
   - Accepts a `POST` request with parameters to update the user's role.

4. **Templates**:
   - Custom signup and login forms styled for the plugin.

### Code Overview
#### Main Plugin File
- `main.php`: This file initializes the plugin, loads the necessary files, and registers activation/deactivation hooks.

#### Includes Directory
- `class-role-handler.php`: Manages custom roles by adding or removing them during plugin activation and deactivation.
- `class-api-endpoint.php`: Defines the REST API endpoint to update user roles.
- `class-character-data.php`: Handles functionality related to character data.
- `class-shortcodes.php`: Registers and defines the `[ckn_signup_form]`, `[ckn_login_form]`, `[ckn_character_data]` shortcode.
- `class-user-access.php`: Handles all user data based on roles.

#### Templates Directory
Contains PHP files for rendering signup and login forms, as well as character data.

#### Assets Directory
- `style.css`: Contains custom CSS for the plugin.

## Technical Specification

### REST API Endpoint Design
- **Route**: `/ckn/v1/change-role`
- **Method**: `POST`
- **body**:
  - `email` (string, required): The user's email address.
  - `role` (string, required): The new role to assign.
- **PowerShell Command**:
```powershell
   $headers = @{
      "Content-Type" = "application/json"
   }

   $body = @{
      "email" = "test@test.com"
      "role" = "coolest_kid"
   }

   $cred = Get-Credential

   Invoke-RestMethod -Uri "https://wakeful-channel.localsite.io/wp-json/ckn/v1/change-role" -Method POST -Headers $headers -Body ($body | ConvertTo-Json) -Credential $cred
```

#### Auth Credentials
- `Username` admin
- `Password` Test12345##


### How the Endpoint Works
1. The `class-api-endpoint.php` file registers the `/change-role` endpoint.
2. It validates the incoming request to ensure the `email` and `role` fields are provided.
3. It verifies that the role is valid and updates the user's role in the database.
4. If successful, a JSON response confirms the update.

## Technical Decisions

1. **Custom Roles**:
   - Chose descriptive role names (`cool_kid`, `cooler_kid`, `coolest_kid`) to align with the theme.

2. **REST API**:
   - Provides a secure and scalable way for administrators to update user roles programmatically.

3. **Shortcodes**:
   - Enables dynamic, user-specific content display in WordPress posts or pages.

4. **Templates**:
   - Simplifies the integration of custom signup and login forms.

5. **Styling**:
   - Enqueued separately for maintainability.

## How the Solution Meets the Admin's Needs
The plugin provides administrators with a simple interface to:
1. Dynamically update user roles through an API.
2. Display personalized content via shortcodes.
3. Leverage role-based access controls to enhance the user experience.

## Approach to the Problem

### How I Thought About It
- Focused on extensibility and ease of use.
- Followed WordPress coding standards for compatibility and reliability.

### Why This Direction
- REST API provides flexibility and can integrate with external systems.
- Shortcodes allow admins to easily display content without modifying code.

### Why It's a Better Solution
- Combines automation with ease of use.
- Streamlines user role management without requiring admin dashboard navigation.

## Temporary Live URL
[Cool Kids Network Demo Site](https://wakeful-channel.localsite.io/)
#### Auth Credentials
- `Username` admin
- `Password` Test12345##

## WP Admin Access
[Cool Kids Network Demo Site Admin URL](https://wakeful-channel.localsite.io/wp-admin/)
- `Username` admin
- `Password` Test12345##

## Git Repository
[GitHub - Cool Kids Network](https://github.com/qasidsaleh/cool-kids-network)


## Next Steps
- Enhancements: Add more custom shortcodes for richer content display.
- Caching: Implement caching to optimize performance for large user bases.
- Role Hierarchies: Add support for hierarchical roles.

#### Thank you for using the Cool Kids Network plugin! 

## Author
Qasid Saleh
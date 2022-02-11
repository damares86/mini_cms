# Mini Cms

The Mini Cms is a solution that allows you create and manage little websites or blog.
It offers many features:
- create and manage user with 2 different roles
- blog functions (post and category creation)
- create and manage your website's pages
- change website's theme (and if you know html and css you can create a theme on your own)

## Install

Install Mini Cms is very easy.
The only thing you need are:
- an host for your website
- a MySql db with user and password

### Step-by-Step

1. Download the latest release of Mini Cms or clone the repository
2. Copy all the file on your localhost or web server
3. With your browser, go to the Mini Cms folder
4. The page will show you a form: fill it with the requested information, including your email and a password
5. Submit the form and "that's all folks" (it means that Mini Cms will create all the db tables and record he needs)
6. Login into the admin area using the email and password that you choose during the registration

## Interface overview
![minicms](https://user-images.githubusercontent.com/85158984/153583519-6a5c5f12-3b1b-4df9-99a0-a2084b8714ce.png)


## User

In Mini Cms users are the people who are allowed to modify the website's contents. 
There are 2 specific roles, which different level of permissions.
The only thing that only the Administrator is allowed to do is create and manage users.


### Role

#### Editor

It can create, modify and delete pages, posts and categories.
It can also manage website's settings, like site name or theme.

#### Contributor

It can only create, modify and delete posts and categories.


### Profile

In this tab, every user can change his username, email and password.


## Post

You can manage the existing posts or create a new post using a simple WYSIWYG editor.
On creating a new post, you can choose the title and the category of the post.
Then you will find two different editor in "Add new post".

### Summary vs Content

The first one, called **Summary** is for the preview of the post, that will be shown in the blog page where all the post will be shown.
The second one, called **Content** is for the content of the post, this will be shown by clicking **Continue reading ->**.

## Categories

You can create new categories that will automatically added to the available category for the posts.

## Pages

You can create, manage and delete all the the page that you need (except from the index page, that can be only edited, and blog pages).
I created a specific structure for the pages, that will be explained below.

### Your page in "6 blocks"

![minicms_layout](https://user-images.githubusercontent.com/85158984/153586670-e59669b5-728a-43e2-9c99-83ab65648d31.png)

When you create a new page, you will have the possibility to insert various content in max 6 blocks (one per editor).
The image above shows the **6 blocks** of the pages. This is the default behaviour of the blocks as they are set in the css file.
If you want to modify one or more block's behaviour, you can customize it in the custom.css (see the[Managing themes](#managing-themes) section).

### Background and text color

## Files

## Site settings

### Menu

## Theme settings

## Managing themes






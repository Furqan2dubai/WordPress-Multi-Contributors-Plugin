Assignment - 2: WordPress Contributors Plugin
This plugin will test if you are familiar with WordPress metabox functionality. Goal is to create a plugin so that we can
display more than one author-name on a post.
Admin-Side:
Add a new metabox, labeled "contributors" to WordPress post-editor page.
This metabox will display list of authors (wordpress users) with a checkbox for each author.
User (author/editor/admin) may tick one or more authors name from the list.
When post saves, states of checkboxes for author-list in "contributors" box must be saved as well.
Front-end:
Use a post-content filter.
At the end of post, display a box called "Contributors".
It will have list of authors checked for that post.
Show contributor names with their Gravatars.
Contributor-names must be clickable and will link to their respective "author" page.
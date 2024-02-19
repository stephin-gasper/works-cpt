# Works Custom Post Type

> A CPT for showing projects and contributions made by developer

## Description

This WordPress plugin registers a custom post type called Works for showing projects and contributions made by developer, making it easy to create an impressive portfolio website. It also registers separate custom taxonomy for categories called work category.

This plugin doesn't change how work items are displayed in your theme. You will need to add templates for archive-work.php and single-work.php if you want to customize the display of work items.

## Plugin Information

- Plugin Name: Works Custom Post Type
- Description: A CPT for showing projects and contributions made by developer
- Author: Stephin Gasper
- Author URI: [stephingasper.com](https://stephin-gasper.vercel.app)
- Version: 1.0.0
- License: MIT
- License URI: https://mit-license.org/

## Installation

### Upload

1. Download the latest tagged archive (choose the "zip" option).
2. Go to the **Plugins -> Add New** screen and click the **Upload** tab.
3. Upload the zipped archive directly.
4. Go to the Plugins screen and click **Activate**.

### Manual

1. Download the latest tagged archive (choose the "zip" option).
2. Unzip the archive.
3. Copy the folder to your `/wp-content/plugins/` directory.
4. Go to the Plugins screen and click **Activate**.

Check out the Codex for more information about [installing plugins manually](https://wordpress.org/documentation/article/manage-plugins/#manual-plugin-installation-1).

### Git

1. Using command line, browse to your `/wp-content/plugins/` directory and clone this repository.
2. Then go to your Plugins screen and click **Activate**.

## Dependency

This plugin has optional dependency on [MetaBox](https://wordpress.org/plugins/meta-box/) which is used to display additional information for your work like website URL, tech stack, platform, github url, domain, featured image url( optional field, useful when hosting images separately)

## Usage

- Works can be managed under **Works** in the WordPress dashboard.
- Each Work entry can have the following fields:

  - **Title:** *(Text)* The title of the work.
  - **Content:** *(Gutenberg Editor)* A detailed description of the work.
  - **Work Category:** *(Combobox)* The categories associated with the work.
  - **Featured Image:** *(Wordpress Image Gallery)* Image associated with the work.
  - **Excerpt:** *(Textarea)* A brief description of the work.
  - **Page Attribute:** *(Text)* Set order in which the work will be displayed.
  - **Website URL:** *(URL)* The URL of the project.
  - **Tech Stack Highlights:** *(Checkboxes)* The highlighted tech stack utilized in the project, fetched from tech stack custom taxonomy. *(Multiple selections allowed)*
  - **Tech Stack:** *(Checkboxes)* The tech stack utilized in the project, fetched from tech stack custom taxonomy. *(Multiple selections allowed)*
  - **Platform:** *(Checkboxes)* The platforms which the project is built for. *(Multiple selections allowed)*
  - **Github URL:** *(URL)* The URL of the Github project if it is open source.
  - **Domain:** *(Text)* The domain of the work.
  - **Featured Image Url:** *(URL)* The featured image url of the work hosted on different server, supports multiple entries to display list of images
- Add tech stacks under **Works -> Tech Stacks**
- Add categories for work under **Works -> Work Categories**

## Screenshot

![Edit page](https://i.ibb.co/gTfdf8w/works-cpt.png)
![Tech Stack page](https://i.ibb.co/b7rzHFX/works-cpt-tech-stack.png)

## Contributors

Stephin Gasper - [stephingasper.com](https://stephin-gasper.vercel.app/)

## License

This plugin is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

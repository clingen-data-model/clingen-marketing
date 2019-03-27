# clinicalgenome.org

This repository includes the code for the clinicalgenome.org website. There are two directories under root important to this project:

**deploy**: This directory contains Ansible scripts sufficient for updating an existing site, or installing the base for a new site, except for the initial DB and the site's uploaded assets.

**processwire**: this directory contains the code, modules, and templates necessary for the website. It's contents will be rsync'd to the destination folder when the deploy scripts are run.

## Installing

Ansible is required to run the deployment scripts. To install, follow the set of instructions appropriate to your platform: https://docs.ansible.com/ansible/latest/installation_guide/intro_installation.html

After installing Ansible, it is also necessary to configure it to use the password to decrypt the secrets stored in the repository. The ansible vault guide will be helpful for understanding the usage of this file: https://docs.ansible.com/ansible/latest/user_guide/vault.html

## Deployment

site.yml is the master playbook for deploying the site. This playbook is idempotent and sufficient for both an initial deployment and incremental updates.

When deploying the site for the first time, a couple steps must be performed manually: the pw database in MariaDB must be initialized and the site's assets must be uploaded. In future this will be automated.

To run the deployment script, the following command will suffice once your secrets file is properly configured:

    ansible-playbook -i <target> site.yml

### Initialize DB

The site is run from the pw database on localhost, with user pw and password pw. MariaDB is not reachable from other hosts. Copy a current sql dump to the deployment server and import it into the pw database to initialize it, eg:

    mysql -upw -ppw pw < db_dump.sql

### Copy assets

The contents of /processwire/site/assets are dynamic at runtime and cannot be maintained in version control. There must exist on the target system a directory /data/processwire-assets owned by www-data that contains these asset files (likely copied from your development system or a recent backup). The deployment script will susbtitute a symlink to this directory for the /processwire/site/assets directory, preventing these files from being altered or modified during site updates.

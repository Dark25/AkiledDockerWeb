# Akiled Docker
### A simple way to setup a private Habbo server, in only two commands.

## Requirements
* Python 3
* [Just](https://github.com/casey/just#packages)
* [Docker](https://docs.docker.com/get-docker/)
* [Docker Compose](https://docs.docker.com/compose/install/)
  * Note: If you are using Docker Desktop, this comes pre-installed
## Installation Instructions

1. Clone this repository - it might take a _very_ long time:
``git clone --recursive https://github.com/Dark25/AkiledDockerWeb.git``
2. Initiate the setup procedure: `just setup`
3. Create a User, and, in PhpMyAdmin, set it's rank to `25`
   1. Alternatively, run `just createUser` to create a new user automatically. This does require the MariaDB C Connector.
   2. On Ubuntu, this can be installed by running `just installUbuntuDeps`
   4. (optional) In Fedora it is common for partitions to be limited so use this command to verify the partition ``lvscan`` In Fedora it is common for partitions to be limited, so use this command to check the adsda partition and if it is available, add what you need ``sudo lvextend --size +5.9G --resizefs /dev/fedora_ip9/root``


## Operation Instructions

### Starting the server

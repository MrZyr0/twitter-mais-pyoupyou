# twitter-mais-pyoupyou


## Install

To install the project you need first to :


### Install PHP 7.2
```bash
sudo apt-get update
sudo apt-get install apt-transport-https lsb-release ca-certificates
sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list
sudo apt-get update
sudo apt-get install php7.2-cli php7.2-xml php7.2-curl zip
```


### Install the latest version of Composer
[Follow official composer documentaiton](https://getcomposer.org/download/)


### Install MariaDB

##### Install
```bash
sudo apt-get install mariadb-server
```
##### Run it
```bash
sudo service mysql start
```

##### Setup it
Replace `#USER#` and `#PASS#` bay your personnal username and password

```bash
sudo mysql -uroot
USE mysql;
DELETE FROM user WHERE user = "";
CREATE USER "#USER#"@"%" IDENTIFIED BY "#PASS#";
GRANT ALL PRIVILEGES ON *.* TO "#USER#"@"%";
FLUSH PRIVILEGES;
exit
```


<!-- ### Install NodeJS

```bash
bash -c "curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -"
sudo apt-get update
sudo apt-get install nodejs
```

### Install Yarn

```bash
sudo npm install --global yarn
``` -->


### Clone the project
Go where you want the project to be
```bash
clone git@github.com:tentacode-classroom/twitter-mais-pyoupyou.git
```

### Install the composer dependencies
Go into the project folder that you just clone
```bash
composer i
```

### Execute the install command
<!-- Go into the project folder that you just clone -->
```bash
php bin/console app:install
```

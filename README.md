# CiscoRank

## Instalação

```bash
sudo apt install -y \
apache2 \
git \
libapache2-mod-php \
memcached  \
php \
php-bcmath \
php-curl \
php-mbstring \
php-memcached \
php-zip

sudo a2enmod rewrite &&
sudo a2enmod ssl &&
sudo systemctl restart apache2
```
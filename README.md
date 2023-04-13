# CiscoRank

## Instalação

```bash
sudo apt install -y \
apache2 \
cron \
git \
libapache2-mod-php \
memcached  \
php \
php-bcmath \
php-curl \
php-mbstring \
php-memcached \
php-zip &&
sudo a2enmod rewrite &&
sudo a2enmod ssl &&
sudo systemctl restart apache2
```

## Memcache

```bash
sudo nano /etc/memcached.conf && sudo /etc/init.d/memcached restart
```

Configure com 2048 mb de limtie de memória e 128 mb por item:

```
-m 2048
-I 128M
```

## Crontab

Roda o cron.php a cada 1 hora

```
0 * * * * php -f /var/www/ciscorank.com/bin/cron.php > /dev/null &
```